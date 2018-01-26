
@extends('layouts.app')

@section('content')
@include('house.list')
{{$houses->links()}}
@endsection