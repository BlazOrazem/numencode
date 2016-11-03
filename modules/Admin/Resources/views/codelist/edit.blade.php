@extends('admin::layout')

@section('title')
    Codelist
@stop

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="data-info" data-id="codelist-items">
                <table data-title="{{ $codelistGroup->title }} items" class="display datatable middle-align datatable-striped table" data-order='[[ 2, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Code</th>
                        <th class="text-right">Order</th>
                        @if ($admin->can('edit_managers'))
                            <th class="no-sort text-center">Edit</th>
                        @endif
                        @if ($admin->can('delete_managers'))
                            <th class="no-sort text-center">Delete</th>
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
                    <h5 class="content-title pull-left">Update {{ $codelistGroup->title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('codelist.update', [$codelistGroup]) }}" class="form-horizontal">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <div class="form-group{{ $errors->groupErrors->has('title') ? ' has-error' : '' }}">
                            <label for="codelistEditTitle" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="{{ old('title', $codelistGroup->title) }}" class="form-control" id="codelistEditTitle" placeholder="Enter group title" required>
                                <p class="help-block">{{ $errors->groupErrors->first('title', ':message') }}</p>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->groupErrors->has('sort_order') ? ' has-error' : '' }}">
                            <label for="codelistEditOrder" class="col-sm-2 control-label">Order</label>
                            <div class="col-sm-10">
                                <input type="text" name="sort_order" value="{{ old('sort_order', $codelistGroup->sort_order) }}" class="form-control" id="codelistEditOrder" placeholder="Set order" required>
                                <p class="help-block">{{ $errors->groupErrors->first('sort_order', ':message') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <div class="btn-toolbar">
                                    <button type="submit" class="btn btn-info">{{ trans('admin::messages.codelist.group_update') }}</button>
                                    <a class="btn btn-default btn-link pull-right" href="{{ route('codelist.index') }}">{{ trans('admin::messages.codelist.index') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="content-box">
                <div class="head warning-bg clearfix">
                    <h5 class="content-title pull-left">Add new item</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('codelist.item.create', [$codelistGroup]) }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->itemErrors->has('title') ? ' has-error' : '' }}">
                            <label for="itemNewTitle" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="itemNewTitle" placeholder="Enter title" required>
                                <p class="help-block">{{ $errors->itemErrors->first('title', ':message') }}</p>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->itemErrors->has('code') ? ' has-error' : '' }}">
                            <label for="itemNewCode" class="col-sm-2 control-label">Code</label>
                            <div class="col-sm-10">
                                <input type="text" name="code" value="{{ old('code') }}" class="form-control" id="itemNewCode" placeholder="Enter code" required>
                                <p class="help-block">{{ $errors->itemErrors->first('code', ':message') }}</p>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->itemErrors->has('sort_order') ? ' has-error' : '' }}">
                            <label for="itemNewOrder" class="col-sm-2 control-label">Order</label>
                            <div class="col-sm-10">
                                <input type="text" name="sort_order" value="{{ old('sort_order', $codelistGroup->items->pluck('sort_order')->last() + 10) }}" class="form-control" id="itemNewOrder" placeholder="Set order" required>
                                <p class="help-block">{{ $errors->itemErrors->first('sort_order', ':message') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <div class="btn-toolbar">
                                    <button type="submit" class="btn btn-info">{{ trans('admin::messages.codelist.item_create') }}</button>
                                    <a class="btn btn-default btn-link pull-right" href="{{ route('codelist.index') }}">{{ trans('admin::messages.codelist.index') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop