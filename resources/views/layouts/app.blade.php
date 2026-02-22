<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <body class="bg-body text-body">

        <nav class="navbar navbar-expand-lg border-bottom bg-body px-4">
            <div class="container-fluid">
        
                <div class="d-flex flex-column lh-1">
                    <span class="fw-bold kv-title text-body-emphasis">M I N D W E A V E</span>
                    <small class="text-body-secondary">Knowledge Vault</small>
                </div>
        
                <div class="ms-auto d-flex align-items-center gap-3">
        
                    @guest
                        <a href="" class="btn btn-outline-primary btn-sm">
                            Login
                        </a>
                        <a href="" class="btn btn-secondary btn-sm">
                            Register
                        </a>
                    @else
                        <span class="small text-body-secondary">
                            {{ auth()->user()->name }}
                        </span>
                        <form method="POST" action="">
                            @csrf
                            <button class="btn btn-outline-secondary btn-sm">
                                Logout
                            </button>
                        </form>
                    @endguest
        
                    <button class="btn btn-sm btn-outline-secondary" id="themeToggle">
                        <span id="themeIcon">🌙</span>
                    </button>
        
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
        <script>
            const html = document.documentElement;
            const toggleBtn = document.getElementById("themeToggle");
            const icon = document.getElementById("themeIcon");
            
            const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
            const savedTheme = localStorage.getItem("theme") || (prefersDark ? "dark" : "light");
            html.setAttribute("data-bs-theme", savedTheme);
            icon.textContent = savedTheme === "dark" ? "☀️" : "🌙";
            
            toggleBtn.addEventListener("click", () => {
                const current = html.getAttribute("data-bs-theme");
                const newTheme = current === "light" ? "dark" : "light";
            
                html.setAttribute("data-bs-theme", newTheme);
                localStorage.setItem("theme", newTheme);
            
                icon.textContent = newTheme === "dark" ? "☀️" : "🌙";
            });
        </script>
</html>
