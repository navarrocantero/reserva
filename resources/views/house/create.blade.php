@extends('layouts.app')

@section('content')
    <div class="row col-12 justify-content-center">

        <h3 class="mt-1">Añadir nueva casa </h3>
    </div>
    <div class="col-md-12  form-group-sm">
        <form action="{{ url('/') }}/add" method="post">
            {{ csrf_field() }}


            <div class="d-md-inline-flex  w-100 form-control justify-content-around">

                <div class="col-md-2  mr-4 col-11 ">
                    <div class="list-group d-inline-flex offset-md-0 offset-3" id="list-tab" role="tablist">

                        <a class="list-group-item list-group-item-action active form-tab" id="list-data-list"
                           data-toggle="list"
                           href="#list-data" role="tab" aria-controls="home">Datos
                            <i class="badge badge-danger ml-2 pane-one-badge"></i>
                        </a>
                        <a class="list-group-item text-nowrap list-group-item-action" id="list-features-list"
                           data-toggle="list"
                           href="#list-features" role="tab" aria-controls="features">
                            Caracteristicas<i class="badge badge-danger ml-2 pane-two-badge"></i>
                        </a>
                        <a class="list-group-item list-group-item-action " id="list-profile-list" data-toggle="list"
                           href="#list-images" role="tab" aria-controls="features">Imagenes
                        </a>
                    </div>
                </div>

                <div class="col-md-8 offset-md-1 col-11">

                    <!-- form complex example -->
                    <div class="tab-content  row " id="nav-tabContent">

                        <div class="tab-pane tab-pane-one fade show active w-100" id="list-data">
                            <div class="col-sm-12 pb-3">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control valid-item pane-one
                                       @if($errors->get('name'))
                                        is-invalid @endif"
                                       id="name" name="name"
                                       value="{{old('name')}}">
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

                            <div class="col-sm-12 pb-3">
                                <label for="location">Localizacion</label>
                                <input type="text" class="form-control valid-item pane-one
                                        @if($errors->get('location'))
                                        is-invalid @endif"
                                       id="location"
                                       name="location"
                                       value="{{old('location')}}">

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

                            <div class="col-sm-12 pb-3">
                                <label for="location">Direccion</label>
                                <input type="text" class="form-control valid-item pane-one
               @if($errors->get('direction'))
                                        is-invalid
                            @endif"
                                       id="direction"
                                       name="direction"
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


                            <div class="col-sm-12 pb-3">
                                <label for="description">Descripcion</label>
                                <textarea type="text" rows="4" class="form-control valid-item pane-one
                                    @if($errors->has('description')) is-invalid
                                            @endif"
                                          id="description"
                                          name="description"
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


                        </div>

                        <div class="tab-pane tab-pane-one fade w-100" id="list-features">

                            <div class="col-sm-12 pb-3">
                                <label for="features">Caracteristicas</label>
                                <textarea type="text" class="form-control area valid-item pane-two
                    @if($errors->get('features'))
                                        is-invalid
                            @endif" id="features"
                                          name="features"
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


                            <div class="col-sm-12 pb-3">
                                <label for="max_users_house">Capacidad maxima</label>
                                <input type="number" class="form-control valid-item pane-two
                                    @if($errors->get('max_users_house'))
                                        is-invalid
                                        @endif
                                        " id="max_users_house"
                                       name="max_users_house"
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
                            <div class="col-sm-6 pb-3">
                                <label for="price_user_night">Precio Persona/Noche
                                </label>
                                <input type="number" class="form-control valid-item pane-two
                              @if($errors->get('price_user_night'))
                                        is-invalid
                                        @endif"
                                       id="price_user_night"
                                       name="price_user_night"
                                       min="1"
                                       max="100"
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

                        </div>


                        <div class="tab-pane fade  w-100" id="list-images">
                            <div class="col-sm-12 pb-3">
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
                        </div>
                    </div>
                </div>

            </div>
            <div class="text-right mb-5">
                <button type="submit" class="btn btn-primary mt-5 mb-5 submit-button" id="Create-house-submit" disabled>Añadir
                </button>
            </div>
        </form>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.js" type="text/javascript"></script>

    <script src="{{ asset('js/createHouseRequest.js') }}" defer></script>
@endsection

