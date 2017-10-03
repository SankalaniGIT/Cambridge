<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


class Student_bc extends Model
{
    protected $table = "bc_student_details_tbl";
    protected $primarykey = "admission_no";
    public $incrementing = false;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    function getName($id)
    {
        try {
            $name = DB::table($this->table)
                ->select('std_fname', 'std_lname')
                ->where('admission_no', '=', $id)
                ->get();
            return $name[0]->std_fname.' '.$name[0]->std_lname;
        } catch (QueryException $ex) {
            return E111;
        }
    }
}
