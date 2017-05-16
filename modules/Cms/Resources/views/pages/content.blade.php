<div class="{{ $content->position }}">

    @if($content->title)
        <h4>{{ $content->title }}</h4>
    @endif

    @if($content->lead)
        <p>{{ $content->lead }}</p>
    @endif

    @if($content->body)
        {!! $content->body !!}
    @endif

    @if($content->plugin_id)
        {!! $content->renderPlugin() !!}
    @endif

</div>