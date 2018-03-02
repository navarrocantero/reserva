<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{ asset('images/ico.png') }}"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.style')

    @include('layouts.scripts')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
<!-- Navbar structure -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">Reserving</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link trigger" href="javascript:void(0)" id="unete-id">
                        @if (Auth::guest())
                            Unete
                        @else
                            {{ Auth::user()->username }}

                        @endif
                    </a>
                </li>


                <li class="nav-item">
                    @auth
                        <a class="nav-link" href="{{url('/add')}}"><span>Alquila tu casa!</span></a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container">

    <div class="row mt-3">


        @yield('content')
        @yield('sidebar')

    </div>


</div>

<!-- Modal structure -->
<div class="modal" id="modal-login">
    <div class="container h-100">
        @if (Auth::guest())
            <div class=" ">
                <div class="account-wall">
                    <img class="profile-img"
                         src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                         alt="">

                    <form class="form-horizontal form-signin" method="POST" action="{{route('login')}}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="email" class="  col-form-label text-lg-right">E-Mail </label>


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
                            <label for="password"
                                   class="  col-form-label text-lg-right">Password</label>
                            <input
                                    id="password"
                                    type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password"
                                    placeholder="Password"
                                    required>

                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group row">
                            <button class="btn btn-md btn-primary btn-block mb-2" type="submit">
                                Login
                            </button>
                        </div>
                        <a href="#"
                           class="pull-right need-help text-dark links-login mt-2">Ayuda</a><span
                                class="clearfix"></span>

                    </form>

                    <a href="{{ route('register') }}"
                       class="text-center new-account links-login text-dark">Nuevo usuario </a>
                </div>
            </div>
        @else
            <div class="w-100 text-center">
                <a href="/profile" class="dropdown-item mb-2">Mi perfil</a>
                <a href="{{ route('logout') }}" class="dropdown-item mt-2"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        @endif
    </div>

</div>


<footer class="footer">
    <div class="container">
        <span class="text-muted">Reserving  &copy; 2018</span>
    </div>
</footer>
</body>
</html>
