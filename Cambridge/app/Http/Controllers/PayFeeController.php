<?php

namespace App\Http\Controllers;

use App\Http\Requests\payFeeRequest;
use App\Model\Charge;
use App\Model\Student_bc;
use App\Model\Student_nc;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Model\TermFee;
use Carbon\Carbon;
use App\Model\CashInHand as CashInHand;

class PayFeeController extends Controller
{
    /**************************************  Pay Fee  ***********************************************/


    public function viewPayFee()
    {
        return view('Activities.Revenue.payFees');//view all charges
    }

    public function fillpayfee(Request $request)
    {
        $namenc = new Student_nc();
        $namebc = new Student_bc();
        $mainCls = new Charge();
        $TF = new TermFee();
        $T1 = 0;
        $T2 = 0;
        $T3 = 0;//full paid terms
        $_1T1P = 0;
        $_1T2P = 0;
        $_1T3P = 0;
        $_2T1P = 0;
        $_2T2P = 0;
        $_2T3P = 0;
        $_3T1P = 0;
        $_3T2P = 0;
        $_3T3P = 0;
        if (substr($request->id, 0, 2) == 'nc') {
            $name = $namenc->getName($request->id);
            $terms = array('JAN-APR', 'MAY-AUG', 'SEP-DEC');

        } else if (substr($request->id, 0, 2) == 'bc') {
            $name = $namebc->getName($request->id);
            $terms = array('SEP-DEC', 'MAY-AUG', 'JAN-APR');
        }

        $class = $TF->getClass($request->id);//get class details like NUR_R_CLS,2,nc2

        $totTermFee = $mainCls->gettotTermFee($class[2]);//get total term fee details

        $isPrePrimary = $mainCls->isPrePrimary($class[1]);//check is primary
        if ($isPrePrimary) {

            $pre = $TF->getCountTotPaid($request->id, $class[1], $request->yr);//get count and total paid amount of paid terms in pre primary

            if ($pre[0] == 3) {
                $_1T1P = 1;
                $_1T2P = 1;
                $_1T3P = 1;
                $_2T1P = 1;
                $_2T2P = 1;
                $_2T3P = 1;
                $_3T1P = 1;
                $_3T2P = 1;
                $_3T3P = 1;
                $OutStand = 0;
                $T1 = 1;
                $T2 = 1;
                $T3 = 1;//pass full paid terms
            } elseif ($pre[0] == 2) {
                $_1T1P = 1;
                $_1T2P = 1;
                $_1T3P = 1;
                $_2T1P = 1;
                $_2T2P = 1;
                $_2T3P = 1;
                $OutStand = $totTermFee;
                $T1 = 1;
                $T2 = 1;//pass full paid terms
            } elseif ($pre[0] == 1) {
                $_1T1P = 1;
                $_1T2P = 1;
                $_1T3P = 1;

                $OutStand = $totTermFee * 2;
                $T1 = 1;//pass full paid terms
            } else  $OutStand = $totTermFee * 3;

            return array($_1T1P, $_1T2P, $_1T3P, $_2T1P, $_2T2P, $_2T3P, $_3T1P, $_3T2P, $_3T3P, $OutStand, $name, $class[0], $terms, $T1, $T2, $T3);
        }//pre primary students
        else {

            try {
                $paid = 0;

                //************************ 1st term payments
                if ($TF->isFullPaid($request->id, $class[1], $request->yr, 'T1', 4)) {//check full paid for 1st term
                    $_1T1P = 1;
                    $_1T2P = 1;
                    $_1T3P = 1;
                    $paid = $totTermFee;
                    $T1 = 1;//pass full paid terms
                } else {

                    $countPaid = $TF->getTermCountPaid($request->id, $class[1], $request->yr, 'T1');//get payment count of 1st term & total paid for term

                    if ($countPaid[0] == 3) {
                        $_1T1P = 1;
                        $_1T2P = 1;
                        $_1T3P = 1;// full paid for 1st term
                        $paid = $countPaid[1];
                        $T1 = 1;//pass full paid terms
                    } else if ($countPaid[0] == 2) {
                        $_1T1P = 1;
                        $_1T2P = 1;// 2nd payment paid for 1st term
                        $paid = $countPaid[1];
                    } else if ($countPaid[0] == 1) {
                        $_1T1P = 1;// 1st payment paid for 1st term
                        $paid = $countPaid[1];
                    }

                }//not full paid for 1st term


                //************************ 2nd term payments
                if ($TF->isFullPaid($request->id, $class[1], $request->yr, 'T2', 4)) {//check full paid for 2nd term
                    $_2T1P = 1;
                    $_2T2P = 1;
                    $_2T3P = 1;
                    $paid = $paid + $totTermFee;
                    $T1 = 1;//pass full paid terms
                } else {

                    $countPaid = $TF->getTermCountPaid($request->id, $class[1], $request->yr, 'T2');//get payment count of 2nd term & total paid for term

                    if ($countPaid[0] == 3) {
                        $_2T1P = 1;
                        $_2T2P = 1;
                        $_2T3P = 1;// full paid for 2nd term
                        $paid = $paid + $countPaid[1];
                        $T2 = 1;//pass full paid terms
                    } else if ($countPaid[0] == 2) {
                        $_2T1P = 1;
                        $_2T2P = 1;// 2nd payment paid for 2nd term
                        $paid = $paid + $countPaid[1];
                    } else if ($countPaid[0] == 1) {
                        $_2T1P = 1;// 1st payment paid for 2nd term
                        $paid = $paid + $countPaid[1];
                    }

                }//not full paid for 2nd term


                //************************ 3rd term payments
                if ($TF->isFullPaid($request->id, $class[1], $request->yr, 'T3', 4)) {//check full paid for 3rd term
                    $_3T1P = 1;
                    $_3T2P = 1;
                    $_3T3P = 1;
                    $paid = $paid + $totTermFee;
                    $T1 = 1;//pass full paid terms
                } else {

                    $countPaid = $TF->getTermCountPaid($request->id, $class[1], $request->yr, 'T3');//get payment count of 3rd term & total paid for term

                    if ($countPaid[0] == 3) {
                        $_3T1P = 1;
                        $_3T2P = 1;
                        $_3T3P = 1;// full paid for 3rd term
                        $paid = $paid + $countPaid[1];
                        $T2 = 1;//pass full paid terms
                    } else if ($countPaid[0] == 2) {
                        $_3T1P = 1;
                        $_3T2P = 1;// 2nd payment paid for 3rd term
                        $paid = $paid + $countPaid[1];
                    } else if ($countPaid[0] == 1) {
                        $_3T1P = 1;// 1st payment paid for 3rd term
                        $paid = $paid + $countPaid[1];
                    }

                }//not full paid for 3rd term
                $OutStand = ($totTermFee * 3) - $paid;
                return array($_1T1P, $_1T2P, $_1T3P, $_2T1P, $_2T2P, $_2T3P, $_3T1P, $_3T2P, $_3T3P, $OutStand, $name, $class[0], $terms, $T1, $T2, $T3);
            } catch (QueryException $ex) {
                return redirect('payFees')->with('error_code', 111);
            }

        }//other students
    }//fill payfees details

    public function fillPmethods(Request $request)
    {
        $mainCls = new Charge();
        $TF = new TermFee();

        $class = $TF->getClass($request->id);//get class details like NUR_R_CLS,2,nc2

        $isPrePrimary = $mainCls->isPrePrimary($class[1]);//check is primary

        if ($isPrePrimary) {
            return $Pmethod = 4;//full payment to pay
        } else {
            $countPaid = $TF->getTermCountPaid($request->id, $class[1], $request->yr, $request->trm);//get payment count of term & total paid for term

            if ($countPaid[0] == 2) {
                return $Pmethod = 3;//3rd payment to pay
            } elseif ($countPaid[0] == 1) {
                return $Pmethod = 2;//2nd payment to pay
            } elseif ($countPaid[0] == 0) {
                return $Pmethod = 1;//1st payment or full payment to pay
            }
        }
    }//return payment methods

    public function fillfees(Request $request)
    {
        $mainCls = new Charge();
        $TF = new TermFee();

        try {
            $class = $TF->getClass($request->id);//get class details like NUR_R_CLS,2,nc2

            $fees = $mainCls->getFees($class[2]);//get term_fee,exam_fee,extra_cur_fee

            if (substr($request->id, 0, 2) == 'nc') {
                $Tinv = $TF->getTinv('nc_term_tbl', 'NCTF');
                $Einv = $TF->getEinv('nc_exam_tbl', 'NCEF');
                $Extinv = $TF->getExtinv('nc_ex_curr_tbl', 'NCEXTF');
            } else {
                $Tinv = $TF->getTinv('bc_term_tbl', 'BCTF');
                $Einv = $TF->getEinv('bc_exam_tbl', 'BCEF');
                $Extinv = $TF->getExtinv('bc_ex_curr_tbl', 'BCEXTF');
            }//get NC and BC invoice nos

            if ($request->pm == 4) {
                $term_fee = $fees[0];
                $exam_fee = $fees[1];
                $extra_cur_fee = $fees[2];
            } elseif ($request->pm == 3) {
                $term_fee = $fees[0] / 2;
                $exam_fee = 0;
                $extra_cur_fee = 0;
            } elseif ($request->pm == 2) {
                $term_fee = $fees[0] / 4;
                $exam_fee = 0;
                $extra_cur_fee = 0;
            } elseif ($request->pm == 1) {
                $term_fee = $fees[0] / 4;
                $exam_fee = $fees[1];
                $extra_cur_fee = $fees[2];
            }// assign term_fee,exam_fee,extra_cur_fee

            return array($term_fee, $exam_fee, $extra_cur_fee, $Tinv, $Einv, $Extinv);
        } catch (QueryException $ex) {
            return 0;
        }
    }//return fees and invoice numbers


