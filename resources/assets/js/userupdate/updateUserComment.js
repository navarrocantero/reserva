setModal()

function validateFetch() {
    event.preventDefault();
    let id = $(this).attr('id');
    axios.get('/comment/edit?id=' + id).then(function (response) {
        $("#comment-container").html(response.data);

    }).catch(function (error) {
        console.log(error);
    }).then(function () {
        $("#edit-comment").iziModal('open')
    });
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

    $(".edit_comment").on("click", validateFetch);
}
