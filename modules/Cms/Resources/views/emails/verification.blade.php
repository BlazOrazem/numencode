@extends('theme::emails.partials.layout')

@section('title')
    Verify Your E-mail Address
@stop

@section('content')
    <table>
        <tr>
            <td>
                <h2>Verify Your E-mail Address</h2>
                <p>We just need you to verify your email address real quick!</p>
                <!-- button -->
                <table class="btn-primary" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td>
                            <a href='{{ url("auth/register/verify/{$user->token}") }}'>Verify My Email Address</a>
                        </td>
                    </tr>
                </table>
                <!-- /button -->
                <p>Thanks, have a lovely day.</p>
                <p><a href="http://twitter.com/">Follow @CleanSlate on Twitter</a></p>
            </td>
        </tr>
    </table>
@stop