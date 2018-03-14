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
/******/ 	return __webpack_require__(__webpack_require__.s = 50);
/******/ })
/************************************************************************/
/******/ ({

/***/ 40:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return Spinner; });
var __assign = (this && this.__assign) || Object.assign || function(t) {
    for (var s, i = 1, n = arguments.length; i < n; i++) {
        s = arguments[i];
        for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
            t[p] = s[p];
    }
    return t;
};
var defaults = {
    lines: 12,
    length: 7,
    width: 5,
    radius: 10,
    scale: 1.0,
    corners: 1,
    color: '#000',
    fadeColor: 'transparent',
    opacity: 0.25,
    rotate: 0,
    direction: 1,
    speed: 1,
    trail: 100,
    fps: 20,
    zIndex: 2e9,
    className: 'spinner',
    top: '50%',
    left: '50%',
    shadow: 'none',
    position: 'absolute',
};
var Spinner = /** @class */ (function () {
    function Spinner(opts) {
        if (opts === void 0) { opts = {}; }
        this.opts = __assign({}, defaults, opts);
    }
    /**
     * Adds the spinner to the given target element. If this instance is already
     * spinning, it is automatically removed from its previous target by calling
     * stop() internally.
     */
    Spinner.prototype.spin = function (target) {
        var _this = this;
        this.stop();
        this.el = document.createElement('div');
        this.el.className = this.opts.className;
        this.el.setAttribute('role', 'progressbar');
        css(this.el, {
            position: this.opts.position,
            width: 0,
            zIndex: this.opts.zIndex,
            left: this.opts.left,
            top: this.opts.top,
            transform: "scale(" + this.opts.scale + ")",
        });
        if (target) {
            target.insertBefore(this.el, target.firstChild || null);
        }
        var animator;
        var getNow;
        if (typeof requestAnimationFrame !== 'undefined') {
            animator = requestAnimationFrame;
            getNow = function () { return performance.now(); };
        }
        else {
            // fallback for IE 9
            animator = function (callback) { return setTimeout(callback, 1000 / _this.opts.fps); };
            getNow = function () { return Date.now(); };
        }
        var lastFrameTime;
        var state = 0; // state is rotation percentage (between 0 and 1)
        var animate = function () {
            var time = getNow();
            if (lastFrameTime === undefined) {
                lastFrameTime = time - 1;
            }
            state += getAdvancePercentage(time - lastFrameTime, _this.opts.speed);
            lastFrameTime = time;
            if (state > 1) {
                state -= Math.floor(state);
            }
            if (_this.el.childNodes.length === _this.opts.lines) {
                for (var line = 0; line < _this.opts.lines; line++) {
                    var opacity = getLineOpacity(line, state, _this.opts);
                    _this.el.childNodes[line].childNodes[0].style.opacity = opacity.toString();
                }
            }
            _this.animateId = _this.el ? animator(animate) : undefined;
        };
        drawLines(this.el, this.opts);
        animate();
        return this;
    };
    /**
     * Stops and removes the Spinner.
     * Stopped spinners may be reused by calling spin() again.
     */
    Spinner.prototype.stop = function () {
        if (this.el) {
            if (typeof requestAnimationFrame !== 'undefined') {
                cancelAnimationFrame(this.animateId);
            }
            else {
                clearTimeout(this.animateId);
            }
            if (this.el.parentNode) {
                this.el.parentNode.removeChild(this.el);
            }
            this.el = undefined;
        }
        return this;
    };
    return Spinner;
}());

function getAdvancePercentage(msSinceLastFrame, roundsPerSecond) {
    return msSinceLastFrame / 1000 * roundsPerSecond;
}
function getLineOpacity(line, state, opts) {
    var linePercent = (line + 1) / opts.lines;
    var diff = state - (linePercent * opts.direction);
    if (diff < 0 || diff > 1) {
        diff += opts.direction;
    }
    // opacity should start at 1, and approach opacity option as diff reaches trail percentage
    var trailPercent = opts.trail / 100;
    var opacityPercent = 1 - diff / trailPercent;
    if (opacityPercent < 0) {
        return opts.opacity;
    }
    var opacityDiff = 1 - opts.opacity;
    return opacityPercent * opacityDiff + opts.opacity;
}
/**
 * Tries various vendor prefixes and returns the first supported property.
 */
