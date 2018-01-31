@extends('layouts.app')

@section('content')

    <form action="{{ url('/') }}/add" method="post">
        {{ csrf_field() }}
        <div class="d-inline-flex bg-dark col-12">

            <div class="col-5 offset-1 mt-4 bg-light h-100">

                <div class="form-group @if($errors->has('name'))is-invalid @endif">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                </div>
                <div>
                    @if($errors->has('name'))
                        @foreach($errors->get('name') as $message)
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="form-group @if($errors->has('location'))is-invalid @endif">
                    <label for="location">Localizacion</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{old('location')}}">
                </div>
                <div>
                    @if($errors->has('location'))
                        @foreach($errors->get('location') as $message)
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="form-group @if($errors->has('direction'))is-invalid @endif">
                    <label for="location">Direccion</label>
                    <input type="text" class="form-control" id="direction" name="direction"
                           value="{{old('direction')}}">
                </div>
                <div>
                    @if($errors->has('direction'))
                        @foreach($errors->get('direction') as $message)
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="form-group @if($errors->has('images'))is-invalid @endif">
                    <label for="images">Imagenes</label>
                    <input type="text" class="form-control" id="images" name="images"
                           value="{{old('images')}}">
                </div>
                <div>
                    @if($errors->has('images'))
                        @foreach($errors->get('images') as $message)
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="col-12 d-inline-flex">
                    <div class="col-6">
                        <div class="form-group   @if($errors->has('price_user_night'))is-invalid @endif">
                            <label for="price_user_night">Precio Persona/Noche
                            </label>
                            <input type="number" class="form-control " id="price_user_night"
                                   name="price_user_night"
                                   value="{{old('price_user_night')}}">
                        </div>
                        <div>
                            @if($errors->has('price_user_night'))
                                @foreach($errors->get('price_user_night') as $message)
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group  @if($errors->has('max_users_house'))is-invalid @endif">
                            <label for="max_users_house">Capacidad maxima</label>
                            <input type="number" class="form-control" id="max_users_house" name="max_users_house"
                                   value="{{old('max_users_house')}}">
                        </div>
                        <div>
                            @if($errors->has('max_users_house'))
                                @foreach($errors->get('max_users_house') as $message)
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-5 offset-1 mt-4 bg-light h-100">


                <div class="form-group @if($errors->has('features'))is-invalid @endif">
                    <label for="features">Caracteristicas</label>
                    <textarea type="text" class="form-control area" id="features" name="features"
                    >{{old('features')}}</textarea>

                </div>
                <div>
                    @if($errors->has('features'))
                        @foreach($errors->get('features') as $message)
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="form-group @if($errors->has('activities'))is-invalid @endif">
                    <label for="activities">Actividades</label>
                    <textarea type="text" class="form-control" id="activities" name="activities"
                    >{{old('activities')}} </textarea>
                </div>
                <div>
                    @if($errors->has('activities'))
                        @foreach($errors->get('activities') as $message)
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="form-group @if($errors->has('description'))is-invalid @endif">
                    <label for="description">Descripcion</label>
                    <textarea type="text" class="form-control" id="description" name="description"
                    >{{old('description')}} </textarea>
                </div>
                <div>
                    @if($errors->has('description'))
                        @foreach($errors->get('description') as $message)
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary mt-5 " id="Create-house-submit">Añadir</button>
                </div>
            </div>

        </div>
    </form>

    <script src="{{ asset('js/validate.js') }}" defer></script>
@endsection