    public function postPayFee(payFeeRequest $request)
    {

        $TF = new TermFee();
        $CashInHand = new CashInHand();
        $current_date = Carbon::now()->toDateString();

        $class = $TF->getClass($request->input('adNo'));//get class details like NUR_R_CLS,2,nc2
        $amount = $request->input('Tfee') + $request->input('Efee') + $request->input('ExCfee');

        $isExist = $TF->isAlreadyInserted($request->input('term'), $request->input('adNo'), $class[1], $amount,
            $current_date, $request->input('P_method'), $request->input('year'));//check is already inserted this payment
        if ($isExist) {
            return redirect('payFees')->with('error_code', 26);
        }//already inserted payment
        else {
            $termfeeid = $TF->saveTermfee($request->input('term'), $request->input('adNo'), $class[1], $amount,
                $current_date, $request->input('P_method'), $request->input('year'));//insert term fee details


            if (substr($request->input('adNo'), 0, 2) == 'nc') {

                $TF->saveTerm('nc_term_tbl', $termfeeid, $request->input('TfeeInv'));
                if ($request->input('Efee') != 0 && $request->input('ExCfee') != 0) {
                    $TF->saveExam('nc_exam_tbl', $termfeeid, $request->input('EfeeInv'));
                    $TF->saveExtCurry('nc_ex_curr_tbl', $termfeeid, $request->input('ExCfeeInv'));
                }
                $curry = 'nc';
            } elseif (substr($request->input('adNo'), 0, 2) == 'bc') {

                $TF->saveTerm('bc_term_tbl', $termfeeid, $request->input('TfeeInv'));
                if ($request->input('Efee') != 0 && $request->input('ExCfee') != 0) {
                    $TF->saveExam('bc_exam_tbl', $termfeeid, $request->input('EfeeInv'));
                    $TF->saveExtCurry('bc_ex_curr_tbl', $termfeeid, $request->input('ExCfeeInv'));
                }
                $curry = 'bc';
            }//save term,exam,extra curricular invoice no's of NC and BC  and assign months of terms


            $returnCIH = $CashInHand->saveCashInHand($current_date, $disc = 0, $amount);//save cash in hand as income

            if ($returnCIH == 1) {
            } else {
                return redirect('payFees')->with('error_code', 111);
            }//if not saved cash in hand return error message

            $MT=$this->getTerm_Month($request->input('term'), $request->input('P_method'), $curry);//get term and month according to payment
            $month=$MT[0];
            $term=$MT[1];

            $TFees = array('invNo' => $request->input('TfeeInv'), 'adNo' => $request->input('adNo'), 'name' => $request->input('name'),
                'cls' => $request->input('class'), 'Ftype' => 'Term Fees', 'term' => $term, 'month' => $month, 'amt' => $request->input('Tfee'), 'date' => $current_date);

            $EFees = array('invNo' => $request->input('EfeeInv'), 'adNo' => $request->input('adNo'), 'name' => $request->input('name'),
                'cls' => $request->input('class'), 'Ftype' => 'Exam Fees', 'term' => $term, 'month' => 'Full Term', 'amt' => $request->input('Efee'), 'date' => $current_date);

            $ExtFees = array('invNo' => $request->input('ExCfeeInv'), 'adNo' => $request->input('adNo'), 'name' => $request->input('name'),
                'cls' => $request->input('class'), 'Ftype' => 'Extra Curricular Fees', 'term' => $term, 'month' => 'Full Term', 'amt' => $request->input('ExCfee'), 'date' => $current_date);


            if ($request->input('Efee') == 0 && $request->input('ExCfee') == 0) {
                return view('Activities.Revenue.viewPayFee', ['termFees' => [$TFees]]);//return term fee array
            } else {
                return view('Activities.Revenue.viewPayFee', ['termFees' => [$TFees, $EFees, $ExtFees]]);//return term fee,exam fees, extra curricular arrays
            }
        }////a new payment
    }

    public function getTerm_Month($trm, $pM, $curry)
    {
        if ($curry == 'nc') {
            $_1T = array('JAN', 'FEB', 'MAR', 'APR');
            $_2T = array('MAY', 'JUN', 'JUL', 'AUG');
            $_3T = array('SEP', 'OCT', 'NOV', 'DEC');
        } else {
            $_1T = array('SEP', 'OCT', 'NOV', 'DEC');
            $_2T = array('MAY', 'JUN', 'JUL', 'AUG');
            $_3T = array('JAN', 'FEB', 'MAR', 'APR');
        }
        if ($trm == 'T1') {
            if ($pM == 1) {
                $month = $_1T[0];
            } elseif ($pM == 2) {
                $month = $_1T[1];
            } elseif ($pM == 3) {
                $month = $_1T[2] . '&' . $_1T[3];
            } elseif ($pM == 4) {
                $month = 'Full Term';
            }
            $term = $_1T[0] . '-' . $_1T[3];
        } elseif ($trm == 'T2') {
            if ($pM == 1) {
                $month = $_2T[0];
            } elseif ($pM == 2) {
                $month = $_2T[1];
            } elseif ($pM == 3) {
                $month = $_2T[2] . '&' . $_2T[3];
            } elseif ($pM == 4) {
                $month = 'Full Term';
            }
            $term = $_2T[0] . '-' . $_2T[3];
        } elseif ($trm == 'T3') {
            if ($pM == 1) {
                $month = $_3T[0];
            } elseif ($pM == 2) {
                $month = $_3T[1];
            } elseif ($pM == 3) {
                $month = $_3T[2] . '&' . $_3T[3];
            } elseif ($pM == 4) {
                $month = 'Full Term';
            }
            $term = $_3T[0] . '-' . $_3T[3];
        }
        return array($month,$term);
    }//get term and month according to payment
}
