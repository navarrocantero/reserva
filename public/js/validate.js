/**
 * Created by Jorge on 24/01/2018.
 */
function objetoXHR() {
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        var versionesIE = new Array('MsXML2.XMLHTTP.5.0', 'MsXML2.XMLHTTP.4.0',
            'MsXML2.XMLHTTP.3.0', 'MsXML2.XMLHTTP', 'Microsoft.XMLHTTP');
        for (var i = 0; i < versionesIE.length; i++) {
            try {
                return new ActiveXObject(versionesIE[i]);
            } catch (errorControlado) {
            }
        }
    }
    throw new Error("No se pudo crear el objeto XMLHTTPRequest");
}


function validarNombre(parametro) {
    let inputNombre = $("#name");
    let miXHR = objetoXHR();
    miXHR.open("POST", "/register/validar");
    miXHR.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    miXHR.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    miXHR.onreadystatechange = comprobarEstadoPeticionNombre;
    miXHR.send("name=" + inputNombre.val());
}

function validarEmail() {
    let inputEmail = $("#email");
    let miXHR = objetoXHR();
    miXHR.open("POST", "/register/validar");
    miXHR.onreadystatechange = comprobarEstadoPeticionEmail;
    miXHR.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    miXHR.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    miXHR.send("email=" + inputEmail.val());
}

function validarFormulario() {
    event.preventDefault();
    validacionFormularioAjax();
}

function validacionFormularioAjax() {
    let inputNombre = $("#name");
    let inputEmail = $("#email");
    let miXHR = objetoXHR();
    miXHR.open("POST", "/register/validate");
    miXHR.onreadystatechange = comprobarEstadoPeticionFormulario;
    miXHR.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    miXHR.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    miXHR.send("name=" + inputNombre.val() + "&" + "email=" + inputEmail.val());
}


function comprobarEstadoPeticionNombre() {
    if (this.readyState === 4 && this.status === 200) {
        console.log(this.response)
        let errores = JSON.parse(this.response);
        let inputNombre = $("#name");
        gestionarErrores(inputNombre, errores.name);
    }
}

function comprobarEstadoPeticionEmail() {
    if (this.readyState == 4 && this.status == 200) {
        let errores = JSON.parse(this.responseText);
        let input = $("#email");
        gestionarErrores(input, errores.email);
    }
}

function comprobarEstadoPeticionFormulario() {
    if (this.readyState == 4 && this.status == 200) {
        let errores = JSON.parse(this.responseText);
        let inputNombre = $("#name");
        let inputEmail = $("#email");
        let hayErroresNombre = gestionarErrores(inputNombre, errores.name);
        let hayErroresEmail = gestionarErrores(inputEmail, errores.email);
        if (!hayErroresNombre && !hayErroresEmail) {
            let formulario = $("#formulario");
            formulario.submit();
        }
    }
}

function gestionarErrores(input, errores) {
    var hayErrores = false;
    let divErrores = input.next();
    divErrores.html("");
    input.removeClass("is-valid is-invalid");
    if (errores.length === 0) {
        input.addClass("is-valid");
    } else {
        hayErrores = true;
        input.addClass("is-invalid");
        for (let error of errores) {
            divErrores.append("<div>" + error + "</div>");
        }
    }
    input.parent().next().remove();
    return hayErrores;
}

function incluirSpinner(input) {
    if (input.parent().next().length === 0) {
        let spin = $(".spinner").first().clone(true);
        input.parent().after(spin);
        spin.show();
    }
}


function validarNombreAjax() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        data: {name: $("#name").val()},
        url: "/register/validate",
        dataType: "JSON"
    }).done(function (datos) {
        let input = $("#name");
        gestionarErrores(input, datos.name);
    });
}


function validarNombreFetch() {
    var myHeaders = new Headers();
    myHeaders.append("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    let form = new FormData();
    form.append("name", $("#name").val());
    var configuracion = {
        method: 'POST',
        headers: myHeaders,
        body: form,
        credentials: "same-origin"
    };

    fetch("/register/validar", configuracion)
        .then(function (response) {
            console.log(response.json())
        })
        .then(function (data) {
            gestionarErrores($("#name"), data.name)
        })
        .catch(function (err) {
            console.log(err);
            console.log("SE HA PRODUCIDO UN ERROR");
        });
}

function validarNombreAxios() {

    axios.post('/register/validar', {
        name: $("#name").val()
    }).then(function (response) {
        gestionarErrores($("#name"), response.data.name)
    })
        .catch(function (error) {
            console.log(error);
        });
}
