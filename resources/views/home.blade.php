@extends('layout.app')

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
                    <p id="list-item-name-direction"> Navaluenga , Navaluenga (Ávila)</p>
                    <p id="list-item-name-location">Ver en mapa</p>
                </div>
                <div class="col-4   mt-2">
                    <p id="list-item-name-price">22€</p>
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