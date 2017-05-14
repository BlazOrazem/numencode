@if($randomBlog)
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ $randomBlog->title }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p>{!! $randomBlog->body !!}</p>
        </div>
    </div>
@endif