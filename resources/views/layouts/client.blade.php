<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GlobalDrop - @yield('title', 'Accueil')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --main-color: #ab3fd6;
        }
        body {
            font-family: 'Roboto', sans-serif;
        }
        /* Custom Bootstrap overrides or additions */
        .bg-main-color {
            background-color: var(--main-color) !important;
        }
        .text-main-color {
            color: var(--main-color) !important;
        }
        .border-main-color {
            border-color: var(--main-color) !important;
        }
        .btn-main-color {
            background-color: var(--main-color);
            color: white;
            border: none;
        }
        .btn-main-color:hover {
            background-color: #8a319e;
            color: white;
        }
        .rounded-full {
            border-radius: 50rem !important;
        }
        .carousel-text {
            font-size: 0.875rem; /* text-sm */
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 text-dark bg-white">

<!-- Barre d'annonces -->
<div class="bg-main-color text-white py-2 small">
    <div class="container d-flex justify-content-center">
        <span id="carousel-text" class="carousel-text">Livraison gratuite sur toutes les commandes</span>
    </div>
</div>

<!-- Header -->
<header class="sticky-top bg-white shadow-sm">
    <div class="container d-flex align-items-center justify-content-between py-3">

        <!-- Logo -->
        <a href="{{ route('produits.index') }}" class="text-main-color fs-3 fw-bold d-flex align-items-center">
            <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop" height="40" />
        </a>

        <!-- Barre de recherche -->
        <form action="{{ route('produits.index') }}" method="GET" class="flex-grow-1 mx-3 d-none d-md-flex">
            <input type="text" name="search" placeholder="Rechercher un produit..." 
                   class="form-control rounded-pill border-secondary" />
        </form>

        <!-- Icônes & Auth -->
        @auth
        <div class="d-flex align-items-center gap-3 flex-wrap">

            <div class="px-3 py-2 bg-light rounded shadow-sm d-flex align-items-center gap-2">
                <span class="small fw-semibold text-secondary">
                    👋 Bienvenue, 
                    <span class="text-main-color fw-bold cursor-pointer">
                        {{ auth()->user()->name }}
                    </span>
                </span>
            </div>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-success btn-sm">
                    Dashboard
                </a>
            @endif

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class="text-decoration-underline text-main-color small fw-medium cursor-pointer">
                Déconnexion
            </a>

            <a href="{{ route('commandes.mes-commandes') }}" 
               class="btn btn-outline-main-color btn-sm rounded-pill shadow-sm">
               📋 Mes commandes
            </a>

            <a href="{{ route('parrainage.index') }}" 
               class="btn btn-outline-success btn-sm rounded-pill shadow-sm">
               🎁 Mon lien de parrainage
            </a>

            <a href="{{ route('page') }}" 
               class="btn btn-outline-main-color btn-sm rounded-pill shadow-sm">
               🌐 Nous suivre
            </a>
        </div>
        @else
        <div class="d-flex gap-2 align-items-center">
            <a href="{{ route('login') }}" class="btn btn-main-color btn-sm rounded-pill shadow-sm d-flex align-items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M15 3h4a2 2 0 0 1 2 2v4m-5 10H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4m7 7l5 5m0 0l-5 5m5-5H9" />
                </svg>
                Se connecter
            </a>
            <a href="{{ route('parrainage.index') }}" class="btn btn-outline-success btn-sm rounded-pill shadow-sm">
                🎁 Mon lien de parrainage
            </a>
            <a href="{{ route('page') }}" class="btn btn-outline-main-color btn-sm rounded-pill shadow-sm">
                🌐 Nous suivre
            </a>
        </div>
        @endauth

        <a href="{{ route('cart.index') }}" class="position-relative ms-3">
            <svg class="text-secondary" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 0 0 .9 1.3h10.9a1 1 0 0 0 .9-1.3L17 13M7 13V6h10v7" />
            </svg>
            @if(session('panier') && count(session('panier')) > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ count(session('panier')) }}
                <span class="visually-hidden">articles dans le panier</span>
            </span>
            @endif
        </a>

    </div>

    <!-- Navigation principale -->
    <nav class="bg-light border-top border-bottom">
        <div class="container d-flex overflow-auto gap-3 py-2 small text-secondary fw-bold">
            @foreach (['Toutes', 'Mode & Accessoires', 'Pour Hommes', 'Pour Femmes'] as $cat)
                <a href="{{ route('produits.index', ['category' => $cat == 'Toutes' ? null : $cat]) }}"
                   class="text-decoration-none text-secondary text-nowrap hover:text-main-color">
                   {{ $cat }}
                </a>
            @endforeach
        </div>
    </nav>
</header>

<!-- Pourquoi choisir GlobalDrop - Style TEMU -->
<section class="py-5 mt-4 bg-white border-top border-bottom">
    <div class="container">
        <h2 class="mb-4 text-center fw-bold fs-3 text-dark">
            Pourquoi <span class="text-main-color">choisir GlobalDrop</span> ?
        </h2>

        <div class="row g-3 justify-content-center">

            <!-- Item 1 -->
            <div class="col-12 col-md-4">
                <div class="d-flex gap-3 p-3 bg-light border rounded shadow-sm hover-shadow">
                    <div class="flex-shrink-0 bg-main-color bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width:48px; height:48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-main-color" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16l4-4H3V8l5-5h11a2 2 0 012 2v12a2 2 0 01-2 2H5l-2 2v-4z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="mb-1 fs-6 fw-semibold text-dark">Livraison rapide</h3>
                        <p class="small text-secondary">Nous livrons rapidement partout au Togo grâce à notre logistique performante.</p>
                    </div>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="col-12 col-md-4">
                <div class="d-flex gap-3 p-3 bg-light border rounded shadow-sm hover-shadow">
                    <div class="flex-shrink-0 bg-main-color bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width:48px; height:48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-main-color" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="mb-1 fs-6 fw-semibold text-dark">Service client 24/7</h3>
                        <p class="small text-secondary">Notre support est disponible jour et nuit pour vous aider.</p>
                    </div>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="col-12 col-md-4">
                <div class="d-flex gap-3 p-3 bg-light border rounded shadow-sm hover-shadow">
                    <div class="flex-shrink-0 bg-main-color bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width:48px; height:48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-main-color" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M12 2a10 10 0 1 1-9.95 12.5" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="mb-1 fs-6 fw-semibold text-dark">Qualité garantie</h3>
                        <p class="small text-secondary">Nous garantissons des produits authentiques et vérifiés.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Pied de page -->
<footer class="bg-dark text-light py-4 mt-auto">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <span>© 2024 GlobalDrop, Tous droits réservés.</span>
        <a href="{{ route('cgv') }}" class="text-light text-decoration-underline small">Conditions générales de vente</a>
    </div>
</footer>

<!-- Bootstrap JS Bundle (Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Carousel text animation example (simple version)
    const messages = [
        'Livraison gratuite sur toutes les commandes',
        'Service client disponible 24/7',
        'Qualité garantie sur tous nos produits',
    ];
    let i = 0;
    const carouselText = document.getElementById('carousel-text');

    setInterval(() => {
        i = (i + 1) % messages.length;
        carouselText.textContent = messages[i];
    }, 5000);
</script>

</body>
</html>
