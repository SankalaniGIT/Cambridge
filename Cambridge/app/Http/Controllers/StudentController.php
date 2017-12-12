<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUserRequest;
use App\Http\Requests\studentInsertRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Student_nc; //use NC student model in controller
use App\Model\Student_bc;
use  App\Model\Charge;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use SebastianBergmann\Environment\Console;

class StudentController extends Controller
{

    /**********    Student details Insertion           **********************/

    public function insertShow()
    {
        return view('Activities.Student.stuRegistration');
    }//show student details form

    public function studentGrade(Request $request)
    {
        $category = $request->all();

        $grades = DB::table('main_class_tbl')->select('cls_name')->where('c_category', '=', $category['id'])->get();
        return $grades;

    }//return Students Grades

    public function studentClass(Request $request)
    {
        $category = $request->all();

        $classes = DB::table('class_category_tbl')
            ->join('main_class_tbl', function ($join) use ($category) {
                $join->on('main_class_tbl.main_class_id', '=', 'class_category_tbl.main_class_id')
                    ->where('main_class_tbl.c_category', '=', $category['id']);
            })
            ->select('class_category_tbl.class_category')
            ->get();
        return $classes;
    }//return Student Classes

    public function studentAddNo(Request $request)
    {
        $category = $request['id'];
        if ($category == 'nc') {
            $adNo = DB::table('nc_student_details_tbl')->select('admission_no')->orderBy('id', 'desc')->limit(1)->get();//get last inserted Admission No in nc_student_details_tbl
            return $adNo;
        } elseif ($category == 'bc') {
            $adNo = DB::table('bc_student_details_tbl')->select('admission_no')->orderBy('id', 'desc')->limit(1)->get();//get last inserted Admission No in bc_student_details_tbl
            return $adNo;
        }
    }//return next Admission no

    public function dbInsertShow(studentInsertRequest $request)
    {
        if (isset($request->state)) {
            $state = 'true';
        } elseif (!isset($request->state)) {
            $state = 'false';
        }

        $classCatId = DB::table('class_category_tbl')
            ->select('class_cat_id', 'main_class_id')
            ->where('class_category', '=', $request->input('class'))
            ->get();

        foreach ($classCatId as $cat) {
            $cat_id = $cat->class_cat_id;
            $class_id = $cat->main_class_id;
        }//get Class Category and class id


        if (substr($class_id, 0, 2) == 'nc') {
            try {
                $ncStudent = new Student_nc;
                $ncStudent->admission_no = $request->input('adNo');
                $ncStudent->std_fname = $request->input('First_name');
                $ncStudent->std_lname = $request->input('Last_name');
                $ncStudent->std_gender = $request->input('gender');
                $ncStudent->std_dob = $request->input('DOB');
                $ncStudent->std_address = $request->input('Address');
                $ncStudent->std_tel_no = $request->input('Tell');
                $ncStudent->std_f_fname = $request->input('Father_First_name');
                $ncStudent->std_f_lname = $request->input('Father_Last_name');
                $ncStudent->std_m_fname = $request->input('Mother_First_name');
                $ncStudent->std_m_lname = $request->input('mLname');
                $ncStudent->date_admission = $request->input('date');
                $ncStudent->std_m_moblie = $request->input('Mother_tell');
                $ncStudent->std_f_mobile = $request->input('Father_tell');
                $ncStudent->state = $state;
                $ncStudent->save();

                DB::table('student_class_tbl')->insert([
                    'admission_no' => $request->input('adNo'),
                    'class_cat_id' => $cat_id
                ]);//insert Admission no and class category id


                return redirect('studentRegistration')->with('error_code', 1); //pass a variable when redirecting to msgScript.blade.php

            } catch (QueryException $ex) {
                return redirect('studentRegistration')->with('error_code', 0);//pass a variable when redirecting to msgScript.blade.php
            }


        } elseif (substr($class_id, 0, 2) == 'bc') {
            try {

                $bcStudent = new Student_bc;
                $bcStudent->admission_no = $request->input('adNo');
                $bcStudent->std_fname = $request->input('First_name');
                $bcStudent->std_lname = $request->input('Last_name');
                $bcStudent->std_gender = $request->input('gender');
                $bcStudent->std_dob = $request->input('DOB');
                $bcStudent->std_address = $request->input('Address');
                $bcStudent->std_tel_no = $request->input('Tell');
                $bcStudent->std_f_fname = $request->input('Father_First_name');
                $bcStudent->std_f_lname = $request->input('Father_Last_name');
                $bcStudent->std_m_fname = $request->input('Mother_First_name');
                $bcStudent->std_m_lname = $request->input('mLname');
                $bcStudent->date_admission = $request->input('date');
                $bcStudent->std_m_moblie = $request->input('Mother_tell');
                $bcStudent->std_f_mobile = $request->input('Father_tell');
                $bcStudent->state = $state;
                $bcStudent->save();

                DB::table('student_class_tbl')->insert([
                    'admission_no' => $request->input('adNo'),
                    'class_cat_id' => $cat_id
                ]);//insert Admission no and class category id


                return redirect('studentRegistration')->with('error_code', 2);//pass a variable when redirecting to msgScript.blade.php

            } catch (QueryException $ex) {
                return redirect('studentRegistration')->with('error_code', 0);//pass a variable when redirecting to msgScript.blade.php
            }
        }
    }//save student details

