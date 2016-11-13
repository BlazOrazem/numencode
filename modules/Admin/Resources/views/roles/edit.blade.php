@extends('admin::layout')

@section('title')
    {{ trans('admin::roles.title') }}
@stop

@section('content')

    <div class="row">

        <div class="col-lg-6">
            <div class="content-box">
                <div class="head success-bg clearfix">
                    <h5 class="content-title pull-left">{{ trans('admin::roles.update') }}: {{ $role->name }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('roles.update', [$role]) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.name'),
                            'field' => 'name',
                            'placeholder' => trans('admin::roles.placeholder.name'),
                            'entity' => $role,
                            'class' => 'snake-slug',
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.label'),
                            'field' => 'label',
                            'placeholder' => trans('admin::roles.placeholder.label'),
                            'entity' => $role,
                        ])
                        @include ('admin::components.form.order', [
                            'sortOrder' => $role->sort_order,
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::roles.update'),
                        ])
                    </form>
                </div>
            </div>
            <div class="content-box">
                <div class="content text-center">
                    <a class="btn btn-default btn-link btn-md btn-full" href="{{ route('roles.index') }}">
                        <i class="zmdi zmdi-caret-left-circle left"></i>
                        {{ trans('admin::roles.index') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-6">

        </div>

    </div>

@stop