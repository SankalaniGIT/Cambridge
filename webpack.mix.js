const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.sass('resources/assets/sass/home/updateLogin.scss', 'public/css/');
mix.sass('resources/assets/sass/charges/charges.scss', 'public/css/');
mix.sass('resources/assets/sass/auth/user.scss', 'public/css/');
mix.sass('resources/assets/sass/forms/forms.scss', 'public/css/');
mix.sass('resources/assets/sass/forms/msg.scss', 'public/css/');
mix.sass('resources/assets/sass/student/studentUpdate.scss', 'public/css/');
mix.sass('resources/assets/sass/student/viewStudentTbl.scss', 'public/css/');
mix.sass('resources/assets/sass/student/upgrade.scss', 'public/css/');
mix.sass('resources/assets/sass/revenue/ckBox.scss', 'public/css/');
mix.sass('resources/assets/sass/revenue/admission&refund.scss', 'public/css/');
mix.sass('resources/assets/sass/revenue/viewPayFee.scss', 'public/css/');
mix.sass('resources/assets/sass/invoice/admissionInv.scss', 'public/css/');
mix.sass('resources/assets/sass/invoice/stationaryInv.scss', 'public/css/');
mix.sass('resources/assets/sass/revenue/stationary.scss', 'public/css/');
mix.sass('resources/assets/sass/expenses/payExp.scss', 'public/css/');
mix.sass('resources/assets/sass/invoice/expensesInv.scss', 'public/css/');
mix.sass('resources/assets/sass/expenses/viewExpenses.scss', 'public/css/');
mix.sass('resources/assets/sass/course/viewCourse.scss', 'public/css/');
mix.sass('resources/assets/sass/inventory/viewInventory.scss', 'public/css/');
mix.sass('resources/assets/sass/Reports/viewFeeHistory.scss', 'public/css/');


mix.js('resources/assets/js/charges/charges.js', 'public/js/');
mix.js('resources/assets/js/msg/msg.js', 'public/js/');
mix.js('resources/assets/js/student/insertStudent.js', 'public/js/');
mix.js('resources/assets/js/student/studentManagement.js', 'public/js/');
mix.js('resources/assets/js/student/fillUpdateStudents.js', 'public/js/');
mix.js('resources/assets/js/Revenue/fillAdmissionRefund.js', 'public/js/');
mix.js('resources/assets/js/Revenue/fillStationary.js', 'public/js/');
mix.js('resources/assets/js/expenses/fillExpenses.js', 'public/js/');
mix.js('resources/assets/js/expenses/viewExpenses.js', 'public/js/');
mix.js('resources/assets/js/courses/fillUpdateCosStu.js', 'public/js/');
mix.js('resources/assets/js/courses/fillUpdateCos.js', 'public/js/');
mix.js('resources/assets/js/courses/viewCosStudent.js', 'public/js/');
mix.js('resources/assets/js/inventory/viewInventory.js', 'public/js/');
mix.js('resources/assets/js/inventory/fillInventory.js', 'public/js/');
mix.js('resources/assets/js/Revenue/viewPayFee.js', 'public/js/');
mix.js('resources/assets/js/Reports/dailyReport.js', 'public/js/');
mix.js('resources/assets/js/Reports/filldailyTReport.js', 'public/js/');
mix.js('resources/assets/js/Reports/viewFeeHistory.js', 'public/js/');
mix.js('resources/assets/js/Reports/fillPayArrearsRpt.js', 'public/js/');
mix.js('resources/assets/js/Reports/fillMonthlyRpt.js', 'public/js/');



mix.styles([
    'resources/assets/sass/app.scss',
    'resources/assets/sass/home/home.scss',
    'resources/assets/sass/home/navbar.scss',
    'resources/assets/sass/home/logo.scss',

], 'public/css/all.css');

mix.scripts([
    'resources/assets/js/home/home.js',
    'resources/assets/js/home/navbar.js',
], 'public/js/alljs.js');

mix.scripts([
    'resources/assets/js/student/fillStuUpgrade.js',
    'resources/assets/js/student/searchStuUpgrade.js',
], 'public/js/studentUpgrade.js');

mix.scripts([
    'resources/assets/js/Revenue/fillPayFeeDetails.js',
    'resources/assets/js/Revenue/fillPmethods.js',
    'resources/assets/js/Revenue/fillfees.js'
], 'public/js/payFee.js');