    /************   Student Details Update             ************************/

    public function updateShow()
    {
        return view('Activities.Student.updateRegistration');
    }//show update student details form

    public function dbUpdate(studentInsertRequest $request)
    {
        $CLS = new Charge();
        if (isset($request->state)) {
            $state = 'true';
        } elseif (!isset($request->state)) {
            $state = 'false';
        }

        if ($request->curriculum == 'nc') {
            try {

                Student_nc::where('admission_no', $request->adNo)
                    ->update(['std_fname' => $request->First_name, 'std_lname' => $request->Last_name, 'std_gender' => $request->gender,
                        'std_dob' => $request->DOB, 'std_address' => $request->Address, 'std_tel_no' => $request->Tell,
                        'std_f_fname' => $request->Father_First_name, 'std_f_lname' => $request->Father_Last_name, 'std_m_fname' => $request->Mother_First_name,
                        'std_m_lname' => $request->mLname, 'date_admission' => $request->date, 'std_m_moblie' => $request->Mother_tell,
                        'std_f_mobile' => $request->Father_tell, 'state' => $state]);

                $classCat = $CLS->getClassCategory($request->input('class'));//get class category id

                DB::table('student_class_tbl')->where('admission_no', '=', $request->adNo)->update([
                    'class_cat_id' => $classCat
                ]);//update class category id

                return redirect('studentRegistrationUpdate')->with('error_code', 4); //pass a variable when redirecting to msgScript.blade.php
            } catch
            (QueryException $ex) {
                return redirect('studentRegistrationUpdate')->with('error_code', 3);//pass a variable when redirecting to msgScript.blade.php
            }

        } elseif ($request->curriculum == 'bc') {
            try {
                Student_bc::where('admission_no', $request->adNo)
                    ->update(['std_fname' => $request->First_name, 'std_lname' => $request->Last_name, 'std_gender' => $request->gender,
                        'std_dob' => $request->DOB, 'std_address' => $request->Address, 'std_tel_no' => $request->Tell,
                        'std_f_fname' => $request->Father_First_name, 'std_f_lname' => $request->Father_Last_name, 'std_m_fname' => $request->Mother_First_name,
                        'std_m_lname' => $request->mLname, 'date_admission' => $request->date, 'std_m_moblie' => $request->Mother_tell,
                        'std_f_mobile' => $request->Father_tell, 'state' => $state]);

                $classCat = $CLS->getClassCategory($request->input('class'));//get class category id

                DB::table('student_class_tbl')->where('admission_no', '=', $request->adNo)->update([
                    'class_cat_id' => $classCat
                ]);//update class category id

                return redirect('studentRegistrationUpdate')->with('error_code', 5); //pass a variable when redirecting to msgScript.blade.php
            } catch
            (QueryException $ex) {
                return redirect('studentRegistrationUpdate')->with('error_code', 3);//pass a variable when redirecting to msgScript.blade.php
            }
        }

    }

