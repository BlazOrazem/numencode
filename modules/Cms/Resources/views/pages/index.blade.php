@extends('theme::layouts.' . $page->layout)

@section('title')
    @if($page->title)
        {{ $page->title }}
    @endif
@endsection

@section('content')

    @if($page->lead)
        <p>{{ $page->lead }}</p>
    @endif

    @if($page->body)
        {!! $page->body !!}
    @endif

@endsection

@section('plugins_center')
    @each('theme::pages.content', $page->getContents('center'), 'content')
@endsection

@section('plugins_bottom')
    @each('theme::pages.content', $page->getContents('bottom'), 'content')
@endsection