@extends('admin::layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Roles and Permissions
            </h1>
        </div>
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Roles
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table data-table table-striped table-bordered table-hover" data-order='[[ 0, "asc" ]]'>
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Is admin?</th>
                            <th>Assign permissions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td class="text-right">{{ $key + 1 }}</td>
                                <td>{{ ucfirst($role->name) }}</td>
                                <td>{{ $role->label }}</td>
                                <td>{{ $role->is_admin }}</td>
                                <td class="text-center">
                                    <a href="{{ route('roles.permissions', compact('role')) }}">
                                        <i class="fa fa-search-plus"></i>
                                    </a>
                                </td>
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

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Permissions
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table data-table table-striped table-bordered table-hover" data-order='[[ 0, "asc" ]]'>
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions as $key => $permission)
                            <tr>
                                <td class="text-right">{{ $key + 1 }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->label }}</td>
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