function objetoXHR() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        var versionesIE = new Array('MsXML2.XMLHTTP.5.0', 'MsXML2.XMLHTTP.4.0', 'MsXML2.XMLHTTP.3.0', 'MsXML2.XMLHTTP', 'Microsoft.XMLHTTP');
        for (var i = 0; i < versionesIE.length; i++) {
            try {
                return new ActiveXObject(versionesIE[i]);
            } catch (errorControlado) {
            }
        }
    }
    throw new Error("No se pudo crear el objeto XMLHTTPRequest");
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

    fetch("/add/validate", configuracion).then(function (response) {
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
    if (errores.length === 0) {
        input.addClass("is-valid");
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

function validarFormularioFetch() {
    event.preventDefault();
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

    fetch("/add/validate", configuracion).then(function (response) {
        return response.json();
    }).then(function (errores) {
        let errors = data[inputTargetName]
        console.log(errors)
        if (errores.length === 0) {
            var formulario = $("#formulario");
            formulario.submit();
        } else {
            // gestionarErrores($("#name"), errores.name);
            console.log("nononono")
        }
    }).catch(function (err) {
        console.log("error" + err);
    });
}

$(function () {
    $("#name").on("change", validateFetch);
    $("#location").on("change", validateFetch);
    $("#direction").on("change", validateFetch);
    $("#images").on("change", validateFetch);
    $("#price_user_night").on("change", validateFetch);
    $("#max_users_house").on("change", validateFetch);
    $("#features").on("change", validateFetch);
    $("#activities").on("change", validateFetch);
    $("#description").on("change", validateFetch);
    // $("#Create-house-submit").on("click", validarFormularioFetch);
});

function incluirSpinner(input) {
    if (input.parent().next().length === 0) {
        var spin = $(".spinner").first().clone(true);
        input.parent().after(spin);
        spin.show();
    }
}