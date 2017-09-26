<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student_nc extends Model
{
    protected $table = "nc_student_details_tbl";
    protected $primarykey = "admission_no";
    public $incrementing = false;
    // protected $timestamp = false;

    protected $guarded=['id','created_at','updated_at'];

//    protected $fillable = ['admission_no', 'std_fname', 'std_lname', 'std_gender', 'std_dob', 'std_address', 'std_tel_no', 'std_f_fname'
//        , 'std_f_lname', 'std_m_fname', 'std_m_lname', 'date_admission', 'std_m_moblie', 'std_f_mobile','updated_at','created_at'];


}
