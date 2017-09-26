<?php

namespace App\Http\Controllers;

use App\Http\Requests\courseStudentRegRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Course;
use App\Model\CashInHand as CashInHand;

class CourseController extends Controller
{

    public function getLastInsertedCosStu()
    {
        $adNo = DB::table('course_school_join_tbl')->select('student_id')->orderBy('student_id', 'desc')->limit(1)->get();
        $id = substr($adNo[0]->student_id, 2);
        $Adno = "CS" . ($id + 1);
        return $Adno;
    }

    /********************************************    Course Students Registration    ***********************************************/
    public function cosStuReg()
    {
        $Adno = $this->getLastInsertedCosStu();
        return view('Activities.Courses.courseStudentReg', array('adNo' => $Adno));
    }

    public function postCosStuReg(courseStudentRegRequest $request)
    {
        DB::table('course_student_tbl')->insert([
            'std_fname' => $request->input('First_name'),
            'std_lname' => $request->input('Last_name'),
            'DOB' => $request->input('DOB'),
            'gender' => $request->input('gender'),
            'std_address' => $request->input('address'),
            'tell' => $request->input('tel'),
            'school' => $request->input('school'),
            'grade' => $request->input('grade'),
            'nic' => $request->input('nic'),
        ]);
        $stId = DB::table('course_student_tbl')->select('std_id')->orderBy('std_id', 'desc')->limit(1)->get();

        try {
            DB::table('course_school_join_tbl')->insert([
                'student_id' => $request->input('adNo'),
                'course_school_id' => $stId[0]->std_id,
                'state' => $request->input('state'),
                'date' => $request->input('date'),
            ]);
            return redirect('cosStuReg')->with('error_code', 12);
        } catch (QueryException $ex) {
            return redirect('cosStuReg')->with('error_code', 111);
        }

    }

    /********************************************   Update Course Students Registration    ***********************************************/

    public function UpdateCosStuReg()
    {
        return view('Activities.Courses.UpdateCosStudentReg');
    }

    public function searchCosAdno(Request $request)
    {
        $query = $request->get('term', '');
        $tbl = DB::table('course_school_join_tbl')
            ->join('course_student_tbl', 'course_student_tbl.std_id', '=', 'course_school_join_tbl.course_school_id')
            ->select('course_school_join_tbl.student_id', 'course_school_join_tbl.course_school_id', 'course_school_join_tbl.state', 'std_fname', 'std_lname')
            ->where('course_school_join_tbl.student_id', 'LIKE', $query . '%')->orderBy('course_school_join_tbl.student_id', 'DESC')->limit(10)->get();

        $data = array();
        foreach ($tbl as $tb) {
            $data[] = array('value' => $tb->state . ' -- ' . $tb->std_fname . ' ' . $tb->std_lname . ' -- ' . $tb->student_id, 'id' => $tb->student_id);
        }
        if (count($data))
            return $data;
        else
            return ['value' => 'No Result Found', 'id' => ''];
    }//search course admission no

    public function getsearchCosAdno(Request $request)
    {
        $query = $request->get('id', '');
        $tbl = DB::table('course_school_join_tbl')
            ->join('course_student_tbl', 'course_student_tbl.std_id', '=', 'course_school_join_tbl.course_school_id')
            ->select('student_id', 'state', 'date', 'std_fname', 'std_lname', 'DOB', 'gender', 'std_address', 'tell', 'school', 'grade', 'nic')
            ->where('course_school_join_tbl.student_id', 'LIKE', $query)->orderBy('course_school_join_tbl.student_id', 'DESC')->get();

        foreach ($tbl as $t) {
            $state = $t->state;
            $date = $t->date;
            $std_fname = $t->std_fname;
            $std_lname = $t->std_lname;
            $DOB = $t->DOB;
            $gender = $t->gender;
            $std_address = $t->std_address;
            $tell = $t->tell;
            $school = $t->school;
            $grade = $t->grade;
            $nic = $t->nic;
        }
        $arr = array($state, $date, $std_fname, $std_lname, $DOB, $gender, $std_address, $tell, $school, $grade, $nic);
        return $arr;
    }//get course student details according to id

    public function postUpdateCosStuReg(courseStudentRegRequest $request)
    {
        if ($request->input('state') == 1)
            $state = 1;
        else
            $state = 0;

        try {
            $adNo = DB::table('course_school_join_tbl')
                ->select('course_school_id')
                ->where('student_id', '=', $request->input('adNo'))
                ->get();

            DB::table('course_student_tbl')
                ->where('std_id', '=', $adNo[0]->course_school_id)
                ->update([
                    'std_fname' => $request->input('First_name'),
                    'std_lname' => $request->input('Last_name'),
                    'DOB' => $request->input('DOB'),
                    'gender' => $request->input('gender'),
                    'std_address' => $request->input('address'),
                    'tell' => $request->input('tel'),
                    'school' => $request->input('school'),
                    'grade' => $request->input('grade'),
                    'nic' => $request->input('nic'),
                ]);


            DB::table('course_school_join_tbl')
                ->where('student_id', '=', $request->input('adNo'))
                ->update([
                    'state' => $state,
                    'date' => $request->input('date'),
                ]);

            return redirect('UpdateCosStuReg')->with('error_code', 18);
        } catch (QueryException $ex) {
            return redirect('UpdateCosStuReg')->with('error_code', 111);
        }
    }//update course student details

