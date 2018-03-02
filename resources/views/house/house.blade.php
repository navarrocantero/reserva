<div class="col-lg-4 col-md-6 mb-4 mt-2">
    <div class="card h-100">
        <a href="/house/{{$house->slugname}}"><img class="card-img-top" src="{{$house->images()->first()['image_url']}}"
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
