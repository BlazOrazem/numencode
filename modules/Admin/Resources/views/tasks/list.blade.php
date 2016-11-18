@extends('admin::layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tasks</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('tasks.create') }}" class="btn btn-success">Create new Task</a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table width="100%" class="table data-table table-striped table-hover" data-order='[[ 3, "desc" ]]'>
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Completed</th>
                                <th>Created at</th>
                                <th width="30" class="no-sort text-center">Show</th>
                                <th width="30" class="no-sort text-center">Edit</th>
                                <th width="30" class="no-sort text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->title }}</td>
                                <td>
                                    @if ($task->completed)
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    @endif
                                </td>
                                <td>{{ $task->created_at }}</td>
                                <td class="text-center">
                                    <a href="{{ route('tasks.show', compact('task')) }}">
                                        <i class="glyphicon glyphicon-list-alt"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('tasks.edit', compact('task')) }}">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form method="POST" action="{{ route('tasks.destroy', compact('task')) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-link btn-confirmation">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->

@endsection