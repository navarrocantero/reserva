// loadProgressBar()
setLoginModal()


function setLoginModal() {
    $("#modal-login").iziModal();
    $("#unete-id").on("click", function () {
        $('#modal-login').iziModal('open');

    });
}
