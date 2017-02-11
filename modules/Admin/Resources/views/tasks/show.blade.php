@extends('admin::layout')

@section('title')
    @lang('admin::tasks.title')
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">{{ $task->title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <p>{{ $task->body }}</p>
                </div>
            </div>
        </div>

    </div>

@endsection