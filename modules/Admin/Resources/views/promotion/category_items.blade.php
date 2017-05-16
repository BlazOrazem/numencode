@extends('admin::layout')

@section('title')
    @lang('admin::promotion.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('promotion.item.create', $promotionCategory) }}" class="btn btn-md btn-success">@lang('admin::promotion.item_create')</a>
            <br /><br />
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-info content-box" data-id="promotion-items">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">{{ $promotionCategory->title }} @lang('admin::promotion.items')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 1, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>@lang('admin::tables.title')</th>
                        <th width="60" class="text-right">@lang('admin::tables.order')</th>
                        <th width="60" class="no-sort text-center">@lang('admin::tables.edit')</th>
                        <th width="60" class="no-sort text-center">@lang('admin::tables.delete')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($promotionCategory->items as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td class="text-right">
                                <span class="badge badge-base f-s-14">
                                    {{ $item->sort_order }}
                                </span>
                            </td>
                            <td class="text-center">
                                @include('admin::components.button.edit', [
                                    'action' => route('promotion.item.edit', $item)
                                ])
                            </td>
                            <td class="text-center">
                                @include('admin::components.button.delete', [
                                    'action' => route('promotion.item.destroy', $item)
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
        <div class="content-box">
            <div class="content text-center">
                <a class="btn btn-default btn-link btn-md btn-full" href="{{ route('promotion.index') }}">
                    <i class="zmdi zmdi-caret-left-circle left"></i>
                    @lang('admin::promotion.index')
                </a>
            </div>
        </div>
    </div>

@endsection