@extends('admin::layout')

@section('title')
    Roles and Permissions Management
@stop

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="content-box">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">Update permission : {{ $permission->name }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('permissions.update', [$permission]) }}" class="form-inline form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include ('admin::components.form.text', [
                            'label' => 'Name',
                            'field' => 'name',
                            'placeholder' => 'Enter permission name',
                            'entity' => $permission,
                            'inline' => true,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => 'Label',
                            'field' => 'label',
                            'placeholder' => 'Enter permission label',
                            'entity' => $permission,
                            'inline' => true,
                        ])
                        @include ('admin::components.form.order', [
                            'sortOrder' => $permission->sort_order,
                            'inline' => true,
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::messages.permissions.update'),
                            'type' => 'info',
                            'inline' => true,
                        ])
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop