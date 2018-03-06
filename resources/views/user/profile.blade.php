@extends('layouts.app')

@section('content')
    <div class="col-lg-9 col-md-9">


        @if(Request::is('profile/reserves'))
            @include('user.partials.reserves')

        @elseif(Request::is('profile'))
            @include('user.partials.data')

        @elseif(Request::is('profile/password'))
            @include('user.partials.password')

        @endif
    </div>
@endsection

@section('sidebar')
    @if(!@auth)
        @include('user.partials.sidebar')
    @elseif(@auth)
        @include('user.partials.authsidebar')
    @endif
@endsection