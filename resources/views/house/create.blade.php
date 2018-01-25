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
                <input type="number" class="form-control" id="price_user_night" name="price_user_night">
                <label for="price_user_night">Precio Persona/Noche</label>

            </div>
            @if($errors->has('price_user_night'))
                @foreach($errors->get('price_user_night') as $message)
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endforeach
            @endif
            <button type="submit" class="btn btn-primary">Añadir</button>
        </form>
    </div>
@endsection