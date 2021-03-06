@extends('layouts.app')

@section('content')
    <div class="mt-auto mb-auto">
        <div class="col-sm-6 col-md-4 col-md-offset-4  ml-auto mr-auto mt-5 mb-5">
            <h1 class="text-center login-title"></h1>
            <div class="account-wall">
                <img class="profile-img"
                     src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                     alt="">
                <form class="form-signin">
                    <input type="text" class="form-control" placeholder="Email" required autofocus>
                    <input type="password" class="form-control" placeholder="Password" required>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">
                        Sign in
                    </button>
                </form>
            </div>
            <a href="{{ route('register') }}" class="text-center new-account">Create an account </a>
        </div>
    </div>
@endsection
