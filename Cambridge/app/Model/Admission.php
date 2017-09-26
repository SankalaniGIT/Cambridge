<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $table="admission_tbl";
    protected $guarded=['id','created_at','updated_at'];
}
