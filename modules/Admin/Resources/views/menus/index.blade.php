@extends('admin::layout')

@section('title')
    {{ trans('admin::menus.title') }}
@stop

@section('content')

    <div class="row">

        <div class="col-lg-6">
            <div class="data-table data-info content-box">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">{{ trans('admin::menus.types') }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 2, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>{{ trans('admin::tables.code') }}</th>
                        <th>{{ trans('admin::tables.title') }}</th>
                        <th>{{ trans('admin::tables.order') }}</th>
                        @if ($admin->can('edit_menus'))
                            <th class="no-sort text-center">{{ trans('admin::tables.edit') }}</th>
                        @endif
                        @if ($admin->can('delete_menus'))
                            <th class="no-sort text-center">{{ trans('admin::tables.delete') }}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($menus as $menu)
                        <tr>
                            <td>{{ $menu->code }}</td>
                            <td>{{ $menu->title }}</td>
                            <td class="text-right">
                                <span class="badge badge-info">
                                    {{ $menu->sort_order }}
                                </span>
                            </td>
                            @if ($admin->can('edit_menus'))
                                <td class="text-center">
                                    @include ('admin::components.button.edit', [
                                        'action' => route('menus.edit', compact('menu')),
                                    ])
                                </td>
                            @endif
                            @if ($admin->can('delete_menus'))
                                <td class="text-center">
                                    @include ('admin::components.button.delete', [
                                        'action' => route('menus.destroy', compact('menu'))
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
                    <h5 class="content-title pull-left">{{ trans('admin::menus.create') }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('menus.store') }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.code'),
                            'field' => 'code',
                            'placeholder' => trans('admin::menus.placeholder.code'),
                            'class' => 'snake-slug',
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.title'),
                            'field' => 'title',
                            'placeholder' => trans('admin::menus.placeholder.title'),
                        ])
                        @include ('admin::components.form.order', [
                            'sortOrder' => $menus->max('sort_order') + 10,
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::menus.create'),
                        ])
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop