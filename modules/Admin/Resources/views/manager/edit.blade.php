@extends('admin::layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update manager</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <form method="POST"
                  action="{{ route('manager.update', ['manager' => $manager]) }}"
                  class="form-horizontal"
                  enctype="multipart/form-data"
                    >
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control normal" value="{{ $manager->name }}">
                        <p class="help-block">{{ $errors->first('name', ':message') }}</p>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control normal" value="{{ $manager->email }}">
                        <p class="help-block">{{ $errors->first('email', ':message') }}</p>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" name="phone" class="form-control small" value="{{ $manager->phone }}">
                        <p class="help-block">{{ $errors->first('phone', ':message') }}</p>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" name="password" class="form-control small">
                        <p class="help-block">{{ $errors->first('password', ':message') }}</p>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                    <label class="col-sm-2 control-label">Avatar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control normal" name="avatar">
                        <p class="help-block">{{ $errors->first('avatar', ':message') }}</p>
                        <br class="clearfix">
                        <img src="{{ $manager->avatar }}" class="img-responsive" width="300">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default btn-primary">Update manager</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@stop