function vendor(el, prop) {
    if (el.style[prop] !== undefined) {
        return prop;
    }
    // needed for transform properties in IE 9
    var prefixed = 'ms' + prop.charAt(0).toUpperCase() + prop.slice(1);
    if (el.style[prefixed] !== undefined) {
        return prefixed;
    }
    return '';
}
/**
 * Sets multiple style properties at once.
 */
function css(el, props) {
    for (var prop in props) {
        el.style[vendor(el, prop) || prop] = props[prop];
    }
    return el;
}
/**
 * Returns the line color from the given string or array.
 */
function getColor(color, idx) {
    return typeof color == 'string' ? color : color[idx % color.length];
}
/**
 * Internal method that draws the individual lines.
 */
function drawLines(el, opts) {
    var borderRadius = (Math.round(opts.corners * opts.width * 500) / 1000) + 'px';
    var shadow = 'none';
    if (opts.shadow === true) {
        shadow = '0 2px 4px #000'; // default shadow
    }
    else if (typeof opts.shadow === 'string') {
        shadow = opts.shadow;
    }
    var shadows = parseBoxShadow(shadow);
    for (var i = 0; i < opts.lines; i++) {
        var degrees = ~~(360 / opts.lines * i + opts.rotate);
        var backgroundLine = css(document.createElement('div'), {
            position: 'absolute',
            top: -opts.width / 2 + "px",
            width: (opts.length + opts.width) + 'px',
            height: opts.width + 'px',
            background: getColor(opts.fadeColor, i),
            borderRadius: borderRadius,
            transformOrigin: 'left',
            transform: "rotate(" + degrees + "deg) translateX(" + opts.radius + "px)",
        });
        var line = css(document.createElement('div'), {
            width: '100%',
            height: '100%',
            background: getColor(opts.color, i),
            borderRadius: borderRadius,
            boxShadow: normalizeShadow(shadows, degrees),
            opacity: opts.opacity,
        });
        backgroundLine.appendChild(line);
        el.appendChild(backgroundLine);
    }
}
function parseBoxShadow(boxShadow) {
    var regex = /^\s*([a-zA-Z]+\s+)?(-?\d+(\.\d+)?)([a-zA-Z]*)\s+(-?\d+(\.\d+)?)([a-zA-Z]*)(.*)$/;
    var shadows = [];
    for (var _i = 0, _a = boxShadow.split(','); _i < _a.length; _i++) {
        var shadow = _a[_i];
        var matches = shadow.match(regex);
        if (matches === null) {
            continue; // invalid syntax
        }
        var x = +matches[2];
        var y = +matches[5];
        var xUnits = matches[4];
        var yUnits = matches[7];
        if (x === 0 && !xUnits) {
            xUnits = yUnits;
        }
        if (y === 0 && !yUnits) {
            yUnits = xUnits;
        }
        if (xUnits !== yUnits) {
            continue; // units must match to use as coordinates
        }
        shadows.push({
            prefix: matches[1] || '',
            x: x,
            y: y,
            xUnits: xUnits,
            yUnits: yUnits,
            end: matches[8],
        });
    }
    return shadows;
}
/**
 * Modify box-shadow x/y offsets to counteract rotation
 */
function normalizeShadow(shadows, degrees) {
    var normalized = [];
    for (var _i = 0, shadows_1 = shadows; _i < shadows_1.length; _i++) {
        var shadow = shadows_1[_i];
        var xy = convertOffset(shadow.x, shadow.y, degrees);
        normalized.push(shadow.prefix + xy[0] + shadow.xUnits + ' ' + xy[1] + shadow.yUnits + shadow.end);
    }
    return normalized.join(', ');
}
function convertOffset(x, y, degrees) {
    var radians = degrees * Math.PI / 180;
    var sin = Math.sin(radians);
    var cos = Math.cos(radians);
    return [
        Math.round((x * cos + y * sin) * 1000) / 1000,
        Math.round((-x * sin + y * cos) * 1000) / 1000,
    ];
}


