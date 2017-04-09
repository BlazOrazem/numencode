@extends('admin::layout')

@section('title')
    @lang('admin::contents.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('contents.create') }}" class="btn btn-md btn-success">Create new content</a>
            <br /><br />
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-info content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::contents.title')</h5>
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
                    @foreach($contents as $content)
                        <tr>
                            <td>{{ $content->title }}</td>
                            <td class="text-right">
                                <span class="badge badge-base">
                                    {{ $content->sort_order }}
                                </span>
                            </td>
                            <td class="text-center">
                                @include('admin::components.button.edit', [
                                    'action' => route('contents.edit', compact('content')),
                                ])
                            </td>
                            <td class="text-center">
                                @include('admin::components.button.delete', [
                                    'action' => route('contents.destroy', compact('content')),
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