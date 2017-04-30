@extends('admin::layout')

@section('title')
    @lang('admin::languages.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::languages.title')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>

                <div class="content">
                    <div class="m-b-20">
                        <ul class="nav nav-tabs">
                            @foreach($languages as $language)
                                <li @if ($loop->first) class="active" @endif>
                                    <a href="#language-{{ $language->locale }}" data-toggle="tab">
                                        {{ $language->locale }}
                                    </a>
                                </li>
                            @endforeach
                            <li><a href="#language-add" data-toggle="tab">@lang('admin::dictionary.add')</a></li>
                        </ul>
                        <div class="tab-content">
                            @foreach($languages as $language)
                            <div class="tab-pane fade @if ($loop->first) in active @endif" id="language-{{ $language->locale }}">
                                <form method="POST" action="{{ route('languages.update', [$language]) }}" class="form-horizontal form-validate">
                                    {{ csrf_field() }}
                                    {{ method_field('patch') }}
                                    @include('admin::components.form.text', [
                                        'label' => trans('admin::languages.locale'),
                                        'field' => 'locale',
                                        'placeholder' => trans('admin::languages.placeholder.locale'),
                                        'entity' => $language,
                                        'required' => true,
                                    ])
                                    @include('admin::components.form.text', [
                                        'label' => trans('admin::languages.label'),
                                        'field' => 'label',
                                        'placeholder' => trans('admin::languages.placeholder.label'),
                                        'entity' => $language,
                                        'required' => true,
                                    ])
                                    @include('admin::components.form.order', [
                                        'sortOrder' => $language->sort_order
                                    ])
                                    @include('admin::components.form.checkbox', [
                                        'label' => 'Is default?',
                                        'field' => 'is_default',
                                        'checked' => $language->is_default,
                                    ])
                                    @include('admin::components.form.checkbox', [
                                        'label' => 'Is hidden?',
                                        'field' => 'is_hidden',
                                        'type' => 'warning',
                                        'checked' => $language->is_hidden,
                                    ])
                                    <div class="form-group">
                                        <div class="col-sm-9 col-sm-offset-3">
                                            <button type="submit" class="btn btn-md btn-success submit">
                                                @lang('admin::languages.update')
                                            </button>
                                            <form method="POST" action="{{ route('languages.destroy', compact('language')) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-md btn-danger submit btn-confirmation">
                                                    @lang('admin::languages.delete')
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endforeach
                            <div class="tab-pane fade" id="language-add">
                                <form method="POST" action="{{ route('languages.store') }}" class="form-horizontal form-validate">
                                    {{ csrf_field() }}
                                    @include('admin::components.form.text', [
                                        'label' => trans('admin::languages.locale'),
                                        'field' => 'locale',
                                        'placeholder' => trans('admin::languages.placeholder.locale'),
                                        'required' => true,
                                    ])
                                    @include('admin::components.form.text', [
                                        'label' => trans('admin::languages.label'),
                                        'field' => 'label',
                                        'placeholder' => trans('admin::languages.placeholder.label'),
                                        'required' => true,
                                    ])
                                    @include('admin::components.form.order', [
                                        'sortOrder' => $languages->max('sort_order') + 10,
                                    ])
                                    @include('admin::components.form.checkbox', [
                                        'label' => 'Is default?',
                                        'field' => 'is_default',
                                    ])
                                    @include('admin::components.form.checkbox', [
                                        'label' => 'Is hidden?',
                                        'field' => 'is_hidden',
                                        'type' => 'warning',
                                    ])
                                    @include('admin::components.form.submit', [
                                        'button' => trans('admin::languages.create')
                                    ])
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection