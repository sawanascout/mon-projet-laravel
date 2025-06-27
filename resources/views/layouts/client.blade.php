<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlobalDrop - @yield('title', 'Accueil')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #ab3fd6;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .main {
            flex: 1;
        }
        .top-bar {
            background-color: var(--primary);
            color: #fff;
            padding: 8px;
            text-align: center;
            font-size: 14px;
        }
        .navbar-brand img {
            height: 40px;
        }
        .nav-link {
            color: #333 !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: var(--primary) !important;
        }
        .btn-main {
            background: var(--primary);
            color: white;
            border-radius: 25px;
        }
        .btn-main-outline {
            border: 1px solid var(--primary);
            color: var(--primary);
            border-radius: 25px;
        }
        .btn-main-outline:hover {
            background: var(--primary);
            color: white;
        }
        .whatsapp-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
            background: #25d366;
            color: white;
            padding: 10px 15px;
            border-radius: 40px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        footer {
            background: #f8f9fa;
            padding: 20px 0;
        }
        .social-icon svg {
            width: 24px;
            height: 24px;
            color: var(--primary);
            transition: 0.3s;
        }
        .social-icon svg:hover {
            color: #7b26a3;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <span id="carousel-text">Livraison rapide & Paiement 100% sécurisé au Togo 🇹🇬</span>
    </div>

    <nav class="bg-white shadow-sm navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('produits.index') }}">
                <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="mb-2 navbar-nav ms-auto mb-lg-0">
                    @auth
                        <li class="nav-item">
                            <span class="nav-link">👋 Bonjour, <strong class="text-primary">{{ auth()->user()->name }}</strong></span>
                        </li>
                        @if (auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('commandes.mes-commandes') }}">📦 Mes commandes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Parrainage.index') }}">🎁 Parrainage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('page') }}">🌐 Nous suivre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">@csrf</form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-main btn-sm me-2" href="{{ route('login') }}">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-main-outline btn-sm me-2" href="{{ route('Parrainage.index') }}">🎁 Parrainage</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-main-outline btn-sm" href="{{ route('page') }}">🌐 Nous suivre</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-dark position-relative">
                            🛒
                            @if(session('panier') && count(session('panier')) > 0)
                                <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count(session('panier')) }}
                                </span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main">
        @yield('content')
    </main>

    <footer class="mt-auto">
        <div class="container text-center">
            <div class="mb-3">
                <a href="#" class="me-3 social-icon">🔗</a>
                <a href="https://wa.me/22890171119" class="me-3 social-icon" target="_blank">WhatsApp</a>
                <a href="https://www.instagram.com/globaldroptg" class="me-3 social-icon" target="_blank">Instagram</a>
                <a href="https://www.facebook.com/share/19BrbhLzb2" class="me-3 social-icon" target="_blank">Facebook</a>
                <a href="https://www.tiktok.com/@globaldrop2428" class="social-icon" target="_blank">TikTok</a>
            </div>
            <small class="text-muted">&copy; {{ date('Y') }} GlobalDrop - La qualité au bout du clic.</small>
        </div>
    </footer>

    <a href="https://wa.me/22890171119" class="whatsapp-float">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
            <path d="M20.52 3.48a11.91 11.91 0 0 0-16.84 0 11.91 11.91 0 0 0-2.55 12.93L2 21l4.69-1.23a11.92 11.92 0 0 0 13.83-16.29z"/>
        </svg>
        Contact
    </a>

    <script>
        const messages = [
            "Livraison gratuite sur toutes les commandes",
            "Retour facile sous 30 jours",
            "Nouvelle collection disponible maintenant",
            "Profitez de 10% de réduction avec le code WELCOME"
        ];
        let currentMessage = 0;
        const carouselText = document.getElementById("carousel-text");
        setInterval(() => {
            currentMessage = (currentMessage + 1) % messages.length;
            carouselText.textContent = messages[currentMessage];
        }, 4000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
