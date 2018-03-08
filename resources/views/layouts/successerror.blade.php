@if( session('success') )
    <div class="mt-2">
        <div class="alert alert-success" role="alert">
            <h5>{{  session('success') }}</h5>
            {{--<h5>Actualizacion correcta !</h5>--}}
        </div>
    </div>
@elseif( session('error'))
    <div class="mt-2">
        <div class="alert alert-danger" role="alert">
            <h5>{{  session('error') }}</h5>
        </div>
    </div>
@endif