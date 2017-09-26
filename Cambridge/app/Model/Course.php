<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Course extends Model
{
    protected  $table='course_details';
    public $timestamps=false;

    function getCourseName($cos){
        $course= DB::table($this->table)
            ->select('course_name')
            ->where('course_id','=',$cos)
            ->get();

        return $course[0]->course_name;
    }
}
