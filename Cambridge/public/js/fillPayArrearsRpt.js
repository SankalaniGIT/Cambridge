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
/******/ 	return __webpack_require__(__webpack_require__.s = 56);
/******/ })
/************************************************************************/
/******/ ({

/***/ 56:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(57);


/***/ }),

/***/ 57:
/***/ (function(module, exports) {

$(document).ready(function () {
    $('#subBtn').click(function () {
        $('#tblbody').find("tr:gt(0)").remove();
        $.ajax({
            type: 'get',
            url: 'fillPayArrearsRpt',
            data: { year: $('#year').val() },
            success: function success(data) {
                var cls = 'c';
                $.each(data, function (index, value) {
                    if (value.class_category != cls) {
                        cls = value.class_category;
                        var x = '<tr>' + '<td style="font-weight: 600" colspan="4">' + value.class_category + '</td>' + '</tr>';

                        $('#tblbody tr:last').after(x);
                    } //add class category raw

                    var y = '<tr>' + '<td>' + value.admmision_no + '</td>' + '<td>' + value.NAME + '</td>' + '<td>' + value.class_category + '</td>' + '<td>' + value.amount + '</td>' + '<td>' + value.totYrfee + '</td>' + '<td>' + (value.totYrfee - value.amount) + '</td>' + '<td>' + value.yrs + '</td>' + '</tr>';

                    $('#tblbody tr:last').after(y); //add other raws
                });

                $('#hd').text(' Student Payment Arrears for ' + $('#year').val());
                $('#printDiv').removeClass('hidden');
                $('#btn').removeClass('hidden');
            }
        });
    });
});

/***/ })

/******/ });