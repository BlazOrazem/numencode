@extends('admin::layout')

@section('title')
    Codelist
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
                    <form method="POST" action="{{ route('codelist.update', [$codelistGroup]) }}" class="form-inline">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <div class="form-group{{ $errors->groupErrors->has('title') ? ' has-error' : '' }}">
                            <label for="codelistEditTitle" class="control-label">Title</label>
                            <input type="text" name="title" value="{{ old('title', $codelistGroup->title) }}" class="form-control" id="codelistEditTitle" placeholder="Enter group title" required>
                            <span class="help-block">{{ $errors->groupErrors->first('title', ':message') }}</span>
                        </div>
                        <div class="form-group{{ $errors->groupErrors->has('sort_order') ? ' has-error' : '' }}">
                            <label for="codelistEditOrder" class="control-label">Order</label>
                            <input type="text" name="sort_order" value="{{ old('sort_order', $codelistGroup->sort_order) }}" class="form-control" id="codelistEditOrder" placeholder="Set order" required>
                            <span class="help-block">{{ $errors->groupErrors->first('sort_order', ':message') }}</span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-md btn-info">{{ trans('admin::messages.codelist.group_update') }}</button>
                            <span class="help-block"></span>
                        </div>
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
                        <th class="text-right">{{ trans('admin::tables.order') }}</th>
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
                                    @include ('admin::components.edit', [
                                        'action' => route('codelist.item.edit', compact('item'))
                                    ])
                                </td>
                            @endif
                            @if ($admin->can('delete_managers'))
                                <td class="text-center">
                                    @include ('admin::components.delete', [
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
                    <form method="POST" action="{{ route('codelist.item.create', [$codelistGroup]) }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->itemErrors->has('title') ? ' has-error' : '' }}">
                            <label for="itemNewTitle" class="col-sm-2 control-label">{{ trans('admin::forms.title') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="itemNewTitle" placeholder="Enter title">
                                <span class="help-block">{{ $errors->itemErrors->first('title', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->itemErrors->has('code') ? ' has-error' : '' }}">
                            <label for="itemNewCode" class="col-sm-2 control-label">{{ trans('admin::forms.code') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="code" value="{{ old('code') }}" class="form-control" id="itemNewCode" placeholder="Enter code">
                                <span class="help-block">{{ $errors->itemErrors->first('code', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->itemErrors->has('sort_order') ? ' has-error' : '' }}">
                            <label for="itemNewOrder" class="col-sm-2 control-label">{{ trans('admin::forms.order') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="sort_order" value="{{ old('sort_order', $codelistGroup->items->pluck('sort_order')->last() + 10) }}" class="form-control" id="itemNewOrder" placeholder="Set order">
                                <p class="help-block">{{ $errors->itemErrors->first('sort_order', ':message') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-md btn-success">{{ trans('admin::messages.codelist.item_create') }}</button>
                            </div>
                        </div>
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