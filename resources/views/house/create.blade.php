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
    <div class="col-md-10 offset-md-1">
        <span class="anchor" id="formComplex"></span>
        <hr class="my-5">
        <h3>Complex Form Example </h3>

        <!-- form complex example -->
        <div class="row mt-4">
            <div class="col-sm-5 pb-3">
                <label for="exampleAccount">Account #</label>
                <input type="text" class="form-control" id="exampleAccount" placeholder="XXXXXXXXXXXXXXXX">
            </div>
            <div class="col-sm-3 pb-3">
                <label for="exampleCtrl">Control #</label>
                <input type="text" class="form-control" id="exampleCtrl" placeholder="0000">
            </div>
            <div class="col-sm-4 pb-3">
                <label for="exampleAmount">Amount</label>
                <div class="input-group">
                    <div class="input-group-addon">$</div>
                    <input type="text" class="form-control" id="exampleAmount" placeholder="Amount">
                </div>
            </div>
            <div class="col-sm-6 pb-3">
                <label for="exampleFirst">First Name</label>
                <input type="text" class="form-control" id="exampleFirst">
            </div>
            <div class="col-sm-6 pb-3">
                <label for="exampleLast">Last Name</label>
                <input type="text" class="form-control" id="exampleLast">
            </div>
            <div class="col-sm-6 pb-3">
                <label for="exampleCity">City</label>
                <input type="text" class="form-control" id="exampleCity">
            </div>
            <div class="col-sm-3 pb-3">
                <label for="exampleSt">State</label>
                <select class="form-control" id="exampleSt">
                    <option>Pick a state</option>
                </select>
            </div>
            <div class="col-sm-3 pb-3">
                <label for="exampleZip">Postal Code</label>
                <input type="text" class="form-control" id="exampleZip">
            </div>
            <div class="col-md-6 pb-3">
                <label for="exampleAccount">Color</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Blue
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Red
                        </label>
                    </div>
                    <div class="form-check form-check-inline disabled">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled=""> Green
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option4"> Yellow
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option5"> Black
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option6"> Orange
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pb-3">
                <label for="exampleMessage">Message</label>
                <input type="text" class="form-control" id="exampleMessage">
                <small class="text-muted">
                    Add the packaging note here.
                </small>
            </div>
        </div>

    </div>

    </div>
    <!--/row-->

    </div>
    <!--/col-->
    </div>
    <!--/row-->
    </div>
    <!--/container-->

    <script src="{{ asset('js/validate.js') }}" defer></script>
@endsection

