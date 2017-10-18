<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class TermFee extends Model
{
    protected $table = 'term_fee_tbl';
    public $timestamps = false;

    function getClass($id)
    {
        try {
            $cls = DB::table('class_category_tbl')
                ->join('student_class_tbl', 'student_class_tbl.class_cat_id', '=', 'class_category_tbl.class_cat_id')
                ->select('class_category_tbl.class_category', 'class_category_tbl.main_class_id', 'student_class_tbl.class_cat_id')
                ->where('student_class_tbl.admission_no', '=', $id)
                ->get();
            return array($cls[0]->class_category, $cls[0]->class_cat_id, $cls[0]->main_class_id);
        } catch (QueryException $ex) {
            return E111;
        }
    }//return class name

    function getCountTotPaid($id, $cls, $yr)
    {
        $result = DB::table($this->table)
            ->select(DB::raw(' COUNT(amount) AS preCount ,SUM(amount) AS preAmt'))
            ->where([['admmision_no', '=', $id], ['class_cat_id', '=', $cls], ['year', '=', $yr]])
            ->get();
        return array($result[0]->preCount, $result[0]->preAmt);
    }//get count and total paid amount of paid terms in pre primary

    function isFullPaid($id, $cls, $yr, $term, $pMethod)
    {
        $result = DB::table($this->table)
            ->where([['admmision_no', '=', $id], ['class_cat_id', '=', $cls], ['year', '=', $yr], ['term_name', '=', $term], ['payment_method', '=', $pMethod]])
            ->exists();
        return $result;
    }//check full paid for terms

    function getTermCountPaid($id, $cls, $yr, $term)
    {
        $result = DB::table($this->table)
            ->select(DB::raw(' COUNT(amount) AS SCount ,SUM(amount) AS SPaidAmt'))
            ->where([['admmision_no', '=', $id], ['class_cat_id', '=', $cls], ['year', '=', $yr], ['term_name', '=', $term]])
            ->get();
        return array($result[0]->SCount, $result[0]->SPaidAmt);
    }//get payment count of term & total paid amount for term

    function getTinv($tbl, $ext)
    {
        $result = DB::table($tbl)->select('T_inv_no')->orderBy('term_id', 'desc')->limit(1)->get();
        $id = substr($result[0]->T_inv_no, 4);
        return $ext . ($id + 1);
    }//return next term fee invoice No

    function getEinv($tbl, $ext)
    {
        $result = DB::table($tbl)->select('ex_inv_no')->orderBy('exam_id', 'desc')->limit(1)->get();
        $id = substr($result[0]->ex_inv_no, 4);
        return $ext . ($id + 1);
    }//return next Exam fee invoice No

    function getExtinv($tbl, $ext)
    {
        $result = DB::table($tbl)->select('ex_inv_no')->orderBy('ex_curr_id', 'desc')->limit(1)->get();
        $id = substr($result[0]->ex_inv_no, 6);
        return $ext . ($id + 1);
    }//return next Extra curricular fee invoice No

    function saveTermfee($term, $adNo, $cls, $amt, $date, $Pmethod, $yr)
    {
        $TF = new TermFee();
        $TF->term_name = $term;
        $TF->admmision_no = $adNo;
        $TF->class_cat_id = $cls;
        $TF->amount = $amt;
        $TF->term_invoice_date = $date;
        $TF->payment_method = $Pmethod;
        $TF->year = $yr;
        $TF->save();//save term fee details

        $id = TermFee::select('term_fee_id')
            ->where([['term_name', '=', $term], ['admmision_no', '=', $adNo], ['class_cat_id', '=', $cls], ['amount', '=', $amt], ['term_invoice_date', '=', $date], ['payment_method', '=', $Pmethod], ['year', '=', $yr]])
            ->get();//return inserted term fee id
        return $id[0]->term_fee_id;
    }

    function saveTerm($tbl, $termid, $inv)
    {
        DB::table($tbl)
            ->insert([
                'term_fee_id' => $termid,
                'T_inv_no' => $inv
            ]);
    }//save term invoice no

    function saveExam($tbl, $termid, $inv)
    {
        DB::table($tbl)
            ->insert([
                'term_fee_id' => $termid,
                'ex_inv_no' => $inv
            ]);
    }//save exam invoice no

    function saveExtCurry($tbl, $termid, $inv)
    {
        DB::table($tbl)
            ->insert([
                'term_fee_id' => $termid,
                'ex_inv_no' => $inv
            ]);
    }//save extra curricular invoice no

    function isAlreadyInserted($term, $adNo, $cls, $amt, $date, $Pmethod, $yr)
    {
        $id = DB::table($this->table)
            ->where([['term_name', '=', $term], ['admmision_no', '=', $adNo], ['class_cat_id', '=', $cls], ['amount', '=', $amt], ['term_invoice_date', '=', $date], ['payment_method', '=', $Pmethod], ['year', '=', $yr]])
            ->exists();
        return $id;
    }//check is already inserted

    function TotTfee($date, $tbl)
    {
        $TotFTF = DB::table($tbl)
            ->select(DB::raw('IFNULL(SUM(amount-(exam_fee+extra_cur_fee)),0) AS TotTamt'))
            ->join($this->table, 'term_fee_tbl.term_fee_id', '=', $tbl . '.term_fee_id')
            ->join('student_class_tbl', 'student_class_tbl.admission_no', '=', 'term_fee_tbl.admmision_no')
            ->join('class_category_tbl', 'class_category_tbl.class_cat_id', '=', 'student_class_tbl.class_cat_id')
            ->join('main_class_tbl', 'main_class_tbl.main_class_id', '=', 'class_category_tbl.main_class_id')
            ->where('term_fee_tbl.term_invoice_date', '=', $date)
            ->whereIn('payment_method', [1, 4])
            ->get();
        $TotHTF = DB::table($tbl)
            ->select(DB::raw('SUM(amount) AS TotTamt'))
            ->join($this->table, 'term_fee_tbl.term_fee_id', '=', $tbl . '.term_fee_id')
            ->join('student_class_tbl', 'student_class_tbl.admission_no', '=', 'term_fee_tbl.admmision_no')
            ->join('class_category_tbl', 'class_category_tbl.class_cat_id', '=', 'student_class_tbl.class_cat_id')
            ->join('main_class_tbl', 'main_class_tbl.main_class_id', '=', 'class_category_tbl.main_class_id')
            ->where('term_fee_tbl.term_invoice_date', '=', $date)
            ->whereIn('payment_method', [2, 3])
            ->get();
        return $TotFTF[0]->TotTamt + $TotHTF[0]->TotTamt;
    }//total term fee according to date

    function TotEfee($date, $tbl)
    {
        $TotTF = DB::table($tbl)
            ->select(DB::raw('IFNULL(SUM(exam_fee),0) AS TotEamt'))
            ->join($this->table, 'term_fee_tbl.term_fee_id', '=', $tbl . '.term_fee_id')
            ->join('student_class_tbl', 'student_class_tbl.admission_no', '=', 'term_fee_tbl.admmision_no')
            ->join('class_category_tbl', 'class_category_tbl.class_cat_id', '=', 'student_class_tbl.class_cat_id')
            ->join('main_class_tbl', 'main_class_tbl.main_class_id', '=', 'class_category_tbl.main_class_id')
            ->where('term_fee_tbl.term_invoice_date', '=', $date)
            ->get();
        return $TotTF[0]->TotEamt;
    }//total exam fee according to date

    function TotExtfee($date, $tbl)
    {
        $TotTF = DB::table($tbl)
            ->select(DB::raw('IFNULL(SUM(extra_cur_fee),0) AS TotExtamt'))
            ->join($this->table, 'term_fee_tbl.term_fee_id', '=', $tbl . '.term_fee_id')
            ->join('student_class_tbl', 'student_class_tbl.admission_no', '=', 'term_fee_tbl.admmision_no')
            ->join('class_category_tbl', 'class_category_tbl.class_cat_id', '=', 'student_class_tbl.class_cat_id')
            ->join('main_class_tbl', 'main_class_tbl.main_class_id', '=', 'class_category_tbl.main_class_id')
            ->where('term_fee_tbl.term_invoice_date', '=', $date)
            ->get();
        return $TotTF[0]->TotExtamt;
    }//total extra curricular fee according to date

    function getMonthlyTF($Fd, $Td, $tbl)
    {
        $t1 = DB::select(DB::raw('SELECT TF.term_invoice_date,TF.admmision_no,amount-(exam_fee+extra_cur_fee) AS amount
FROM ' . $tbl . ' AS T
INNER JOIN term_fee_tbl AS TF ON TF.term_fee_id=T.term_fee_id
INNER JOIN student_class_tbl AS S ON S.admission_no=TF.admmision_no
INNER JOIN class_category_tbl AS CT ON CT.class_cat_id=S.class_cat_id
INNER JOIN main_class_tbl AS M ON M.main_class_id=CT.main_class_id
WHERE TF.term_invoice_date BETWEEN "' . $Fd . '" AND "' . $Td . '" AND payment_method IN (1,4)'));

        $t2 = DB::select(DB::raw('SELECT TF.term_invoice_date,TF.admmision_no,amount 
FROM ' . $tbl . ' AS T
INNER JOIN term_fee_tbl AS TF ON TF.term_fee_id=T.term_fee_id
INNER JOIN student_class_tbl AS S ON S.admission_no=TF.admmision_no
INNER JOIN class_category_tbl AS CT ON CT.class_cat_id=S.class_cat_id
INNER JOIN main_class_tbl AS M ON M.main_class_id=CT.main_class_id
WHERE TF.term_invoice_date BETWEEN "' . $Fd . '" AND "' . $Td . '" AND  payment_method IN (2,3)'));
        return [$t1, $t2];
    }//return all monthly term fee

    function getMonthlyEF($Fd, $Td, $tbl)
    {
        $MEF = DB::select(DB::raw('SELECT TF.term_invoice_date,TF.admmision_no,exam_fee
FROM ' . $tbl . ' AS T
INNER JOIN term_fee_tbl AS TF ON TF.term_fee_id=T.term_fee_id
INNER JOIN student_class_tbl AS S ON S.admission_no=TF.admmision_no
INNER JOIN class_category_tbl AS CT ON CT.class_cat_id=S.class_cat_id
INNER JOIN main_class_tbl AS M ON M.main_class_id=CT.main_class_id
WHERE TF.term_invoice_date BETWEEN "' . $Fd . '" AND "' . $Td . '"'));

        return $MEF;
    }//return all monthly exam fee

    function getMonthlyExtF($Fd, $Td, $tbl)
    {
        $MExtF = DB::select(DB::raw('SELECT TF.term_invoice_date,TF.admmision_no,extra_cur_fee
FROM ' . $tbl . ' AS T
INNER JOIN term_fee_tbl AS TF ON TF.term_fee_id=T.term_fee_id
INNER JOIN student_class_tbl AS S ON S.admission_no=TF.admmision_no
INNER JOIN class_category_tbl AS CT ON CT.class_cat_id=S.class_cat_id
INNER JOIN main_class_tbl AS M ON M.main_class_id=CT.main_class_id
WHERE TF.term_invoice_date BETWEEN "' . $Fd . '" AND "' . $Td . '"'));

        return $MExtF;
    }//return all monthly extra curricular fee

    function viewTFHistory($id)
    {
        $t = DB::select(DB::raw(' SELECT TF.admmision_no,CONCAT(SD.std_fname,SD.std_lname) AS stname,CT.class_category,TF.term_invoice_date,TC.term_cat,
 IF(TF.payment_method=1,"1st Payment",IF(TF.payment_method=2,"2nd Payment",IF(TF.payment_method=3,"3rd Payment",IF(TF.payment_method=4,"Full Payment","other")))) 
 AS payment_method ,TF.amount,TF.year AS yrs
 FROM term_fee_tbl AS TF
 INNER JOIN student_class_tbl AS S ON S.admission_no=TF.admmision_no
 INNER JOIN class_category_tbl AS CT ON CT.class_cat_id=S.class_cat_id
 INNER JOIN term_cat_tbl AS TC ON TC.term_name=TF.term_name
INNER JOIN (SELECT * FROM bc_student_details_tbl  UNION SELECT * FROM nc_student_details_tbl) AS SD ON SD.admission_no=TF.admmision_no
 WHERE TF.admmision_no="' . $id . '" AND TC.term_id  LIKE CONCAT(SUBSTR("' . $id . '",1,2),"%")'));
        return $t;
    }//return all term fee history according to student admission no

    function printTFInv()
    {
        $tbl = DB::select(DB::raw('
SELECT invNo,adNo,name,cls,Ftype,month,amt,date,term,term_fee_id
FROM(
SELECT T.T_inv_no AS invNo,TF.admmision_no AS adNo,CONCAT(SD.std_fname,SD.std_lname) AS name,CT.class_category AS cls,"Term Fees" AS Ftype,
 IF(TC.term_id="BC_1",IF(TF.payment_method=1,"SEP",IF(TF.payment_method=2,"OCT",IF(TF.payment_method=3,"NOV and DEC","Full Term"))) ,
 IF(TC.term_id="BC_2",IF(TF.payment_method=1,"MAY",IF(TF.payment_method=2,"JUN",IF(TF.payment_method=3,"JUL and AUG","Full Term"))),
  IF(TC.term_id="BC_3",IF(TF.payment_method=1,"JAN",IF(TF.payment_method=2,"FEB",IF(TF.payment_method=3,"MAR and APR","Full Term"))),
  IF(TC.term_id="NC_1",IF(TF.payment_method=1,"JAN",IF(TF.payment_method=2,"FEB",IF(TF.payment_method=3,"MAR and APR","Full Term"))),
  IF(TC.term_id="NC_2",IF(TF.payment_method=1,"MAY",IF(TF.payment_method=2,"JUN",IF(TF.payment_method=3,"JUL and AUG","Full Term"))),
  IF(TF.payment_method=1,"MAY",IF(TF.payment_method=2,"JUN",IF(TF.payment_method=3,"JUL and AUG","Full Term")))))))) AS month ,
  IF(payment_method=1 OR payment_method=4,amount-(exam_fee+extra_cur_fee),amount) AS amt,TF.term_invoice_date AS date,TC.term_cat AS term,TF.term_fee_id 
FROM (SELECT * FROM nc_term_tbl  UNION SELECT * FROM bc_term_tbl) AS T
INNER JOIN term_fee_tbl AS TF ON TF.term_fee_id=T.term_fee_id
INNER JOIN student_class_tbl AS S ON S.admission_no=TF.admmision_no
INNER JOIN class_category_tbl AS CT ON CT.class_cat_id=S.class_cat_id
INNER JOIN main_class_tbl AS M ON M.main_class_id=CT.main_class_id
INNER JOIN term_cat_tbl AS TC ON  TC.term_name=TF.term_name
INNER JOIN (SELECT * FROM nc_student_details_tbl  UNION SELECT * FROM bc_student_details_tbl) AS SD ON SD.admission_no=TF.admmision_no
 WHERE TC.term_id  LIKE CONCAT( M.c_category,"%")
 UNION
 SELECT T.ex_inv_no AS invNo ,TF.admmision_no AS adNo,CONCAT(SD.std_fname,SD.std_lname) AS name,CT.class_category AS cls,
IF(T.ex_inv_no LIKE "NCEF%" OR T.ex_inv_no LIKE "BCEF%" ,"Exam Fees","Extra Curricular Fees") AS Ftype, 
"Full Term" AS month ,
IF(T.ex_inv_no LIKE "NCEF%" OR T.ex_inv_no LIKE "BCEF%" ,exam_fee,extra_cur_fee) AS amt,TF.term_invoice_date AS date,TC.term_cat AS term,TF.term_fee_id 
FROM (SELECT * FROM nc_exam_tbl UNION 
	SELECT * FROM bc_exam_tbl UNION
	SELECT * FROM nc_ex_curr_tbl UNION
	SELECT * FROM bc_ex_curr_tbl ) AS T
INNER JOIN term_fee_tbl AS TF ON TF.term_fee_id=T.term_fee_id
INNER JOIN student_class_tbl AS S ON S.admission_no=TF.admmision_no
INNER JOIN class_category_tbl AS CT ON CT.class_cat_id=S.class_cat_id
INNER JOIN main_class_tbl AS M ON M.main_class_id=CT.main_class_id
INNER JOIN term_cat_tbl AS TC ON  TC.term_name=TF.term_name
INNER JOIN (SELECT * FROM nc_student_details_tbl  UNION SELECT * FROM bc_student_details_tbl) AS SD ON SD.admission_no=TF.admmision_no
 WHERE TC.term_id  LIKE CONCAT( M.c_category,"%")
 ) tbl
ORDER BY term_fee_id
 '));
        return $tbl;
    }//return term fee invoice details to print

    function getYrlyTFoutstanding($year)
    {
        $tbl = DB::select(DB::raw('SELECT  TF.admmision_no,NAME,CT.class_category,SUM( TF.amount) AS amount,
(SELECT 3*(term_fee+exam_fee+extra_cur_fee) FROM main_class_tbl WHERE main_class_id=CT.main_class_id)AS totYrfee,TF.year as yrs
FROM term_fee_tbl AS TF
INNER JOIN (SELECT CONCAT(std_fname,std_lname) AS NAME,admission_no FROM nc_student_details_tbl 
	UNION SELECT CONCAT(std_fname,std_lname) AS NAME,admission_no FROM bc_student_details_tbl) AS SD
	ON SD.admission_no=TF.admmision_no
INNER JOIN student_class_tbl AS S ON S.admission_no=TF.admmision_no
INNER JOIN class_category_tbl AS CT ON CT.class_cat_id=S.class_cat_id
WHERE TF.year=' . $year . '
GROUP BY TF.admmision_no
ORDER BY TF.class_cat_id'));

        return $tbl;
    }//yearly payment outstanding

    function getPNLtermFtot($Fd, $Td, $tbl)
    {
        $tf = DB::select(DB::raw('SELECT  IFNULL (SUM(IF(payment_method=1 OR payment_method=4,amount-(exam_fee+extra_cur_fee),amount)),0)AS Tamt
FROM ' . $tbl . ' AS T
INNER JOIN term_fee_tbl AS TF ON TF.term_fee_id=T.term_fee_id
INNER JOIN student_class_tbl AS S ON S.admission_no=TF.admmision_no
INNER JOIN class_category_tbl AS CT ON CT.class_cat_id=S.class_cat_id
INNER JOIN main_class_tbl AS M ON M.main_class_id=CT.main_class_id
WHERE TF.term_invoice_date BETWEEN "' . $Fd . '" AND "' . $Td . '"'));
        return $tf[0]->Tamt;
    }//return total monthly term fee(PNL)

    function getPNLexamFtot($Fd, $Td, $tbl)
    {
        $tf = DB::select(DB::raw('SELECT IFNULL(SUM(exam_fee),0) AS TotEamt 
FROM '.$tbl.' AS T
INNER JOIN term_fee_tbl AS TF ON TF.term_fee_id=T.term_fee_id
INNER JOIN student_class_tbl AS S ON S.admission_no=TF.admmision_no
INNER JOIN class_category_tbl AS CT ON CT.class_cat_id=S.class_cat_id
INNER JOIN main_class_tbl AS M ON M.main_class_id=CT.main_class_id
WHERE TF.term_invoice_date BETWEEN "'.$Fd.'" AND "'.$Td.'"'));
        return $tf[0]->TotEamt;
    }//return total monthly exam fee(PNL)

    function getPNLextraCFtot($Fd, $Td, $tbl)
    {
        $tf = DB::select(DB::raw('SELECT  IFNULL(SUM(extra_cur_fee),0) AS TotExtamt 
FROM '.$tbl.' AS T
INNER JOIN term_fee_tbl AS TF ON TF.term_fee_id=T.term_fee_id
INNER JOIN student_class_tbl AS S ON S.admission_no=TF.admmision_no
INNER JOIN class_category_tbl AS CT ON CT.class_cat_id=S.class_cat_id
INNER JOIN main_class_tbl AS M ON M.main_class_id=CT.main_class_id
WHERE TF.term_invoice_date BETWEEN "'.$Fd.'" AND "'.$Td.'"'));
        return $tf[0]->TotExtamt;
    }//return total monthly extra curricular fee(PNL)
}
