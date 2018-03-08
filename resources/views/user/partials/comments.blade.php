<table class="table table-hover table-bordered table-striped mt-2">
    <thead>
    <tr>
        <th scope="col">Identificador</th>
        <th scope="col">Casa</th>
        <th scope="col">Creado</th>
        <th scope="col">Editar</th>
        <th scope="col" class="table-danger">Borrar</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($comments as $comment)


        <tr>
            <th> {{$comment->id}}</th>
            <td><a href="/house/{{$comment->house()->first()->slugname}}">{{$comment->house()->first()->slugname}}</a>
            </td>
            <td>{{$comment->created_at}}</td>
            {{--<td>{{$reserve->exit_date}}</td>--}}
            {{--<td><a href="void:" class="delete_reserve"><i class="fas fa-trash-alt"></i>--}}
            {{--</a></td>--}}
            <td><a href="void:" class="edit_comment" id="{{$comment->id}}"><i class="fas fa-pencil-alt"></i>
                </a></td>
            <td><a href="void:" class="delete_comment"><i class="fas fa-trash-alt"></i>
                </a></td>

        </tr>

    @empty

        <th>No</th>
        <td> hay</td>
        <td> datos</td>
        <td> para</td>
        <td> mostrar !</td>

    @endforelse
    </tbody>
</table>

@if(isset($comments[0]))
    <div class="modal" id="delete-confirm">

        <div class="d-inline-flex w-100 justify-content-around mb-2">
            <button class="btn btn-primary   " data-izimodal-close=""> Cancelar</button>
            <form action="{{ '/profile/comment/delete/' }}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <input type="hidden" id="comment-id" name="comment-id" value="{{$comment->id}}">

                <button class="btn btn-danger" type="submit"> Borrar</button>

            </form>
        </div>
    </div>

    <div class="modal" id="edit-comment">
        <div id="comment-container">

    </div>
    </div>
    <script src="{{ asset('js/userupdate/updateUserComment.js') }}" defer></script>
@endif

