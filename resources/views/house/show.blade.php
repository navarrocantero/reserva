@extends('layouts.app')

@section('content')


    <div class="col-lg-9 col-md-10 mt-2 ">

        <a href="/"><img class="card-img-top" src="{{$house->images}}" alt=""></a>
        <div class="card-body">
            <h4 class="card-title">
                <a class="card-title" href="/">{{$house->name}}</a>
            </h4>

            <p class="card-text">{{$house->description}}</p>
        </div>
        <div class="card-columns">
            @foreach($features as $feature)
                <p class="card-text"><a href="">{{$feature->slugname}}</a></p>
            @endforeach
        </div>

        <div class="card-footer content">
            <small class="text-muted ">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            <div class="d-inline-flex  offset-11">
                <h5>{{$house->price_user_night}}</h5>
                <i class="fa fa-eur ml-2" aria-hidden="true"></i>
            </div>
        </div>
    </div>

    {{--Comentarios--}}
    <div class="col-lg-3 col-md-2 h-100 bg-light card-group ">
        @foreach($comments as $comment)

            @foreach($comment as $value)

                @if ($loop -> first)
                    <h5 class="h5 mt-2"><a href={{url('/user/'.$value)}}>{{$value}} </a></h5>
                @else
                    <span class="mt-5 mb-2">{{$value}} </span>
                @endif

            @endforeach
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
                        <div class="text-right mt-5">
                            <button type="submit" class="btn btn-primary mt-5  submit-button"
                                    id="Create-comment-submit">Añadir
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        @endif
    </div>



    <script src="{{ asset('js/validate.js') }}" defer></script>

@endsection



