@extends('admin::layout')

@section('title')
    @lang('admin::managers.title')
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::managers.profile')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('managers.profile.update') }}" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include('admin::components.form.text', [
                            'label' => trans('admin::managers.name'),
                            'field' => 'name',
                            'placeholder' => trans('admin::managers.placeholder.name'),
                            'entity' => $admin,
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::managers.email'),
                            'field' => 'email',
                            'placeholder' => trans('admin::managers.placeholder.email'),
                            'entity' => $admin,
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::managers.phone'),
                            'field' => 'phone',
                            'placeholder' => trans('admin::managers.placeholder.phone'),
                            'entity' => $admin,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::managers.password'),
                            'field' => 'password',
                            'help' => trans('admin::managers.placeholder.password-help'),
                        ])
                        @include('admin::components.form.picture', [
                            'label' => trans('admin::managers.avatar'),
                            'field' => 'avatar',
                            'entity' => $admin,
                            'help' => trans('admin::managers.placeholder.avatar-help'),
                        ])
                        @include('admin::components.form.submit', [
                            'button' => trans('admin::managers.profile')
                        ])
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection