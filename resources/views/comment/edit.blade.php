<div class="col-12 mt-2 mb-2">
    <form action="" method="POST"  onsubmit="validateComment()"enctype="multipart/form-data">
    {{--<form action="{{ url('/comment/update/'.$comment->id)}}" method="POST" enctype="multipart/form-data">--}}

        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div id="tooltips">

        </div>
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
            <div id="spin" class=" offset-1 col-1" ></div>
            <button class="btn btn-success" type="button" id="comment-submit"> Actualizar</button>
        </div>

    </form>
</div>


