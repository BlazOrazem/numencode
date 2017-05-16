@if($randomBlog)
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <h4>{{ $randomBlog->title }} <small>({{ $randomBlog->created_at->format(config('numencode.dates.date')) }}</small>)</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p>{!! str_limit($randomBlog->body, 200) !!}</p>
        </div>
    </div>
    <hr />
@endif