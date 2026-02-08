<form
    hx-post="/app/nodes"
    hx-target="#nodes-area"
    hx-swap="innerHTML"
    class="card card-body"
>
    @csrf

    <div class="mb-2">
        <label class="form-label">Node Title</label>
        <input
            type="text"
            name="title"
            class="form-control"
            required
        >
    </div>

    <div class="mb-2">
        <label class="form-label">Content</label>
        <textarea
            name="content"
            class="form-control"
            rows="2"
        ></textarea>
    </div>

    <div class="mb-2">
        <label class="form-label">Tag Name</label>
        <input
            type="text"
            name="tag_name"
            class="form-control"
        >
    </div>

    <div class="mb-3">
        <label class="form-label">Tag Color</label>
        <input
            type="color"
            name="tag_color"
            class="form-control form-control-color"
            value="#0d6efd"
        >
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">
            Save
        </button>

        <button
            type="button"
            class="btn btn-secondary"
            hx-get="/app/nodes/form/close"
            hx-target="#node_form_area"
            hx-swap="innerHTML"
        >
            Cancel
        </button>
    </div>
</form>
