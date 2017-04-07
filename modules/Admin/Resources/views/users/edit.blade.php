@extends('admin::layout')

@section('title')
    @lang('admin::users.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::users.update') : {{ $user->name }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('users.update', [$user]) }}" class="form-horizontal form-validate" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include('admin::components.form.text', [
                            'label' => trans('admin::users.name'),
                            'field' => 'name',
                            'placeholder' => trans('admin::users.placeholder.name'),
                            'entity' => $user,
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::users.nickname'),
                            'field' => 'nickname',
                            'placeholder' => trans('admin::users.placeholder.nickname'),
                            'entity' => $user,
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::users.email'),
                            'field' => 'email',
                            'placeholder' => trans('admin::users.placeholder.email'),
                            'entity' => $user,
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::users.password'),
                            'field' => 'password',
                            'help' => trans('admin::users.placeholder.password-help'),
                        ])
                        @include('admin::components.form.image', [
                            'label' => trans('admin::users.avatar'),
                            'field' => 'avatar',
                            'entity' => $user,
                            'help' => trans('admin::users.placeholder.avatar-help'),
                        ])
                        @include('admin::components.form.submit', [
                            'button' => trans('admin::users.update')
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($admin->can('assign_user_roles'))
        <div class="row">
            <div class="col-lg-12">
                <div class="data-table data-base content-box">
                    <div class="head base-bg clearfix">
                        <h5 class="content-title pull-left">Roles for {{ $user->name }}</h5>

                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        </div>
                    </div>
                    <table class="display datatable middle-align datatable-striped table" data-order='[[ 0, "asc" ]]'>
                        <thead>
                        <tr>
                            <th>Role</th>
                            <th>Description</th>
                            <th width="100" class="no-sort text-center">Assigned?</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $item)
                            <tr>
                                <td>{{ ucfirst($item->name) }}</td>
                                <td>{{ $item->label }}</td>
                                <td class="text-center">
                                    <label>
                                        <input class="toggle toggle-base"
                                               type="checkbox"
                                               name="toggle"
                                               data-toggle="{{ route('roles.assign.user', [$user, $item]) }}"
                                                {{ in_array($item->id, $user->roles()->pluck('id')->toArray()) ? 'checked' : '' }}
                                                >
                                        <i></i>
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="content text-center">
                    <a class="btn btn-default btn-link btn-md btn-full" href="{{ route('roles.index') }}">
                        @lang('admin::roles.manage')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection