@extends('theme::emails.partials.layout', [
    'action' => [
        'title' => 'Verify My Email Address',
        'url'   => route("register.verify", ['token' => $data->token]),
        'color' => 'green',
    ],
])

@section('title')
    Verify Your E-mail Address
@endsection

@section('intro')
    We just need you to verify your email address real quick!
@endsection

@section('outro')
    Thanks, have a lovely day.
@endsection
