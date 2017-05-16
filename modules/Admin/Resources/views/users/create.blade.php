@extends('admin::layout')

@section('title')
    @lang('admin::users.title')
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::users.create')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('users.store') }}" class="form-horizontal form-validate" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include('admin::components.form.text', [
                            'label' => trans('admin::users.name'),
                            'field' => 'name',
                            'placeholder' => trans('admin::users.placeholder.name'),
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::users.nickname'),
                            'field' => 'nickname',
                            'placeholder' => trans('admin::users.placeholder.nickname'),
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::users.email'),
                            'field' => 'email',
                            'placeholder' => trans('admin::users.placeholder.email'),
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::users.password'),
                            'field' => 'password',
                            'required' => true,
                        ])
                        @include('admin::components.form.picture', [
                            'label' => trans('admin::users.avatar'),
                            'field' => 'avatar',
                        ])
                        @include('admin::components.form.submit', [
                            'button' => trans('admin::users.create')
                        ])
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection