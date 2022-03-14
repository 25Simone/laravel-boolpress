<form action="{{ route($route, $id) }}" method="post" id="delete_button_{{$id}}">
    @csrf
    @method('delete')

    <button class="btn btn-danger" type="submit">Elimina</button>
</form>

{{-- Create a js modal to confirm the deletion --}}
<script>
    // save button in a variable
    const deleteButtonForm_{{$id}} = document.getElementById("delete_button_{{$id}}");
    // prevent the destroy action
    deleteButtonForm_{{$id}}.addEventListener("submit", function(e) {
        e.preventDefault();

        const confirmation = confirm("Vuoi cancellare {{ $post->title }}?");

        // Set the condition to re-launch the destroy action
        if (confirmation) {
            deleteButtonForm_{{$id}}.submit();
        }
    });

</script>