let paneOneValues = ['name', 'location', 'direction', 'description'];
let paneTwo = ['activities', 'features', 'max_users_house', 'price_user_night'];
let ACTIVE = "active"
let INVALID = "invalid"
let VALID = "is-valid"


$(function () {
    // Cada ves que se clikee sobre un elemento de la lista  se comprobara si hay errores
    $('a[data-toggle="list"]').on('shown.bs.tab', checkErrorClass)

    // A todos los elementos de validacion se le incluye la funcion AJAX
    $("#name").on("change", validateFetch);
    $("#location").on("change", validateFetch);
    $("#direction").on("change", validateFetch);
    $("#price_user_night").on("change", validateFetch);
    $("#max_users_house").on("change", validateFetch);
    $("#features").on("change", validateFetch);
    $("#activities").on("change", validateFetch);
    $("#description").on("change", validateFetch);
    $("#comment").on("change", validateFetch)

    // Llamada a la funcion de comprobacion de errores para la respuesta del POST
    checkErrorClass()

});

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
        checkErrorClass();


        // Se comprueba si todos los elementos del formulario estan validados
        let validationItems = $(".valid-item")
        let validatedItem = $(".is-valid");
        let submitButton = $(".submit-button");

        if (validationItems.length === validatedItem.length) {
            submitButton.removeClass("disabled");
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

function validarFormularioFetch(parameter) {
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
    }).then(function (errores) {
        let errors = data[inputTargetName]
        console.log(errors)
        if (errores.length === 0) {
            var formulario = $("#formulario");
            formulario.submit();
        } else {
            console.log("nononono")
        }
    }).catch(function (err) {
        console.log("error" + err);
    });
}

function checkErrorClass() {

    // Elementos para la busqueda de numero de erroes para los BADGETS
    let paneOne = $('.pane-one');
    let paneTwo = $('.pane-two');
    let paneOneBadge = $('.pane-one-badge');
    let paneTwoBadge = $('.pane-two-badge');
    let PaneOneButton = $('#list-data-list');
    let PaneTwoButton = $('#list-features-list');
    let errors;

    // Elementos para validar el formulario y habilitar el envio POST
    let success = $(".is-valid");
    let validItems = $(".valid-item");
    let formButton = $("#Create-house-submit");


    if ((PaneTwoButton.attr('class')).search(ACTIVE) !== -1) {
        paneTwoBadge.text("");
        paneOneBadge.text("");
        errors = findErrorsInPane(paneOne);
        paneOneBadge.text(errors !== 0 ? errors : "")
    } else if ((PaneOneButton.attr('class')).search(ACTIVE) !== -1) {
        paneOneBadge.text("");
        paneTwoBadge.text("");
        errors = findErrorsInPane(paneTwo);
        paneTwoBadge.text(errors !== 0 ? errors : "")
    }

    if(success.length === validItems.length){
        formButton.attr('disabled',false)
        formButton.addClass('btn-success')
    }

}

function findErrorsInPane(pane) {
    let errors = [];
    for (let i = 0; i < pane.length; i++) {
        let item = $(pane[i]);
        let itemClass = item.attr('class')
        if (itemClass.search(INVALID) !== -1) {
            errors.push(item);

        }
    }

    return errors.length;
}