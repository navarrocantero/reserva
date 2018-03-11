
<table class="table table-hover table-bordered table-striped mt-2">
        <thead>
        <tr>
            <th scope="col">Identificador</th>
            <th scope="col">Nombre</th>
            <th scope="col">Precio</th>
            <th scope="col">Salida</th>
            <th scope="col">Editar</th>
            <th scope="col" class="table-danger"> Borrar</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($houses as $house)


            <tr>
                <th> {{$house->id}}</th>
                <td><a href="/house/{{$house->slugname}}">{{$house->name}}</a></td>
                <td>{{$house->price_user_night}}</td>
                <td>{{$house->direction}}</td>
                <td><a href="void:" class="edit_house" id="{{$house->id}}"><i class="fas fa-pencil-alt"></i>
                    </a></td>
                <td><a href="void:" class="delete_house"><i class="fas fa-trash-alt"></i>
                    </a></td>

            </tr>


        @empty
            <th>No</th>
            <td> hay</td>
            <td> datos</td>
            <td> para</td>
            <td> mostrar</td>
            <td> !</td>

        @endforelse


        </tbody>
    </table>
@if(isset($houses[0]))
    <div class="modal" id="delete-confirm">

        <div class="d-inline-flex w-100 justify-content-around mb-2">
            <button class="btn btn-primary   " data-izimodal-close=""> Cancelar</button>
            <form action="{{ '/profile/houses/delete/' }}{{$house->slugname}}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}

                <button class="btn btn-danger" type="submit"> Borrar</button>

            </form>
        </div>
    </div>
    <div class="modal" id="edit-house">
        <div id="house-container">

        </div>
    </div>
    <script src="{{ asset('js/userupdate/updateUserHouse.js') }}" defer></script>
@endif
