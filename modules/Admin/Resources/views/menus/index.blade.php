@extends('admin::layout')

@section('title')
    @lang('admin::menus.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-base content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::menus.types')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 2, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>@lang('admin::tables.code')</th>
                        <th>@lang('admin::tables.title')</th>
                        <th width="60" class="text-right">@lang('admin::tables.order')</th>
                        <th width="60" class="no-sort text-center">@lang('admin::tables.edit')</th>
                        <th width="60" class="no-sort text-center">@lang('admin::tables.delete')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($menus as $menu)
                        <tr>
                            <td>{{ $menu->code }}</td>
                            <td>{{ $menu->title }}</td>
                            <td class="text-right">
                                <span class="badge badge-base">
                                    {{ $menu->sort_order }}
                                </span>
                            </td>
                            <td class="text-center">
                                @include('admin::components.button.edit', [
                                    'action' => route('menus.edit', compact('menu')),
                                ])
                            </td>
                            <td class="text-center">
                                @include('admin::components.button.delete', [
                                    'action' => route('menus.destroy', compact('menu'))
                                ])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::menus.create')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('menus.store') }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.code'),
                            'field' => 'code',
                            'placeholder' => trans('admin::menus.placeholder.code'),
                            'class' => 'snake-slug',
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.title'),
                            'field' => 'title',
                            'placeholder' => trans('admin::menus.placeholder.title'),
                            'required' => true,
                        ])
                        @include('admin::components.form.order', [
                            'sortOrder' => $menus->max('sort_order') + 10,
                        ])
                        @include('admin::components.form.submit', [
                            'button' => trans('admin::menus.create')
                        ])
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection