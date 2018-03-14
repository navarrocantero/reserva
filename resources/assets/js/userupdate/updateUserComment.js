let spin;
let tooltips;
setModal()
import {Spinner} from 'spin.js';


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

    spin = $('#spin').html(new Spinner(opts).spin().el);
    spin.hide()

}

function getComment() {
    event.preventDefault();
    let id = $(this).attr('id');
    axios.get('/comment/edit/' + id).then(function (response) {
        $("#comment-container").html(response.data);

    }).catch(function (error) {
        console.log(error);
    }).then(function () {
        $("#edit-comment").iziModal('open')
        $("#comment-submit").on("click", validateComment);
        setSpinner()
    });
}

function getCommentValidation() {

}

function setModal() {

    $("#delete-confirm").iziModal({
        title: 'Esta accion no se puede deshacer',
        subtitle: 'Continuar ?',
        headerColor: '#b92734',
        icon: null,
        iconText: null,
        iconColor: '',
        rtl: false,
        top: true,
        borderBottom: true,
        padding: 0,
        radius: 0,
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
    $("#edit-comment").iziModal({
        onOpened: function () {
        }

    });

    $(".delete_comment").on("click", function () {
        $('#delete-confirm').iziModal('open');

    });

    $(".edit_comment").on("click", getComment);


}

function validateComment() {
    $("#comment-submit").prop("disabled", true);
     tooltips = $('#tooltips')
    spin.show();
    event.preventDefault()
    let comment = $('#comment').val()
    let commentId = $('#comment-id').val()
    var myHeaders = new Headers();
    myHeaders.append("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    var form = new FormData();

    form.append("comment", comment);
    form.append("comment-id", commentId);
    form.append("type", "comment");


    var configuracion = {
        method: 'POST',
        headers: myHeaders,
        body: form,
        credentials: "same-origin"
    };
    let urlName = window.location.href + "/async"


    fetch(urlName, configuracion).then(function (response) {

        return response.json();
    }).then(function (data) {
            let errores = data['comment']

            return errores;
        }
    ).then(function (errores) {

        if (errores) {
            for (let i = 0; i < errores.length; i++) {
                tooltips.append("<button type='button' class=\"btn btn-danger\" data-toogle=\"tooltip\">" + errores[i] + "</button>");
            }
            spin.hide()
            $("#comment-submit").prop("disabled", false);
        } else {
            tooltips.html("<button type='button' class=\"btn btn-success\" data-toogle=\"tooltip\">" + "Realizado cambios" + "</button>");
            updateCommentAsync()
        }
    });

    function updateCommentAsync() {
        urlName = window.location.href + "/async/update"
        fetch(urlName, configuracion).then(function (response) {
            $('#comment-container').html("<button type='button' class=\"btn btn-success w-100 h-100\" data-toogle=\"tooltip\">" + "Cambios realizados" + "</button>")
        });
    }
}