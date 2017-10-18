<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class CashInHand extends Model
{
    protected $table = 'cash_in_hand';
    public $timestamps = false;

    function saveCashInHand($date, $disc, $paid)
    {

        $cashInHand = DB::table($this->table)->select('acc_date', 'pre_amount', 'revenue_amount', 'expense_amount')->orderBy('cash_in_hand_id', 'desc')->limit(1)->get();

        foreach ($cashInHand as $item) {
            $da = $item->acc_date;
            $preAmount = $item->pre_amount;
            $revenueAmount = $item->revenue_amount;
            $expenseAmount = $item->expense_amount;
        }

        if ($da == $date) {
            try {
                DB::table($this->table)
                    ->where('acc_date', $date)
                    ->update(['revenue_amount' => $revenueAmount + $paid, 'expense_amount' => $expenseAmount + $disc]);
            } catch (QueryException $ex) {
                return E111;
            }

        } else {
            try {
                DB::table($this->table)->insert([
                    'acc_date' => $date,
                    'pre_amount' => $preAmount + ($revenueAmount - $expenseAmount),
                    'revenue_amount' => $paid,
                    'expense_amount' => $disc
                ]);//insert cash in hand
            } catch (QueryException $ex) {
                return E111;
            }

        }

        return true;

    }//save income and expenses to cash_in_hand table

    function getCashInhand($date)
    {
        $d = DB::table($this->table)
            ->where('acc_date', '=', $date)
            ->first();
        if (is_null($d)) {
            return array(0, 0, 0);
        } else {
            return array($d->pre_amount, $d->revenue_amount, $d->expense_amount);
        }
    }//return cash in hand according to a day

    function getTotalIncome($Fd, $Td)
    {
        //total fees
        $Fee = TermFee::select(DB::raw('IFNULL(SUM(amount),0) AS amount'))
            ->whereBetween('term_invoice_date', [$Fd, $Td])
            ->get();

        //stationary
        $sta = DB::table('stationary_transaction_tbl')
            ->join('stationary_inv_tbl', 'stationary_inv_tbl.st_inv_id', '=', 'stationary_transaction_tbl.st_inv_id')
            ->select(DB::raw('IFNULL(SUM(amount),0) AS amount'))
            ->whereBetween('stationary_inv_tbl.st_date', [$Fd, $Td])
            ->get();

        //Other income
        $Oincm = OtherIncome::select(DB::raw('IFNULL(SUM(amount),0) AS amount'))
            ->whereBetween('date', [$Fd, $Td])
            ->get();

        //admission & refund
        $ARF = Admission::select(DB::raw('IFNULL(SUM(ad_paid_amount),0) AS amount'))
            ->whereBetween(DB::raw('DATE(created_at)'), [$Fd, $Td])
            ->get();

        //courses
        $cosF = DB::table('course_fee_tbl')
            ->select(DB::raw('IFNULL(SUM(fee_amount),0) AS amount'))
            ->whereBetween('date', [$Fd, $Td])
            ->get();

        return $Fee[0]->amount + $sta[0]->amount + $Oincm[0]->amount + $ARF[0]->amount + $cosF[0]->amount;
    }

    function getTotalExpense($Fd, $Td)
    {
        //admission discount
        $disE = Admission::select(DB::raw('IFNULL(SUM(discount),0) AS amount'))
            ->whereBetween(DB::raw('DATE(created_at)'), [$Fd, $Td])
            ->get();

        //other expense
        $Oexp = DB::table('expense_tbl')
            ->join('expense_transaction_tbl', 'expense_tbl.expense_inv_id', '=', 'expense_transaction_tbl.expense_inv_id')
            ->select(DB::raw('IFNULL(SUM(amount),0) AS amount'))
            ->whereBetween('date', [$Fd, $Td])
            ->get();
        return $disE[0]->amount + $Oexp[0]->amount;
    }
}