    /********************************************    Add School Students to courses    ***********************************************/

    public function addSclStu()
    {
        $Adno = $this->getLastInsertedCosStu();
        return view('Activities.Courses.addSclStudents', array('adNo' => $Adno));
    }//view Add School Students to courses

    public function postAddSclStu(Request $request)
    {
        if (DB::table('course_school_join_tbl')->where('course_school_id', '=', $request->input('adNo'))->exists()) {
            return redirect('addSclStu')->with('error_code', 14);
        } else {
            if (substr($request->input('adNo'), 0, 2) == 'nc' || substr($request->input('adNo'), 0, 2) == 'bc') {
                try {
                    DB::table('course_school_join_tbl')->insert([
                        'student_id' => $request->input('cosAdNo'),
                        'course_school_id' => $request->input('adNo'),
                        'state' => $request->input('state'),
                        'date' => $request->input('date'),
                    ]);
                    return redirect('addSclStu')->with('error_code', 13);
                } catch (QueryException $ex) {
                    return redirect('addSclStu')->with('error_code', 111);
                }
            }
        }//check this school student already registered
    }

    /********************************************    Add & Update Courses to Students   ***********************************************/

    //**********  Add Course   ***********/


    public function getCourses()
    {
        return Course::select('course_id', 'course_name')->get();
    }//get all courses

    public function addStdCos()
    {
        $courses = $this->getCourses();
        return view('Activities.Courses.addStdCos', array('courses' => $courses));
    }//view add & update courses to student frm with all courses

    public function getCosAddNo(Request $request)
    {
        $query = $request->get('term', '');

        $tbl1 = DB::table('course_school_join_tbl')
            ->join('course_student_tbl', 'course_student_tbl.std_id', '=', 'course_school_join_tbl.course_school_id')
            ->select('course_school_join_tbl.student_id', 'course_school_join_tbl.course_school_id', 'course_school_join_tbl.state', 'std_fname', 'std_lname')
            ->where('course_school_join_tbl.student_id', 'LIKE', $query . '%')->orderBy('course_school_join_tbl.student_id', 'DESC')->limit(5);

        $tbl2 = DB::table('course_school_join_tbl')
            ->join('nc_student_details_tbl', 'nc_student_details_tbl.admission_no', '=', 'course_school_join_tbl.course_school_id')
            ->select('course_school_join_tbl.student_id', 'course_school_join_tbl.course_school_id', 'course_school_join_tbl.state', 'std_fname', 'std_lname')
            ->where('course_school_join_tbl.student_id', 'LIKE', $query . '%')->orderBy('course_school_join_tbl.student_id', 'DESC')->limit(5);

        $tbl3 = DB::table('course_school_join_tbl')
            ->join('bc_student_details_tbl', 'bc_student_details_tbl.admission_no', '=', 'course_school_join_tbl.course_school_id')
            ->select('course_school_join_tbl.student_id', 'course_school_join_tbl.course_school_id', 'course_school_join_tbl.state', 'std_fname', 'std_lname')
            ->where('course_school_join_tbl.student_id', 'LIKE', $query . '%')->orderBy('course_school_join_tbl.student_id', 'DESC')->limit(5)
            ->union($tbl1)
            ->union($tbl2)
            ->get();

        $data = array();
        foreach ($tbl3 as $tb) {
            $data[] = array('value' => $tb->state . ' -- ' . $tb->std_fname . ' ' . $tb->std_lname . ' -- ' . $tb->student_id, 'id' => $tb->student_id);
        }
        if (count($data))
            return $data;
        else
            return ['value' => 'No Result Found', 'id' => ''];


    }//get course admission nos with name

    public function postAddStdCos(Request $request)
    {
        $check = $this->checkCosAdded($request->input('cosAdNo'), $request->input('course'));
        if ($check) {
            return redirect('addStdCos')->with('error_code', 15);
        }//check already added courses to students
        else {
            if ($request->input('state') == 1) {
                DB::table('student_courses_tbl')
                    ->insert([
                        'student_id' => $request->input('cosAdNo'),
                        'course_id' => $request->input('course'),
                        'course_state' => 1
                    ]);
                return redirect('addStdCos')->with('error_code', 16);
            } //check student already left in courses
            else {
                return redirect('addStdCos')->with('error_code', 17);
            }
        }

    }

    public function checkCosAdded($id, $cos)
    {
        return DB::table('student_courses_tbl')
            ->where([['student_id', '=', $id], ['course_id', '=', $cos]])
            ->exists();
    }//check already added courses to students


