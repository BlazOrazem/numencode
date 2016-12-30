@extends('admin::layout')

@section('title')
    @lang('admin::managers.title')
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-8">
            <div class="content-box">
                <div class="head success-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::managers.create')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('managers.store') }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.name'),
                            'field' => 'name',
                            'placeholder' => trans('admin::managers.placeholder.name'),
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::managers.create'),
                        ])
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection