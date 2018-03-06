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
/******/ 	return __webpack_require__(__webpack_require__.s = 43);
/******/ })
/************************************************************************/
/******/ ({

/***/ 43:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(44);


/***/ }),

/***/ 44:
/***/ (function(module, exports) {

var ACTIVE = "active";
var INVALID = "invalid";
window.Dropzone.autoDiscover = false;
// let urlName = window.location.href + "/uploadImage"
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    setInputField();

    var dropzone = $("#dropzone").dropzone({
        url: "/add/uploadImage",
        addRemoveLinks: true,
        method: 'get',
        withCredentials: false,
        dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
        dictResponseError: 'Error uploading file!',
        headers: {
            'X-CSRFToken': $('meta[name="csrf-token"]').attr('content')
        },
        allowExt: '|gif|jpg|jpeg|png|bmp|',
        maxFileSize: 3242880,
        maxFiles: 5,
        showProgress: false,
        success: function success(file, response) {
            console.log(response);
        }

    });
});

function setInputField() {
    // Create house

    $("#name").on("change", validateFetch);
    $("#location").on("change", validateFetch);
    $("#direction").on("change", validateFetch);
    $("#price_user_night").on("change", validateFetch);
    $("#max_users_house").on("change", validateFetch);
    $("#features").on("change", validateFetch);
    $("#description").on("change", validateFetch);

    // Add comment
    $("#comment").on("change", validateFetch);
    $('a[data-toggle="list"]').on('shown.bs.tab', checkErrorClass);
}

function validateFetch(parameter) {
    var myHeaders = new Headers();
    myHeaders.append("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    var form = new FormData();

    var inputTargetName = parameter.currentTarget.name;
    var finaInputTargetName = $("#" + inputTargetName);
    form.append(inputTargetName, finaInputTargetName.val());
    form.append("type", inputTargetName);
    var configuracion = {
        method: 'POST',
        headers: myHeaders,
        body: form,
        credentials: "same-origin"
    };
    var urlName = window.location.href + "/profile/delete";

    fetch(urlName, configuracion).then(function (response) {

        return response.json();
    }).then(function (data) {

        var errors = data[inputTargetName];

        if (data.length === 0) {
            errors = [];
        }

        gestionarErrores(finaInputTargetName, errors);
    }).catch(function (err) {
        console.log("error" + err);
    });
}

function gestionarErrores(input, errores) {
    var hayErrores = false;
    var divErrores = input.next();
    divErrores.html("");
    input.removeClass("is-valid is-invalid");

    // Si array errores es igual se añade la clase correspondiente
    if (errores.length === 0) {
        input.addClass("is-valid");
        checkErrorClass();

        // Se comprueba si todos los elementos del formulario estan validados
        var validationItems = $(".valid-item");
        var validatedItem = $(".is-valid");
        var submitButton = $(".submit-button");

        if (validationItems.length === validatedItem.length) {
            submitButton.prop("disabled", false);
        }
    } else {
        hayErrores = true;
        input.addClass("is-invalid");
        var _iteratorNormalCompletion = true;
        var _didIteratorError = false;
        var _iteratorError = undefined;
        checkErrorClass();

        try {
            for (var _iterator = errores[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                var error = _step.value;

                divErrores.append("<div class=\"alert alert-danger\" role=\"alert\" >" + error + "</div>");
            }
        } catch (err) {
            _didIteratorError = true;
            _iteratorError = err;
        } finally {
            try {
                if (!_iteratorNormalCompletion && _iterator.return) {
                    _iterator.return();
                }
            } finally {
                if (_didIteratorError) {
                    throw _iteratorError;
                }
            }
        }
    }
    return hayErrores;
}

function checkErrorClass() {

    var paneOne = $('.pane-one');
    var paneTwo = $('.pane-two');
    var paneOneBadge = $('.pane-one-badge');
    var paneTwoBadge = $('.pane-two-badge');
    var PaneOneButton = $('#list-data-list');
    var PaneTwoButton = $('#list-features-list');
    var errors = void 0;

    if (PaneTwoButton.attr('class').search(ACTIVE) !== -1) {
        paneTwoBadge.text("");
        paneOneBadge.text("");
        errors = findErrorsInPane(paneOne);
        paneOneBadge.text(errors !== 0 ? errors : "");
    } else if (PaneOneButton.attr('class').search(ACTIVE) !== -1) {
        paneOneBadge.text("");
        paneTwoBadge.text("");
        errors = findErrorsInPane(paneTwo);
        paneTwoBadge.text(errors !== 0 ? errors : "");
    }
}

function findErrorsInPane(pane) {
    var errors = [];
    for (var i = 0; i < pane.length; i++) {
        var item = $(pane[i]);
        var itemClass = item.attr('class');
        if (itemClass.search(INVALID) !== -1) {
            errors.push(item);
        }
    }

    return errors.length;
}

/***/ })

/******/ });