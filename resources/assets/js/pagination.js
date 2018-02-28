$(function () {
    asociarEventoAsincrono();
});

function validateAxio() {
    event.preventDefault();

    let enlace = $(event.target);
    let valor = parseInt(enlace.text());

    $(event.target).addClass("active");
    axios.get('/asyncLoad?page='+valor)
        .then(function(response){
            $("#housePaginationAjaxList").html(response.data);
            asociarEventoAsincrono();
        }).catch(function (error) {
        console.log(error);
    });
    window.scrollTo(0, 0);
}

function asociarEventoAsincrono() {
    $(".pagination > li > a").on("click", validateAxio);
}