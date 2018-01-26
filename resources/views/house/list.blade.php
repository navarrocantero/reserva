@forelse ($houses as $house)
    <div class="row bg-secondary ">
        <div class="col-3 bg-danger"></div>
        <div class="col-8 d-inline-flex border p-2">
            <div class="col-2">
                <img src="{{$house->images}}"
                     class="img-responsive ">
            </div>
            <div class="col-4 offset-2 mt-2">
                <p id="list-item-name">{{$house->name}}</p>
                <p id="list-item-name-direction">{{$house->direction}}</p>
                <p id="list-item-name-location">{{$house->location}}</p>
            </div>
            <div class="col-4   mt-2">
                <div class="d-inline-flex align-items-baseline align">
                    <p id="list-item-name-price ">{{$house->price_user_night}}</p>
                    <i class="fa fa-eur" aria-hidden="true"></i>

                </div>
                <p>Precio por pers/noche</p>
            </div>
        </div>
        <div class="col-1 bg-danger"></div>
    </div>
@empty
    <div class="row">
        <p>Error no se han cargado datos</p>
    </div>

@endforelse
<div class="text-center">

</div>