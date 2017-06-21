@extends('theme::layouts.default')

@section('content')

    <div class="row">
        <div class="col-lg-8">
            <h1>{{ $blogItem->title }}</h1>

            {{--<p class="lead">--}}
                {{--by <a href="#">Start Bootstrap</a>--}}
            {{--</p>--}}

            {{--<hr>--}}

            <p><span class="glyphicon glyphicon-time"></span> @lang('theme::blog.posted_on') {{ $blogItem->created_at->format(config('numencode.dates.date')) }}</p>

            <hr>

            {{--<img class="img-responsive" src="http://placehold.it/900x300" alt="">--}}

            {{--<hr>--}}

            @if($blogItem->lead)
                <p class="lead">{{ $blogItem->lead }}</p>
            @endif

            @if($blogItem->body)
                {!! $blogItem->body !!}
            @endif

            <hr>

            @if($signedIn)
                @can('write_comments')
                    <div class="well">
                        <h4>@lang('theme::blog.leave_comment'):</h4>
                        <form method="POST"
                              role="form"
                              action="{{ route('blog.comment', compact('blogItem')) }}"
                                >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea name="comment" class="form-control" rows="3"></textarea>
                                <span class="help-block">
                                    {{ $errors->first('comment', ':message') }}
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary">@lang('theme::blog.submit_comment')</button>
                        </form>
                    </div>

                    <hr>
                @endcan
            @endif

            @if($blogItem->publishedComments()->count())
                <h3>@lang('theme::blog.comments')</h3>

                @foreach($blogItem->publishedComments() as $comment)
                    <div class="media">
                        <a class="pull-left" href="#">
                            @if($comment->user->avatar)
                                <img class="media-object img-circle" src="{{ $comment->user->avatar }}" height="64" alt="">
                            @endif
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $comment->user->name }}
                                <small>{{ $comment->user->created_at->format(config('numencode.dates.date')) }}</small>
                            </h4>
                            {{ $comment->comment }}
                        </div>
                    </div>
                @endforeach
            @endif

            <br><br>

        </div>

        <div class="col-md-4">

            <div class="well">
                <h4>@lang('theme::blog.search')</h4>
                <div class="input-group">
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>

            <div class="well">
                <h4>@lang('theme::blog.entries')</h4>
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href="#">Testni zapis 1</a>
                            </li>
                            <li><a href="#">Testni zapis 2</a>
                            </li>
                            <li><a href="#">Testni zapis 3</a>
                            </li>
                            <li><a href="#">Testni zapis 4</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-unstyled">
                            <li><a href="#">Testni zapis 5</a>
                            </li>
                            <li><a href="#">Testni zapis 6</a>
                            </li>
                            <li><a href="#">Testni zapis 7</a>
                            </li>
                            <li><a href="#">Testni zapis 8</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="well">
                <h4>@lang('theme::blog.leave_feedback')</h4>
                <p>@lang('theme::blog.feedback_text')</p>
            </div>

        </div>

    </div>

@endsection