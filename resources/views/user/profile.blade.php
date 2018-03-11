@extends('layouts.app')

@section('content')
    <div class="col-lg-9 col-md-9">


        @if(Request::is('profile/reserves'))
            @include('user.partials.reserves')

        @elseif(Request::is('profile'))
            @include('user.partials.data')

        @elseif(Request::is('profile/password'))
            @include('user.partials.password')

        @elseif(Request::is('profile/comments'))
            @include('user.partials.comments')

        @elseif(Request::is('profile/houses'))
            @include('user.partials.houses')

        @endif
    </div>
@endsection

@section('sidebar')
    @if(Auth::check() && Auth::user()->isMe($user))
        @include('user.partials.authsidebar')
    @else
        @include('user.partials.sidebar')
    @endif
@endsection