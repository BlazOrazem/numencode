@extends('admin::layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update manager</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control normal" value="{{ $manager->name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control normal" value="{{ $manager->email }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control small" value="{{ $manager->phone }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control small">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Avatar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control normal" name="avatar">
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
        <!-- /.col-lg-12 -->
    </div>

@stop