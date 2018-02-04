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
        <div class="card-footer content">
            <small class="text-muted ">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            <div class="d-inline-flex  offset-11">
                <h5>{{$house->price_user_night}}</h5>
                <i class="fa fa-eur ml-2" aria-hidden="true"></i>
            </div>
        </div>


    </div>


    <div class="col-lg-3 col-md-2 mt-2 ">

            <a href=""> <h4 class="my-4">Pepe</h4></a>

             Category 1Los mejores dias Los mejores dias Los mejores dias Los mejores dias </a>
                <a href="#" class="list-group-item">Category 2</a>
                <a href="#" class="list-group-item">Category 3</a>
        </div>
    </div>

@endsection



