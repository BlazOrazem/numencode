@extends('admin::layout')

@section('title')
    @lang('admin::codelist.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">{{ $codelistItem->title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('codelist.item.update', $codelistItem) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.title'),
                            'field' => 'title',
                            'placeholder' => trans('admin::codelist.placeholder.item_title'),
                            'entity' => $codelistItem,
                            'errors' => $errors->itemErrors,
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.code'),
                            'field' => 'code',
                            'placeholder' => trans('admin::codelist.placeholder.item_code'),
                            'errors' => $errors->itemErrors,
                            'entity' => $codelistItem,
                            'required' => true,
                        ])
                        @include('admin::components.form.order', [
                            'sortOrder' => $codelistItem->sort_order,
                            'errors' => $errors->itemErrors,
                        ])
                        @include('admin::components.form.submit', [
                            'button' => trans('admin::codelist.item_update')
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-info content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">{{ $codelistItem->group->title }} @lang('admin::codelist.items')</h5>
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
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($codelistItem->group->items as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->code }}</td>
                            <td class="text-right">
                                <span class="badge badge-base">
                                    {{ $item->sort_order }}
                                </span>
                            </td>
                            @if($admin->can('manage_codelist'))
                                <td class="text-center">
                                    @include('admin::components.button.edit', [
                                        'action' => route('codelist.item.edit', compact('item'))
                                    ])
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="content-box">
                <div class="content text-center">
                    <a class="btn btn-default btn-link btn-md btn-full" href="{{ route('codelist.edit', $codelistItem->group) }}">
                        <i class="zmdi zmdi-caret-left-circle left"></i>
                        @lang('admin::codelist.index_group')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection