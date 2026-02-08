@php use Illuminate\Support\Str; @endphp

@if($nodes->isEmpty())
    <div class="alert alert-secondary">
        No nodes found.
    </div>
    @else
        <div class="list-group">
            @foreach($nodes as $node)
            <div id="node_{{ $node->id }}">
                    <div
                    class="card shadow-sm mb-3"
                    style="
                        border: 6px solid {{ optional($node->tags->first())->color ?? '#6c757d' }};
                    "
                >
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title mb-1">
                                    {{ $node->title }}
                                </h5>
                
                                <p class="card-text text-muted mb-2">
                                    {{ Str::limit($node->content, 120) }}
                                </p>
                
                                @if($node->relationLoaded('tags') && $node->tags->isNotEmpty())
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($node->tags as $tag)
                                            <span
                                                class="badge"
                                                style="background-color: {{ $tag->color }};"
                                            >
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                
                            <div class="d-flex flex-column gap-1 ms-3">
                                <button
                                    class="btn btn-sm btn-outline-primary"
                                    hx-get="{{ route('nodes.edit', $node) }}"
                                    hx-target="#node_form_area"
                                    hx-swap="innerHTML"
                                >
                                    Edit
                                </button>
                
                                <button
                                    class="btn btn-sm btn-outline-danger"
                                    hx-delete="{{ route('nodes.delete', $node) }}"
                                    hx-confirm="Delete this node?"
                                    hx-target="#node_{{ $node->id }}"
                                    hx-swap="outerHTML"
                                    hx-on::after-request="if(event.detail.successful) window.location.reload()"
                                >
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        @endforeach
    </div>
@endif
