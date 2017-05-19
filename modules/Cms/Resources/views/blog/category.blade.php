<div class="row">
    <div class="col-md-8 col-md-offset-2">

        @foreach($blogCategory->items as $blogItem)

            <h2>
                <a href="{{ $blogItem->link }}">{{ $blogItem->title }}</a>
            </h2>

            @if($blogItem->lead)
                <p class="lead">{{ $blogItem->lead }}</p>
            @endif

            <p><span class="glyphicon glyphicon-time"></span> @lang('theme::blog.posted_on') {{ $blogItem->created_at->format(config('numencode.dates.date')) }}</p>

            <hr>

            {{--<img class="img-responsive" src="http://placehold.it/900x300" alt="">--}}

            {{--<hr>--}}

            <p>{!! str_limit($blogItem->body, 200) !!}</p>

            <a class="btn btn-primary" href="{{ $blogItem->link }}">@lang('theme::home.read_more') <span class="glyphicon glyphicon-chevron-right"></span></a>

            @if(!$loop->last)
                <hr>
            @endif

        @endforeach

    </div>
</div>