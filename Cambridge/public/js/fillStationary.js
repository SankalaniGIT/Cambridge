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
/******/ 	return __webpack_require__(__webpack_require__.s = 31);
/******/ })
/************************************************************************/
/******/ ({

/***/ 31:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(32);


/***/ }),

/***/ 32:
/***/ (function(module, exports) {

$(document).ready(function () {
    $globleVal = 0;
    $('#btnAdd').click(function () {
        if ($('#adNo').val() == 0 || $('#quantity').val() == 0) {} else {
            $.ajax({
                type: 'get',
                url: 'getStationaryData',
                data: { id: $('#adNo').val(), item: $('#item').val(), Qty: $('#quantity').val() },
                success: function success(data) {
                    var array = data.split('--');
                    $globleVal++;
                    var htmlcode = '<tr id="' + $globleVal + '">' + '<td width="35%">' + '<input type="text" name="item[]" value="' + array[0] + '" class="form-control" readonly>' + '</td>' + '<td width="15%">' + '<input type="text" name="qty[]" value="' + array[1] + '" class="form-control" readonly>' + '</td>' + '<td width="15%">' + '<input type="text" name="UPrice[]" value="' + array[2] + '" class="form-control" readonly>' + '</td>' + '<td width="15%">' + '<input type="text" name="tot[]" value="' + array[3] + '" class="form-control" readonly>' + '</td>' + '<td width="7%">' + '<input type="button" name="remove[]" value="Remove" onclick="removebtn($(this))" class="btn remove btn-info form-control">' + '</td>' + '</tr>';

                    $('#tblbody').append(htmlcode);
                    $('#name').val($('#adNo').val());

                    if (array[4] == 0) {
                        document.getElementById('mHeader').innerHTML = 'Stationary';
                        document.getElementById('mtxt').innerHTML = 'Stock is not enough!';
                        click();
                    }
                }

            });

            $('form').removeClass('hidden');
        }
    });
});

/***/ })

/******/ });