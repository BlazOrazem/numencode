@extends('admin::layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update a Task</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Update a Task <strong>{{ $task->title }}</strong>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form method="POST" action="{{ route('tasks.update', compact('task')) }}" role="form">
                                {{ method_field('PATCH') }}

                                @include ('admin::tasks.form', [
                                    'submitButtonText' => trans('admin::messages.tasks.submit_update')
                                ])
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

@endsection