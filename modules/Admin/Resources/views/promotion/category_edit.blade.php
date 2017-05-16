@extends('admin::layout')

@section('title')
    @lang('admin::promotion.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::promotion.update_category') {{ $promotionCategory->title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('promotion.update', $promotionCategory) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.title'),
                            'field' => 'title',
                            'placeholder' => trans('admin::promotion.placeholder.category_title'),
                            'entity' => $promotionCategory,
                            'errors' => $errors->categoryErrors,
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.lead'),
                            'field' => 'lead',
                            'placeholder' => trans('admin::promotion.placeholder.category_lead'),
                            'entity' => $promotionCategory,
                            'errors' => $errors->categoryErrors,
                        ])
                        <div class="form-group">
                            <label class="control-label col-sm-3">
                                @lang('admin::forms.description')
                            </label>
                            <div class="col-sm-9">
                                <textarea name="body" class="wysiwyg-editor">{{ old('body', $promotionCategory->body) }}</textarea>
                            </div>
                        </div>
                        @include('admin::components.form.order', [
                            'sortOrder' => $promotionCategory->sort_order,
                            'errors' => $errors->categoryErrors,
                        ])
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="submit" value="save" class="btn btn-md btn-success submit">
                                    @lang('admin::forms.buttons.save')
                                </button>
                                <button type="submit" class="btn btn-md btn-info submit">
                                    @lang('admin::forms.buttons.return')
                                </button>
                                <a href="{{ route('promotion.index') }}" class="btn btn-md btn-default btn-link">
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