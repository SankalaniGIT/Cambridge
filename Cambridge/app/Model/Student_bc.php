<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student_bc extends Model
{
    protected $table = "bc_student_details_tbl";
    protected $primarykey = "admission_no";
    public $incrementing = false;

    protected $guarded=['id','created_at','updated_at'];
}
