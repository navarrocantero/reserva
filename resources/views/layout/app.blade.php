<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"
            integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4"
            crossorigin="anonymous"></script>

    <script src="js/reserva.js" defer></script>



    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"
          integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy"
          crossorigin="anonymous">

    <link rel="stylesheet" href="css/reserva.css">


    <title>@yield('title')</title>
</head>
<body>
<div class="container-fluid">
    <div class="flex-center position-ref full-height">
        <div class="navBar">
            <div class="row navbar">
                <div class="col-2  navbar-left">
                    <a href="{{url('/')}}"><h5>Reserving</h5></a>
                </div>
                <div class="col-7  offset-1  navbar-default">
                    <div class="row">
                        <input class="offset-1 w-75" type="" placeholder="Search for Reserves " name="">
                        <button class=" ">
                            <svg width="15px" height="15px">
                                <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="col-2 navbar-right">
                    <h5 class="text-center dropdown" id="join-us-h2">
                        <a href="javascript:void(0)"
                           onclick="showDropDownMenu()">
                            Join us
                        </a></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-2 offset-10">
                    <div class="collapse row navbar-collapse" id="nav-bar-menu-id">


                        <div></a>
                            <div>
                                <div>
                                    <div class="join-us-form">
                                        <div class="tabs-nav  only-tabs" data-ev-group="tabs" id="gen-id-19"
                                             data-script-executed="tabs">
                                            <ul class="tabs-navigation">
                                                <li><a href="#">
                                                        Inicia sesión
                                                    </a></li>
                                                <li><a href="{{url("/register")}}">
                                                        Únete
                                                    </a></li>
                                            </ul>
                                            <div><a href="#">
                                                    Inicia sesión
                                                </a>
                                                <div>
                                                    <form>
                                                        <div class="fieldset">
                                                            <div class="field">
                                                                <input type="email" name="email" placeholder="E-mail">
                                                            </div>
                                                            <div class="field">
                                                                <input type="password" name="clave"
                                                                       placeholder="Contraseña"></div>
                                                            <div class="field">
                                                                <button type="submit">
                                                                    Entrar
                                                                </button>
                                                            </div>
                                                            <p>
                                                                <a href=" ">
                                                                    ¿Has olvidado tu contraseña?
                                                                </a></p></div>
                                                    </form>
                                                    <p class="divider">
                                                        <span>o accede con</span></p>
                                                    <div>
                                                        <a href=""> Google </a>
                                                        <a href=""> Facebook </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
</div>
</body>
</html>
