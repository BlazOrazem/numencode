@extends('admin::layout')

@section('title')
    Roles and permissions
@stop

@section('content')

    <div class="row">

        <div class="col-md-6">
            <div class="content-box">
                <div class="head success-bg clearfix">
                    <h5 class="content-title pull-left">Create a new Role</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('roles.store') }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                @include ('admin::components.form.text', [
                                    'label' => 'Name',
                                    'field' => 'name',
                                    'placeholder' => 'Enter role name',
                                    'errors' => $errors->roleErrors,
                                ])
                                @include ('admin::components.form.text', [
                                    'label' => 'Label',
                                    'field' => 'label',
                                    'placeholder' => 'Enter role label',
                                    'errors' => $errors->roleErrors,
                                ])
                            </div>
                            <div class="col-md-6">
                                @include ('admin::components.form.order', [
                                    'errors' => $errors->roleErrors,
                                    'next' => $roles->pluck('sort_order')->last() + 10
                                ])
                                @include ('admin::components.form.submit', [
                                    'button' => trans('admin::messages.roles.create'),
                                ])
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="data-table data-success content-box" data-id="roles">
                <div class="head success-bg clearfix">
                    <h5 class="content-title pull-left">Roles</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 2, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>{{ trans('admin::tables.name') }}</th>
                        <th>{{ trans('admin::tables.label') }}</th>
                        <th class="text-right">{{ trans('admin::tables.order') }}</th>
                        <th>Is admin?</th>
                        @if ($admin->can('edit_managers'))
                            <th class="no-sort text-center">{{ trans('admin::tables.manage') }}</th>
                        @endif
                        @if ($admin->can('delete_managers'))
                            <th class="no-sort text-center">{{ trans('admin::tables.delete') }}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->label }}</td>
                            <td class="text-right">{{ $item->sort_order }}</td>
                            <td>{{ $item->is_admin }}</td>
                            @if ($admin->can('edit_managers'))
                                <td class="text-center">
                                    @include ('admin::components.button.edit', [
                                        'action' => route('roles.edit', compact('item')),
                                        'icon' => 'zmdi-collection-text'
                                    ])
                                </td>
                            @endif
                            @if ($admin->can('delete_managers'))
                                <td class="text-center">
                                    @if ($item->isDeletable())
                                        @include ('admin::components.button.delete', [
                                            'action' => route('roles.destroy', compact('item'))
                                        ])
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="content-box">
                <div class="head warning-bg clearfix">
                    <h5 class="content-title pull-left">Create a new Permission</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('permissions.create') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->permissionErrors->has('name') ? ' has-error' : '' }}">
                                    <label for="roleNewName" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="roleNewName" placeholder="Enter permission name">
                                        <span class="help-block">{{ $errors->permissionErrors->first('name', ':message') }}</span>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->permissionErrors->has('label') ? ' has-error' : '' }}">
                                    <label for="roleNewLabel" class="col-sm-2 control-label">Label</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="label" value="{{ old('label') }}" class="form-control" id="roleNewLabel" placeholder="Enter permission label">
                                        <span class="help-block">{{ $errors->permissionErrors->first('label', ':message') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->permissionErrors->has('sort_order') ? ' has-error' : '' }}">
                                    <label for="itemNewOrder" class="col-sm-2 control-label">Order</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="sort_order" value="{{ old('sort_order', $permissions->pluck('sort_order')->last() + 10) }}" class="form-control" id="itemNewOrder" placeholder="Set order">
                                        <p class="help-block">{{ $errors->permissionErrors->first('sort_order', ':message') }}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <button type="submit" class="btn btn-md btn-warning">{{ trans('admin::messages.permissions.create') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="data-table data-warning content-box" data-id="permissions">
                <div class="head warning-bg clearfix">
                    <h5 class="content-title pull-left">Permissions</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 2, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>{{ trans('admin::tables.name') }}</th>
                        <th>{{ trans('admin::tables.label') }}</th>
                        <th class="text-right">{{ trans('admin::tables.order') }}</th>
                        @if ($admin->can('edit_managers'))
                            <th class="no-sort text-center">{{ trans('admin::tables.edit') }}</th>
                        @endif
                        @if ($admin->can('delete_managers'))
                            <th class="no-sort text-center">{{ trans('admin::tables.delete') }}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($permissions as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->label }}</td>
                            <td class="text-right">{{ $item->sort_order }}</td>
                            @if ($admin->can('edit_managers'))
                                <td class="text-center">
                                    @include ('admin::components.button.edit', [
                                        'action' => route('permissions.edit', compact('item'))
                                    ])
                                </td>
                            @endif
                            @if ($admin->can('delete_managers'))
                                <td class="text-center">
                                    @include ('admin::components.button.delete', [
                                        'action' => route('permissions.destroy', compact('item'))
                                    ])
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@stop