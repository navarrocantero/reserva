<div class="card mt-2">

    <div class="card-footer">

        <form action="{{ url('/house/update/'.$house->id)}}" method="POST">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            @if( $errors->has('location') )
                <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('location') }}
                        </span>
                </div>
            @endif
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Coordenadas - {{ $house->location }}" id="location"
                       name="location">
                <div class="input-group-append">
                    <span class="input-group-text" ><i class="fas fa-user"></i></span>
                </div>
            </div>

            @if( $errors->has('direction') )
                <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('direction') }}
                        </span>
                </div>
            @endif
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Direccion - {{ $house->direction }}" id="direction"
                       name="direction">
                <div class="input-group-append">
                    <span class="input-group-text" ><i class="fas fa-user"></i></span>
                </div>
            </div>

            @if( $errors->has('name') )
                <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('name') }}
                        </span>
                </div>
            @endif
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nombre - {{ $house->name }}" id="name"
                       name="name">
                <div class="input-group-append">
                    <span class="input-group-text" ><i class="fas fa-user"></i></span>
                </div>
            </div>

            @if( $errors->has('price_user_night') )
                <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('price_user_night') }}
                        </span>
                </div>
            @endif
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Precio - {{ $house->name }}" id="price_user_night"
                       name="price_user_night">
                <div class="input-group-append">
                    <span class="input-group-text" ><i class="fas fa-user"></i></span>
                </div>
            </div>

            @if( $errors->has('max_users_house') )
                <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('max_users_house') }}
                        </span>
                </div>
            @endif
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Capacidad - {{ $house->max_users_house }}" id="max_users_house"
                       name="max_users_house">
                <div class="input-group-append">
                    <span class="input-group-text" ><i class="fas fa-user"></i></span>
                </div>
            </div>

            @if( $errors->has('description') )
                <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('description') }}
                        </span>
                </div>
            @endif
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Descripcion - {{ $house->description }}" id="description"
                       name="description">
                <div class="input-group-append">
                    <span class="input-group-text" ><i class="fas fa-user"></i></span>
                </div>
            </div>


            <div class=" d-inline-flex justify-content-between w-100">
                <button class="btn btn-danger   " data-izimodal-close=""> Cancelar</button>

                <button class="btn btn-success" type="submit" id="comment-submit"> Actualizar</button>
            </div>
        </form>
    </div>
</div>