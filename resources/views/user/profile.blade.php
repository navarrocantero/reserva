@extends('layouts.app')

@section('content')
    <div class="col-lg-9 col-md-9">

        @if( session('exito') )
            <div class="mt-2">
                <div class="alert alert-success" role="alert">
                    <h5>Actualizacion correcta !</h5>
                </div>
            </div>
        @elseif( session('error'))
                <div class="mt-2">
                    <div class="alert alert-danger" role="alert">
                        <h5>{{  session('error') }}</h5>
                    </div>
            </div>
        @endif

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
    <div class="col-lg-3 col-md-3 mt-2 ">
        <div class="card">
            <h3 class="card-title text-center">Perfil</h3>
            <div class="card-text">
                <a href="{{url('profile')}}" class="list-group-item">Datos</a>
            </div>

            <div class="card-text">

                <a href="{{url('profile/password')}}" class="list-group-item">Seguridad</a>
            </div>

            <div class="card-text">

                <a href="" class="list-group-item">Alquileres</a>
            </div>
            <div class="card-text">

                <a href="" class="list-group-item">Comentarios</a>
            </div>
            <div class="card-text">

                <a href="{{url('profile/reserves')}}" class="list-group-item">Reservas</a>
            </div>


        </div>
    </div>
@endsection