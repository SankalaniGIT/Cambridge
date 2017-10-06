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
    }

}
