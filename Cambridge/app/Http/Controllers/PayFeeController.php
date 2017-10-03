<?php

namespace App\Http\Controllers;

use App\Http\Requests\payFeeRequest;
use App\Model\Charge;
use App\Model\Student_bc;
use App\Model\Student_nc;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Model\TermFee;

class PayFeeController extends Controller
{
    /**************************************  Pay Fee  ***********************************************/


    public function viewPayFee()
    {
        return view('Activities.Revenue.payFees');//view all charges
    }

    public function postPayFee(payFeeRequest $request)
    {
        print_r($request->all());
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

            return array($_1T1P, $_1T2P, $_1T3P, $_2T1P, $_2T2P, $_2T3P, $_3T1P, $_3T2P, $_3T3P, $OutStand, $name, $class[0], $terms,$T1,$T2,$T3);
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
                return array($_1T1P, $_1T2P, $_1T3P, $_2T1P, $_2T2P, $_2T3P, $_3T1P, $_3T2P, $_3T3P, $OutStand, $name, $class[0], $terms,$T1,$T2,$T3);
            } catch (QueryException $ex) {
                return redirect('payFees')->with('error_code', 111);
            }

        }//other students


    }
}
