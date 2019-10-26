@extends('admin::layout')

@section('title')
    @lang('admin::pages.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::pages.update') {{ $page->title }} on {{ $page->menu_title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('pages.update', compact('page')) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
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
                                        'selected' => $page->parent_id,
                                        'level' => 1,
                                    ])
                                </select>
                            </div>
                        </div>
                        @include('admin::components.form.select', [
                            'label' => trans('admin::pages.layout'),
                            'field' => 'layout',
                            'data' => $layouts,
                            'selected' => $page->layout,
                            'params' => ['code', 'title'],
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

                        <div class="form-group">
                            <label class="control-label col-sm-3">
                                @lang('admin::pages.body')
                            </label>
                            <div class="col-sm-9">
                                <textarea name="body" class="wysiwyg-editor">{{ old('body', $page->body) }}</textarea>
                            </div>
                        </div>

                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.url'),
                            'field' => 'link',
                            'entity' => $page,
                        ])
                        @include('admin::components.form.order', [
                            'sortOrder' => $page->sort_order,
                        ])
                        @include('admin::components.form.save', ['cancel' => route('pages.index')])
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-info content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::pages.contents')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 1, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>@lang('admin::tables.title')</th>
                        <th width="60" class="text-right">@lang('admin::tables.order')</th>
                        <th width="60" class="no-sort text-center">@lang('admin::tables.edit')</th>
                        <th width="60" class="no-sort text-center">@lang('admin::tables.delete')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($page->contents as $content)
                        <tr>
                            <td>{{ $content->title }}</td>
                            <td class="text-right">
                                <span class="badge badge-base">
                                    {{ $content->sort_order }}
                                </span>
                            </td>
                            <td class="text-center">
                                @include('admin::components.button.edit', [
                                    'action' => route('contents.edit', compact('content')),
                                ])
                            </td>
                            <td class="text-center">
                                @include('admin::components.button.delete', [
                                    'action' => route('contents.destroy', compact('content')),
                                ])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('contents.create', compact('page')) }}" class="btn btn-md btn-success">Create new content</a>
            <br /><br />
        </div>
    </div>

@endsection
