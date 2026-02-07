@php use Illuminate\Support\Str; @endphp

@if($nodes->isEmpty())
    <div class="alert alert-secondary">
        No nodes found.
    </div>
@else
    <div class="list-group">
        @foreach($nodes as $node)
            <div class="list-group-item">
                <h5 class="mb-1">{{ $node->title }}</h5>
                <p class="mb-0 text-muted">
                    {{ Str::limit($node->content, 120) }}
                </p>
            </div>
        @endforeach
    </div>
@endif
