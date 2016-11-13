@extends('admin::layout')

@section('title')
    Roles and Permissions Management
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Role: {{ ucfirst($role->name) }}
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Permissions for {{ ucfirst($role->name) }}
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="30">Assigned?</th>
                            <th>Permission</th>
                            <th>Code</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td class="text-center"><input type="checkbox" @if (in_array($permission->id, $role->permissions()->pluck('id')->toArray())) checked @endif></td>
                                <td>{{ $permission->label }}</td>
                                <td>{{ $permission->name }}</td>
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

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Users with role {{ ucfirst($role->name) }}
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="no-sort">Picture</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Nickname</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($role->users as $user)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ $user->avatar }}" width="50" height="50" class="img-circle">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->nickname }}</td>
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

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Managers with role {{ ucfirst($role->name) }}
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="no-sort">Picture</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Phone</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($role->managers as $manager)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ $manager->avatar }}" width="50" height="50" class="img-circle">
                                </td>
                                <td>{{ $manager->name }}</td>
                                <td>{{ $manager->email }}</td>
                                <td>{{ $manager->phone }}</td>
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