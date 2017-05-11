@extends('admin::layout')

@section('title')
    @lang('admin::codelist.title')
@endsection

@section('content')

    @if($admin->can('manage_codelist'))
        <div class="row">
            <div class="col-md-12">
                <div class="content-box">
                    <div class="head base-bg clearfix">
                        <h5 class="content-title pull-left">@lang('admin::codelist.update_group') {{ $codelistGroup->title }}</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        </div>
                    </div>
                    <div class="content">
                        <form method="POST" action="{{ route('codelist.update', $codelistGroup) }}" class="form-inline form-validate">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            @include('admin::components.form.text', [
                                'label' => trans('admin::forms.code'),
                                'field' => 'code',
                                'placeholder' => trans('admin::codelist.placeholder.group_code'),
                                'class' => 'snake-slug',
                                'entity' => $codelistGroup,
                                'errors' => $errors->groupErrors,
                                'inline' => true,
                                'required' => true,
                            ])
                            @include('admin::components.form.text', [
                                'label' => trans('admin::forms.title'),
                                'field' => 'title',
                                'placeholder' => trans('admin::codelist.placeholder.group_title'),
                                'entity' => $codelistGroup,
                                'errors' => $errors->groupErrors,
                                'inline' => true,
                                'required' => true,
                            ])
                            @include('admin::components.form.order', [
                                'sortOrder' => $codelistGroup->sort_order,
                                'errors' => $errors->groupErrors,
                                'inline' => true,
                            ])
                            @include('admin::components.form.submit', [
                                'button' => trans('admin::codelist.group_update'),
                                'inline' => true,
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-info content-box" data-id="codelist-items">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">{{ $codelistGroup->title }} @lang('admin::codelist.items')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 2, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>@lang('admin::tables.title')</th>
                        <th>@lang('admin::tables.code')</th>
                        <th width="60" class="text-right">@lang('admin::tables.order')</th>
                        @if($admin->can('manage_codelist'))
                            <th width="60" class="no-sort text-center">@lang('admin::tables.edit')</th>
                            <th width="60" class="no-sort text-center">@lang('admin::tables.delete')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($codelistGroup->items as $codelistItem)
                        <tr>
                            <td>{{ $codelistItem->title }}</td>
                            <td>{{ $codelistItem->code }}</td>
                            <td class="text-right">
                                <span class="badge badge-base">
                                    {{ $codelistItem->sort_order }}
                                </span>
                            </td>
                            @if($admin->can('manage_codelist'))
                                <td class="text-center">
                                    @include('admin::components.button.edit', [
                                        'action' => route('codelist.item.edit', $codelistItem)
                                    ])
                                </td>
                                <td class="text-center">
                                    @include('admin::components.button.delete', [
                                        'action' => route('codelist.item.destroy', $codelistItem)
                                    ])
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($admin->can('manage_codelist'))
        <div class="row">
            <div class="col-lg-12">
                <div class="content-box">
                    <div class="head base-bg clearfix">
                        <h5 class="content-title pull-left">@lang('admin::codelist.new_item') {{ $codelistGroup->title }}</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        </div>
                    </div>
                    <div class="content">
                        <form method="POST" action="{{ route('codelist.item.create', $codelistGroup) }}" class="form-horizontal form-validate">
                            {{ csrf_field() }}
                            @include('admin::components.form.text', [
                                'label' => trans('admin::forms.title'),
                                'field' => 'title',
                                'placeholder' => trans('admin::codelist.placeholder.item_title'),
                                'errors' => $errors->itemErrors,
                                'required' => true,
                            ])
                            @include('admin::components.form.text', [
                                'label' => trans('admin::forms.code'),
                                'field' => 'code',
                                'placeholder' => trans('admin::codelist.placeholder.item_code'),
                                'errors' => $errors->itemErrors,
                                'required' => true,
                            ])
                            @include('admin::components.form.order', [
                                'sortOrder' => $codelistGroup->items->max('sort_order') + 10,
                                'errors' => $errors->itemErrors,
                            ])
                            @include('admin::components.form.submit', [
                                'button' => trans('admin::codelist.item_create'),
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="content-box">
            <div class="content text-center">
                <a class="btn btn-default btn-link btn-md btn-full" href="{{ route('codelist.index') }}">
                    <i class="zmdi zmdi-caret-left-circle left"></i>
                    @lang('admin::codelist.index')
                </a>
            </div>
        </div>
    </div>

@endsection