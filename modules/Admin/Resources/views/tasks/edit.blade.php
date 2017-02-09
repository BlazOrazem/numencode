@extends('admin::layout')

@section('title')
    @lang('admin::tasks.title')
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <div class="content-box">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::tasks.update'): {{ $task->name }}</h5>

                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('tasks.update', [$task]) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::tasks.name'),
                            'field' => 'title',
                            'placeholder' => trans('admin::tasks.placeholder.title'),
                            'entity' => $task,
                            'required' => true,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::tasks.body'),
                            'field' => 'body',
                            'placeholder' => trans('admin::tasks.placeholder.body'),
                            'entity' => $task,
                            'required' => true,
                        ])
                        @include ('admin::components.form.checkbox', [
                            'label' => trans('admin::tasks.completed'),
                            'field' => 'completed',
                            'type' => 'success',
                            'isChecked' => $task->completed,
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::tasks.update'),
                            'type' => 'info',
                        ])
                    </form>
                </div>
            </div>
            <div class="content-box">
                <div class="content text-center">
                    <a class="btn btn-default btn-link btn-md btn-full" href="{{ route('tasks.index') }}">
                        <i class="zmdi zmdi-caret-left-circle left"></i>
                        @lang('admin::tasks.index')
                    </a>
                </div>
            </div>
        </div>

    </div>

@endsection