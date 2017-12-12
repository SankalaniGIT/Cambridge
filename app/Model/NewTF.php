<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NewTF extends Model
{
##########################################  Only for database conversion ##########################################################
    function insertOldTFtoNew($adNo, $amt, $date, $pmethod, $year, $inv, $c_cat, $cat, $term, $count)
    {

        $sta = DB::table('new_term_fee_tbl')
            ->insert([
                'term_name' => $term,
                'admmision_no' => $adNo,
                'class_cat_id' => $cat,
                'amount' => $amt,
                'term_invoice_date' => $date,
                'payment_method' => $pmethod,
                'year' => $year,
                'count' => $count
            ]);

        $id = $this->selectTFid($term, $adNo, $cat, $amt, $date, $pmethod, $count);

        if ($c_cat == 'nc') {
            $TF = $this->insertTFinv($tbl = 'new_nc_term_tbl', $exten = 'NCTF', $id, $inv);
            if ($TF) return true;
            else return false;
        } elseif ($c_cat == 'bc') {
            $TF = $this->insertTFinv($tbl = 'new_bc_term_tbl', $exten = 'BCTF', $id, $inv);
            if ($TF) return true;
            else return false;
        }

    }//insert all old term fee data to new term fee table

    function selectTFid($term, $adNo, $cat, $amt, $date, $pmethod, $count)
{
$id = DB::table('new_term_fee_tbl')
->select('term_fee_id')
->where([['term_name', '=', $term],
['admmision_no', '=', $adNo],
['class_cat_id', '=', $cat],
['amount', '=', $amt],
['term_invoice_date', '=', $date],
['payment_method', '=', $pmethod],
['count', '=', $count]]
)
->get();
return $id[0]->term_fee_id;
}//select last inserted term fee tbl id

    function insertTFinv($tbl, $exten, $id, $inv)
    {
        $id = DB::table($tbl)
            ->insert([
                'term_fee_id' => $id,
                'T_inv_no' => $exten . $inv
            ]);
        return true;
    }//insert term fee invoice no


    ////////////////////////////////////////////////////

    function getLastInsertedPayment($term, $adNo, $cat)
    {
        $tbl = DB::table('new_term_fee_tbl')
            ->select('term_fee_id', 'payment_method', 'count', 'amount')
            ->where([['term_name', '=', $term],
                    ['admmision_no', '=', $adNo],
                    ['class_cat_id', '=', $cat]]
            )
            ->whereNotIn('payment_method', [0])
            ->orderBy('term_fee_id', 'desc')->limit(1)
            ->get();

        if ($tbl->count() == 0) {
            return [0, 0, 0, 0];
        } else {
            return [$tbl[0]->term_fee_id, $tbl[0]->payment_method, $tbl[0]->count, $tbl[0]->amount];
        }

    }//return last inserted payment of new TF table

    function updateOldTFtoNew($id,$amt,$inv,$c_cat)
    {
        $tbl = DB::table('new_term_fee_tbl')
            ->where('term_fee_id','=',$id)
            ->update(['amount'=>$amt,'count'=>2]);

        if ($c_cat == 'nc') {
            $TF = $this->updateTFinv($tbl = 'new_nc_term_tbl', $exten = 'NCTF', $id, $inv);
            if ($TF) return true;
            else return false;
        } elseif ($c_cat == 'bc') {
            $TF = $this->updateTFinv($tbl = 'new_bc_term_tbl', $exten = 'BCTF', $id, $inv);
            if ($TF) return true;
            else return false;
        }
    }

    function updateTFinv($tbl, $exten, $id, $inv)
    {
        $id = DB::table($tbl)
            ->where('term_fee_id','=',$id)
            ->update([
                'T_inv_no' => $exten . $inv
            ]);
        return true;
    }//update term fee invoice no
}
