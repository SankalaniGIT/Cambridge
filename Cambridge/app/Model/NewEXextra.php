<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NewEXextra extends Model
{
    ##########################################  Only for database conversion ##########################################################

    function addExtExmFee($term, $adNo, $cat, $amt, $year, $ext, $tbl, $ex, $inv,$date,$pmethod)
    {

        $id = $this->selectExExFeeid($term, $adNo, $cat, $year);//select inserting row id,amount,count

        if ($id[0]==0){
            $sta = DB::table('new_term_fee_tbl')
                ->insert([
                    'term_name' => $term,
                    'admmision_no' => $adNo,
                    'class_cat_id' => $cat,
                    'amount' => $amt,
                    'term_invoice_date' => $date,
                    'payment_method' => 1,
                    'year' => $year,
                    'count' => 0
                ]);
        }//insert if theres no any paid term fees to this term
        else {
            DB::table('new_term_fee_tbl')
                ->where([['term_name', '=', $term],
                    ['admmision_no', '=', $adNo],
                    ['class_cat_id', '=', $cat],
                    ['year', '=', $year]])
                ->whereIn('payment_method', array(1, 4))
                ->update([
                    'amount' => $id[1] + $amt,
                    'count' => $id[2] . $ext
                ]);
        }
        $id2 = $this->selectExExFeeid($term, $adNo, $cat, $year);//select inserting row id,amount,count

        if (!$tbl==0 && !$id2[0]==0){

            $result = $this->insertExExinv($tbl, $ex, $id2[0], $inv);

            if($result){
                return true;
            }else {
                return false;
            }
        }//check exm or extra tbl is 0 & last inserted id is 0
    }

    function insertExExinv($tbl, $ex, $id, $inv)
    {
        DB::table($tbl)
            ->insert([
                'term_fee_id' => $id,
                'ex_inv_no' => $ex . $inv
            ]);
        return true;
    }//insert exam and extra fee invoice nos

    function selectExExFeeid($term, $adNo, $cat, $year)
    {
        $id = DB::table('new_term_fee_tbl')
            ->select('term_fee_id','amount','count')
            ->where([['term_name', '=', $term],
                ['admmision_no', '=', $adNo],
                ['class_cat_id', '=', $cat],
                ['year', '=', $year]])
            ->whereIn('payment_method', array(1, 4))
            ->get();

        if ($id->count() == 0) {
            return [0, 0, 0];
        } else {
            return [$id[0]->term_fee_id, $id[0]->amount, $id[0]->count];
        }
    }//select last inserted exam or extra fee tbl id



}
