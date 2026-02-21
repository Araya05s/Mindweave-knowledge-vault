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
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/ropes.js'])
        <script src="https://unpkg.com/htmx.org@latest"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg border-bottom bg-light px-4">
            <div class="container-fluid">

                <div class="d-flex flex-column lh-1">
                    <span class="fw-bold kv-title">M I N D W E A V E</span>
                    <small class="text-muted">Knowledge Vault</small>
                </div>

                <div class="ms-auto d-flex align-items-center gap-3">
                    
                    <span class="mr-2 text-switch">Dark mode</span>
                    <div class="form-check form-switch ml-2">
                        <input class="form-check-input" type="checkbox" id="themeSwitch">
                    </div>

                    @guest
                        <a href="" class="btn btn-outline-dark btn-sm">
                            Login
                        </a>
                        <a href="" class="btn btn-dark btn-sm">
                            Register
                        </a>
                    @else
                        <span class="small me-2">
                            {{ auth()->user()->name }}
                        </span>
                        <form method="POST" action="">
                            @csrf
                            <button class="btn btn-outline-dark btn-sm">
                                Logout
                            </button>
                        </form>
                    @endguest
        
                </div>
            </div>
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
</html>
