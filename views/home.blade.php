@extends('layouts.app')

@section('name')
    @php
        var_dump(Application::$app->user)
    @endphp
@endsection