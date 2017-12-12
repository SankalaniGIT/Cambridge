<?php

namespace App\Http\Controllers;

use App\Model\Admission;
use App\Model\CashInHand;
use App\Model\Course;
use App\Model\Expense;
use App\Model\OtherIncome;
use App\Model\Stationary;
use App\Model\TermFee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /*******************************************Daily Report**********************************************/
    public function viewDailyReport()
    {
        return view('Activities.Reports.dailyReports');
    }//view daily report

    public function fillDailyReport(Request $request)
    {
        $CIH = new CashInHand();
        $TF = new TermFee();
        $STA = new Stationary();
        $AD = new Admission();
        $COS = new Course();
        $exp = new Expense();
        $OI = new OtherIncome();

        //income
        $CashIH = $CIH->getCashInhand($request->date);//get 'pre_amount', 'revenue_amount', 'expense_amount'

        $cashInHand = $CashIH[0];//previous cash in hand

        $bcTotTF = $TF->TotTfee($request->date, 'bc_term_tbl');//BC total term fee

        $ncTotTF = $TF->TotTfee($request->date, 'nc_term_tbl');//NC total term fee

        $bcTotEF = $TF->TotEfee($request->date, 'bc_exam_tbl');//BC total exam fee

        $ncTotEF = $TF->TotEfee($request->date, 'nc_exam_tbl');//NC total exam fee

        $bcTotExtF = $TF->TotExtfee($request->date, 'bc_ex_curr_tbl');//BC total ext curricular fee

        $ncTotExtF = $TF->TotExtfee($request->date, 'nc_ex_curr_tbl');//NC total ext curricular fee

        $stationary = $STA->getSumStationary($request->date);//get total of stationary amount

        $refund = $AD->getTotRefund($request->date);//get total refund

        $admission = $AD->getTotAdmission($request->date);//get total admission

        $courseFee = $COS->getTotCourses($request->date);//get total course fee

        $otherIncome = $OI->totOincome($request->date);//get total other income

        $totOincome = 0;
        foreach ($otherIncome as $item) {
            $totOincome = $totOincome + $item->totOincome;//get other income
        }

        //expenses
        $discountExp = $AD->getTotADdiscount($request->date);//get total discount

        $expense = $exp->getTotExp($request->date);//get expenses

        $totExp = 0;
        foreach ($expense as $item) {
            $totExp = $totExp + $item->totExp;//get expenses
        }

        $totalIcome = $cashInHand + $bcTotTF + $ncTotTF + $bcTotEF + $ncTotEF + $bcTotExtF + $ncTotExtF + $stationary + $refund + $admission + $courseFee + $totOincome;//sum of income
        $totalExpenses = $discountExp + $totExp;//sum of expense
        $totCashInHand = $totalIcome - $totalExpenses;//last cash in hand

        return array($cashInHand, $bcTotTF, $ncTotTF, $bcTotEF, $ncTotEF, $bcTotExtF, $ncTotExtF, $stationary, $refund, $admission, $courseFee, $otherIncome, $discountExp, $expense, $totalIcome, $totalExpenses, $totCashInHand);
    }//fill daily report details

    /*******************************************Daily Transaction Report**********************************************/

    public function viewDailyTraReport()
    {
        return view('Activities.Reports.dailyTransactionRpt');
    }//view daily transaction report

    public function fillDailyTReport(Request $request)
    {
        $CIH = new CashInHand();
        $TF = new TermFee();
        $STA = new Stationary();
        $AD = new Admission();
        $COS = new Course();
        $exp = new Expense();
        $OI = new OtherIncome();

        //fees
        $ncTF = $TF->getMonthlyTF($request->Fdate, $request->Tdate, 'nc_term_tbl');//NC all monthly term fee
        $bcTF = $TF->getMonthlyTF($request->Fdate, $request->Tdate, 'bc_term_tbl');//BC all monthly term fee
        $ncEF = $TF->getMonthlyEF($request->Fdate, $request->Tdate, 'nc_exam_tbl');//NC all monthly exam fee
        $bcEF = $TF->getMonthlyEF($request->Fdate, $request->Tdate, 'bc_exam_tbl');//BC all monthly exam fee
        $ncExtF = $TF->getMonthlyExtF($request->Fdate, $request->Tdate, 'nc_exam_tbl');//NC all monthly extra curricular fee
        $bcExtF = $TF->getMonthlyExtF($request->Fdate, $request->Tdate, 'bc_exam_tbl');//BC all monthly extra curricular fee

        //stationary
        $stationary = $STA->getMonthlySta($request->Fdate, $request->Tdate);//get all monthly stationary

        //Other income
        $otherIncm = $OI->getMonthlyOI($request->Fdate, $request->Tdate);//get all monthly other income

        //admission & refund
        $admRefM = $AD->getMonthlyAdmRef($request->Fdate, $request->Tdate);//get all monthly admission & refund
        $admDisMexp = $AD->getMonthlydiscount($request->Fdate, $request->Tdate);//get all monthly discount expense

        //courses
        $cosM = $COS->getMonthlyCos($request->Fdate, $request->Tdate);//get all monthly course fee

        //expenses
        $expM = $exp->getMonthlyExp($request->Fdate, $request->Tdate);//get all monthly expenses

        //total income
        $totIncome = $CIH->getTotalIncome($request->Fdate, $request->Tdate);//get total income
        //total expense
        $totExpense = $CIH->getTotalExpense($request->Fdate, $request->Tdate);//get total expense

        return array($ncTF, $bcTF, $ncEF, $bcEF, $ncExtF, $bcExtF, $stationary, $otherIncm, $admRefM, $cosM, $admDisMexp, $expM, $totIncome, $totExpense);
    }//view daily transaction report

    /******************************************Student Fees Arrears Report********************************************/

    public function viewFeeHistory()
    {
        return view('Activities.Reports.feeHistoryRpt');//view fee history report
    }

    public function fillTFHistory(Request $request)
    {
        $TF = new TermFee();
        $TFHistory = $TF->viewTFHistory($request->adNo);

        return $TFHistory;
    }

    /******************************************Print Term Fee Report********************************************/

    public function printTermFee()
    {
        ini_set('max_execution_time', 0);
        $TF = new TermFee();
        $PTFI = $TF->printTFInv();
        return view('Activities.Reports.printTermFeeRpt', array('termFees' => $PTFI));
    }//view print term fee ,exam fee & extra curricular fee invoice report

    /******************************************Print Payment Arrears List Report********************************************/

    public function viewArrears()
    {
        return view('Activities.Reports.paymentArrearsRpt');
    }//view payment arrears report

    public function fillPayArrearsRpt(Request $request)
    {
        $TF = new TermFee();
        $YTFO = $TF->getYrlyTFoutstanding($request->year,$request->term);
        return $YTFO;
    }//fill yearly payment outstanding

    /******************************************Print Monthly Report********************************************/


    public function viewMonthlyRpt()
    {
        return view('Activities.Reports.monthlyRpt(PNL)');
    }//view Monthly Report

    public function getMonthlyRpt(Request $request)
    {
        session()->flash('Fdate', $request->Fdate);
        session()->flash('Tdate', $request->Tdate);
        $TF = new TermFee();
        $STA = new Stationary();
        $AD = new Admission();
        $COS = new Course();
        $exp = new Expense();
        $OI = new OtherIncome();

        //Income
        $ncMTF = $TF->getPNLtermFtot($request->Fdate, $request->Tdate, 'nc_term_tbl');//NC get total monthly term fee
        $bcMTF = $TF->getPNLtermFtot($request->Fdate, $request->Tdate, 'bc_term_tbl');//BC get total monthly term fee
        $ncMEF = $TF->getPNLexamFtot($request->Fdate, $request->Tdate, 'nc_exam_tbl');//NC get total monthly exam fee
        $bcMEF = $TF->getPNLexamFtot($request->Fdate, $request->Tdate, 'bc_exam_tbl');//BC get total monthly exam fee
        $ncMExtF = $TF->getPNLextraCFtot($request->Fdate, $request->Tdate, 'nc_ex_curr_tbl');//NC get total monthly extra curricular fee
        $bcMExtF = $TF->getPNLextraCFtot($request->Fdate, $request->Tdate, 'bc_ex_curr_tbl');//BC get total monthly extra curricular fee

        $AdDis = $AD->getPNLAdDisTot($request->Fdate, $request->Tdate);//get total admission and discount of monthly

        //Other Income
        $stationary = $STA->getPNLstaTot($request->Fdate, $request->Tdate);//get total stationary profit of monthly

        $course = $COS->getPNLcosTot($request->Fdate, $request->Tdate);//get total course profit of monthly

        $otherIncome = $OI->getPNLotherTot($request->Fdate, $request->Tdate);//get total other income profit of monthly

        //Expenses
        $expenses = $exp->getPNLexpTot($request->Fdate, $request->Tdate);//get total expenses of monthly

        $fillarray = array($ncMTF, $bcMTF, $ncMEF, $bcMEF, $ncMExtF, $bcMExtF, $AdDis, $stationary, $course, $otherIncome, $expenses);
        session()->flash('Pnldata', $fillarray);
        return $fillarray;

    }//return monthly transaction report details (PNL)

    public function pnlExcel()
    {

        $Fdate = session()->get('Fdate');
        $Tdate = session()->get('Tdate');


        Excel::create('PNL("' . $Fdate . '" to "' . $Tdate . '")', function ($excel) {
            $excel->sheet('Sheet 1', function ($sheet) {
                $Fdate = session()->get('Fdate');
                $Tdate = session()->get('Tdate');
                $fillarray = session()->get('Pnldata');
                $cosfee = (int)$fillarray[8];
                $totAdmission = $fillarray[6][0] - $fillarray[6][1];
                $totfee = $fillarray[0] + $fillarray[1] + $fillarray[2] + $fillarray[3] + $fillarray[4] + $fillarray[5];
                $grossProfit = (($fillarray[6][0] - $fillarray[6][1]) + $cosfee + $fillarray[7] + $fillarray[9] + $fillarray[0] + $fillarray[1] + $fillarray[2] + $fillarray[3] + $fillarray[4] + $fillarray[5]);

                $sheet->mergeCells('A1:G3');
                $ar1 = array(array('Profitability statement for the '.$Fdate.' to '.$Tdate),
                    array(' '),
                    array(' '),
                    array(' '),
                    array('INCOME'),
                    array('Admission', ' ', $fillarray[6][0]),
                    array('Admission Discounts 10%', ' ', $fillarray[6][1]),
                    array(' ', ' ', '', $totAdmission),
                    array('Fees-NC', $fillarray[0]),
                    array('Fees-BC', $fillarray[1], $fillarray[0] + $fillarray[1]),
                    array('Exam Fees-NC', $fillarray[2]),
                    array('Exam Fees-BC', $fillarray[3], $fillarray[2] + $fillarray[3]),
                    array('Extra Fees-NC', $fillarray[4]),
                    array('Extra Fees-BC', $fillarray[5], $fillarray[4] + $fillarray[5], $totfee),
                    array(),
                    array('OTHER INCOME'),
                    array('Stationary', '', $fillarray[7]),
                    array('Course fee', '', $cosfee, $fillarray[7] + $fillarray[8]),
                    array(),
                    array('OTHER INCOME'),
                    array('Others', '', $fillarray[9], $fillarray[9]),
                    array('Gross Profit', '', '', $grossProfit),
                    array(),
                    array('EXPENSES'));//all income

                $sheet->fromArray($ar1, null, 'A1', false, false);
                $Totexp = 0;
                foreach ($fillarray[10] as $item) {
                    $Totexp = $Totexp + $item->Tamt;
                    if ($item == end($fillarray[10])) {
                        $sheet->appendRow(array(
                            $item->expense_type, '', $item->Tamt,  $Totexp
                        ));
                    } else {
                        $sheet->appendRow(array(
                            $item->expense_type, '', $item->Tamt
                        ));
                    }
                }//add all expense

                $sheet->appendRow(array(
                    'Net Profit', '', '', $grossProfit - $Totexp
                ));


                $sheet->freezeFirstColumn();
                $sheet->cells('A1:G1', function($cells) {
                    $cells->setFontColor('#ffffff');
                    $cells->setBackground('#000000');
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '16',
                        'bold'       =>  true
                    ));
                    $cells->setValignment('center');
                    $cells->setAlignment('center');
                });
            });
        })->export('xlsx');


    }//create PNL excel sheet (Monthly income and expense)


}
