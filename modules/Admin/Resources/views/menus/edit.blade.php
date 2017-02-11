@extends('admin::layout')

@section('title')
    @lang('admin::menus.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::menus.update') : {{ $menu->title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('menus.update', [$menu]) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.code'),
                            'field' => 'code',
                            'placeholder' => trans('admin::menus.placeholder.code'),
                            'entity' => $menu,
                            'class' => 'snake-slug',
                            'required' => true,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.title'),
                            'field' => 'title',
                            'placeholder' => trans('admin::menus.placeholder.title'),
                            'entity' => $menu,
                            'required' => true,
                        ])
                        @include ('admin::components.form.order', [
                            'sortOrder' => $menu->sort_order,
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::menus.update')
                        ])
                    </form>
                </div>
            </div>
            <div class="content-box">
                <div class="content text-center">
                    <a class="btn btn-default btn-link btn-md btn-full" href="{{ route('menus.index') }}">
                        <i class="zmdi zmdi-caret-left-circle left"></i>
                        @lang('admin::menus.index')
                    </a>
                </div>
            </div>
        </div>
    </div>

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
                    @foreach ($menus as $item)
                        <tr>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->title }}</td>
                            <td class="text-right">
                                <span class="badge badge-base">
                                    {{ $item->sort_order }}
                                </span>
                            </td>
                            <td class="text-center">
                                @include ('admin::components.button.edit', [
                                    'action' => route('menus.edit', compact('item'))
                                ])
                            </td>
                            <td class="text-center">
                                @include ('admin::components.button.delete', [
                                    'action' => route('menus.destroy', compact('item'))
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