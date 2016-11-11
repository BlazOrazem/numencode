<form method="POST" action="{{ $action }}" data-element="{{ isset($htmlItem) ? $htmlItem : 'tr' }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type="submit" class="btn btn-danger {{ isset($noAjax) ? 'btn-confirmation' : 'ajax-confirmation' }}">
        <i class="zmdi zmdi-delete"></i>
    </button>
</form>