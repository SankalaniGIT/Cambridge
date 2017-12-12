<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GetOldTF extends Model
{

    ##########################################  Only for database conversion ##########################################################
    protected $table = 'old_term_fee_tbl';
    public $timestamps = false;

    function getAllOldTF()
    {
        $tbl = GetOldTF::whereIn('payment_method', array(1, 2, 3, 4))->get();
        return $tbl;
    }//get all term fee

    function getCategory($cat)
    {
        $tbl = DB::table('old_class_category_tbl')
            ->select('id')
            ->where('class_category', '=', $cat)
            ->get();

            return $tbl[0]->id;

    }

    function getTerm($term)
    {
        $tbl = DB::table('old_term_cat_tbl')
            ->select('term')
            ->where('term_id', '=', $term)
            ->get();

            return $tbl[0]->term;

    }

    function getAllOldExExF()
    {
        $tbl = GetOldTF::whereIn('payment_method', array(0))->get();
        return $tbl;
    }//get all exam and extra fee
}
