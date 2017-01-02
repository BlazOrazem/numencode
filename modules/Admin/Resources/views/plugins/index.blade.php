@extends('admin::layout')

@section('title')
    @lang('admin::plugins.title')
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-6">
            <div class="data-table data-info content-box">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::plugins.types')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 2, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>@lang('admin::tables.title')</th>
                        <th>@lang('admin::tables.description')</th>
                        <th>@lang('admin::tables.order')</th>
                        @if ($admin->can('manage_plugins'))
                            <th class="no-sort text-center">@lang('admin::tables.edit')</th>
                            <th class="no-sort text-center">@lang('admin::tables.delete')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($plugins as $plugin)
                        <tr>
                            <td>{{ $plugin->title }}</td>
                            <td>{{ $plugin->description }}</td>
                            <td class="text-right">
                                <span class="badge badge-info">
                                    {{ $plugin->sort_order }}
                                </span>
                            </td>
                            @if ($admin->can('manage_plugins'))
                                <td class="text-center">
                                    @include ('admin::components.button.edit', [
                                        'action' => route('plugins.edit', compact('plugin')),
                                    ])
                                </td>
                                <td class="text-center">
                                    @include ('admin::components.button.delete', [
                                        'action' => route('plugins.destroy', compact('plugin'))
                                    ])
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if ($admin->can('manage_plugins'))
            <div class="col-lg-6">
                <div class="content-box">
                    <div class="head success-bg clearfix">
                        <h5 class="content-title pull-left">@lang('admin::plugins.create')</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                            <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>
                    <div class="content">
                        <form method="POST" action="{{ route('plugins.store') }}" class="form-horizontal form-validate">
                            {{ csrf_field() }}
                            @include ('admin::components.form.text', [
                                'label' => trans('admin::forms.title'),
                                'field' => 'title',
                                'placeholder' => trans('admin::plugins.placeholder.title'),
                            ])
                            @include ('admin::components.form.text', [
                                'label' => trans('admin::forms.description'),
                                'field' => 'description',
                                'placeholder' => trans('admin::plugins.placeholder.description'),
                            ])
                            @include ('admin::components.form.text', [
                                'label' => trans('admin::forms.action'),
                                'field' => 'action',
                                'placeholder' => trans('admin::plugins.placeholder.action'),
                            ])
                            @include ('admin::components.form.order', [
                                'sortOrder' => $plugins->max('sort_order') + 10,
                            ])
                            @include ('admin::components.form.checkbox', [
                                'label' => 'Is hidden?',
                                'field' => 'is_hidden',
                                'type' => 'success',
                            ])
                            @include ('admin::components.form.submit', [
                                'button' => trans('admin::plugins.create'),
                            ])
                        </form>
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection