@extends('admin::layout')

@section('title')
    @lang('admin::pages.title')
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    @if(isset($pages))
                        <h5 class="content-title pull-left">@lang('admin::pages.create.menu') {{ $menu->title }}</h5>
                    @else
                        <h5 class="content-title pull-left">@lang('admin::pages.update') {{ $page->title }}</h5>
                    @endif
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('pages.store') }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{--@if(isset($pages))--}}
                            {{--<input type="hidden" name="menu" value="{{ $menu->code }}">--}}
                            {{--@include('admin::components.form.select', [--}}
                                {{--'label' => trans('admin::pages.parent'),--}}
                                {{--'field' => 'parent_id',--}}
                                {{--'placeholder' => trans('admin::pages.placeholder.parent'),--}}
                                {{--'data' => $pages,--}}
                                {{--'required' => true,--}}
                            {{--])--}}
                        {{--@else--}}
                            {{--<input type="hidden" name="menu" value="{{ $page->menu }}">--}}
                            {{--<input type="hidden" name="parent_id" value="{{ $page->id }}">--}}
                        {{--@endif--}}
                        @include('admin::components.form.select', [
                            'label' => trans('admin::pages.layout'),
                            'field' => 'layout',
                            'placeholder' => trans('admin::pages.placeholder.layout'),
                            'data' => $layouts,
                            'params' => ['code', 'title'],
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::pages.name'),
                            'field' => 'title',
                            'entity' => $page,
                            'placeholder' => trans('admin::pages.placeholder.title'),
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::pages.lead'),
                            'field' => 'lead',
                            'entity' => $page,
                            'placeholder' => trans('admin::pages.placeholder.lead'),
                        ])
                        @include('admin::components.form.textarea', [
                            'label' => trans('admin::pages.body'),
                            'field' => 'body',
                            'entity' => $page,
                            'placeholder' => trans('admin::pages.placeholder.body'),
                        ])
                        @include('admin::components.form.order', [
                            'sortOrder' => $page->sort_order,
                        ])
                        @include('admin::components.form.submit', [
                            'button'  => trans('admin::pages.submit.save'),
                            'subject' => 'save'
                        ])
                        @include('admin::components.form.submit', [
                            'button'  => trans('admin::pages.submit.return'),
                            'subject' => 'return'
                        ])
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection