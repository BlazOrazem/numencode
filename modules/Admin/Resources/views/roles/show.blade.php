@extends('admin::layout')

@section('title')
    @lang('admin::roles.title')
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-6">
            <div class="data-table data-info content-box">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::roles.roles')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 2, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>@lang('admin::tables.name')</th>
                        <th>@lang('admin::tables.label')</th>
                        <th>@lang('admin::tables.order')</th>
                        <th>Admin?</th>
                        <th>Permissions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->label }}</td>
                            <td class="text-right">
                                <span class="badge badge-info">
                                    {{ $item->sort_order }}
                                </span>
                            </td>
                            <td class="text-center text-success">
                                @if($item->is_admin)
                                    <button type="submit" class="btn btn-success">
                                        <i class="zmdi zmdi-shield-check"></i>
                                    </button>
                                @endif
                            </td>
                            <td class="text-center">
                                @include('admin::components.button.edit', [
                                    'action' => route('roles.show', compact('item')),
                                    'icon' => 'zmdi-collection-text'
                                ])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="data-table data-danger content-box">
                <div class="head danger-bg clearfix">
                    <h5 class="content-title pull-left">Permissions for: {{ $role->name }}</h5>

                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 0, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>Permission</th>
                        <th class="no-sort text-right">Assigned?</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $item)
                        <tr>
                            <td>{{ $item->label }}</td>
                            <td class="text-right">
                                <label>
                                    <input class="toggle toggle-danger"
                                           type="checkbox"
                                            @if($admin->can('assign_permissions'))
                                                name="toggle"
                                                data-toggle="{{ route('roles.assign.permissions', [$role->id, $item->id]) }}"
                                            @else
                                                disabled
                                            @endif
                                            {{ in_array($item->id, $role->permissions()->pluck('id')->toArray()) ? 'checked' : '' }}
                                            >
                                    <i></i>
                                </label>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection