<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Tasks</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tasks
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
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->id }} {{ $task->name }}</td>
                                <td>{{ $task->body }}</td>
                                <td>{{ $task->completed }}</td>
                                <td>{{ $task->created_at }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>
<!-- /.row -->