<h4>{{ $content->title }}</h4>
<p>{{ $content->lead }}</p>
<p>{{ $content->body }}</p>

<div class="row">
    {!! $content->renderPlugin() !!}
</div>

<hr>