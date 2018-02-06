@extends('layouts.app')

@section('content')
    <div class="row col-12 justify-content-center">

        <h3 class="mt-1">Añadir nueva casa </h3>
    </div>
    <div class="col-12">
        <form action="{{ url('/') }}/add" method="post">
            {{ csrf_field() }}


            <div class="d-inline-flex w-100">
                <div class="col-md-1 mt-5 mr-1">
                    <div class="list-group d-inline-flex" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                           href="#list-home" role="tab" aria-controls="home">Datos</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                           href="#list-features" role="tab" aria-controls="features">Caracteristicas</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                           href="#list-images" role="tab" aria-controls="features">Imagenes</a>
                    </div>
                </div>

                <div class="col-md-9 offset-md-1">
                    <hr class="my-5">

                    <!-- form complex example -->
                    <div class="tab-content  row " id="nav-tabContent">
                        <div class="tab-pane fade w-100" id="list-features">
                            <div class="col-sm-3 pb-3">
                                <label for="features">Caracteristicas</label>
                                <textarea type="text" class="form-control area valid-item" id="features"
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

                            <div class="col-sm-5 pb-3">
                                <label for="max_users_house">Capacidad maxima</label>
                                <input type="number" class="form-control valid-item" id="max_users_house"
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


                        </div>


                        <div class="tab-pane fade show active w-100" id="list-home">
                            <div class="col-sm-5 pb-3">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control valid-item" id="name" name="name"
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

                            <div class="col-sm-3 pb-3">
                                <label for="location">Localizacion</label>
                                <input type="text" class="form-control valid-item" id="location" name="location"
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

                            <div class="col-sm-4 pb-3">
                                <label for="location">Direccion</label>
                                <input type="text" class="form-control valid-item" id="direction" name="direction"
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
                                <label for="description">Descripcion</label>
                                <textarea type="text" rows="4" class="form-control valid-item" id="description"
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

                        <div class="tab-pane fade  w-100" id="list-images">
                            <div class="col-sm-6 pb-3">
                                <label for="images">Imagenes</label>
                                <input type="text" class="form-control valid-item" id="images" name="images"
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


            <div class="text-right mt-5">
                <button type="submit" class="btn btn-primary mt-5  submit-button" id="Create-house-submit">Añadir
                </button>


            </div>
        </form>
    </div>
    <script src="{{ asset('js/validate.js') }}" defer></script>
@endsection

