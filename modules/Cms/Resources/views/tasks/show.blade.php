<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">{{ $task->title }}</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <p>{!! $task->body !!}</p>
        @if(isset($data) && ($data->first_name || $data->last_name))
            <h5>@lang('theme::content.author'): {{ $data->first_name }} {{ $data->last_name }}</h5>
        @endif
    </div>
</div>