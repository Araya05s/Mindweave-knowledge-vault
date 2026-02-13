<div class="modal-header">
    <h5 class="modal-title">Create Node</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <form
        hx-post="/app/nodes"
        hx-target="#nodes-area"
        hx-swap="innerHTML"
        hx-on="htmx:afterRequest: closeNodeModal()"
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
                hx-post="{{ route('nodes.check') }}"
                hx-trigger="keyup changed delay:500ms"
                hx-target="#tag-warning"
                hx-sync="closest form:abort"
            >
            <div id="tag-warning" class="mt-1"></div>
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
            <button 
                type="submit" 
                class="btn btn-primary"
            >
                Save
            </button>
    
            <button
                type="button"
                class="btn btn-secondary"
                hx-get="/app/nodes/form/close"
                hx-target="#node_form_area"
                data-bs-dismiss="modal"
            >
                Cancel
            </button>
        </div>
    </form>
</div>
