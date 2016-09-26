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
                    Tasks
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table data-table table-striped table-hover" data-order='[[ 1, "asc" ]]'>
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Body</th>
                                <th>Completed</th>
                                <th>Created at</th>
                                <th class="no-sort text-center" width="30">Edit</th>
                                <th class="no-sort text-center" width="30">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tasks as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->body }}</td>
                                <td>{{ $item->completed }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td class="text-center">
                                    <a href="/admin/task/{{ $item->id }}/edit">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form method="POST" action="/admin/task/{{ $item->id }}">
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

@stop