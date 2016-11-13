@extends('admin::layout')

@section('title')
    Codelist Management
@stop

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="content-box">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">Update group : {{ $codelistGroup->title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('codelist.update', [$codelistGroup]) }}" class="form-inline form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include ('admin::components.form.text', [
                            'label' => 'Title',
                            'field' => 'title',
                            'placeholder' => 'Enter group title',
                            'entity' => $codelistGroup,
                            'errors' => $errors->groupErrors,
                            'inline' => true,
                        ])
                        @include ('admin::components.form.order', [
                            'sortOrder' => $codelistGroup->sort_order,
                            'errors' => $errors->groupErrors,
                            'inline' => true,
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::messages.codelist.group_update'),
                            'type' => 'info',
                            'inline' => true,
                        ])
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-6">
            <div class="data-table data-success content-box" data-id="codelist-items">
                <div class="head success-bg clearfix">
                    <h5 class="content-title pull-left">{{ $codelistGroup->title }} items</h5>
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
                        @if ($admin->can('edit_managers'))
                            <th class="no-sort text-center">{{ trans('admin::tables.edit') }}</th>
                        @endif
                        @if ($admin->can('delete_managers'))
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
                            @if ($admin->can('edit_managers'))
                                <td class="text-center">
                                    @include ('admin::components.button.edit', [
                                        'action' => route('codelist.item.edit', compact('item'))
                                    ])
                                </td>
                            @endif
                            @if ($admin->can('delete_managers'))
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
                <div class="head success-bg clearfix">
                    <h5 class="content-title pull-left">Add new item to {{ $codelistGroup->title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('codelist.item.create', [$codelistGroup]) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        @include ('admin::components.form.text', [
                            'label' => 'Title',
                            'field' => 'title',
                            'placeholder' => 'Enter title',
                            'errors' => $errors->itemErrors,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => 'Code',
                            'field' => 'code',
                            'placeholder' => 'Enter code',
                            'errors' => $errors->itemErrors,
                        ])
                        @include ('admin::components.form.order', [
                            'errors' => $errors->itemErrors,
                            'sortOrder' => $codelistGroup->items->pluck('sort_order')->last() + 10,
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::messages.codelist.item_create'),
                        ])
                    </form>
                </div>
            </div>

            <div class="content-box">
                <div class="content">
                    <a class="btn btn-default btn-link btn-md" href="{{ route('codelist.index') }}">
                        <i class="zmdi zmdi-caret-left-circle left"></i>
                        {{ trans('admin::messages.codelist.index') }}
                    </a>
                </div>
            </div>
        </div>

    </div>

@stop