@extends('layouts.app')

@section('sidebar')
    <div class="col-lg-3 col-md-3 mt-2 ">
        @include('feature.list')
    </div>
@endsection


@section('content')
    <div class="col-lg-9 col-md-9" id="housePaginationAjaxList">
        @include('house.list')
    </div>
@endsection