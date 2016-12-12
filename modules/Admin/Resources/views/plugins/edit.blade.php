@extends('admin::layout')

@section('title')
    @lang('admin::plugins.title')
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-6">
            <div class="data-table data-success content-box">
                <div class="head success-bg clearfix">
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
                        @if ($admin->can('edit_plugins'))
                            <th class="no-sort text-center">@lang('admin::tables.edit')</th>
                        @endif
                        @if ($admin->can('delete_plugins'))
                            <th class="no-sort text-center">@lang('admin::tables.delete')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($plugins as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->description }}</td>
                            <td class="text-right">
                                <span class="badge badge-info">
                                    {{ $item->sort_order }}
                                </span>
                            </td>
                            @if ($admin->can('edit_plugins'))
                                <td class="text-center">
                                    @include ('admin::components.button.edit', [
                                        'action' => route('plugins.edit', compact('item'))
                                    ])
                                </td>
                            @endif
                            @if ($admin->can('delete_plugins'))
                                <td class="text-center">
                                    @include ('admin::components.button.delete', [
                                        'action' => route('plugins.destroy', compact('item'))
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
                    <h5 class="content-title pull-left">@lang('admin::plugins.update'): {{ $plugin->title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('plugins.update', [$plugin]) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.title'),
                            'field' => 'title',
                            'placeholder' => trans('admin::plugins.placeholder.title'),
                            'entity' => $plugin,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.description'),
                            'field' => 'description',
                            'placeholder' => trans('admin::plugins.placeholder.description'),
                            'entity' => $plugin,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.action'),
                            'field' => 'action',
                            'placeholder' => trans('admin::plugins.placeholder.action'),
                            'entity' => $plugin,
                        ])
                        @include ('admin::components.form.order', [
                            'sortOrder' => $plugin->sort_order,
                        ])
                        @include ('admin::components.form.checkbox', [
                            'label' => 'Is hidden?',
                            'field' => 'is_hidden',
                            'type' => 'warning',
                            'isChecked' => $plugin->is_hidden,
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::plugins.update'),
                            'type' => 'warning',
                        ])
                    </form>
                </div>
            </div>
            <div class="content-box">
                <div class="content text-center">
                    <a class="btn btn-default btn-link btn-md btn-full" href="{{ route('plugins.index') }}">
                        <i class="zmdi zmdi-caret-left-circle left"></i>
                        @lang('admin::plugins.index')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection