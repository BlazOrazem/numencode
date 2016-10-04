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
                                @include ('admin::tasks.form', [
                                    'resetButton' => true
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

@stop