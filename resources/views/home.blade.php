
@extends('layouts.app')

@section('content')

    @foreach ($houses as $house)
        <div class="row bg-secondary">
            <div class="col-3 bg-danger"></div>
            <div class="col-8 d-inline-flex">
                <div class="col-2">
                    <img src="{{$house->image}}"
                         class="img-responsive ">
                </div>
                <div class="col-4 offset-2 mt-2">
                    <p id="list-item-name">{{$house->name}}</p>
                    <p id="list-item-name-direction">{{$house->direction}}</p>
                    <p id="list-item-name-location">{{$house->location}}</p>
                </div>
                <div class="col-4   mt-2">
                    <p id="list-item-name-price">{{$house->price_user_night}}</p>
                    <p>pers/noche</p>
                </div>
            </div>
            <div class="col-1 bg-danger"></div>
        </div>

    @endforeach

    {{$houses->links()}}
@endsection

{{-- Strings CONSTANTS--}}


@section('Reserva', 'title')