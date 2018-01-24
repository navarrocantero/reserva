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


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
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
                            @if (Auth::guest())
                                Unete
                            @else
                                {{ Auth::user()->name }}

                            @endif
                        </a></h5>

                    {{--<li class="nav-item dropdown">--}}
                        {{--<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink"--}}
                           {{--data-toggle="dropdown"--}}
                           {{--aria-haspopup="true" aria-expanded="false">--}}
                            {{--{{ Auth::user()->name }}--}}
                        {{--</a>--}}
                        {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">--}}
                            {{--<a href="{{ route('logout') }}" class="dropdown-item"--}}
                               {{--onclick="event.preventDefault();document.getElementById('logout-form').submit();">--}}
                                {{--Logout--}}
                            {{--</a>--}}
                            {{--<form id="logout-form" action="{{ route('logout') }}" method="POST"--}}
                                  {{--style="display: none;">--}}
                                {{--{{ csrf_field() }}--}}
                            {{--</form>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="row  collapse navbar-collapse" id="nav-bar-menu-id">
                        <div class="col-sm-6 col-md-5 col-md-offset-4  ml-auto mr-auto p-5">
                            <div class="account-wall">
                                <img class="profile-img"
                                     src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                                     alt="">
                                    {{ csrf_field() }}
                                    <form class="form-horizontal form-signin" method="POST" action="{{url('/')}}">
                                        <div class="form-group row">
                                            <label for="email" class="col-lg-4 col-form-label text-lg-right">E-Mail
                                                Address</label>


                                            <input id="email" type="email"
                                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   name="email"
                                                   value="{{ old('email') }}"
                                                   placeholder="Email"
                                                   required
                                                   autofocus>

                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </div>
                                            @endif

                                        </div>
                                        <div class="form-group row">
                                            <input
                                                    id="password"
                                                    type="password"
                                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                    name="password"
                                                    required
                                            >

                                            @if ($errors->has('password'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </div>
                                            @endif
                                        </div>

                                        <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">
                                            Sign in</button>
                                        <a href="#" class="pull-right need-help text-dark links-login">Need help? </a><span class="clearfix"></span>

                            </form>

                            <a href="{{ route('register') }}" class="text-center new-account links-login text-dark">Create an account </a>
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
