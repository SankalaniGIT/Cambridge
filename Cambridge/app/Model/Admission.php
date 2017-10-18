<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admission extends Model
{
    protected $table = "admission_tbl";
    protected $guarded = ['id', 'created_at', 'updated_at'];

    function getTotRefund($date)
    {
        $ref = DB::select(DB::raw('SELECT IFNULL(SUM(ad_paid_amount),0) AS refundAmt
FROM admission_tbl
WHERE ad_payment_type="Refundable Deposit" AND DATE(created_at)="' . $date . '"'));

        return $ref[0]->refundAmt;
    }//get total refund according to date

    function getTotAdmission($date)
    {
        $ad = DB::select(DB::raw('SELECT IFNULL(SUM(ad_paid_amount),0) AS admiAmt
FROM admission_tbl
WHERE ad_payment_type="Admission Fee" AND DATE(created_at)="' . $date . '"'));

        return $ad[0]->admiAmt;
    }//get total admission according to date

    function getTotADdiscount($date)
    {
        $dis = DB::select(DB::raw('SELECT IFNULL(SUM(discount),0) AS discount
FROM admission_tbl
WHERE DATE(created_at)="' . $date . '"'));
        return $dis[0]->discount;
    }//get total discount according to date

    function getMonthlyAdmRef($Fd, $Td)
    {
        $MAR = DB::select(DB::raw('
SELECT  DATE(created_at) AS dates,ad_payment_type,admission_no,ad_paid_amount
FROM admission_tbl
WHERE DATE(created_at) BETWEEN "' . $Fd . '" AND "' . $Td . '"'));
        return $MAR;
    }//return all monthly admission & refund

    function getMonthlydiscount($Fd, $Td)
    {
        $Mdis = DB::select(DB::raw('
SELECT  DATE(created_at) AS dates,admission_no,discount
FROM admission_tbl
WHERE DATE(created_at) BETWEEN "' . $Fd . '" AND "' . $Td . '" AND discount IS NOT NULL AND discount != 0'));
        return $Mdis;
    }//return all monthly discount expenses

    function getPNLAdDisTot($Fd, $Td)
    {
        $AD = DB::select(DB::raw('SELECT IFNULL(SUM(ad_paid_amount),0) AS paidAmt,IFNULL(SUM(discount),0) AS discountAmt
FROM admission_tbl
WHERE DATE(created_at) BETWEEN "' . $Fd . '" AND "' . $Td . '"'));

        return array($AD[0]->paidAmt,$AD[0]->discountAmt);
    }//return total discount and admission of month (PNL)


}
