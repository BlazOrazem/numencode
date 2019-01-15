@extends('admin::layout')

@section('title')
    @lang('admin::blog.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::blog.update_category') {{ $blogCategory->title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('blog.update', $blogCategory) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.title'),
                            'field' => 'title',
                            'placeholder' => trans('admin::blog.placeholder.category_title'),
                            'entity' => $blogCategory,
                            'errors' => $errors->categoryErrors,
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.lead'),
                            'field' => 'lead',
                            'placeholder' => trans('admin::blog.placeholder.category_lead'),
                            'entity' => $blogCategory,
                            'errors' => $errors->categoryErrors,
                        ])
                        <div class="form-group">
                            <label class="control-label col-sm-3">
                                @lang('admin::forms.description')
                            </label>
                            <div class="col-sm-9">
                                <textarea name="body" class="wysiwyg-editor">{{ old('body', $blogCategory->body) }}</textarea>
                            </div>
                        </div>
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.url'),
                            'field' => 'link',
                            'entity' => $blogCategory,
                        ])
                        @include('admin::components.form.order', [
                            'sortOrder' => $blogCategory->sort_order,
                            'errors' => $errors->categoryErrors,
                        ])
                        @include('admin::components.form.save', ['cancel' => route('blog.index')])
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection