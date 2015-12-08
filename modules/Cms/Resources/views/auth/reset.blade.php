@extends('theme::layout')

@section('content')

    <div class="omb_login">

        <h3 class="omb_authTitle">Reset Your Password</h3>

        <form method="POST" action="{{ route('password_reset') }}" class="omb_loginForm">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">
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
                </div>
            </div>
            <div class="row omb_row-sm-offset-2">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="input-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password">
                            </div>
                            <span class="help-block">{!! $errors->first('password', ':message') !!}</span>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="input-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Password again">
                            </div>
                            <span class="help-block">{!! $errors->first('password_confirmation', ':message') !!}</span>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-success btn-block" type="submit">Reset Password</button>
                </div>
            </div>
        </form>

    </div>

@stop