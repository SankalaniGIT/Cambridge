<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


Route::get('/home', 'HomeController@index')->name('home');//home page


/**********************************   User Register   **********************************/

Auth::routes();

Route::get('/level', function () {
    return view('auth.levels');
});

Route::get('/userRegister','Auth\NewRegisterController@userRegister')->name('userRegister');//view user register form in user level 1
Route::post('/postRegister','Auth\NewRegisterController@postRegister')->name('postRegister');//post user register form in user level 1


/********************************** School Charges  **********************************/

Route::get('/viewCharges','ChargesController@index')->name('ViewCharges');//View Charges table

Route::post('/postUserRegister','Auth\NewRegisterController@store')->name('PostUserRegister');//store user register form in user level 1


Route::get('/updateCharges','ChargesController@viewUpdate')->name('UpdateCharges');//view Update Charges table

Route::get('/saveCharges','ChargesController@saveUpdate')->name('SaveCharges');//save all updated charges


/**********************************  Student Management  **********************************/


//insert student details

Route::get('/studentGrade', 'StudentController@studentGrade');//get Student grade to select box
Route::get('/studentClass', 'StudentController@studentClass');//get Student class to select box
Route::get('/studentAddNo', 'StudentController@studentAddNo');//get Student admission no

Route::get('/studentRegistration', 'StudentController@insertShow')->name('studentRegistration');//show insert student details

Route::post('/postStudentRegistration','StudentController@dbInsertShow')->name('postStudentRegistration');//insert student details


//update student details

Route::get('/studentRegistrationUpdate', 'StudentController@updateShow')->name('studentRegistrationUpdate');//show update student details

Route::post('/postUpdateStudent','StudentController@dbUpdate')->name('postUpdateStudent');//update student details


Route::get('searchAdno',array('as'=>'searchAdno','uses'=>'StudentController@adNoAutoComplete'));//get admission nos
Route::get('searchName',array('as'=>'searchName','uses'=>'StudentController@nameAutoComplete'));//get students name

Route::get('/getsearchAdno','StudentController@getsearchAdno');//fill update student form according to admission no

//View and Print Student details

Route::get('/getStudents','StudentController@getStudents')->name('getStudents');

//upgrade all students

Route::get('/viewUpgrade','StudentController@viewUpgrade')->name('viewUpgrade');//view student classes

Route::get('/searchStuUpgrade','StudentController@searchStuUpgrade')->name('searchStuUpgrade');//fill table data

Route::post('/postStuUpgrade','StudentController@postStuUpgrade')->name('postStuUpgrade');//Post student Upgrade classes

/**********************************  Revenue  **********************************/

//Pay Fees---->IN Pay fee section


//Admission & Refundable

Route::get('/admission&Ref','RevenueController@admissionRef')->name('admission&Ref');

Route::get('/getAdRef','RevenueController@getAdRef');//fill Admission & refundable form according to admission no

Route::get('/x',function (){
    return view('Invoice.admissionInv', ['form' => 'REFUNDABLE FEE','part'=>'2nd Installment','Curriculum' => 'National Curriculum', 'invNo' => '100', 'date' => '2017-08-25',
        'AdNo' => 'nc389', 'name' => 'Fleming Snowden', 'class' => 'GRADE_7_S', 'amount' => '10000','paid'=>'1000','totPaid'=>'10000', 'bottom' => 'REFUNDABLE DEPOSIT']);
});

Route::post('/postAdmissionRef','RevenueController@postAdmissionRef')->name('postAdmissionRef');//insert admission and refundable data

//Stationary

Route::get('/viewStationary','RevenueController@viewStationary')->name('viewStationary');//View Stationary

Route::get('/getStationaryData','RevenueController@getStationaryData');//get Stationary Data

Route::post('/postStationary','RevenueController@postStationary')->name('postStationary');//insert stationary data


//Other Income

Route::get('/viewOtherIncome','RevenueController@viewOtherIncome')->name('viewOtherIncome');//View Other Income

Route::post('/postOtherIncome','RevenueController@postOtherIncome')->name('postOtherIncome');//insert Other Income


/**********************************  Expenses  **********************************/

//Pay Expenses
Route::get('/viewPayExpenses','ExpensesController@viewPayExpenses')->name('viewPayExpenses');//view pay expenses

Route::post('/postPayExpenses','ExpensesController@postPayExpenses')->name('postPayExpenses');//insert pay expenses


Route::get('/inv',function (){
    return view('Invoice.expensesInv');
});

//View Expenses
Route::get('/viewExpenses','ExpensesController@viewExpenses')->name('viewExpenses');//View and Print pay expenses


//Add New Expense
Route::get('addExpense','ExpensesController@addExpense')->name('addExpense');//view add new expense

Route::post('postAddNewExpense','ExpensesController@postAddNewExpense')->name('postAddNewExpense');//post add new expense

/**********************************  Course Billing  **********************************/

//Student Registration
Route::get('/cosStuReg','CourseController@cosStuReg')->name('cosStuReg');//view Course students

Route::post('/postCosStuReg','CourseController@postCosStuReg')->name('postCosStuReg');//insert course students

//Update Student Registration
Route::get('/UpdateCosStuReg','CourseController@UpdateCosStuReg')->name('UpdateCosStuReg');//view Update Course students
Route::post('/postUpdateCosStuReg','CourseController@postUpdateCosStuReg')->name('postUpdateCosStuReg');// course students
Route::get('/searchCosAdno','CourseController@searchCosAdno')->name('searchCosAdno');//search Course Admission no
Route::get('/getsearchCosAdno','CourseController@getsearchCosAdno')->name('getsearchCosAdno');//fill student details according to Course Admission no

//Add School Students
Route::get('/addSclStu','CourseController@addSclStu')->name('addSclStu');//view add school students to courses
Route::post('/postAddSclStu','CourseController@postAddSclStu')->name('postAddSclStu');//insert add school students to courses

//Add & Update Student Courses

//----Add
Route::get('/addStdCos','CourseController@addStdCos')->name('addStdCos');//view add student courses
Route::get('/getCosAddNo','CourseController@getCosAddNo')->name('getCosAddNo');//get course admission nos with name
Route::post('/postAddStdCos','CourseController@postAddStdCos')->name('postAddStdCos');//insert add student courses

//----Update
Route::post('/postUpdateStdCos','CourseController@postUpdateStdCos')->name('postUpdateStdCos');//update student courses
Route::get('/fillUpdateCos','CourseController@fillUpdateCos')->name('fillUpdateCos');//update student course status

//Bill a Course
Route::get('/billCourse','CourseController@billCourse')->name('billCourse');//view Billing course
Route::post('/postBillCourse','CourseController@postBillCourse')->name('postBillCourse');//insert Billing course details


//View Courses

Route::get('/viewCourses','CourseController@viewCourses')->name('viewCourses');//view Courses

Route::get('/CosInv/{course}/{id}/{invNo}/{date}/{name}/{paid}/{month}/{term}',function ($course,$id,$invNo,$date,$name,$paid,$month,$term){
    return view('Invoice.CosInv', ['class' => $course, 'AdNo' => $id, 'invNo' => $invNo, 'date' => $date, 'name' => $name, 'fee' => $paid, 'month' => $month,'term'=>$term]);
})->name('CosInv');//print Course Student details


/**********************************  Inventories  **********************************/

Route::get('/viewInventory','InventoriesController@viewInventory')->name('viewInventory');//view Inventory

Route::get('/updateInventory','InventoriesController@updateInventory')->name('updateInventory');//Add Update Delete Inventory

Route::get('/fillInventory','InventoriesController@fillInventory')->name('fillInventory');//Fill Inventory


Route::post('postAddInven','InventoriesController@postAddInven')->name('postAddInven');//post add details
Route::post('postUpdateInven','InventoriesController@postUpdateInven')->name('postUpdateInven');//Update details


/**********************************  Pay Fee (Revenue)  **********************************/


//Pay Fees

Route::get('/payFees','PayFeeController@viewPayFee')->name('payFees');//view Pay fee frm

Route::get('getAddNo',array('as'=>'getAddNo','uses'=>'RevenueController@getAddNos'));//get admission nos

Route::post('/postPayFee','PayFeeController@postPayFee')->name('postPayFee');//Post Pay Fee Details

Route::get('/fillpayfee','PayFeeController@fillpayfee')->name('fillpayfee');//fill pay fee details

Route::get('/fillPmethods','PayFeeController@fillPmethods')->name('fillPmethods');//fill payment methods

Route::get('/fillfees','PayFeeController@fillfees')->name('fillfees');//fill term fees


/**********************************  Reports  **********************************/

//Daily Report

Route::get('viewDailyReport','ReportController@viewDailyReport')->name('viewDailyReport');//view Daily Report

Route::get('fillDailyReport','ReportController@fillDailyReport')->name('fillDailyReport');//fill Daily Report

//Daily Transaction Report

Route::get('viewDailyTraReport','ReportController@viewDailyTraReport')->name('viewDailyTraReport');//view Daily Transaction Report

Route::get('fillDailyTReport','ReportController@fillDailyTReport')->name('fillDailyTReport');//fill daily Transaction Report

//Fees History Report

Route::get('viewFeeHistory','ReportController@viewFeeHistory')->name('viewFeeHistory');//view fee history

Route::get('fillTFHistory','ReportController@fillTFHistory')->name('fillTFHistory');//fill fee history

//Print Term Fee Report

Route::get('printTermFee','ReportController@printTermFee')->name('printTermFee');//view term fee report

//Payment Arrears List Report

Route::get('viewArrears','ReportController@viewArrears')->name('viewArrears');//view payment arrears report

Route::get('fillPayArrearsRpt','ReportController@fillPayArrearsRpt')->name('fillPayArrearsRpt');//fill payment arrears report

//Monthly Report

Route::get('viewMonthlyRpt','ReportController@viewMonthlyRpt')->name('viewMonthlyRpt');//view Monthly Report

Route::get('getMonthlyRpt','ReportController@getMonthlyRpt')->name('getMonthlyRpt');//fill Monthly Report

Route::get('pnlExcel','ReportController@pnlExcel')->name('pnlExcel');//export Monthly Report to excel



/**********************************  Old school data base transfer to new one  **********************************/

Route::get('oldTFtoNew','oldTFtoNewDbController@oldTFtoNew')->name('oldTFtoNew');//convert term fee old tbl data to new
Route::get('oldExExFtoNew','oldEXextraToNewDbController@oldExExFtoNew')->name('oldExExFtoNew');//convert term fee old tbl data to new


