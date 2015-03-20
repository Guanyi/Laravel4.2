@extends('master')

@section('content')
    <p>{{$message}}</p>

    <p><a href="{{ URL::to('/'); }}">Login</a></p>
@endsection