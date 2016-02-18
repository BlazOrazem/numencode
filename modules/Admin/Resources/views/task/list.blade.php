@extends('admin::layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tasks</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <datatable title="Tasks"></datatable>

            <template id="tasks-template">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        @{{ title }}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table data-table table-striped table-hover" data-order='[[ 1, "asc" ]]'>
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Body</th>
                                    <th>Completed</th>
                                    <th>Created at</th>
                                    <th class="no-sort text-center" width="30">Edit</th>
                                    <th class="no-sort text-center" width="30">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in list">
                                    <td>@{{ item.id }} @{{ item.name }}</td>
                                    <td>@{{ item.body }}</td>
                                    <td>@{{ item.completed }}</td>
                                    <td>@{{ item.created_at }}</td>
                                    <td class="text-center">
                                        <a href="/admin/task/@{{ item.id }}/edit">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <form v-if="adminId != item.id" method="POST"
                                              action="/admin/task/@{{ item.id }}"
                                              @submit.prevent="submit($event, item)"
                                              title="Are you sure?"
                                              notification="This action is irreversible."
                                              completeTitle="Deleted"
                                              completeText="The task has been deleted."
                                              data-id="@{{ item.id }}"
                                                >
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-link">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </button>
                                        </form>
                                    </td>
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