<div class="col-lg-9">
    <div class="row">

        @forelse ($houses as $house)



            {{--<div class="row bg-secondary ">--}}
            {{--<div class="col-3 bg-danger"></div>--}}
            {{--<div class="col-8 d-inline-flex border p-2 offset-3">--}}
            {{--<div class="col-2">--}}
            {{--<img src="{{$house->images}}"--}}
            {{--class="img-responsive ">--}}
            {{--</div>--}}
            {{--<div class="col-9 offset-1 mt-2">--}}
            {{--<div class="row">--}}
            {{--<div class="col-6">--}}
            {{--<p id="list-item-name" class="font-weight-bold">{{$house->name}}</p>--}}
            {{--<p id="list-item-name-direction">{{$house->direction}}</p>--}}
            {{--<p id="list-item-name-location">{{$house->location}}</p>--}}
            {{--</div>--}}
            {{--<div class="col-6">--}}

            {{--<div class=" col-12 d-inline-flex align-items-baseline  justify-content-end">--}}

            {{--<p id="list-item-name-price ">{{$house->price_user_night}}</p>--}}
            {{--<i class="fa fa-eur" aria-hidden="true"></i>--}}
            {{--</div>--}}
            {{--<div class="text-right">--}}
            {{--<p>Precio por pers/noche</p>--}}

            {{--<a href="">Ver</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<span id="list-item-name-location" class="xs">{{$house->description}}</span>--}}
            {{--</div>--}}
            {{--<div class="col-5">--}}

            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-1 bg-danger"></div>--}}

            {{--</div>--}}

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="{{$house->images}}" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a class="card-title" href="#">{{$house->name}}</a>
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
            </div>
        @empty
            <div class="row">
                <p>Error no se han cargado datos</p>
            </div>

        @endforelse

                <div class="col-4  offset-5 text-center p-5">

                    {{$houses->links()}}
            </div>

    </div>

</div>
