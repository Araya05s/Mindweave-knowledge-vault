@php use Illuminate\Support\Str; @endphp

<script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>

@if($nodes->isEmpty())
    <div class="alert alert-secondary">
        No nodes found.
    </div>
@else
    <div id="sortable-nodes" class="node-area" style="position: relative; width: 100%; height: 60vh; overflow: hidden;">
        <div class="graph-bg"></div>
        <div class="container">
            <canvas id="ropes-area"></canvas>
            @foreach($nodes as $node)
                <div
                    id="node_{{ $node->id }}"
                    data-id="{{ $node->id }}"
                    data-x="{{ $node->x_pos ?? 0 }}"
                    data-y="{{ $node->y_pos ?? 0 }}"
                    data-tags='@json($node->tags->pluck("id"))'
                    class="list-group draggable-node card glass-card shadow-sm rounded-4 mb-3"
                    style="position: absolute; left: {{ $node->x_pos ?? 50 }}px; top: {{ $node->y_pos ?? 50 }}px; min-width: 30vh; border-left: 8px solid {{ optional($node->tags->first())->color ?? '#6c757d' }} !important;"
                >
                    <div id="node-card" class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="bi bi-grip-vertical text-muted drag-handle" style="cursor: grab;"></i>
                                    <h5 class=" mb-0">{{ $node->title }}</h5>
                                </div>

                                <p class="card-text text-muted mb-2 small">
                                    {{ Str::limit($node->content, 120) }}
                                </p>

                                @if($node->relationLoaded('tags') && $node->tags->isNotEmpty())
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($node->tags as $tag)
                                            <span class="card-text" style="background-color: {{ $tag->color }};">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex flex-column gap-1 ms-3">
                                <button class="btn btn-sm btn-link text-primary p-0"
                                        hx-get="{{ route('nodes.edit', $node) }}"
                                        hx-target="#node_form_area"
                                        hx-swap="outerHTML">
                                    Edit
                                </button>
                                <button class="btn btn-sm btn-link text-danger p-0"
                                        hx-delete="{{ route('nodes.delete', $node) }}"
                                        hx-confirm="Delete?"
                                        hx-target="#node_{{ $node->id }}"
                                        hx-swap="outerHTML">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
