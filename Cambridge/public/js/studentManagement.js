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
/******/ 	return __webpack_require__(__webpack_require__.s = 23);
/******/ })
/************************************************************************/
/******/ ({

/***/ 23:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(24);


/***/ }),

/***/ 24:
/***/ (function(module, exports) {

$(document).ready(function () {

    $('#curriculum').change(function () {

        var id = $('#curriculum').find(":selected").val();

        //*********************      Get grade options to select box in Insert Student Details        */


        $.ajax({
            type: 'get',
            url: 'studentGrade',
            data: { id: id },
            success: function success(data) {
                $('#grade').find('option').remove().end();
                for (var i = 0; i < data.length; i++) {
                    for (var grade in data[i]) {
                        $('#grade').append($("<option></option>").attr("value", data[i][grade]).text(data[i][grade]));
                    }
                }
            }
        });

        //  /*********************      Get class options to select box in Insert Student Details       */


        $.ajax({
            type: 'get',
            url: 'studentClass',
            data: { id: id },
            success: function success(data) {
                $('#class').find('option').remove().end();
                for (var i = 0; i < data.length; i++) {
                    for (var classes in data[i]) {
                        $('#class').append($("<option></option>").attr("value", data[i][classes]).text(data[i][classes]));
                    }
                }
            }
        });

        //  /*********************      Get Admission No according to curriculum in Insert Student Details       */


        $.ajax({
            type: 'get',
            url: 'studentAddNo',
            data: { id: id },
            success: function success(data) {
                for (var i = 0; i < data.length; i++) {
                    for (var classes in data[i]) {
                        var value = data[i][classes];
                        var no = parseInt(value.substr(2));
                        var lno = no + 1;

                        if (value.match("^nc")) {
                            adNo = 'nc' + lno;
                        } else if (value.match("^bc")) {
                            adNo = 'bc' + lno;
                        }
                        $('#adNoid').val(adNo);
                    }
                }
            }
        });
    });

    $('#curriculum').change();

    $('#state').change(function () {
        cb = $(this);
        cb.val(cb.prop('checked'));
    }); //change state checkbox value

});

/***/ })

/******/ });