@extends('admin::layout')

@section('title')
    @lang('admin::roles.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::roles.update') : {{ $role->name }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('roles.update', [$role]) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.name'),
                            'field' => 'name',
                            'placeholder' => trans('admin::roles.placeholder.name'),
                            'entity' => $role,
                            'class' => 'snake-slug',
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.label'),
                            'field' => 'label',
                            'placeholder' => trans('admin::roles.placeholder.label'),
                            'entity' => $role,
                            'required' => true,
                        ])
                        @include('admin::components.form.order', [
                            'sortOrder' => $role->sort_order,
                        ])
                        @include('admin::components.form.checkbox', [
                            'label' => 'Admin role?',
                            'field' => 'is_admin',
                            'checked' => $role->is_admin,
                        ])
                        @include('admin::components.form.submit', [
                            'button' => trans('admin::roles.update')
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
                    <h5 class="content-title pull-left">Permissions for : {{ $role->name }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 0, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>Permission</th>
                        <th>Code</th>
                        <th width="100" class="no-sort text-center">Assigned?</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $item)
                        <tr>
                            <td>{{ $item->label }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-center">
                                <label>
                                    <input class="toggle toggle-base"
                                           type="checkbox"
                                           name="toggle"
                                           data-toggle="{{ route('roles.assign.permissions', [$role->id, $item->id]) }}"
                                            {{ in_array($item->id, $role->permissions()->pluck('id')->toArray()) ? 'checked' : '' }}
                                            >
                                    <i></i>
                                </label>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($role->is_admin)
        <div class="row">
            <div class="col-lg-12">
                <div class="data-table data-base content-box">
                    <div class="head base-bg clearfix">
                        <h5 class="content-title pull-left">Managers with role : {{ $role->name }}</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        </div>
                    </div>
                    <table class="display datatable middle-align datatable-striped table" data-order='[[ 1, "asc" ]]'>
                        <thead>
                        <tr>
                            <th class="no-sort">@lang('admin::tables.picture')</th>
                            <th>@lang('admin::tables.name')</th>
                            <th>@lang('admin::tables.email')</th>
                            <th>@lang('admin::tables.phone')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($role->managers as $item)
                            <tr>
                                <td>
                                    <img src="{{ $item->avatar }}" width="50" height="50" class="img-circle">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    @if(!$role->is_admin)
        <div class="row">
            <div class="col-lg-12">
                <div class="data-table data-base content-box">
                    <div class="head base-bg clearfix">
                        <h5 class="content-title pull-left">Users with role : {{ $role->name }}</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        </div>
                    </div>
                    <table class="display datatable middle-align datatable-striped table" data-order='[[ 1, "asc" ]]'>
                        <thead>
                        <tr>
                            <th class="no-sort">@lang('admin::tables.picture')</th>
                            <th>@lang('admin::tables.name')</th>
                            <th>@lang('admin::tables.nickname')</th>
                            <th>@lang('admin::tables.email')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($role->users as $item)
                            <tr>
                                <td>
                                    <img src="{{ $item->avatar }}" width="50" height="50" class="img-circle">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->nickname }}</td>
                                <td>{{ $item->email }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="content text-center">
                    <a class="btn btn-default btn-link btn-md btn-full" href="{{ route('roles.index') }}">
                        <i class="zmdi zmdi-caret-left-circle left"></i>
                        @lang('admin::roles.index')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection