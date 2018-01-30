@extends('layouts.app')

@section('content')
    @auth()
        <p>Perfil privado de {{$user->username}}:</p>

    @else

        <p>Perfil publico de {{$user->username}}:</p>

    @endauth

    <p>Correo electronico {{$user->email}}</p>

    @include('house.list')
@endsection