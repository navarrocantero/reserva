@extends('layouts.app')

@section('content')

    <div class="col-10 offset-1">
        <form action="{{"/add"}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location">
            </div>

            <div class="form-group">
                <label for="location">Direction</label>
                <input type="text" class="form-control" id="direction" name="direction">
            </div>

            <div class="form-group">
                <label for="price_user_night">Price User/Night</label>
                <input type="text" class="form-control" id="price_user_night" name="price_user_night">
            </div>
            <button type="submit" class="btn btn-primary">Añadir</button>
        </form>
    </div>
@endsection