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
/******/ 	return __webpack_require__(__webpack_require__.s = 27);
/******/ })
/************************************************************************/
/******/ ({

/***/ 27:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(28);


/***/ }),

/***/ 28:
/***/ (function(module, exports) {

$(document).ready(function () {

    $('#adclick').click(function () {
        //*********************      fill Admission & Refundable data according to admission no        */
        $('#refundErr').addClass("hidden");
        $('#admissionErr').addClass("hidden");
        $('#admission1stPartErr').addClass("hidden");
        $('#border').css("border", "");
        $('#partRow').addClass("hidden");

        $('#discount').val('');
        $('#1stPart').val('');
        $('#2ndPart').val('');
        if ($('#adNo').val() == '') {} else {
            $.ajax({
                type: 'get',
                url: 'getAdRef',
                data: { id: $('#adNo').val(), ptype: $('#Payment_Type').val(), category: $('#category').val() },
                success: function success(data) {
                    // return [$name, $class, $ammount, $discount, $paid,$count];

                    $('#name').val(data[0]);
                    $('#class').val(data[1]);
                    $('#amount').val(data[2]);

                    changeDiscountColor(data[3]);
                    if ($('#category').val() == 'Admission Fee') {

                        $('#discount').attr('readonly', false);
                        $('#partPaymentid').removeClass("hidden");

                        if (data[5] > 0) {

                            $('#discount').val(data[3]);

                            if (data[5] == 1 && data[4] == data[2]) {
                                $('#admissionErr').removeClass("hidden");
                                $('#border').css("border", "double");
                            } //check discount and paid amount is equal to amount (mean full payment)
                            else if (data[5] == 1 && data[4] < data[2]) {
                                    $('#Payment_Type').val('Part');
                                    $('#admission1stPartErr').removeClass("hidden");
                                    $('#border').css("border", "double");
                                    $('#1stPart').val(data[4]);
                                    $('#1stPart').attr('readonly', true);
                                    $('#partRow').removeClass("hidden");
                                } //check discount and paid amount is less than to amount (mean part payment)
                            if (data[5] == 2) {
                                $('#admissionErr').removeClass("hidden");
                                $('#border').css("border", "double");
                            } //paid admission fee all parts (mean full payment)
                        } //check admission fee is exist this payment
                    } else if ($('#category').val() == 'Refundable Deposit') {

                        $('#partRow').addClass("hidden");
                        $('#partPaymentid').addClass("hidden");
                        $('#discount').attr('readonly', true);

                        if (data[5] > 0) {
                            $('#refundErr').removeClass("hidden");
                            $('#border').css("border", "double");
                        } //check Refundable Deposit is exist this payment
                    }
                }
            });
        }
    });

    $('#Payment_Type').change(function () {
        if ($(this).val() === 'Part') {
            $('#partRow').removeClass("hidden");
        } else {
            $('#partRow').addClass("hidden");
        }
    }); //hide part payment and paid amount according to payment type

    function changeDiscountColor($val) {

        if ($val == 0) {
            $('#discount').css("border-color", "#ccc");
        } else if ($val != 0) {
            $('#discount').css("border-color", "red");
        }
    } //change discount border color when not empty
});

/***/ })

/******/ });