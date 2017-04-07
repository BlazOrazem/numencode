@extends('admin::layout')

@section('title')
    @lang('admin::users.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-base content-box" data-id="user-list">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::users.title')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table data-search="Search" class="display datatable search paginate middle-align datatable-striped table" data-order='[[ 1, "asc" ]]'>
                    <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th>@lang('admin::users.name')</th>
                        <th>@lang('admin::users.nickname')</th>
                        <th>@lang('admin::users.email')</th>
                        <th class="no-sort text-right">@lang('admin::users.is_verified')</th>
                        <th>@lang('admin::tables.created')</th>
                        @if($admin->can('manage_users'))
                            <th width="60" class="no-sort text-center">@lang('admin::tables.edit')</th>
                            <th width="60" class="no-sort text-center">@lang('admin::tables.delete')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center">
                                <img src="{{ $user->avatar }}" width="50" height="50" class="img-circle">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->nickname }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-right">
                                <label>
                                    <input class="toggle toggle-base"
                                           type="checkbox"
                                           name="toggle"
                                           disabled
                                            {{ $user->is_verified ? 'checked' : '' }}
                                            >
                                    <i></i>
                                </label>
                            </td>
                            <td>{{ $user->created_at->format(config('numencode.dates.date')) }}</td>
                            @if($admin->can('manage_users'))
                                <td class="text-center">
                                    @include('admin::components.button.edit', [
                                        'action' => route('users.edit', compact('user')),
                                    ])
                                </td>
                                <td class="text-center">
                                    @include('admin::components.button.delete', [
                                        'action' => route('users.destroy', compact('user'))
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

@endsection