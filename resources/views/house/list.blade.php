@section('sidebar')

    <div class="col-lg-3 mt-2">


        <div class="card">
            <h3  class="card-title text-center">Categorias</h3>
            @foreach ($features as $feature)
                <div class="card-text">
                <a  href="/feature/{{$feature->slugname}}"class="list-group-item"><p>{{$feature->slugname}}</p></a>
                </div>
                @endforeach
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-9">
        <div class="row">

            @forelse ($houses as $house)

                <div class="col-lg-4 col-md-6 mb-4 mt-2">
                    <div class="card h-100">
                        <a href="/house/{{$house->slugname}}"><img class="card-img-top" src="{{$house->images}}"
                                                                   alt="{{$house->slugname}}"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a class="card-title" href="/house/{{$house->slugname}}">{{$house->name}}</a>
                            </h4>

                            <p class="card-text">{{$house->description}}</p>
                        </div>

                        <div class="card-footer content">
                            <div class="d-inline-flex  offset-10">
                                <h5>{{$house->price_user_night}}</h5>
                                <i class="fa fa-euro-sign ml-1" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="row">
                    <p>No hay datos para mostrar !</p>
                </div>

            @endforelse

            <div class="col-12 text-center p-5">
                {{$houses->links('pagination')}}
            </div>

        </div>

    </div>
@endsection