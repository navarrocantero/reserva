<div class="card-body">
    {{--<input type="text" id="email" name="email" placeholder="{{ $user->username }}"--}}
    {{--class="{{ $errors->has('email') ? 'is-invalid-input' : ''}}">--}}

    <form action="{{ url('/profile/password') }}" method="POST">
        {{ csrf_field() }}
        {{--{{ method_field('PUT') }}--}}
        @if( $errors->has('current_password') )
            <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('current_password') }}
                        </span>
            </div>
        @endif
        <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Contraseña actual -  " id="current_password"
                   name="current_password">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
        </div>


        @if( $errors->has('password') )
            <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('password') }}
                        </span>
            </div>
        @endif
        <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Nueva contraseña" id="password" name="password">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>

        </div>

        @if( $errors->has('password_confirmation') )
            <div class="mb-2">
                <span class="badge badge-pill badge-danger">
                            {{ $errors->first('password_confirmation') }}
                        </span>
            </div>
        @endif

        <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Repita la contraseña" id="password_confirmation"
                   name="password_confirmation">
            <div class="input-group-append">
                <span class="input-group-text "><i class="fas fa-key"></i></span>
            </div>
        </div>

        <div class="small-12 columns">
            <button type="submit" class="button" hidden>Actualizar</button>
        </div>
    </form>
</div>