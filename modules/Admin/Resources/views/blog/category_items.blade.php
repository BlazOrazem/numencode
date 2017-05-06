@extends('admin::layout')

@section('title')
    @lang('admin::blog.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('blog.item.create', $blogCategory) }}" class="btn btn-md btn-success">@lang('admin::blog.item_create')</a>
            <br /><br />
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-info content-box" data-id="blog-items">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">{{ $blogCategory->title }} @lang('admin::blog.items')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 1, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>@lang('admin::tables.title')</th>
                        <th width="130" class="text-right">@lang('admin::tables.date')</th>
                        <th class="text-right">@lang('admin::blog.comments')</th>
                        <th width="60" class="no-sort text-center">@lang('admin::tables.edit')</th>
                        <th width="60" class="no-sort text-center">@lang('admin::tables.delete')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blogCategory->items as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td class="text-right">{{ $item->created_at->format(config('numencode.dates.full')) }}</td>
                            <td class="text-right">
                                @include('admin::components.button.edit', [
                                    'action' => route('blog.item.comments', $item),
                                    'icon' => 'zmdi-collection-text',
                                ])
                                <span class="badge badge-info">
                                    {{ $item->comments()->count() }}
                                </span>
                            </td>
                            <td class="text-center">
                                @include('admin::components.button.edit', [
                                    'action' => route('blog.item.edit', $item)
                                ])
                            </td>
                            <td class="text-center">
                                @include('admin::components.button.delete', [
                                    'action' => route('blog.item.destroy', $item)
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
                <a class="btn btn-default btn-link btn-md btn-full" href="{{ route('blog.index') }}">
                    <i class="zmdi zmdi-caret-left-circle left"></i>
                    @lang('admin::blog.index')
                </a>
            </div>
        </div>
    </div>

@endsection