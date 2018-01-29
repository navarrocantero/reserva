@extends('layouts.app')

@section('content')
    @auth()
        <p>Perfil privado de {{$user->username}}:</p>

    @else

        <p>Perfil publico de {{$user->username}}:</p>

    @endauth

    <p>Nombre {{$user->name}}</p>
    <p>Apellido {{$user->lastname}}</p>

@endsection