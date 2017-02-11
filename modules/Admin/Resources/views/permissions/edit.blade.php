@extends('admin::layout')

@section('title')
    @lang('admin::permissions.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::permissions.update') : {{ $permission->name }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
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
                            'required' => true,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.label'),
                            'field' => 'label',
                            'placeholder' => trans('admin::permissions.placeholder.label'),
                            'entity' => $permission,
                            'required' => true,
                        ])
                        @include ('admin::components.form.order', [
                            'sortOrder' => $permission->sort_order
                        ])
                        @include ('admin::components.form.checkbox', [
                            'label' => 'Is admin?',
                            'field' => 'is_admin',
                            'isChecked' => $permission->is_admin,
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::permissions.update')
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-base content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::permissions.permissions')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 2, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>@lang('admin::tables.name')</th>
                        <th>@lang('admin::tables.label')</th>
                        <th width="60" class="text-right">@lang('admin::tables.order')</th>
                        <th width="60" class="no-sort text-center">@lang('admin::tables.edit')</th>
                        <th width="60" class="no-sort text-center">@lang('admin::tables.delete')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($permissions as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->label }}</td>
                            <td class="text-right">
                                <span class="badge badge-base">
                                    {{ $item->sort_order }}
                                </span>
                            </td>
                            <td class="text-center">
                                @include ('admin::components.button.edit', [
                                    'action' => route('permissions.edit', compact('item'))
                                ])
                            </td>
                            <td class="text-center">
                                @include ('admin::components.button.delete', [
                                    'action' => route('permissions.destroy', compact('item'))
                                ])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="content-box">
                <div class="content text-center">
                    <a class="btn btn-default btn-link btn-md btn-full" href="{{ route('permissions.index') }}">
                        <i class="zmdi zmdi-caret-left-circle left"></i>
                        @lang('admin::permissions.index')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection