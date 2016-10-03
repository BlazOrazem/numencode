@extends('theme::layout')

@section('content')

    <div class="jumbotron">
        <h1>{{ $page->title }}</h1>
        <p>{{ $page->lead }}</p>
        <p>{{ $page->body }}</p>
    </div>

    @if($page->getContents())
        @section('plugins')
            @foreach($page->getContents() as $content)
                <h4>{{ $content->title }}</h4>
                <p>{{ $content->lead }}</p>
                <p>{{ $content->body }}</p>

                <div class="row">
                    {!! $content->renderPlugin() !!}
                </div>

                <hr>
            @endforeach
        @stop
    @endif

@stop