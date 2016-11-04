@extends('admin::layout')

@section('title')
    Codelist
@stop

@section('content')

    <div class="row">

        <div class="col-lg-6">
            <div class="data-table data-info content-box" data-id="codelist-groups">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">Codelist groups</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 1, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th class="text-right">Order</th>
                        @if ($admin->can('edit_managers'))
                            <th class="no-sort text-center">Manage</th>
                        @endif
                        @if ($admin->can('delete_managers'))
                            <th class="no-sort text-center">Delete</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($codelistGroups as $group)
                        <tr>
                            <td>{{ $group->title }}</td>
                            <td class="text-right">{{ $group->sort_order }}</td>
                            @if ($admin->can('edit_managers'))
                                <td class="text-center">
                                    @include ('admin::components.edit', [
                                        'action' => route('codelist.edit', compact('group')),
                                        'icon' => 'zmdi-collection-text'
                                    ])
                                </td>
                            @endif
                            @if ($admin->can('delete_managers'))
                                <td class="text-center">
                                    @if (!$group->items->count())
                                        @include ('admin::components.delete', [
                                            'action' => route('codelist.destroy', compact('group'))
                                        ])
                                    @endif
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
                    <h5 class="content-title pull-left">Create new codelist group</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('codelist.store') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="codelistNewTitle" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="codelistNewTitle" placeholder="Enter group title" required>
                                <p class="help-block">{{ $errors->first('title', ':message') }}</p>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('sort_order') ? ' has-error' : '' }}">
                            <label for="codelistNewOrder" class="col-sm-2 control-label">Order</label>
                            <div class="col-sm-10">
                                <input type="text" name="sort_order" value="{{ old('sort_order', $lastOrder) }}" class="form-control" id="codelistNewOrder" placeholder="Set order" required>
                                <p class="help-block">{{ $errors->first('sort_order', ':message') }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-info">{{ trans('admin::messages.codelist.group_create') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop