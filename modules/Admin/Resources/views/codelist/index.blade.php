@extends('admin::layout')

@section('title')
    Codelist
@stop

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="data-info" data-id="codelist-groups">
                <table data-title="Codelist groups" class="display datatable middle-align datatable-striped table" data-order='[[ 1, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th class="text-right">Order</th>
                        @if ($admin->can('edit_managers'))
                            <th class="no-sort text-center" width="50">Edit</th>
                        @endif
                        @if ($admin->can('delete_managers'))
                            <th class="no-sort text-center" width="50">Delete</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($codelistGroups as $group)
                        <tr>
                            <td>{{ $group->title }}</td>
                            <td class="text-right">{{ $group->ord }}</td>
                            @if ($admin->can('edit_managers'))
                                <td class="text-center">
                                    <a href="#">
                                        <i class="zmdi zmdi-edit"></i>
                                    </a>
                                </td>
                            @endif
                            @if ($admin->can('delete_managers'))
                                <td class="text-center">
                                    <form method="POST" action="#" >
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-confirmation">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </form>
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