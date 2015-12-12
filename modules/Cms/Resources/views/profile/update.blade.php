@extends('theme::layout')

@section('content')

    <div class="omb_login">

        <h3 class="omb_authTitle">Update Your Profile</h3>

        <form method="POST" action="{{ route('profile_update') }}" class="omb_loginForm" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="row omb_row-sm-offset-2">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            @if ($user->avatar)
                                <img src="/{{ $user->avatar }}" class="img-responsive user-avatar-update">
                            @endif
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="input-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fa fa-photo"></i> Avatar</span>
                                <input type="file" class="form-control" name="avatar" value="{{ old('avatar') }}">
                            </div>
                            <span class="help-block">{!! $errors->first('avatar', ':message') !!}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row omb_row-sm-offset-2">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="input-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Your name">
                            </div>
                            <span class="help-block">{!! $errors->first('name', ':message') !!}</span>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="input-group {{ $errors->has('nickname') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <input type="text" class="form-control" name="nickname" value="{{ $user->nickname }}" placeholder="Your nickname">
                            </div>
                            <span class="help-block">{!! $errors->first('nickname', ':message') !!}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row omb_row-sm-offset-2">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="input-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="E-mail address">
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
                            <div class="input-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Password again">
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row omb_row-sm-offset-2">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <button class="btn btn-lg btn-info btn-block" type="submit">Save Changes</button>
                </div>
            </div>
        </form>

    </div>

@stop