@extends('admin::layout')

@section('title')
    @lang('admin::managers.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-info content-box" data-id="manager-list">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::managers.title')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table data-search="Search" class="display datatable search paginate middle-align datatable-striped table" data-order='[[ 1, "asc" ]]'>
                    <thead>
                    <tr>
                        <th class="no-sort"></th>
                        <th>@lang('admin::managers.name')</th>
                        <th>@lang('admin::managers.email')</th>
                        <th>@lang('admin::managers.phone')</th>
                        <th>@lang('admin::tables.created')</th>
                        @if ($admin->can('edit_managers'))
                            <th class="no-sort text-center">@lang('admin::tables.edit')</th>
                        @endif
                        @if ($admin->can('delete_managers'))
                            <th class="no-sort text-center">@lang('admin::tables.delete')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($managers as $manager)
                        <tr>
                            <td class="text-center">
                                <img src="{{ $manager->avatar }}" width="50" height="50" class="img-circle">
                            </td>
                            <td>{{ $manager->name }}</td>
                            <td>{{ $manager->email }}</td>
                            <td>{{ $manager->phone }}</td>
                            <td>{{ $manager->created_at->format(config('numencode.dates.date')) }}</td>
                            @if ($admin->can('edit_managers'))
                                <td class="text-center">
                                    @include ('admin::components.button.edit', [
                                        'action' => route('managers.edit', compact('manager')),
                                    ])
                                </td>
                            @endif
                            @if ($admin->can('delete_managers'))
                                <td class="text-center">
                                    @if ($admin->id != $manager->id)
                                        @include ('admin::components.button.delete', [
                                            'action' => route('managers.destroy', compact('manager'))
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
    </div>

@endsection