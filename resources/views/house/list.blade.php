@forelse ($houses as $house)
    <div class="row bg-secondary ">
        <div class="col-3 bg-danger"></div>
        <div class="col-8 d-inline-flex border p-2">
            <div class="col-2">
                <img src="{{$house->images}}"
                     class="img-responsive ">
            </div>

            <div class="col-9 offset-1 mt-2">
                <div class="row">
                    <div class="col-6">
                        <p id="list-item-name" class="font-weight-bold">{{$house->name}}</p>
                        <p id="list-item-name-direction">{{$house->direction}}</p>
                        <p id="list-item-name-location">{{$house->location}}</p>
                    </div>
                    <div class="col-6">

                        <div class=" col-12 d-inline-flex align-items-baseline  justify-content-end">

                            <p id="list-item-name-price ">{{$house->price_user_night}}</p>
                            <i class="fa fa-eur" aria-hidden="true"></i>
                        </div>
                        <div class="text-right">
                            <p>Precio por pers/noche</p>

                            <a href="">Ver</a>
                        </div>
                    </div>
                </div>
                <p id="list-item-name-location">{{$house->description}}</p>
            </div>

            <div class="col-5">

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