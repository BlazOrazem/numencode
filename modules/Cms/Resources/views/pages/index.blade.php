@extends('theme::layout')

@section('content')

    <div class="jumbotron">
        <h1>{{ $page->title }}</h1>
        <p>{{ $page->body }}</p>
    </div>

    @if($plugins)
        @section('plugins')
            @foreach($plugins as $plugin)
                {!! $plugin !!}
            @endforeach
        @stop
    @endif

@stop