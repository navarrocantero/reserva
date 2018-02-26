 let ACTIVE = "active"
let INVALID = "invalid"
 jQuery(function($){
     $("#price_user_night").mask("1000");
     $("#max_users_house").mask("10");

 });

$(function () {
    // Create house
    $("#name").on("change", validateFetch);
    $("#location").on("change", validateFetch);
    $("#direction").on("change", validateFetch);
    $("#price_user_night").on("change", validateFetch);
    $("#max_users_house").on("change", validateFetch);
    $("#features").on("change", validateFetch);
    $("#description").on("change", validateFetch);
    // Add comment
    $("#comment").on("change", validateFetch)
    checkErrorClass()
    $('a[data-toggle="list"]').on('shown.bs.tab', checkErrorClass);

    // General
    // $(".submit-button").on("click", validarFormularioFetch);
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
            submitButton.prop("disabled",false);
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


    let paneOne = $('.pane-one');
    let paneTwo = $('.pane-two');
    let paneOneBadge = $('.pane-one-badge');
    let paneTwoBadge = $('.pane-two-badge');
    let PaneOneButton = $('#list-data-list');
    let PaneTwoButton = $('#list-features-list');
    let errors;


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