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
/******/ 	return __webpack_require__(__webpack_require__.s = 49);
/******/ })
/************************************************************************/
/******/ ({

/***/ 49:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(50);


/***/ }),

/***/ 50:
/***/ (function(module, exports) {

$(document).ready(function () {
    $('#subBtn').click(function () {
        $.ajax({
            type: 'get',
            url: 'fillDailyReport',
            data: { date: $('#date').val() },
            success: function success(data) {
                //($cashInHand , $bcTotTF , $ncTotTF , $bcTotEF , $ncTotEF , $bcTotExtF , $ncTotExtF , $stationary , $refund
                // , $admission , $courseFee ,$otherIncome, $discountExp,$expense,$totalIcome,$totalExpenses,$totCashInHand);

                $('#CIH').text(data[0]);
                $('#bcTF').text(data[1]);
                $('#ncTF').text(data[2]);
                $('#bcEF').text(data[3]);
                $('#ncEF').text(data[4]);
                $('#bcExtF').text(data[5]);
                $('#ncExtF').text(data[6]);
                $('#sta').text(data[7]);
                $('#ref').text(data[8]);
                $('#admi').text(data[9]);
                $('#cos').text(data[10]);

                $.map(data[11], function (val, index) {
                    var x = '<tr>' + '<td>' + val.type + '</td>' + '<td></td>' + '<td>' + val.totOincome + '</td>' + '</tr>';

                    $('#addOincome').closest('tr').after(x);
                });

                $('#dis').text(data[12]);

                $.map(data[13], function (val, index) {
                    var x = '<tr>' + '<td>' + val.expense_type + '</td>' + '<td>' + val.totExp + '</td>' + '<td></td>' + '</tr>';

                    $('#addExp').closest('tr').after(x);
                });

                $('#totIncm').text(data[14]);
                $('#totExp').text(data[15]);
                $('#totCIH').text(data[16]);
                $('#hd').text(' Day Sheet as at ' + $('#date').val());
            }
        });
    });
});

/***/ })

/******/ });