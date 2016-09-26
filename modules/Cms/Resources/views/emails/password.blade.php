@extends('theme::emails.partials.layout', [
    'action' => [
        'title' => 'Reset Password',
        'url' => route("password", compact("token")),
        'color' => 'blue',
    ],
])

@section('title')
    Reset Your Password
@stop

@section('intro')
    Click here to reset your password:
@stop

@section('outro')
    If you haven't requested password reset, please ignore this email.
@stop
