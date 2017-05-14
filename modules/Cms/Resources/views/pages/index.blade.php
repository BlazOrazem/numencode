@extends('theme::layouts.' . $page->layout)

@section('content')

    <div class="jumbotron">
        <h1>{{ $page->title }}</h1>
        <p>{{ $page->lead }}</p>
        <p>{!! $page->body !!}</p>
    </div>

@endsection

@section('plugins_center')
    @each('theme::pages.content', $page->getContents('center'), 'content')
@endsection

@section('plugins_bottom')
    @each('theme::pages.content', $page->getContents('bottom'), 'content')
@endsection