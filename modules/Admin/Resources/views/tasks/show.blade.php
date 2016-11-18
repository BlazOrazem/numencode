@extends('admin::layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ $task->title }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $task->title }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {{ $task->body }}
                        </div>
                        <div class="col-lg-6">
                            Task completed:
                            @if ($task->completed)
                                <i class="fa fa-check" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-times" aria-hidden="true"></i>
                            @endif
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