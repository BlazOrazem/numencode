@extends('admin::layout')

@section('title')
    @lang('admin::managers.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::managers.create')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('managers.store') }}" class="form-horizontal form-validate" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::managers.name'),
                            'field' => 'name',
                            'placeholder' => trans('admin::managers.placeholder.name'),
                            'required' => true,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::managers.email'),
                            'field' => 'email',
                            'placeholder' => trans('admin::managers.placeholder.email'),
                            'required' => true,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::managers.phone'),
                            'field' => 'phone',
                            'placeholder' => trans('admin::managers.placeholder.phone'),
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::managers.password'),
                            'field' => 'password',
                            'required' => true,
                        ])
                        @include ('admin::components.form.image', [
                            'label' => trans('admin::managers.avatar'),
                            'field' => 'avatar',
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::managers.create')
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection