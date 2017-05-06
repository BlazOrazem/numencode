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
                        <h5 class="content-title pull-left">@lang('admin::pages.create.page') {{ $page->title }}</h5>
                    @endif
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('pages.store') }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        @if(isset($pages))
                            <input type="hidden" name="menu" value="{{ $menu->code }}">
                            <div class="form-group">
                                <label for="parentPageID" class="control-label col-sm-3">
                                    @lang('admin::pages.parent')
                                </label>
                                <div class="col-sm-9">
                                    <select name="parent_id"
                                            id="parentPageID"
                                            class="form-control selectpicker"
                                            data-style="btn-info"
                                            >
                                        <option value="">@lang('admin::pages.placeholder.parent')</option>
                                        @include('admin::pages.tree.option-list', [
                                            'pageCollection' => $pages['root'],
                                            'pageStructure' => $pages,
                                            'level' => 1,
                                        ])
                                    </select>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="menu" value="{{ $page->menu }}">
                            <input type="hidden" name="parent_id" value="{{ $page->id }}">
                        @endif
                        @include('admin::components.form.select', [
                            'label' => trans('admin::pages.layout'),
                            'field' => 'layout',
                            'data' => $layouts,
                            'params' => ['code', 'title'],
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::pages.name'),
                            'field' => 'title',
                            'placeholder' => trans('admin::pages.placeholder.title'),
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::pages.lead'),
                            'field' => 'lead',
                            'placeholder' => trans('admin::pages.placeholder.lead'),
                        ])

                        <div class="form-group">
                            <label class="control-label col-sm-3">
                                @lang('admin::pages.body')
                            </label>
                            <div class="col-sm-9">
                                <textarea name="body" class="wysiwyg-editor">{{ old('body') }}</textarea>
                            </div>
                        </div>

                        @include('admin::components.form.order', [
                            'sortOrder' => (isset($page) ? $page->items->max('sort_order') : $pages['root']->max('sort_order')) + 10,
                        ])
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="submit" value="save" class="btn btn-md btn-success submit">
                                    @lang('admin::forms.buttons.save')
                                </button>
                                <button type="submit" class="btn btn-md btn-info submit">
                                    @lang('admin::forms.buttons.return')
                                </button>
                                <a href="{{ route('pages.index') }}" class="btn btn-md btn-default btn-link">
                                    @lang('admin::forms.buttons.cancel')
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection