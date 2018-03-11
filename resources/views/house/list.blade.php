    <div class="row">
        @forelse ($houses as $house)
            @include('house.house')
        @empty
            <div class="row">
                <p>No hay datos para mostrar !</p>
            </div>

        @endforelse

            <div class="col-12 text-center p-5">
                {{$houses->links('pagination')}}
            </div>
    </div>



