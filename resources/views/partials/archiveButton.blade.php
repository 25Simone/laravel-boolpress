<form action="{{ route($route, $id) }}" method="post" id="archive_button_{{$id}}">
    @csrf
    @method('delete')

    <button class="btn btn-warning" type="submit">Archivia</button>
</form>