/***/ }),

/***/ 50:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(51);


/***/ }),

/***/ 51:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_spin_js__ = __webpack_require__(40);
var entryDate = void 0;
var exitDate = void 0;
var entry = void 0;
var exit = void 0;
var reserveButton = $('#Create-reserve-submit');
var dates = [];
var minDate = 0;
var spin = void 0;


function setSpinner() {
    var opts = {
        lines: 20, // The number of lines to draw
        length: 0, // The length of each line
        width: 2, // The line thickness
        radius: 1, // The radius of the inner circle
        scale: 4, // Scales overall size of the spinner
        corners: 1, // Corner roundness (0..1)
        color: '#3097D1', // CSS color or array of colors
        fadeColor: 'transparent', // CSS color or array of colors
        opacity: 0, // Opacity of the lines
        rotate: 0, // The rotation offset
        direction: 1, // 1: clockwise, -1: counterclockwise
        speed: 0.5, // Rounds per second
        trail: 44, // Afterglow percentage
        fps: 20, // Frames per second when using setTimeout() as a fallback in IE 9
        zIndex: 2e9, // The z-index (defaults to 2000000000)
        className: 'spinner', // The CSS class to assign to the spinner
        top: '40%', // Top position relative to parent
        position: 'absolute' // Element positioning

    };

    spin = $('#spin').html(new __WEBPACK_IMPORTED_MODULE_0_spin_js__["a" /* Spinner */](opts).spin().el);
    spin.hide();
}

$(function () {
    getBlackOutDates();
    setMap();

    setSpinner();
    $(".modal").iziModal({
        title: '',
        subtitle: '',
        headerColor: '#21b911',
        background: '#b92734',
        theme: '', // light
        icon: null,
        iconText: null,
        iconColor: '',
        rtl: false,
        width: 200,
        top: true,
        bottom: 1,
        borderBottom: true,
        padding: 0,
        radius: 100,
        zindex: 999,
        iframe: false,
        iframeHeight: 400,
        iframeURL: null,
        focusInput: true,
        group: '',
        loop: false,
        arrowKeys: true,
        navigateCaption: true,
        navigateArrows: true, // Boolean, 'closeToModal', 'closeScreenEdge'
        history: false,
        restoreDefaultContent: false,
        autoOpen: 0, // Boolean, Number
        bodyOverflow: false,
        fullscreen: false,
        openFullscreen: false,
        closeOnEscape: true,
        closeButton: true,
        appendTo: 'body', // or false
        appendToOverlay: 'body', // or false
        overlay: true,
        overlayClose: true,
        overlayColor: 'rgba(0, 0, 0, 0.4)',
        timeout: 5000,
        timeoutProgressbar: true,
        pauseOnHover: false,
        timeoutProgressbarColor: 'rgba(255,255,255,0.5)',
        transitionIn: 'comingIn',
        transitionOut: 'comingOut',
        transitionInOverlay: 'fadeIn',
        transitionOutOverlay: 'fadeOut',
        onFullscreen: function onFullscreen() {},
        onResize: function onResize() {},
        onOpening: function onOpening() {},
        onOpened: function onOpened() {},
        onClosing: function onClosing() {},
        onClosed: function onClosed() {},
        afterRender: function afterRender() {}
    });
    $("#modal-reserve-fail").iziModal();

    // Validacion asincrona de añadir comentario
    $("#comment").on("change", validateFetch);

    //Opciones generales de Datepicker
    var datePickerOptions = {
        minDate: minDate,
        maxDate: "+100D",
        beforeShowDay: isThisDayAvalible,
        dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dec"]
    };
    var entry = $("#entryDate").datepicker(datePickerOptions);
    var exit = $("#exitDate").datepicker(datePickerOptions);

    entry.on("change", function () {
        entryDate = entry.datepicker("getDate");
        entryDate = dateForm(entryDate, entry, exit);
        var entryDateUnixStamp = convertMs(new Date(entryDate));
        minDate = entryDateUnixStamp - convertMs(new Date());
        exit.datepicker("option", "minDate", minDate + 1);
    });

    exit.on("change", function () {
        exitDate = exit.datepicker("getDate");
        exitDate = dateForm(exitDate, exit, entry);
        exit.prop("disabled", false);
        validateReserve(entryDate, exitDate);
    });
});

