@extends('admin::layout')

@section('title')
    {{ trans('admin::codelist.title') }}
@stop

@section('content')

    <div class="row">

        <div class="col-lg-6">
            <div class="data-table data-success content-box" data-id="codelist-items">
                <div class="head success-bg clearfix">
                    <h5 class="content-title pull-left">{{ $codelistGroup->title }} {{ trans('admin::codelist.items') }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 2, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>{{ trans('admin::tables.title') }}</th>
                        <th>{{ trans('admin::tables.code') }}</th>
                        <th>{{ trans('admin::tables.order') }}</th>
                        @if ($admin->can('edit_codelist'))
                            <th class="no-sort text-center">{{ trans('admin::tables.edit') }}</th>
                        @endif
                        @if ($admin->can('delete_codelist'))
                            <th class="no-sort text-center">{{ trans('admin::tables.delete') }}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($codelistGroup->items as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->code }}</td>
                            <td class="text-right">{{ $item->sort_order }}</td>
                            @if ($admin->can('edit_codelist'))
                                <td class="text-center">
                                    @include ('admin::components.button.edit', [
                                        'action' => route('codelist.item.edit', compact('item'))
                                    ])
                                </td>
                            @endif
                            @if ($admin->can('delete_codelist'))
                                <td class="text-center">
                                    @include ('admin::components.button.delete', [
                                        'action' => route('codelist.item.destroy', compact('item'))
                                    ])
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="content-box">
                <div class="head warning-bg clearfix">
                    <h5 class="content-title pull-left">{{ $codelistItem->title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('codelist.item.update', [$codelistItem]) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.title'),
                            'field' => 'title',
                            'placeholder' => trans('admin::codelist.placeholder.item_title'),
                            'entity' => $codelistItem,
                            'errors' => $errors->itemErrors,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.code'),
                            'field' => 'code',
                            'placeholder' => trans('admin::codelist.placeholder.item_code'),
                            'errors' => $errors->itemErrors,
                            'entity' => $codelistItem,
                        ])
                        @include ('admin::components.form.order', [
                            'sortOrder' => $codelistItem->sort_order,
                            'errors' => $errors->itemErrors,
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::codelist.item_update'),
                            'type' => 'warning',
                        ])
                    </form>
                </div>
            </div>
            <div class="content-box">
                <div class="content">
                    <a class="btn btn-default btn-link btn-md" href="{{ route('codelist.edit', $codelistGroup) }}">
                        <i class="zmdi zmdi-caret-left-circle left"></i>
                        {{ trans('admin::codelist.index_group') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@stop