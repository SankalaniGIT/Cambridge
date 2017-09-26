<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class CashInHand extends Model
{
    protected  $table='cash_in_hand';
    public $timestamps=false;

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
}
