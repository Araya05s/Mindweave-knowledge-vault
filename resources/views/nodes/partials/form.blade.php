<form
    hx-put="{{ route('nodes.update', $node) }}"
    hx-target="#node_{{ $node->id }}"
    hx-swap="outerHTML"
>
    @csrf
    @method('PUT') {{-- Required if your Laravel route is defined as Route::put --}}

    <div class="mb-2">
        <label class="form-label">Title</label>
        <input
            type="text"
            name="title"
            class="form-control"
            value="{{ $node->title }}"
            required
        >
    </div>

    <div class="mb-2">
        <label class="form-label">Content</label>
        <textarea
            name="content"
            class="form-control"
            rows="3"
        >{{ $node->content }}</textarea>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            Save Changes
        </button>

        <button
            type="button"
            class="btn btn-secondary"
            hx-on:click="document.getElementById('node_form_area').innerHTML = ''"
        >
            Cancel
        </button>
    </div>
</form>