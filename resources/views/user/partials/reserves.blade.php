<table class="table table-hover table-bordered table-striped mt-2">
<thead>
    <tr>
        <th scope="col">Identificador</th>
        <th scope="col">Nombre</th>
        <th scope="col">Entrada</th>
        <th scope="col">Salida</th>
        <th scope="col" class="table-danger">Borrar</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($reserves as $reserve)


    <tr>
        <th  > {{$reserve->id}}</th>
        <td><a href="/house/{{$reserve->house()->first()->slugname}}">{{$reserve->house()->first()->slugname}}</a></td>
        <td>{{$reserve->entry_date}}</td>
        <td>{{$reserve->exit_date}}</td>
        <td><a href="void:" class="delete_reserve"><i class="fas fa-trash-alt"></i>
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

@if(isset($reserves[0]))
    <div class="modal" id="delete-confirm">

        <div class="d-inline-flex w-100 justify-content-around mb-2">
            <button class="btn btn-primary   " data-izimodal-close=""> Cancelar</button>
            <form action="{{ '/profile/reserves/delete/' }}{{$reserve->id}}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}

                <button class="btn btn-danger" type="submit"> Borrar</button>

            </form>
        </div>
    </div>
    <script src="{{ asset('js/userupdate/updateUserReserve.js') }}" defer></script>
@endif