    //**********  Update Course   ***********/


    public function fillUpdateCos(Request $request)
    {
        $id = $request->get('id', '');
        $cos = $request->get('cos', '');

        $state = DB::table('student_courses_tbl')
            ->select('course_state')
            ->where([['student_id', '=', $id], ['course_id', '=', $cos]])
            ->get();
        if ($this->checkCosAdded($id, $cos))
            return $state[0]->course_state;
        else return 2;

    }//fill course availability status to update

    public function postUpdateStdCos(Request $request)
    {
        try {
            if ($request->input('state2') == 1)
                $state = 1;
            else $state = 0;

            if ($this->checkCosAdded($request->input('cosAdNo2'), $request->input('course2'))) {
                DB::table('student_courses_tbl')
                    ->where([['student_id', '=', $request->input('cosAdNo2')], ['course_id', '=', $request->input('course2')]])
                    ->update([
                        'course_state' => $state
                    ]);
                return redirect('addStdCos')->with('error_code', 19);
            }//check is exist
            else {
                return redirect('addStdCos')->with('error_code', 20);
            }
        } catch (QueryException $ex) {
            return redirect('addStdCos')->with('error_code', 111);
        }
    }//update student course availability status


    /********************************************    Bill A course   ***********************************************/

    public function billCourse()
    {
        $courses = $this->getCourses();
        return view('Activities.Courses.billCourse', array('courses' => $courses, 'inv' => $this->getCosInvNo()));
    }

    public function getCosInvNo()
    {
        $cosInv = DB::table('course_fee_tbl')->select('st_c_fee_invNo')->orderBy('st_c_fee_id', 'desc')->limit(1)->get();
        return $cosInv[0]->st_c_fee_invNo + 1;
    }//return new Course billing invoice no

    public function postBillCourse(Request $request)
    {
        $id = $request->input('cosAdNo');
        $cos = $request->input('course');

        $exist = DB::table('student_courses_tbl')
            ->where([['student_id', '=', $id], ['course_id', '=', $cos], ['course_state', '=', 1]])
            ->exists();
        if ($this->checkCosAdded($id, $cos)) {
            if ($exist) {

                DB::table('course_fee_tbl')->insert([
                    'fee_amount' => $request->input('fee'),
                    'month' => $request->input('month'),
                    'date' => $request->input('date'),
                    'st_c_fee_invNo' => $request->input('CosInv'),
                    'std_course_id' => $request->input('course')
                ]);

                $date = $request->input('date');
                $disc = 0;
                $paid = $request->input('fee');

                $CashInHand = new CashInHand();
                $returnCIH = $CashInHand->saveCashInHand($date, $disc, $paid);//insert cash in hand in cashInHand model

                $cs = new Course();
                $course = $cs->getCourseName($cos);//get course name from Course model

                if ($returnCIH == 1) {
                    return view('Invoice.CosInv', ['class' => $course, 'AdNo' => $id, 'invNo' => $request->input('CosInv'), 'date' => $date, 'name' => $request->input('name'), 'fee' => $paid, 'month' => $request->input('month')]);
                } else {
                    return redirect('billCourse')->with('error_code', 111);
                }


            }//check is currently doing this course
            else {
                return redirect('billCourse')->with('error_code', 22);
            }
        }//check is registered in this course
        else {
            return redirect('billCourse')->with('error_code', 21);
        }
    }

    /********************************************    View courses   ***********************************************/

    public function viewCourses()
    {
        $table=DB::select(DB::raw('SELECT SC.student_id,F.fee_amount,F.month,C.course_name,SC.course_state,F.st_c_fee_invNo,F.date,
(
SELECT CONCAT( std_fname," ",std_lname)
FROM course_school_join_tbl
INNER JOIN course_student_tbl
ON course_student_tbl.std_id=course_school_join_tbl.course_school_id 
WHERE course_school_join_tbl.student_id=SC.student_id
UNION 
(SELECT   CONCAT( std_fname," ",std_lname)
FROM course_school_join_tbl
INNER JOIN nc_student_details_tbl
ON nc_student_details_tbl.admission_no=course_school_join_tbl.course_school_id
WHERE course_school_join_tbl.student_id=SC.student_id)

UNION
(SELECT  CONCAT( std_fname," ",std_lname) 
FROM course_school_join_tbl
INNER JOIN bc_student_details_tbl
ON bc_student_details_tbl.admission_no=course_school_join_tbl.course_school_id
WHERE course_school_join_tbl.student_id=SC.student_id) 
) AS name
FROM course_fee_tbl AS F
INNER JOIN student_courses_tbl AS SC
ON F.std_course_id=SC.std_course_id
INNER JOIN course_details AS C
ON C.course_id=SC.course_id

'));
        return view('Activities.Courses.viewCourse',array('courses'=>$table));
    }
}
