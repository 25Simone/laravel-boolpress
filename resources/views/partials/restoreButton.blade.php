<form action="{{ route($route, $id) }}" method="post" id="archive_button_{{$id}}">
    @csrf

    <button class="btn btn-warning mx-3" type="submit">Ripristina</button>
</form>