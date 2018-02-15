let entryDate;
let exitDate;
let entry;
let exit;
let reserveButton = $('#Create-reserve-submit');

$(function () {

    $.datepicker.setDefaults({
        format: "yy/mm/dd",
    });

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


    let entry = $("#entryDate").datepicker({minDate: 0, maxDate: "+1M +10D"});
    let exit = $("#exitDate").datepicker({minDate: 1, maxDate: "+1M +10D"});


    entry.on("change", function () {
        entryDate = entry.datepicker("getDate");
        entryDate = dateForm(entryDate, entry, exit)
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

    let dataDiff = exitDate - entryDate;
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