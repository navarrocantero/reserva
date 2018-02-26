let entryDate;
let exitDate;
let entry;
let exit;
let reserveButton = $('#Create-reserve-submit');
let dates = [];
let minDate = 0;

$(function () {
    getBlackOutDates()

    $(".modal").iziModal({
        title: '',
        subtitle: '',
        headerColor: '#21b911',
        background: '#b92734',
        theme: '',  // light
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
        onFullscreen: function () {
        },
        onResize: function () {
        },
        onOpening: function () {
        },
        onOpened: function () {
        },
        onClosing: function () {
        },
        onClosed: function () {
        },
        afterRender: function () {
        }
    });
    $("#modal-reserve-fail").iziModal();

    // Validacion asincrona de añadir comentario
    $("#comment").on("change", validateFetch)

    //Opciones generales de Datepicker
    let datePickerOptions = {
        minDate: minDate,
        maxDate: "+100D",
        beforeShowDay: isThisDayAvalible,
        dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dec"],
    };
    let entry = $("#entryDate").datepicker(datePickerOptions);
    let exit = $("#exitDate").datepicker(datePickerOptions);

    entry.on("change", function () {
        entryDate = entry.datepicker("getDate");
        entryDate = dateForm(entryDate, entry, exit)
        let entryDateUnixStamp = convertMs(new Date(entryDate))
        minDate = entryDateUnixStamp - convertMs(new Date())
        exit.datepicker("option", "minDate", (minDate + 1));
    });

    exit.on("change", function () {
        exitDate = exit.datepicker("getDate");
        exitDate = dateForm(exitDate, exit, entry)
        exit.prop("disabled", false);
        validateReserve(entryDate, exitDate)
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
    let urlName = window.location.href + "/reserve"
    fetch(urlName, configuracion).then(function (response) {


        return response.json();
    }).then(function (data) {
        reserveButton.removeClass("btn-success btn-danger")

        if (data.length === 0) {
            reserveButton.prop("disabled", false);
            reserveButton.addClass("btn-success");
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
    let inputTargetName = parameter.currentTarget.name;
    let finaInputTargetName = $("#" + inputTargetName)
    form.append(inputTargetName, finaInputTargetName.val());
    form.append("type", inputTargetName);
    var configuracion = {
        method: 'POST',
        headers: myHeaders,
        body: form,
        credentials: "same-origin"
    };
    let urlName = window.location.href + "/validate"

    fetch(urlName, configuracion).then(function (response) {

        return response.json();
    }).then(function (data) {

        let errors = data[inputTargetName]

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
    var divErrores = (input.next());
    divErrores.html("");
    input.removeClass("is-valid is-invalid");

    // Si array errores es igual se añade la clase correspondiente
    if (errores.length === 0) {
        input.addClass("is-valid");


        // Se comprueba si todos los elementos del formulario estan validados
        let validationItems = $(".valid-item")
        let validatedItem = $(".is-valid");
        let submitButton = $(".submit-button");

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
    let urlPath = (window.location.pathname).toString()
    let houseId = urlPath.replace("/house/", "")
    let urlName = "/api/reserves?houseId=" + houseId;
    axios.get(urlName)
        .then(function (response) {
            for (let i = 0; i < response.data.length; i++) {
                dates.push({
                    "entry_date": convertMs(new Date(response.data[i]['entry_date'])),
                    "exit_date": convertMs(new Date(response.data[i]['exit_date'])),
                    "reserve_id": response.data[i]['id'],
                    "days": (Math.floor((Date.parse(new Date(response.data[i]['exit_date'])) -
                        Date.parse(new Date(response.data[i]['entry_date']))) / 86400000)),
                })
            }
        }).catch(function (error) {
        console.log(error);
    })


}

function isThisDayAvalible(date) {

    date = convertMs(date)


    for (let i = 0; i < dates.length; i++) {

        if (date >= dates[i].entry_date && date < dates[i].exit_date) {
            return [false, 'bg-danger'];
        }
    }
    return [true, ''];

}
