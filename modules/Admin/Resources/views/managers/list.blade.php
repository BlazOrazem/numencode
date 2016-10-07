@extends('admin::layout')

@section('title')
    Managers
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="data-info" data-id="manager-list">
                <table data-title="Manager list" data-search="Search manager" class="display datatable search paginate datatable-striped table" data-order='[[ 1, "asc" ]]'>
                    <thead>
                    <tr>
                        <th class="no-sort" width="50"></th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created at</th>
                        @if ($admin->can('edit_managers'))
                            <th class="no-sort text-center" width="30">Edit</th>
                        @endif
                        @if ($admin->can('delete_managers'))
                            <th class="no-sort text-center" width="30">Delete</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($managers as $manager)
                        <tr>
                            <td class="text-center">
                                <img src="{{ $manager->avatar }}" width="50" height="50" class="img-circle">
                            </td>
                            <td>{{ $manager->name }}</td>
                            <td>{{ $manager->email }}</td>
                            <td>{{ $manager->phone }}</td>
                            <td>{{ $manager->created_at }}</td>
                            @if ($admin->can('edit_managers'))
                                <td class="text-center">
                                    <a href="{{ route('managers.edit', compact('manager')) }}">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>
                                </td>
                            @endif
                            @if ($admin->can('delete_managers'))
                                <td class="text-center">
                                    @if ($admin->id != $manager->id)
                                        <form method="POST" action="{{ route('managers.destroy', compact('manager')) }}" >
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-primary btn-link btn-confirmation">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
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

@stop