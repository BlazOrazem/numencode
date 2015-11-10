@extends('layout')

@section('content')

    <div class="jumbotron">
        <div class="container text-center">
            <h1>Hello, {{ $user->name }}!</h1>
            <p>Your nickname is "{{ $user->nickname }}" and your e-mail address is "{{ $user->email }}".</p>
            @if ($user->avatar)
                <img src="{{ $user->avatar }}">
            @endif
        </div>
    </div>

@stop