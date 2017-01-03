@extends('admin::layout')

@section('title')
    @lang('admin::tasks.title')
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-8">
            <div class="content-box">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::tasks.create')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('tasks.store') }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::tasks.name'),
                            'field' => 'title',
                            'placeholder' => trans('admin::tasks.placeholder.title'),
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::tasks.body'),
                            'field' => 'body',
                            'placeholder' => trans('admin::tasks.placeholder.body'),
                        ])
                        @include ('admin::components.form.checkbox', [
                            'label' => trans('admin::tasks.completed'),
                            'field' => 'completed',
                            'type' => 'success',
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::tasks.create'),
                            'type' => 'info',
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