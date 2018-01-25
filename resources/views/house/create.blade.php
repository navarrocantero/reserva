@extends('layouts.app')

@section('content')

    <div class="col-10 offset-1 mt-4 bg-light">
        <form action="{{ url('/') }}/add" method="post">
            {{ csrf_field() }}

                <div class="form-group @if($errors->has('name'))has-error @endif">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                @if($errors->has('name'))
                    @foreach($errors->get('name') as $message)
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @endforeach
                @endif

            <div class="form-group @if($errors->has('location'))has-error @endif">
                <label for="location">Localizacion</label>
                <input type="text" class="form-control" id="location" name="location">
            </div>
            @if($errors->has('location'))
                @foreach($errors->get('location') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif

            <div class="form-group @if($errors->has('direction'))has-error @endif">
                <label for="location">Direccion</label>
                <input type="text" class="form-control" id="direction" name="direction">
            </div> @if($errors->has('direction'))
                @foreach($errors->get('direction') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif


            <div class="form-group @if($errors->has('price_user_night'))has-error @endif">
                <label for="price_user_night">Precio Persona/Noche</label>
                <div class="col-8 row">
                    <input type="number" class="form-control col-2" id="price_user_night" name="price_user_night">
                    <p class="col-1">€</p>
                </div>
            </div>@if($errors->has('price_user_night'))
                @foreach($errors->get('price_user_night') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif

            <div class="form-group @if($errors->has('images'))has-error @endif">
                <label for="location">Imagenes</label>
                <input type="text" class="form-control" id="images" name="images">
            </div> @if($errors->has('images'))
                @foreach($errors->get('images') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif


            <div class="form-group @if($errors->has('max_users_house'))has-error @endif">
                <label for="max_users_house">Numero maximo de personas</label>
                <div class="col-8 row">
                    <input type="number" class="form-control col-2" id="max_users_house" name="max_users_house">
                </div>
            </div>@if($errors->has('max_users_house'))
                @foreach($errors->get('max_users_house') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif


            <div class="form-group @if($errors->has('features'))has-error @endif">
                <label for="location">Caracteristicas</label>
                <input type="text" class="form-control" id="features" name="features">
            </div> @if($errors->has('features'))
                @foreach($errors->get('features') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif

            <div class="form-group @if($errors->has('activities'))has-error @endif">
                <label for="location">Actividades</label>
                <input type="text" class="form-control" id="activities" name="activities">
            </div> @if($errors->has('activities'))
                @foreach($errors->get('activities') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif

            <div class="form-group @if($errors->has('description'))has-error @endif">
                <label for="description">Descripcion</label>
                <input type="text" class="form-control" id="description" name="description">
            </div> @if($errors->has('description'))
                @foreach($errors->get('description') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif

            <button type="submit" class="btn btn-primary">Añadir</button>
        </form>
    </div>
@endsection