@extends('layouts.app')

@section('sidebar')


    <div class="col-12 col-sm-12 col-lg-4  bg-light mt-2 card    order-last order-sm-last order-lg-first h-100" id="comments">

        <div id="map" class=" col-11 offset-1 mt-4">

        </div>
        <form class="mt-5" action="{{ url('/') }}/house/{{$house->slugname}}/confirm " method="post">
            {{ csrf_field() }}
            <div class="">Entrada: <input type="text" class="datepicker input-group" id="entryDate" name="entryDate">
            </div>
            <div class=" ">Salida: <input type="text" class="datepicker input-group" id="exitDate" name="exitDate"
                                          disabled></div>

            <p type="hidden" id="location" hidden>{{$house->location}}</p>


            <button type="submit" class="btn   offset-1 submit-button mt-3"
                    id="Create-reserve-submit" disabled>Reserva ya!
            </button>


        </form>
        <div class="card-title">
            <h4 class="text-center">Comentarios</h4>
        </div>
        <div class="card">
        @forelse($comments as $comment)


                @foreach($comment as $value)
                    @if ($loop -> first)
                        <h5 class="h5 mt-2 card-header"><a href={{url('/user/'.$value)}}>{{$value}} </a></h5>
                    @else
                        <span class="mb-2 text-justify card-body text-wrap mb-5 text-truncate">{{$value}}<a href={{url('/user/'.$value)}}>... </a> </span>
                    @endif
                @endforeach

        @empty

                <span class="h5 mt-2 card-header">Ups esta vacio!</span>
                <span class="mt-5 mb-2  card-body text-wrap">
                        Dejanos tu comentario !</span>


        @endforelse
        </div>
        @if(!$commented)

            <div class="m-5">
                <form action="/house/{{$house->slugname}}/comment" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <div class="row mb-1">
                            <textarea type="text" rows="2" class="form-control valid-item" id="comment" name="comment"

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

    <div class="col-12 col-sm-12 col-lg-8 d-inline-flex  order-first">
        <div class="col-lg-12 col-md-12 mt-2  ">
            <div class="jumbotron">
                <div class="card-columns">
                    @foreach($features as $feature)
                        <p class="card-text text-wrap"><a href="/feature/{{$feature->slugname}}">{{$feature->slugname}}</a></p>
                    @endforeach
                </div>
            </div>


            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                <div class="carousel-inner" role="listbox">
                    @foreach($images as $image)
                        <div class="carousel-item @if($loop->first) active @endif">
                            <img class="d-block img-fluid" src={{\App\House::getImageExtension($image->image_url)}}>
                        </div>
                    @endforeach


                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="card-body">

                <h4 class="card-title">
                    <a class="card-title" href="/">{{$house->name}}</a>
                </h4>
                <div class="card-body">
                    <p class="card-text">{{$house->description}}</p>
                </div>

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
    </div>


    <script src="{{ asset('js/gmaps.js') }}"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyBNc598QIqguGVbQ3pYeeQAuHxSYgL2508"></script>


    <script src="{{ asset('js/reserveHouse.js') }}" defer></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