    public function adNoAutoComplete(Request $request)
    {
        $query = $request->get('term', '');

        if (substr($query, 0, 2) == 'nc') {
            $products = Student_nc::where('admission_no', 'LIKE', '%' . $query . '%')->limit(10)->get();
        }
        if (substr($query, 0, 2) == 'bc') {
            $products = Student_bc::where('admission_no', 'LIKE', '%' . $query . '%')->limit(10)->get();
        }
        $data = array();
        foreach ($products as $product) {
            $data[] = array('value' => $product->admission_no, 'id' => $product->id);
        }
        if (count($data))
            return $data;
        else
            return ['value' => 'No Result Found', 'id' => ''];
    }

    public function nameAutoComplete(Request $request)
    {

        $query = $request->get('term', '');
        $curry = $request->get('curry', '');

        if ($curry == 'nc') {
            $products = Student_nc::select('admission_no', 'std_fname')->where('std_fname', 'LIKE', '%' . $query . '%')->limit(10)->get();
        } elseif ($curry == 'bc') {
            $products = Student_bc::select('admission_no', 'std_fname')->where('std_fname', 'LIKE', '%' . $query . '%')->limit(10)->get();
        }
        $data = array();
        foreach ($products as $product) {
            $data[] = array('value' => $product->std_fname . ' --[ ' . $product->admission_no . ' ]', 'id' => $product->id);
        }
        if (count($data))
            return $data;
        else
            return ['value' => 'No Result Found', 'id' => ''];
    }

    public function getsearchAdno(Request $request)
    {
        if (substr($request['id'], 0, 2) == 'nc') {
            $adData = DB::table('nc_student_details_tbl')->select('*')->where('admission_no', '=', $request['id'])->get();
            $adData2 = DB::table('student_class_tbl')->select('class_cat_id')->where('admission_no', '=', $request['id'])->get();
            foreach ($adData2 as $cat) {
                $catid = $cat->class_cat_id;
            }
            $adData3 = DB::table('class_category_tbl')->select('class_category', 'main_class_id')->where('class_cat_id', '=', $catid)->get();
            foreach ($adData3 as $i) {
                $class = $i->class_category;
                $mid = $i->main_class_id;
            }
            $adData4 = DB::table('main_class_tbl')->select('cls_name', 'c_category')->where('main_class_id', '=', $mid)->get();
            foreach ($adData4 as $gd) {
                $grade = $gd->cls_name;
                $curry = $gd->c_category;
            }
            return [$adData, $class, $grade, $curry];


        } elseif (substr($request['id'], 0, 2) == 'bc') {
            $adData = DB::table('bc_student_details_tbl')->select('*')->where('admission_no', '=', $request['id'])->get();
            $adData2 = DB::table('student_class_tbl')->select('class_cat_id')->where('admission_no', '=', $request['id'])->get();
            foreach ($adData2 as $cat) {
                $catid = $cat->class_cat_id;
            }
            $adData3 = DB::table('class_category_tbl')->select('class_category', 'main_class_id')->where('class_cat_id', '=', $catid)->get();
            foreach ($adData3 as $i) {
                $class = $i->class_category;
                $mid = $i->main_class_id;
            }
            $adData4 = DB::table('main_class_tbl')->select('cls_name', 'c_category')->where('main_class_id', '=', $mid)->get();
            foreach ($adData4 as $gd) {
                $grade = $gd->cls_name;
                $curry = $gd->c_category;
            }
            return [$adData, $class, $grade, $curry];

        }
    }


