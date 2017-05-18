@extends('theme::layouts.default')

@section('title')
    @if($blogItem->title)
        {{ $blogItem->title }}
    @endif
@endsection

@section('content')

    @if($blogItem->lead)
        <p>{{ $blogItem->lead }}</p>
    @endif

    @if($blogItem->body)
        {!! $blogItem->body !!}
    @endif

@endsection