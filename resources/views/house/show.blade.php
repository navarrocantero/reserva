@extends('layouts.app')

@section('sidebar')
    <div class="col-lg-3  col-md-12 h-100 bg-light mt-2 card"   id="comments">
        <div class="card-title">
            <h4 class="text-center">Comentarios</h4>
        </div>
        @forelse($comments as $comment)
            <div class="card">

                @foreach($comment as $value)

                    @if ($loop -> first)
                        <h5 class="h5 mt-2 card-header"><a href={{url('/user/'.$value)}}>{{$value}} </a></h5>
                    @else
                        <span class="mt-5 mb-2 text-justify card-body text-wrap">{{$value}} </span>
                    @endif

                @endforeach
            </div>
        @empty
            <div class="card">
                <h5 class="h5 mt-2 card-header">Ups esta vacio!</h5>
                <span class="mt-5 mb-2  card-body text-wrap">
                        Dejanos tu comentario !</span>

            </div>
        @endforelse

        @if(!$commented)

            <div class="m-5">
                <form action="/house/{{$house->slugname}}/comment" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <div class="row mb-1">
                            <textarea type="text" rows="4" class="form-control valid-item" id="comment" name="comment"

                            ></textarea>

                            <div class="mt-2">
                                @if($errors->has('comment'))
                                    @foreach($errors->get('comment') as $message)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mt-5  mb-5 submit-button"
                                    id="Create-comment-submit">Añadir
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        @endif

        <div class="modal iziModal iziModal-header  text-white text-center" id="modal-reserve-fail">
            <div class="iziModal-progressbar">
                <div style="background-color: rgba(255, 255, 255, 0.5); width: 75.1%;"></div>
            </div>
            <p class="iziModal-content izimodal ">Fecha no disponible</p>
            <p class="iziModal-content izimodal ">Lo sentimos!</p>
        </div>
    </div>
@endsection

@section('content')


    <div class="col-lg-9 col-md-10 mt-2 ">

        <a href="/"><img class="card-img-top" src="{{$house->images}}" alt=""></a>

        <div class="card-body">
            <form action="{{ url('/') }}/house/{{$house->slugname}}/confirm " method="post">
                {{ csrf_field() }}
                <div class="d-inline-flex col-md-push-12 card-group justify-content-around  ">
                    <div class="col-md-3 offset-md-0 col-6 offset-4">Entrada: <input type="text" class="datepicker" id="entryDate" name="entryDate">
                    </div>
                    <div class="col-md-3 offset-md-0 col-6 offset-4">Salida: <input type="text" class="datepicker" id="exitDate" name="exitDate"
                                                      disabled></div>

                    <p type="hidden" id="location" hidden>{{$house->location}}</p>


                    <button type="submit" class="btn   h-100 submit-button mt-3"
                            id="Create-reserve-submit" disabled>Reservar!
                    </button>

                    <div id="map"  class="col-10 offset-2 offset-md-0 col-md-12 mt-4">
                    </div>
                </div>
            </form>

            <h4 class="card-title">
                <a class="card-title" href="/">{{$house->name}}</a>
            </h4>
            <p class="card-text">{{$house->description}}</p>
        </div>
        <div class="card-columns">
            @foreach($features as $feature)
                <p class="card-text"><a href="/feature/{{$feature->slugname}}">{{$feature->slugname}}</a></p>
            @endforeach
        </div>

        <div class="card-footer content justify-content-between">
            <div class="d-inline-flex   ">
                <span class="mr-2">Capacidad Maxima</span>
                <h5 class="text-nowrap">{{$house->max_users_house}}</h5>

            </div>

            <div class="d-inline-flex offset-5">
                <span class="mr-2"> Precio por persona/noche</span>
                <h5 class="text-nowrap">{{$house->price_user_night}}</h5>
                <i class="fa fa-euro-sign ml-2" aria-hidden="true"></i>

            </div>

        </div>
    </div>




    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/gmaps.js') }}" ></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyBNc598QIqguGVbQ3pYeeQAuHxSYgL2508"></script>


    <script src="{{ asset('js/reserveHouse.js') }}" defer></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
