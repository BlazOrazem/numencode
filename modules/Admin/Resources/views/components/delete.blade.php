<form method="POST" action="{{ $action }}" >
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button type="submit" class="btn btn-danger btn-confirmation">
        <i class="zmdi zmdi-delete"></i>
    </button>
</form>