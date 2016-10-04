@extends('admin::layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Managers
            </h1>
        </div>
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Managers list
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table data-table table-striped table-bordered table-hover" data-order='[[ 1, "asc" ]]'>
                        <thead>
                        <tr>
                            <th class="no-sort" width="50"></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created at</th>
                            @if ($admin->can('edit_managers'))
                                <th class="no-sort text-center" width="30">Edit</th>
                            @endif
                            @if ($admin->can('delete_managers'))
                                <th class="no-sort text-center" width="30">Delete</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($managers as $manager)
                        <tr>
                            <td class="text-center">
                                <img src="{{ $manager->avatar }}" width="50" height="50" class="img-circle">
                            </td>
                            <td>{{ $manager->name }}</td>
                            <td>{{ $manager->email }}</td>
                            <td>{{ $manager->phone }}</td>
                            <td>{{ $manager->created_at }}</td>
                            @if ($admin->can('edit_managers'))
                                <td class="text-center">
                                    <a href="{{ route('managers.edit', compact('manager')) }}">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                </td>
                            @endif
                            @if ($admin->can('delete_managers'))
                                <td class="text-center">
                                    @if ($admin->id != $manager->id)
                                    <form method="POST" action="{{ route('managers.destroy', compact('manager')) }}" >
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-link btn-confirmation">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

@stop