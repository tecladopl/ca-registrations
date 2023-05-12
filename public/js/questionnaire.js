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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/questionnaire.js":
/*!***************************************!*\
  !*** ./resources/js/questionnaire.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var step = 1;
  $('#font-size-up').on('click', function () {
    if (step <= 2) {
      $('p,li,h1,h3,h4,label,input').each(function (index, value) {
        var k = parseFloat($(this).css('font-size'));
        var redSize = k * 1.2;
        $(this).css('font-size', redSize);
      });
      step++;
    }
  });
  $('#font-size-down').on('click', function () {
    if (step > 1) {
      $('p,li,h1,h3,h4,label,input').each(function (index, value) {
        var k = parseFloat($(this).css('font-size'));
        var redSize = k / 1.2;
        $(this).css('font-size', redSize);
      });
      step--;
    }
  });
  $('.checkAll').click(function () {
    $('input:checkbox').prop('checked', true);
  });
  var calendar = flatpickr(".calendar", {
    dateFormat: "d-m-Y",
    maxDate: new Date(new Date().getFullYear() - 18, new Date().getMonth(), new Date().getDay()),
    "locale": {
      "firstDayOfWeek": 1 // start week on Monday

    },
    wrap: true,
    allowInput: true,
    clickOpens: false
  });
  $(".calendar-open").on("click", function () {
    calendar.open();
  });
  flatpickr(".calendar2", {
    dateFormat: "Y-m-d H:i:ss",
    "locale": {
      "firstDayOfWeek": 1 // start week on Monday

    },
    wrap: false,
    allowInput: false,
    clickOpens: true,
    enableTime: true,
    time_24hr: true
  });
  flatpickr(".calendar3", {
    dateFormat: "Y-m-d H:i:ss",
    "locale": {
      "firstDayOfWeek": 1 // start week on Monday

    },
    wrap: false,
    allowInput: false,
    clickOpens: true,
    enableTime: true,
    time_24hr: true
  });
  $("#clear").on("click", function (e) {
    $(':input', 'form').not(':button, :submit, :reset, :hidden').removeAttr('checked').removeAttr('selected');
  });
});

/***/ }),

/***/ 1:
/*!*********************************************!*\
  !*** multi ./resources/js/questionnaire.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\undefined\html\panele-rejestracja\resources\js\questionnaire.js */"./resources/js/questionnaire.js");


/***/ })

/******/ });