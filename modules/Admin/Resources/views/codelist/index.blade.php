@extends('admin::layout')

@section('title')
    @lang('admin::codelist.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-info content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::codelist.groups')</h5>
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
                        @if($admin->can('manage_codelist'))
                            <th width="60" class="no-sort text-center">@lang('admin::tables.manage')</th>
                            <th width="60" class="no-sort text-center">@lang('admin::tables.delete')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($codelistGroups as $codelistGroup)
                        <tr>
                            <td>{{ $codelistGroup->title }}</td>
                            <td class="text-right">
                                <span class="badge badge-base f-s-14">
                                    {{ $codelistGroup->sort_order }}
                                </span>
                            </td>
                            @if($admin->can('manage_codelist'))
                                <td class="text-center">
                                    @include('admin::components.button.edit', [
                                        'action' => route('codelist.edit', compact('codelistGroup')),
                                        'icon' => 'zmdi-collection-text',
                                    ])
                                </td>
                                <td class="text-center">
                                    @if(!$codelistGroup->items->count())
                                        @include('admin::components.button.delete', [
                                            'action' => route('codelist.destroy', compact('codelistGroup')),
                                        ])
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($admin->can('manage_codelist'))
        <div class="row">
            <div class="col-lg-12">
                <div class="content-box">
                    <div class="head base-bg clearfix">
                        <h5 class="content-title pull-left">@lang('admin::codelist.new_group')</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        </div>
                    </div>
                    <div class="content">
                        <form method="POST" action="{{ route('codelist.store') }}" class="form-horizontal form-validate">
                            {{ csrf_field() }}
                            @include('admin::components.form.text', [
                                'label' => trans('admin::forms.title'),
                                'field' => 'title',
                                'placeholder' => trans('admin::codelist.placeholder.group_title'),
                                'required' => true,
                            ])
                            @include('admin::components.form.order', [
                                'sortOrder' => $codelistGroups->max('sort_order') + 10,
                                'errors' => $errors->groupErrors,
                            ])
                            @include('admin::components.form.submit', [
                                'button' => trans('admin::codelist.group_create'),
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection