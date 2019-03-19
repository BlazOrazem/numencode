@if($randomBlog)
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">{{ $randomBlog->title }} <small>({{ $randomBlog->created_at->format(config('numencode.dates.date')) }})</small></h3>
        </div>
        <div class="panel-body">
            <p>{!! Str::limit($randomBlog->body, 200) !!}</p>
        </div>
        <div class="panel-footer">
            <a class="btn btn-info" href="{{ $randomBlog->link }}">
                @lang('theme::home.read_more')
            </a>
        </div>
    </div>
@endif