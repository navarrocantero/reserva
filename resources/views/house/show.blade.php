@extends('layouts.app')

@section('content')


    <div class="col-lg-9 col-md-10 mt-2 ">

        <a href="/"><img class="card-img-top" src="{{$house->images}}" alt=""></a>

        <div class="card-body">
            <form action="{{ url('/') }}/house/{{$house->slugname}}/confirm " method="post">
                {{ csrf_field() }}
                <div class="d-inline-flex col-md-push-12 card-group justify-content-around  ">
                    <p class="col-4    ">Entrada: <input type="text" class="datepicker" id="entryDate" name="entryDate"></p>
                    <p class="col-4  ">Salida: <input type="text" class="datepicker" id="exitDate" name="exitDate"  disabled></p>
                    <button type="submit" class="btn   h-100 submit-button mt-3"
                            id="Create-reserve-submit" disabled>Reservar!
                    </button>
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

        <div class="card-footer content">
            <div class="d-inline-flex  offset-11">
                <h5>{{$house->price_user_night}}</h5>
                <i class="fa fa-eur ml-2" aria-hidden="true"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-2 h-100 bg-light " data-spy="scroll" id="comments">
        @foreach($comments as $comment)
    <div class="card">
            @foreach($comment as $value)

                @if ($loop -> first)
                    <h5 class="h5 mt-2 card-header"><a href={{url('/user/'.$value)}}>{{$value}} </a></h5>
                @else
                    <span class="mt-5 mb-2 text-justify card-body text-wrap">{{$value}} </span>
                @endif

            @endforeach
    </div>
        @endforeach


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
                            <button type="submit" class="btn btn-primary mt-5  submit-button"
                                    id="Create-comment-submit">Añadir
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        @endif
    </div>




    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/validate.js') }}" defer></script>
    <script src="{{ asset('js/reserveHouse.js') }}" defer></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection



