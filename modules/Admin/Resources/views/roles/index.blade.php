@extends('admin::layout')

@section('title')
    {{ trans('admin::roles.title') }}
@stop

@section('content')

    <div class="row">

        <div class="col-lg-6">
            <div class="data-table data-info content-box">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">{{ trans('admin::roles.roles') }}</h5>
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
                        @if ($admin->can('edit_roles'))
                            <th class="no-sort text-center">{{ trans('admin::tables.manage') }}</th>
                        @endif
                        @if ($admin->can('delete_roles'))
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
                            @if ($admin->can('edit_roles'))
                                <td class="text-center">
                                    @include ('admin::components.button.edit', [
                                        'action' => route('roles.edit', compact('item')),
                                        'icon' => 'zmdi-collection-text'
                                    ])
                                </td>
                            @endif
                            @if ($admin->can('delete_roles'))
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

        <div class="col-lg-6">
            <div class="content-box">
                <div class="head success-bg clearfix">
                    <h5 class="content-title pull-left">{{ trans('admin::roles.create') }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('roles.store') }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.name'),
                            'field' => 'name',
                            'placeholder' => trans('admin::roles.placeholder.name'),
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.label'),
                            'field' => 'label',
                            'placeholder' => trans('admin::roles.placeholder.label'),
                        ])
                        @include ('admin::components.form.order', [
                            'sortOrder' => $roles->pluck('sort_order')->last() + 10,
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::roles.create'),
                        ])
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop