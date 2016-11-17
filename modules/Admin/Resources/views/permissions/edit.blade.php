@extends('admin::layout')

@section('title')
    {{ trans('admin::permissions.title') }}
@stop

@section('content')

    <div class="row">

        <div class="col-lg-6">
            <div class="data-table data-success content-box">
                <div class="head success-bg clearfix">
                    <h5 class="content-title pull-left">{{ trans('admin::permissions.permissions') }}</h5>
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
                        @if ($admin->can('edit_permissions'))
                            <th class="no-sort text-center">{{ trans('admin::tables.edit') }}</th>
                        @endif
                        @if ($admin->can('delete_permissions'))
                            <th class="no-sort text-center">{{ trans('admin::tables.delete') }}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($permissions as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->label }}</td>
                            <td class="text-right">
                                <span class="badge badge-info">
                                    {{ $item->sort_order }}
                                </span>
                            </td>
                            @if ($admin->can('edit_permissions'))
                                <td class="text-center">
                                    @include ('admin::components.button.edit', [
                                        'action' => route('permissions.edit', compact('item'))
                                    ])
                                </td>
                            @endif
                            @if ($admin->can('delete_permissions'))
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

        <div class="col-lg-6">
            <div class="content-box">
                <div class="head warning-bg clearfix">
                    <h5 class="content-title pull-left">{{ trans('admin::permissions.update') }}: {{ $permission->name }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('permissions.update', [$permission]) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.name'),
                            'field' => 'name',
                            'placeholder' => trans('admin::permissions.placeholder.name'),
                            'entity' => $permission,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.label'),
                            'field' => 'label',
                            'placeholder' => trans('admin::permissions.placeholder.label'),
                            'entity' => $permission,
                        ])
                        @include ('admin::components.form.order', [
                            'sortOrder' => $permission->sort_order,
                        ])
                        @include ('admin::components.form.checkbox', [
                            'label' => 'Is admin?',
                            'field' => 'is_admin',
                            'type' => 'warning',
                            'isChecked' => $permission->is_admin,
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::permissions.update'),
                            'type' => 'warning',
                        ])
                    </form>
                </div>
            </div>
            <div class="content-box">
                <div class="content text-center">
                    <a class="btn btn-default btn-link btn-md btn-full" href="{{ route('permissions.index') }}">
                        <i class="zmdi zmdi-caret-left-circle left"></i>
                        {{ trans('admin::permissions.index') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@stop