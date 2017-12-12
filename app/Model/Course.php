<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Course extends Model
{
    protected $table = 'course_details';
    public $timestamps = false;

    function getCourseName($cos)
    {
        $course = DB::table($this->table)
            ->select('course_name')
            ->where('course_id', '=', $cos)
            ->get();

        return $course[0]->course_name;
    }

    function getTotCourses($date)
    {
        $cos = DB::table('course_fee_tbl')
            ->select(DB::raw('IFNULL(SUM(fee_amount),0) AS totCosFee'))
            ->where('date', '=', $date)
            ->get();
        return $cos[0]->totCosFee;
    }//return daily total course income

    function getMonthlyCos($Fd, $Td)
    {
        $cosM = DB::select(DB::raw('SELECT CF.date,SC.student_id,C.course_name,CF.st_c_fee_invNo,CF.month,CF.fee_amount
FROM course_fee_tbl AS CF
INNER JOIN student_courses_tbl AS SC 
ON SC.std_course_id=CF.std_course_id
INNER JOIN course_details AS C
ON C.course_id=SC.course_id
WHERE CF.date BETWEEN "' . $Fd . '" AND "' . $Td . '"'));

        return $cosM;
    }//return monthly course transaction

    function getPNLcosTot($Fd, $Td)
    {
        $cos = DB::select(DB::raw('SELECT IFNULL(SUM(fee_amount),0) AS totAmt
FROM course_fee_tbl
WHERE DATE BETWEEN "'.$Fd.'" AND "'.$Td.'"'));

        return $cos[0]->totAmt;
    }//return total course transaction per month (PNL)
}
