@extends('admin::layout')

@section('title')
    Roles and Permissions Management
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
                                    'sortOrder' => $roles->pluck('sort_order')->last() + 10,
                                    'errors' => $errors->roleErrors,
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
                        <th>{{ trans('admin::tables.order') }}</th>
                        <th>Admin?</th>
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
                    <form method="POST" action="{{ route('permissions.store') }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                @include ('admin::components.form.text', [
                                    'label' => 'Name',
                                    'field' => 'name',
                                    'placeholder' => 'Enter permission name',
                                    'errors' => $errors->permissionErrors,
                                ])
                                @include ('admin::components.form.text', [
                                    'label' => 'Label',
                                    'field' => 'label',
                                    'placeholder' => 'Enter permission label',
                                    'errors' => $errors->permissionErrors,
                                ])
                            </div>
                            <div class="col-md-6">
                                @include ('admin::components.form.order', [
                                    'sortOrder' => $permissions->pluck('sort_order')->last() + 10,
                                    'errors' => $errors->permissionErrors,
                                ])
                                @include ('admin::components.form.submit', [
                                    'button' => trans('admin::messages.permissions.create'),
                                    'type' => 'warning',
                                ])
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
                        <th>{{ trans('admin::tables.order') }}</th>
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