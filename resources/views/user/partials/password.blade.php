<div class="card mt-2">
<div class="card-header">
    <form action="{{ url('/profile/password') }}" method="POST">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
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
        <div class="card-footer">
   <div class="btn btn-danger mt-5" id="delete-user">Borrar Cuenta</div>

        <div class="small-12 columns">
            <button type="submit" class="button" hidden>Actualizar</button>
        </div>
        </div>
    </form>



</div>

<div class="modal" id="delete-confirm">
<div class="d-inline-flex w-100 justify-content-around mb-2">
    <button class="btn btn-primary   " data-izimodal-close="" > Cancelar </button>
    <div id="tooltips"></div>

    <form  method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <button class="btn btn-danger" type="button"> Borrar </button>

    </form>
</div>
</div>
<script src="{{ asset('js/userupdate/updateUserPassword.js') }}" defer></script>

</div>