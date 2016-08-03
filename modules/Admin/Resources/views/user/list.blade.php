@extends('admin::layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Users
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <datatable title="Managers" admin-id="{{ $admin->id }}"></datatable>

            <template id="managers-template">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        @{{ title }}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table data-table table-striped table-hover" data-paging='false' data-order='[[ 1, "asc" ]]'>
                                <thead>
                                <tr>
                                    <th class="no-sort" width="50"></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Created at</th>
                                    @can('edit_managers')
                                        <th class="no-sort text-center" width="30">Edit</th>
                                    @endcan
                                    @can('delete_managers')
                                        <th class="no-sort text-center" width="30">Delete</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in list">
                                    <td class="text-center"><img :src="item.avatar" width="50" height="50" class="img-circle"></td>
                                    <td>@{{ item.id }} @{{ item.name }}</td>
                                    <td>@{{ item.email }}</td>
                                    <td>@{{ item.phone }}</td>
                                    <td>@{{ item.created_at }}</td>
                                    @can('edit_managers')
                                        <td class="text-center">
                                            <a href="/admin/manager/@{{ item.id }}/edit">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                        </td>
                                    @endcan
                                    @can('delete_managers')
                                        <td class="text-center">
                                            <form v-if="adminId != item.id" method="POST"
                                                  action="/admin/manager/@{{ item.id }}"
                                                  @submit.prevent="submit($event, item)"
                                                  title="Are you sure?"
                                                  notification="This action is irreversible."
                                                  completeTitle="Deleted"
                                                  completeText="The manager has been deleted."
                                                  data-id="@{{ item.id }}"
                                                    >
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-link">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endcan
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->

            </template>

        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->

@stop