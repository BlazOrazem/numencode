@extends('admin::layout')

@section('title')
    @lang('admin::tasks.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-base content-box" data-id="task-list">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::tasks.title')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table data-search="Search" class="display datatable search paginate middle-align datatable-striped table" data-order='[[ 0, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>@lang('admin::tasks.name')</th>
                        <th>@lang('admin::tasks.body')</th>
                        <th class="no-sort text-right">@lang('admin::tasks.completed')</th>
                        <th>@lang('admin::tables.date')</th>
                        <th class="no-sort text-center">@lang('admin::tables.show')</th>
                        <th class="no-sort text-center">@lang('admin::tables.edit')</th>
                        <th class="no-sort text-center">@lang('admin::tables.delete')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->body }}</td>
                            <td class="text-right">
                                <label>
                                    <input class="toggle toggle-base"
                                           type="checkbox"
                                           name="toggle"
                                           data-toggle="{{ route('tasks.complete', [$task->id]) }}"
                                            {{ $task->completed ? 'checked' : '' }}
                                            >
                                    <i></i>
                                </label>
                            </td>
                            <td>{{ $task->created_at->format(config('numencode.dates.date')) }}</td>
                            <td class="text-center">
                                @include('admin::components.button.edit', [
                                    'action' => route('tasks.show', compact('task')),
                                    'icon' => 'zmdi-search'
                                ])
                            </td>
                            <td class="text-center">
                                @include('admin::components.button.edit', [
                                    'action' => route('tasks.edit', compact('task')),
                                ])
                            </td>
                            <td class="text-center">
                                @include('admin::components.button.delete', [
                                    'action' => route('tasks.destroy', compact('task'))
                                ])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection