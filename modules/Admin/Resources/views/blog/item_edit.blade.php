@extends('admin::layout')

@section('title')
    @lang('admin::blog.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">{{ $blogItem->title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('blog.item.update', $blogItem) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <div class="form-group has-icon">
                            <label for="categoryID" class="control-label col-sm-3">
                                @lang('admin::blog.category')
                            </label>
                            <div class="col-sm-9">
                                <select name="blog_category_id"
                                        id="categoryID"
                                        class="form-control selectpicker"
                                        data-style="btn-info"
                                        >
                                    <option value="">@lang('admin::forms.select')</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if($category->id == $blogItem->blog_category_id)
                                                selected
                                            @endif
                                            >{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                <span class="zmdi zmdi-star-outline f-s-18 form-icon"></span>
                            </div>
                        </div>
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.title'),
                            'field' => 'title',
                            'placeholder' => trans('admin::blog.placeholder.item_title'),
                            'errors' => $errors->itemErrors,
                            'entity' => $blogItem,
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.lead'),
                            'field' => 'lead',
                            'placeholder' => trans('admin::blog.placeholder.item_lead'),
                            'errors' => $errors->itemErrors,
                            'entity' => $blogItem,
                        ])
                        <div class="form-group">
                            <label class="control-label col-sm-3">
                                @lang('admin::forms.description')
                            </label>
                            <div class="col-sm-9">
                                <textarea name="body" class="wysiwyg-editor">{{ old('body', $blogItem->body) }}</textarea>
                            </div>
                        </div>
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.url'),
                            'field' => 'link',
                            'entity' => $blogItem,
                        ])
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="submit" value="save" class="btn btn-md btn-success submit">
                                    @lang('admin::forms.buttons.save')
                                </button>
                                <button type="submit" class="btn btn-md btn-info submit">
                                    @lang('admin::forms.buttons.return')
                                </button>
                                <a href="{{ route('blog.index') }}" class="btn btn-md btn-default btn-link">
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