@extends('admin::layout')

@section('title')
    @lang('admin::promotion.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">
                        {{ $promotionCategory->id ? trans('admin::promotion.new_item_to') : trans('admin::promotion.new_item') }} {{ $promotionCategory->title }}
                    </h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST"
                          action="{{ route('promotion.item.store') }}"
                          class="form-horizontal form-validate"
                          enctype="multipart/form-data"
                            >
                        {{ csrf_field() }}
                        @if($promotionCategory->id)
                            <input type="hidden" name="promotion_category_id" value="{{ $promotionCategory->id }}">
                        @else
                            <div class="form-group has-icon">
                                <label for="categoryID" class="control-label col-sm-3">
                                    @lang('admin::promotion.category')
                                </label>
                                <div class="col-sm-9">
                                    <select name="promotion_category_id"
                                            id="categoryID"
                                            class="form-control selectpicker"
                                            data-style="btn-info"
                                            >
                                        <option value="">@lang('admin::forms.select')</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="zmdi zmdi-star-outline f-s-18 form-icon"></span>
                                </div>
                            </div>
                        @endif
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.title'),
                            'field' => 'title',
                            'placeholder' => trans('admin::promotion.placeholder.item_title'),
                            'errors' => $errors->itemErrors,
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.lead'),
                            'field' => 'lead',
                            'placeholder' => trans('admin::promotion.placeholder.item_lead'),
                            'errors' => $errors->itemErrors,
                        ])
                        <div class="form-group">
                            <label class="control-label col-sm-3">
                                @lang('admin::forms.description')
                            </label>
                            <div class="col-sm-9">
                                <textarea name="body" class="wysiwyg-editor">{{ old('body') }}</textarea>
                            </div>
                        </div>
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.redirect'),
                            'field' => 'link',
                            'placeholder' => trans('admin::promotion.placeholder.item_link'),
                            'errors' => $errors->itemErrors,
                        ])
                        @include('admin::components.form.picture', [
                            'label' => trans('admin::forms.picture'),
                            'field' => 'picture',
                            'errors' => $errors->itemErrors,
                        ])
                        @include('admin::components.form.order', [
                            'sortOrder' => ($promotionCategory->id ? $promotionCategory->items->max('sort_order') : 0) + 10,
                            'errors' => $errors->itemErrors,
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