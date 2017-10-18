/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 51);
/******/ })
/************************************************************************/
/******/ ({

/***/ 51:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(52);


/***/ }),

/***/ 52:
/***/ (function(module, exports) {

$(document).ready(function () {
    $('#subBtn').click(function () {
        $('#tblbody').find("tr:gt(0)").remove();
        $.ajax({
            type: 'get',
            url: 'fillDailyTReport',
            data: { Fdate: $('#Fdate').val(), Tdate: $('#Tdate').val() },
            success: function success(data) {
                $.each(data[0], function (index, value) {
                    $.each(value, function (index2, value2) {
                        var x = '<tr>' + '<td>' + value2.term_invoice_date + '</td>' + '<td> Term Fees-NC </td>' + '<td>' + value2.admmision_no + '</td>' + '<td></td>' + '<td>' + value2.amount + '</td>' + '</tr>';

                        $('#tblbody tr:last').after(x);
                    });
                }); //nc term fee

                $.each(data[1], function (index, value) {
                    $.each(value, function (index2, value2) {
                        var x = '<tr>' + '<td>' + value2.term_invoice_date + '</td>' + '<td> Term Fees-BC </td>' + '<td>' + value2.admmision_no + '</td>' + '<td></td>' + '<td>' + value2.amount + '</td>' + '</tr>';

                        $('#tblbody tr:last').after(x);
                    });
                }); //bc term fee

                $.each(data[2], function (index, value) {
                    var x = '<tr>' + '<td>' + value.term_invoice_date + '</td>' + '<td> Exam Fees-NC </td>' + '<td>' + value.admmision_no + '</td>' + '<td></td>' + '<td>' + value.exam_fee + '</td>' + '</tr>';

                    $('#tblbody tr:last').after(x);
                }); //nc exam fee

                $.each(data[3], function (index, value) {
                    var x = '<tr>' + '<td>' + value.term_invoice_date + '</td>' + '<td> Exam Fees-BC </td>' + '<td>' + value.admmision_no + '</td>' + '<td></td>' + '<td>' + value.exam_fee + '</td>' + '</tr>';

                    $('#tblbody tr:last').after(x);
                }); //bc exam fee

                $.each(data[4], function (index, value) {
                    var x = '<tr>' + '<td>' + value.term_invoice_date + '</td>' + '<td> Extra Curricular Fees-NC </td>' + '<td>' + value.admmision_no + '</td>' + '<td></td>' + '<td>' + value.extra_cur_fee + '</td>' + '</tr>';

                    $('#tblbody tr:last').after(x);
                }); //nc extra curricular fee

                $.each(data[5], function (index, value) {
                    var x = '<tr>' + '<td>' + value.term_invoice_date + '</td>' + '<td> Extra Curricular Fees-BC </td>' + '<td>' + value.admmision_no + '</td>' + '<td></td>' + '<td>' + value.extra_cur_fee + '</td>' + '</tr>';

                    $('#tblbody tr:last').after(x);
                }); //bc extra curricular fee

                $.each(data[6], function (index, value) {
                    var x = '<tr>' + '<td>' + value.st_date + '</td>' + '<td>' + value.st_type + '</td>' + '<td>' + value.admission_no + '</td>' + '<td></td>' + '<td>' + value.amount + '</td>' + '</tr>';

                    $('#tblbody tr:last').after(x);
                }); //stationary income

                $.each(data[7], function (index, value) {
                    var x = '<tr>' + '<td>' + value.date + '</td>' + '<td>' + value.type + '</td>' + '<td></td>' + '<td></td>' + '<td>' + value.amount + '</td>' + '</tr>';

                    $('#tblbody tr:last').after(x);
                }); //Other income

                $.each(data[8], function (index, value) {
                    var x = '<tr>' + '<td>' + value.dates + '</td>' + '<td>' + value.ad_payment_type + '</td>' + '<td>' + value.admission_no + '</td>' + '<td></td>' + '<td>' + value.ad_paid_amount + '</td>' + '</tr>';

                    $('#tblbody tr:last').after(x);
                }); //admission and refund income

                $.each(data[9], function (index, value) {
                    var x = '<tr>' + '<td>' + value.date + '</td>' + '<td>' + value.student_id + '</td>' + '<td>' + value.course_name + '<br>invoice No:' + value.st_c_fee_invNo + '<br>Month:' + value.month + '</td>' + '<td></td>' + '<td>' + value.fee_amount + '</td>' + '</tr>';

                    $('#tblbody tr:last').after(x);
                }); //course income

                $.each(data[10], function (index, value) {
                    var x = '<tr>' + '<td>' + value.dates + '</td>' + '<td>' + value.admission_no + '</td>' + '<td>Admission Discount</td>' + '<td>' + value.discount + '</td>' + '<td></td>' + '</tr>';

                    $('#tblbody tr:last').after(x);
                }); //admission discount expenses

                $.each(data[11], function (index, value) {
                    var x = '<tr>' + '<td>' + value.date + '</td>' + '<td>' + value.expense_type + '</td>' + '<td>' + value.description + '<br>Receiver:' + value.receiver_name + '</td>' + '<td>' + value.amount + '</td>' + '<td></td>' + '</tr>';

                    $('#tblbody tr:last').after(x);
                }); //other expenses

                var x = '<tr style="font-weight: 600">' + '<td></td>' + '<td> TOTAL INCOME </td>' + '<td></td>' + '<td>-</td>' + '<td>' + data[12] + '</td>' + '</tr>';

                $('#tblbody tr:last').after(x); //total income

                var y = '<tr style="font-weight: 600">' + '<td></td>' + '<td> TOTAL EXPENSE </td>' + '<td></td>' + '<td>' + data[13] + '</td>' + '<td>-</td>' + '</tr>';

                $('#tblbody tr:last').after(y); //total expenses

                $('#hd').text('' + $('#Fdate').val() + ' To ' + $('#Tdate').val() + ' Transaction Details Report');
                $('#printDiv').removeClass('hidden');
                $('#btn').removeClass('hidden');
            }
        });
    });
});

/***/ })

/******/ });