@extends('theme::emails.partials.new-layout', [
    'action' => [
        'title' => 'Click this button!',
        'url' => 'http://google.com',
        'color' => 'green',
    ],
])

@section('title')
    Test Email Format
@stop

@section('content')
    Check this out!
@stop