    /************   VIew Student Details           ************************/

    public function getStudents()
    {
        $tbl = DB::select(DB::raw('(SELECT nc_student_details_tbl.*,
student_class_tbl.class_cat_id,
class_category_tbl.main_class_id,
class_category_tbl.class_category,
main_class_tbl.cls_name,
main_class_tbl.c_category
FROM class_category_tbl 
JOIN student_class_tbl  ON class_category_tbl.class_cat_id=student_class_tbl.class_cat_id
JOIN main_class_tbl ON main_class_tbl.main_class_id =class_category_tbl.main_class_id
JOIN nc_student_details_tbl ON nc_student_details_tbl.admission_no=student_class_tbl.admission_no
ORDER BY student_class_tbl.admission_no)
UNION
  ( SELECT bc_student_details_tbl.*,
student_class_tbl.class_cat_id,
class_category_tbl.main_class_id,
class_category_tbl.class_category,
main_class_tbl.cls_name,
main_class_tbl.c_category
FROM class_category_tbl 
JOIN student_class_tbl  ON class_category_tbl.class_cat_id=student_class_tbl.class_cat_id
JOIN main_class_tbl ON main_class_tbl.main_class_id =class_category_tbl.main_class_id
JOIN bc_student_details_tbl ON bc_student_details_tbl.admission_no=student_class_tbl.admission_no
ORDER BY student_class_tbl.admission_no)

'));
        return view('Activities.Student.viewStudents', array('Student' => $tbl));//view all Student Details
    }

    /************   Student Upgrade           ************************/

    public function viewUpgrade()
    {
        return view('Activities.Student.stuUpgrade');
    }

    public function searchStuUpgrade(Request $request)
    {
        if ($request->id == 'nc') {


            $clsFill = DB::table('student_class_tbl')
                ->join('nc_student_details_tbl', 'nc_student_details_tbl.admission_no', '=', 'student_class_tbl.admission_no')
                ->join('class_category_tbl', 'class_category_tbl.class_cat_id', '=', 'student_class_tbl.class_cat_id')
                ->where('class_category_tbl.class_category', '=', $request->classs)
                ->select('student_class_tbl.admission_no', 'nc_student_details_tbl.std_fname', 'nc_student_details_tbl.std_lname', 'class_category_tbl.class_category')
                ->get();

            return $clsFill;


        } elseif ($request->id == 'bc') {
            $clsFill = DB::table('student_class_tbl')
                ->join('bc_student_details_tbl', 'bc_student_details_tbl.admission_no', '=', 'student_class_tbl.admission_no')
                ->join('class_category_tbl', 'class_category_tbl.class_cat_id', '=', 'student_class_tbl.class_cat_id')
                ->where('class_category_tbl.class_category', '=', $request->classs)
                ->select('student_class_tbl.admission_no', 'bc_student_details_tbl.std_fname', 'bc_student_details_tbl.std_lname', 'class_category_tbl.class_category')
                ->get();

            return $clsFill;
        }
    }//search current Classes

    public function postStuUpgrade(Request $request)
    {
        $classId = DB::table('class_category_tbl')->select('class_cat_id')->where('class_category', '=', $request->Uclass)->get();
        $count = count($request->admission_no);

        for ($i = 0; $i < $count; $i++) {
            if (isset($request->ckBox[$i])) {
                try {
                    DB::table('student_class_tbl')->where('admission_no', '=', $request->admission_no[$i])->update(['class_cat_id' => $classId[0]->class_cat_id]);
                } catch (QueryException $ex) {
                    return redirect('viewUpgrade')->with('error_code', 111);
                }
            }
        }
        return redirect('viewUpgrade')->with('error_code', 11);

    }//update Student Upgrade Classes

}

