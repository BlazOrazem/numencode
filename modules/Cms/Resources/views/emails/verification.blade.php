@extends('theme::emails.partials.layout', [
    'action' => [
        'title' => 'Verify My Email Address',
        'url' => route("register.verify", ['token' => $user->token]),
        'color' => 'green',
    ],
])

@section('title')
    Verify Your E-mail Address
@stop

@section('intro')
    We just need you to verify your email address real quick!
@stop

@section('outro')
    Thanks, have a lovely day.
@stop