function dateForm(date, inputToDisable, inputToEnable) {

    date = $.datepicker.formatDate("yy-mm-dd", date);
    if (date !== null) {
        inputToDisable.prop("disabled", true);
        inputToEnable.prop("disabled", false);
        return date;
    }
}

function validateReserve(entryDate, exitDate) {
    spin.show();

    var myHeaders = new Headers();
    myHeaders.append("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    var form = new FormData();

    form.append("entryDate", entryDate);
    form.append("exitDate", exitDate);

    var configuracion = {
        method: 'POST',
        headers: myHeaders,
        body: form,
        credentials: "same-origin"
    };
    var urlName = window.location.href + "/reserve";
    fetch(urlName, configuracion).then(function (response) {

        return response.json();
    }).then(function (data) {
        spin.hide();
        reserveButton.removeClass("btn-success btn-danger");

        if (data.length === 0) {
            reserveButton.prop("disabled", false);
            reserveButton.addClass("btn-success ");
        } else {
            reserveButton.prop("disabled", true);
            reserveButton.addClass("btn-danger");
            $('#modal-reserve-fail').iziModal('open');
        }
    }).catch(function (err) {
        console.log("error" + err);
    });
}

function convertMs(milliseconds) {
    var day, hour, minute, seconds;
    seconds = Math.floor(milliseconds / 1000);
    minute = Math.floor(seconds / 60);
    seconds = seconds % 60;
    hour = Math.floor(minute / 60);
    minute = minute % 60;
    day = Math.floor(hour / 24);
    hour = hour % 24;
    // return {
    //     day: day,
    //     hour: hour,
    //     minute: minute,
    //     seconds: seconds
    // };
    return day;
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
    var urlName = window.location.href + "/validate";

    console.log(urlName);
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

        // Se comprueba si todos los elementos del formulario estan validados
        var validationItems = $(".valid-item");
        var validatedItem = $(".is-valid");
        var submitButton = $(".submit-button");

        if (validationItems.length === validatedItem.length) {
            submitButton.prop("disabled");
        }
    } else {
        hayErrores = true;
        input.addClass("is-invalid");
        var _iteratorNormalCompletion = true;
        var _didIteratorError = false;
        var _iteratorError = undefined;

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

function getBlackOutDates() {
    var urlPath = window.location.pathname.toString();
    var houseId = urlPath.replace("/house/", "");
    var urlName = "/api/reserves?houseId=" + houseId;
    axios.get(urlName).then(function (response) {
        for (var i = 0; i < response.data.length; i++) {
            dates.push({
                "entry_date": convertMs(new Date(response.data[i]['entry_date'])),
                "exit_date": convertMs(new Date(response.data[i]['exit_date'])),
                "reserve_id": response.data[i]['id'],
                "days": Math.floor((Date.parse(new Date(response.data[i]['exit_date'])) - Date.parse(new Date(response.data[i]['entry_date']))) / 86400000)
            });
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function isThisDayAvalible(date) {

    date = convertMs(date);

    for (var i = 0; i < dates.length; i++) {

        if (date >= dates[i].entry_date && date < dates[i].exit_date) {
            return [false, 'bg-danger'];
        }
    }
    return [true, ''];
}

function setMap() {
    var location = $('#location').text();
    var n = location.indexOf("/");
    var latitud = "";
    var longitud = "";

    for (var i = 0; i < n; i++) {
        latitud += location[i];
    }
    if (isNaN(latitud)) {
        latitud = 0;
    }

    for (var _i = n + 1; _i < location.length; _i++) {
        longitud += location[_i];
    }
    if (isNaN(longitud)) {
        longitud = 0;
    }

    var map = new GMaps({
        el: '#map',
        lat: latitud,
        lng: longitud
    });
}

/***/ })

/******/ });