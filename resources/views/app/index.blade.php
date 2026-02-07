@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Mindweave</h1>
        <p>This is the core app view. Still W.I.P</p>

        <div
        hx-get="/app"
        hx-trigger="load"
        hx-target="this"
        hx-swap="innerHTML"
    >
        <div class="text-muted">Loading nodes…</div>
    </div>
@endsection