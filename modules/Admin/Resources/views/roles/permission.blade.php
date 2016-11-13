@extends('admin::layout')

@section('title')
    Roles and Permissions Management
@stop

@section('content')

    <div class="row">

        <div class="col-lg-6">
            <div class="content-box">
                <div class="head success-bg clearfix">
                    <h5 class="content-title pull-left">{{ trans('admin::roles.permission.update') }}: {{ $permission->name }}</h5>
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
                            'placeholder' => trans('admin::roles.placeholder.permission_name'),
                            'entity' => $permission,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.label'),
                            'field' => 'label',
                            'placeholder' => trans('admin::roles.placeholder.permission_label'),
                            'entity' => $permission,
                        ])
                        @include ('admin::components.form.order', [
                            'sortOrder' => $permission->sort_order,
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::roles.permission.update'),
                        ])
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop