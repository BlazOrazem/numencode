@extends('admin::layout')

@section('title')
    @lang('admin::pages.title')
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::pages.create')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('pages.store') }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        @include ('admin::components.form.select', [
                            'label' => trans('admin::pages.menu'),
                            'field' => 'menu',
                            'placeholder' => trans('admin::pages.placeholder.menu'),
                            'data' => $menus,
                            'required' => true,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::pages.name'),
                            'field' => 'title',
                            'placeholder' => trans('admin::pages.placeholder.title'),
                            'required' => true,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::pages.lead'),
                            'field' => 'lead',
                            'placeholder' => trans('admin::pages.placeholder.lead'),
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::pages.body'),
                            'field' => 'body',
                            'placeholder' => trans('admin::pages.placeholder.body'),
                            'required' => true,
                        ])
                        @include ('admin::components.form.checkbox', [
                            'label' => trans('admin::pages.completed'),
                            'field' => 'completed',
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::pages.create')
                        ])
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="reset" class="btn btn-md btn-danger">
                                    Reset form
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection