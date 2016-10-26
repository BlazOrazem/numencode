@extends('admin::layout')

@section('title')
    Codelist
@stop

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="data-info" data-id="codelist-groups">
                <table data-title="Codelist groups" class="display datatable middle-align datatable-striped table" data-order='[[ 1, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th class="text-right">Order</th>
                        @if ($admin->can('edit_managers'))
                            <th class="no-sort text-center" width="50">Edit</th>
                        @endif
                        @if ($admin->can('delete_managers'))
                            <th class="no-sort text-center" width="50">Delete</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($codelistGroups as $group)
                        <tr>
                            <td>{{ $group->title }}</td>
                            <td class="text-right">{{ $group->ord }}</td>
                            @if ($admin->can('edit_managers'))
                                <td class="text-center">
                                    <a href="{{ route('codelist.edit', [$group]) }}">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>
                                </td>
                            @endif
                            @if ($admin->can('delete_managers'))
                                <td class="text-center">
                                    <form method="POST" action="{{ route('codelist.destroy', [$group]) }}" >
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-confirmation">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </form>
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
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="codelistNewTitle" placeholder="Enter group title">
                                <p class="help-block">{{ $errors->first('title', ':message') }}</p>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                            <label for="codelistNewOrder" class="col-sm-2 control-label">Order</label>
                            <div class="col-sm-10">
                                <input type="text" name="ord" value="{{ old('order', $lastOrder) }}" class="form-control" id="codelistNewOrder" placeholder="Set order">
                                {{ $errors->first('order', ':message') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-info">{{ trans('admin::messages.tasks.submit_create') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop