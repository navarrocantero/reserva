<div class="card mt-2">
    <div class="card-header align-items-center ">
        <img class="imagen " src="{{$avatar}}">

    </div>
    <div class="card-footer">

        <form action="{{ url('/profile')}}" method="POST">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            @if( $errors->has('username') )
                <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('username') }}
                        </span>
                </div>
            @endif
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Nick - {{ $user->username }}" id="username" name="username">
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
            <input type="text" class="form-control" placeholder="Nombre - {{ $user->name }}" id="name" name="name">
            <div class="input-group-append">
                <span class="input-group-text"  ><i class="fas fa-user"></i></span>
            </div>
        </div>

            @if( $errors->has('lastname') )
                <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('lastname') }}
                        </span>
                </div>
            @endif
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Apellido/s - {{ $user->lastname }}" id="lastname" name="lastname">
            <div class="input-group-append">
                <span class="input-group-text "><i class="fas fa-user"></i></span>
            </div>
        </div>

            @if( $errors->has('email') )
                <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('email') }}
                        </span>
                </div>
            @endif
        <div class="input-group mb-3">
            <input type="text" class="form-control " placeholder="Email - {{ $user->email }}" id="email" name="email" >
            <div class="input-group-append">
                <span class="input-group-text"  ><i class="fas fa-at"></i></span>
            </div>
        </div>

            @if( $errors->has('telephone') )
                <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('telephone') }}
                        </span>
                </div>
            @endif
        <div class="input-group mb-3">
            <input type="text" class="form-control " placeholder="Telefono - {{ $user->telephone }}" id="telephone" name="telephone">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
        </div>

            @if( $errors->has('website') )
                <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('website') }}
                        </span>
                </div>
            @endif
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Website - {{ $user->website }}" id="website" name="website">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-globe"></i></span>
            </div>
        </div>

            @if( $errors->has('city') )
                <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('city') }}
                        </span>
                </div>
            @endif
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Ciudad - {{ $user->city }}" id="city" name="city">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
            </div>
        </div>
            <div class="small-12 columns">
                <button type="submit" class="button" hidden id="submit">Actualizar</button>
            </div>
        </form>
    </div>
</div>