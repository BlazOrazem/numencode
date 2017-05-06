@extends('admin::layout')

@section('title')
    @lang('admin::blog.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-info content-box" data-id="blog-items">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">{{ $blogItem->title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 1, "asc" ]]'>
                    <thead>
                    <tr>
                        <th width="120">@lang('admin::tables.user')</th>
                        <th class="text-right">@lang('admin::blog.comment')</th>
                        <th width="130" class="text-right">@lang('admin::tables.date')</th>
                        <th width="60" class="no-sort text-right">@lang('admin::tables.publish')</th>
                        <th width="60" class="no-sort text-center">@lang('admin::tables.delete')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($blogItem->comments as $comment)
                        <tr>
                            <td>
                                <a href="{{ route('users.edit', $comment->user) }}" target="_blank">
                                    {{ $comment->user->name }}
                                </a>
                            </td>
                            <td>
                                <a href="#"
                                   class="editable"
                                   data-pk="{{ $comment->id }}"
                                   data-url="{{ route('blog.comment.update') }}"
                                   data-title="{{ $comment->id }}"
                                        >{!! $comment->comment !!}</a>
                            </td>
                            <td class="text-right">{{ $comment->created_at->format(config('numencode.dates.full')) }}</td>
                            <td class="text-right">
                                <label class="switch">
                                    <input class="toggle toggle-info"
                                           type="checkbox"
                                           name="toggle"
                                           data-toggle="{{ route('blog.comment.publish', [$comment->id]) }}"
                                            {{ !$comment->is_published ? '' : 'checked' }}
                                            >
                                    <i></i>
                                </label>
                            </td>
                            <td class="text-center">
                                @include('admin::components.button.delete', [
                                    'action' => route('blog.comment.destroy', $comment)
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