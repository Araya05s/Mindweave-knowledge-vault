<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Mindweave') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/htmx.org@latest"></script>
    </head>
    <body>

        <nav class="navbar navbar-dark bg-dark px-3">
            <span class="navbar-brand">Knowledge Vault</span>
        </nav>
        
        <main>
            @yield('content')
        </main>
        
        @yield('scripts')

        <script>
            document.body.addEventListener('htmx:configRequest', function (event) {
                event.detail.headers['X-CSRF-TOKEN'] =
                    document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            });
        </script>
        </body>
</html>
