@extends('admin::layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create a new Task</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form method="POST" action="{{ route('tasks.store') }}" role="form">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="control-label" for="nameError">Name</label>
                                    <input type="text" name="title" class="form-control" id="nameError">
                                    <p class="help-block">{{ $errors->first('name', ':message') }}</p>
                                </div>
                                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                    <label class="control-label" for="bodyError">Body</label>
                                    <textarea class="form-control" name="body" rows="3" id="bodyError"></textarea>
                                    <p class="help-block">{{ $errors->first('body', ':message') }}</p>
                                </div>
                                <div class="form-group">
                                    <label>Completed?</label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="completed">&nbsp;
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-default">Submit Button</button>
                                <button type="reset" class="btn btn-default">Reset Button</button>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

@stop