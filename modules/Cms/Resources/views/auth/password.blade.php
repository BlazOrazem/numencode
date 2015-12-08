@extends('theme::layout')

@section('content')

    <div class="omb_login">

        <h3 class="omb_authTitle">Reset Your Password</h3>

        <form method="POST" action="{{ route('password_send') }}" class="omb_loginForm">
            {!! csrf_field() !!}
            <div class="row omb_row-sm-offset-2">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="input-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail address">
                            </div>
                            <span class="help-block">{!! $errors->first('email', ':message') !!}</span>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Send Password Reset Link</button>
                </div>
            </div>
            <div class="row omb_row-sm-offset-2">
                <div class="row omb_row-sm-offset-2">
                    <div class="col-xs-12 col-sm-12 col-md-8">
                        <p class="omb_forgotPwd">
                            Password reset link will be sent to your inbox.
                        </p>
                    </div>
                </div>
            </div>
        </form>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

@stop