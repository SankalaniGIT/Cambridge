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

    function getTermCountPaid($id, $cls, $yr,$term){
        $result = DB::table($this->table)
            ->select(DB::raw(' COUNT(amount) AS SCount ,SUM(amount) AS SPaidAmt'))
            ->where([['admmision_no', '=', $id], ['class_cat_id', '=', $cls], ['year', '=', $yr], ['term_name', '=', $term]])
            ->get();
        return array($result[0]->SCount,$result[0]->SPaidAmt);
    }//get payment count of term & total paid amount for term


}
