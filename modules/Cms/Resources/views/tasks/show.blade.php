<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Task: {{ $task->title }}</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h4>Hello {{ $data->first_name }} {{ $data->last_name }}!</h4>
        <p>{{ $task->body }}</p>
    </div>
</div>