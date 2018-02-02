@extends('layouts.app')

@section('content')

    <form action="{{ url('/') }}/add" method="post">
        {{ csrf_field() }}


        <div class="col-md-10 offset-md-1">
            <span class="anchor" id="formComplex"></span>
            <hr class="my-5">
            <h3>Complex Form Example </h3>

            <!-- form complex example -->
            <div class="row mt-4">
                <div class="col-sm-5 pb-3">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                    <div class="mt-2">
                        @if($errors->has('name'))
                            @foreach($errors->get('name') as $message)
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>


                <div class="col-sm-3 pb-3">
                    <label for="location">Localizacion</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{old('location')}}">

                    <div class="mt-2">
                        @if($errors->has('location'))
                            @foreach($errors->get('location') as $message)
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-sm-4 pb-3">
                    <label for="location">Direccion</label>
                    <input type="text" class="form-control" id="direction" name="direction"
                           value="{{old('direction')}}">

                    <div class="mt-2">
                        @if($errors->has('direction'))
                            @foreach($errors->get('direction') as $message)
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-sm-6 pb-3">
                    <label for="images">Imagenes</label>
                    <input type="text" class="form-control" id="images" name="images"
                           value="{{old('images')}}">

                    <div class="mt-2">
                        @if($errors->has('images'))
                            @foreach($errors->get('images') as $message)
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-sm-6 pb-3">
                    <label for="price_user_night">Precio Persona/Noche
                    </label>
                    <input type="number" class="form-control " id="price_user_night"
                           name="price_user_night"
                           value="{{old('price_user_night')}}">

                    <div class="mt-2">
                        @if($errors->has('price_user_night'))
                            @foreach($errors->get('price_user_night') as $message)
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>


                <div class="col-sm-3 pb-3">
                    <label for="features">Caracteristicas</label>
                    <textarea type="text" class="form-control area" id="features" name="features"
                    >{{old('features')}}</textarea>


                    <div class="mt-2">
                        @if($errors->has('features'))
                            @foreach($errors->get('features') as $message)
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-md-6 pb-3">
                    <label for="description">Descripcion</label>
                    <textarea type="text" class="form-control" id="description" name="description"
                    >{{old('description')}} </textarea>

                    <div class="mt-2">
                        @if($errors->has('description'))
                            @foreach($errors->get('description') as $message)
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-sm-3 pb-3">
                    <label for="activities">Actividades</label>
                    <textarea type="text" class="form-control" id="activities" name="activities"
                    >{{old('activities')}} </textarea>

                    <div class="mt-2">
                        @if($errors->has('activities'))
                            @foreach($errors->get('activities') as $message)
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-md-6 pb-3">
                    <label for="exampleAccount">Color</label>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                       value="option1"> Blue
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                       value="option2"> Red
                            </label>
                        </div>
                        <div class="form-check form-check-inline disabled">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                                       value="option3" disabled=""> Green
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                       value="option4"> Yellow
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                       value="option5"> Black
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                       value="option6"> Orange
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 pb-3">
                    <label for="max_users_house">Capacidad maxima</label>
                    <input type="number" class="form-control" id="max_users_house" name="max_users_house"
                           value="{{old('max_users_house')}}">

                    <div class="mt-2">
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

        <div class="text-right mt-5">
            <button type="submit" class="btn btn-primary mt-5 " id="Create-house-submit">Añadir</button>


        </div>
    </form>

    <script src="{{ asset('js/validate.js') }}" defer></script>
@endsection

