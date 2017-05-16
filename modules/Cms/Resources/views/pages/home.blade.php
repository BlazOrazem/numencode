@extends('theme::layouts.default')

@section('jumbotron')
    <h1>@lang('theme::home.welcome')</h1>
@endsection

@section('content')

    <div class="row">

        @foreach($promotions as $promotion)
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-{{ $promotion->lead ?: 'check' }}"></i> {{ $promotion->title }}</h4>
                    </div>
                    <div class="panel-body">
                        @if($promotion->picture || true)
                            <div class="thumbnail">
                                <img src="{{ $promotion->picture ?: '/uploads/sample0' . rand(1, 3) . '_600x600.jpg' }}" alt="{{ $promotion->title }}" class="img-responsive center-block" />
                            </div>
                        @endif
                        {!! $promotion->body !!}
                        @if($promotion->link)
                            <a href="{{ $promotion->link }}" target="_blank" class="btn btn-default">@lang('theme::home.read_more')</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection