@extends('admin::layout')

@section('title')
    @lang('admin::managers.title')
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8">
            <div class="content-box">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::managers.update') : {{ $manager->name }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('managers.update', [$manager]) }}" class="form-horizontal form-validate" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::managers.name'),
                            'field' => 'name',
                            'placeholder' => trans('admin::managers.placeholder.name'),
                            'entity' => $manager,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::managers.email'),
                            'field' => 'email',
                            'placeholder' => trans('admin::managers.placeholder.email'),
                            'entity' => $manager,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::managers.phone'),
                            'field' => 'phone',
                            'placeholder' => trans('admin::managers.placeholder.phone'),
                            'entity' => $manager,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::managers.password'),
                            'field' => 'password',
                            'help' => trans('admin::managers.placeholder.password-help'),
                        ])
                        @include ('admin::components.form.image', [
                            'label' => trans('admin::managers.avatar'),
                            'field' => 'avatar',
                            'entity' => $manager,
                            'help' => trans('admin::managers.placeholder.avatar-help'),
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::managers.update'),
                            'type' => 'info',
                        ])
                    </form>
                </div>
            </div>
        </div>

        @if ($admin->can('assign_manager_roles') && $admin->id != $manager->id)
            <div class="col-md-4">
                <div class="data-table data-danger content-box">
                    <div class="head danger-bg clearfix">
                        <h5 class="content-title pull-left">Roles for {{ $manager->name }}</h5>

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
                            <th class="no-sort">Assigned?</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($roles as $item)
                            <tr>
                                <td>{{ ucfirst($item->name) }}</td>
                                <td>{{ $item->label }}</td>
                                <td class="text-center">
                                    <label>
                                        <input class="toggle toggle-danger"
                                               type="checkbox"
                                               name="toggle"
                                               data-toggle="{{ route('roles.assign.manager', [$manager, $item]) }}"
                                                {{ in_array($item->id, $manager->roles()->pluck('id')->toArray()) ? 'checked' : '' }}
                                                >
                                        <i></i>
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="content-box">
                    <div class="content text-center">
                        <a class="btn btn-default btn-link btn-md btn-full" href="{{ route('roles.index') }}">
                            @lang('admin::roles.manage')
                        </a>
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection