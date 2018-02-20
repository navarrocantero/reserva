    <div class="card">
        @if(isset($features))
            <h3 class="card-title text-center">Categorias</h3>
            @foreach ($features as $feature)
                <div class="card-text">
                    <a href="/feature/{{$feature->slugname}}" class="list-group-item">
                        <p>{{$feature->slugname}}</p></a>
                </div>
            @endforeach
        @endif
    </div>
