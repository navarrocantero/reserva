<div class="col-12 mt-2 mb-2">
    <form action="{{ url('/comment/update')}}" method="POST">

        {{--{{ method_field('PATCH') }}--}}
        {{ csrf_field() }}


        <div class="input-group mb-3">
            <input type="text" class="form-control inputfield" placeholder="{{$comment->comment}}"
                   name="comment" id="comment">
            <input type="hidden" id="comment-id" name="comment-id" value="{{$comment->id}}">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
        </div>
        <div class=" d-inline-flex justify-content-between w-100">
            <button class="btn btn-danger   " data-izimodal-close=""> Cancelar</button>
            <button class="btn btn-success" type="submit"> Actualizar</button>
        </div>

    </form>
</div>


