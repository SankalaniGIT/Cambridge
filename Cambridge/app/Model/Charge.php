<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Charge extends Model
{
    protected $table = 'main_class_tbl';
    public $timestamps = false;

    function gettotTermFee($cls)
    {
        $cls = DB::table($this->table)
            ->select(DB::raw('(term_fee+ exam_fee+ extra_cur_fee) AS totTermFee'))
            ->where('main_class_id', '=', $cls)
            ->get();
        return $cls[0]->totTermFee;
    }//return total term fee according to class id

    function isPrePrimary($clsid){
        $isExist=DB::table('class_category_tbl')
            ->join('main_class_tbl','main_class_tbl.main_class_id','=','class_category_tbl.main_class_id')
            ->whereIn('main_class_tbl.cls_name', ['play_group','nursery','lkg','ukg'])
            ->where('class_category_tbl.class_cat_id','=',$clsid)
            ->exists();
        return $isExist;

    }//check is exist in pre primary classes return true and false

    function getFees($cls){
        $cls = DB::table($this->table)
            ->select('term_fee','exam_fee','extra_cur_fee')
            ->where('main_class_id', '=', $cls)
            ->get();
        return array($cls[0]->term_fee,$cls[0]->exam_fee,$cls[0]->extra_cur_fee);
    }
}
