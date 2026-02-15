@extends('layouts.app')

@section('content')
        <div class="container py-4">
            <h1>Mindweave</h1>
            <p>This is the core app view. Still W.I.P</p>

            <div
            id="nodes-area"
            hx-get="/app"
            hx-trigger="load"
            hx-target="this"
            hx-swap="innerHTML"
        >
            <div class="text-muted">Loading nodes…</div>
        </div>

        <div class="mt-4">
            <button
                class="btn btn-outline-primary"
                hx-get="/app/nodes/form"
                hx-target="#node_form_area"
                hx-swap="innerHTML"
                data-bs-toggle="modal"
                data-bs-target="#nodeModal"
                >
                + Node
            </button>
        </div>
    
        <div class="modal fade" id="nodeModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" id="node_form_area">
                </div>
            </div>
        </div>
@endsection