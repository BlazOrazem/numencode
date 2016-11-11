@extends('admin::layout')

@section('title')
    Codelist
@stop

@section('content')

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
                <div class="head warning-bg clearfix">
                    <h5 class="content-title pull-left">Edit {{ $codelistItem->title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('codelist.item.update', [$codelistItem]) }}" class="form-horizontal">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="itemUpdateTitle" class="col-sm-2 control-label">{{ trans('admin::forms.title') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="{{ old('title', $codelistItem->title) }}" class="form-control" id="itemUpdateTitle" placeholder="Enter title" required>
                                <p class="help-block">{{ $errors->first('title', ':message') }}</p>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="itemUpdateCode" class="col-sm-2 control-label">{{ trans('admin::forms.code') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="code" value="{{ old('code', $codelistItem->code) }}" class="form-control" id="itemUpdateCode" placeholder="Enter code" required>
                                <p class="help-block">{{ $errors->first('code', ':message') }}</p>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('sort_order') ? ' has-error' : '' }}">
                            <label for="itemUpdateOrder" class="col-sm-2 control-label">{{ trans('admin::forms.order') }}</label>
                            <div class="col-sm-10">
                                <input type="text" name="sort_order" value="{{ old('sort_order', $codelistItem->sort_order) }}" class="form-control" id="itemUpdateOrder" placeholder="Set order" required>
                                <p class="help-block">{{ $errors->first('sort_order', ':message') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-md btn-warning">{{ trans('admin::messages.codelist.item_update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="content-box">
                <div class="content">
                    <a class="btn btn-default btn-link btn-md" href="{{ route('codelist.edit', $codelistGroup) }}">
                        <i class="zmdi zmdi-caret-left-circle left"></i>
                        {{ trans('admin::messages.codelist.index_group') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@stop