@section('sidebar')

    <div class="col-lg-3">

        <h1 class="my-4">Reserving</h1>
        <div class="list-group">
            <a href="#" class="list-group-item">Category 1</a>
            <a href="#" class="list-group-item">Category 2</a>
            <a href="#" class="list-group-item">Category 3</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-9">
        <div class="row">

            @forelse ($houses as $house)

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
@endsection