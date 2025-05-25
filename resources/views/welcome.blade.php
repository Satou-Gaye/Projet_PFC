<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Application')</title>
    <!-- Bootstrap CSS (ou votre propre fichier) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex">

    {{-- Sidebar --}}
    <nav class="bg-light border-end" id="sidebar" style="width: 220px; min-height: 100vh;">
        <div class="p-3">
            <h5>Menu</h5>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="{{ route('welcome') }}">Accueil</a></li>
                <button><li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li></button>
                
                 
                <!-- etc. -->
            </ul>
        </div>
    </nav>

    {{-- Contenu principal --}}
    <div class="flex-grow-1">

        {{-- Navbar --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('welcome') }}">MonApp</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @auth
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><span class="nav-link">Bonjour, {{ auth()->user()->name }}</span></li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="btn btn-link nav-link">Déconnexion</button>
                                </form>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </nav>

        {{-- Zone utilisateur --}}
        <main class="p-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS (popper + bundle) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
