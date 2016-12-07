@extends('theme::layouts.' . $page->layout)

@section('content')

    <div class="jumbotron">
        <h1>{{ $page->title }}</h1>
        <p>{{ $page->lead }}</p>
        <p>{{ $page->body }}</p>
    </div>

@endsection

@section('plugins')
    @each('theme::pages.content', $page->getContents(), 'content')
@endsection