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
        </div>
    </div>

    <template id="tasks-template">
        <div class="panel-heading">
            @{{ title }}
        </div>
        <div class="dataTable_wrapper">
            <table class="table data-table table-striped table-hover" data-paging='false' data-order='[[ 1, "asc" ]]'>
                <tr v-for="task in list">
                    <td>
                        @{{ task.body }}
                    </td>
                    <td>
                        <form method="POST"
                              action="/admin/task/@{{ task.id }}"
                              @submit.prevent="submit($event, task)"
                              title="Are you sure?"
                              notification="This action is irreversible."
                              completeTitle="Deleted"
                              completeText="The task has been deleted."
                              data-id="@{{ task.id }}"
                                >
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-link">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </template>

@stop