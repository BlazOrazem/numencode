@extends('admin::layout')

@section('content')

    <div class="omb_login">

        <h3 class="omb_authTitle">Admin Login</h3>

        <form method="POST" action="{{ route('admin_login_action') }}" class="omb_loginForm">
            {!! csrf_field() !!}
            @if (isset($ref))
                <input type="hidden" name="ref" value="{{ $ref }}">
            @endif
            <div class="row omb_row-sm-offset-2">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="input-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail address">
                            </div>
                            <span class="help-block">{!! $errors->first('email', ':message') !!}</span>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="input-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <span class="help-block">{!! $errors->first('password', ':message') !!}</span>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                </div>
            </div>
            <div class="row omb_row-sm-offset-2">
                <div class="col-xs-6 col-sm-6 col-md-4">
                    <div class="checkbox">
                        <div class="form-group">
                            <input type="checkbox" name="remember" id="checkboxRemember">
                            <label for="checkboxRemember" class="control-label">
                                Remember me
                            </label>
                            <span class="form-error"></span>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

@stop