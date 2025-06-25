<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GlobalDrop - @yield('title', 'Accueil')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Custom Styles -->
    <style>
        :root {
            --main-color: #ab3fd6;
        }
        body {
            font-family: 'Roboto', sans-serif;
        }
        .btn-main {
            background-color: var(--main-color);
            color: white;
        }
        .btn-main:hover,
        .btn-main:focus {
            background-color: #8a31b3;
            color: white;
        }
        a.text-main {
            color: var(--main-color);
        }
        a.text-main:hover {
            color: #8a31b3;
            text-decoration: none;
        }
        nav.nav-category a {
            color: #6c757d;
            font-weight: 600;
            white-space: nowrap;
            margin-right: 1rem;
        }
        nav.nav-category a:hover {
            color: var(--main-color);
            text-decoration: none;
        }
        .announcement-bar {
            background-color: var(--main-color);
            color: white;
            font-size: 0.875rem;
            padding: 0.375rem 0;
        }
        footer a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-white text-dark">

    <!-- Barre d'annonces -->
    <div class="announcement-bar text-center">
        Livraison gratuite sur toutes les commandes
    </div>

    <!-- Header -->
    <header class="sticky-top bg-white shadow-sm">
        <div class="container d-flex align-items-center justify-content-between py-3">
            <!-- Logo -->
            <a href="{{ route('produits.index') }}" class="d-flex align-items-center text-main text-decoration-none fs-3 fw-bold">
                <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop" style="height: 40px; width: auto;" />
            </a>

            <!-- Recherche -->
            <form action="{{ route('produits.index') }}" method="GET" class="flex-grow-1 mx-3 d-none d-md-flex">
                <input
                    type="text"
                    name="search"
                    placeholder="Rechercher un produit..."
                    class="form-control rounded-pill"
                    aria-label="Recherche produit"
                    style="border-color: var(--main-color);"
                />
            </form>

            <!-- Utilisateur / Connexion / Liens -->
            @auth
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <span class="small fw-semibold text-secondary">
                        👋 Bienvenue, <span class="text-main">{{ auth()->user()->name }}</span>
                    </span>

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-success btn-sm">Dashboard</a>
                    @endif

                    <a
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="small text-decoration-underline text-main"
                    >
                        Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

                    <a href="{{ route('commandes.mes-commandes') }}" class="btn btn-outline-main btn-sm rounded-pill">
                        📋 Mes commandes
                    </a>
                    <a href="{{ route('parrainage.index') }}" class="btn btn-outline-success btn-sm rounded-pill">
                        🎁 Mon lien de parrainage
                    </a>
                    <a href="{{ route('page') }}" class="btn btn-outline-main btn-sm rounded-pill">
                        🌐 Nous suivre
                    </a>
                </div>
            @else
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('login') }}" class="btn btn-main btn-sm rounded-pill d-flex align-items-center gap-1 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M6 3a.5.5 0 0 1 .5.5v2.793l3.146-3.147a.5.5 0 0 1 .708.708L7.707 7H10.5a.5.5 0 0 1 0 1H7.707l2.647 2.646a.5.5 0 0 1-.708.708L6.5 7.707V10.5a.5.5 0 0 1-1 0v-7z"/>
                          <path fill-rule="evenodd" d="M13.5 3.5A1.5 1.5 0 0 1 15 5v6a1.5 1.5 0 0 1-1.5 1.5h-7A1.5 1.5 0 0 1 5 11V9a.5.5 0 0 1 1 0v2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V5a.5.5 0 0 0-.5-.5h-7A.5.5 0 0 0 6 5v2a.5.5 0 0 1-1 0V5A1.5 1.5 0 0 1 6.5 3.5h7z"/>
                        </svg>
                        Se connecter
                    </a>
                    <a href="{{ route('parrainage.index') }}" class="btn btn-outline-success btn-sm rounded-pill">
                        🎁 Mon lien de parrainage
                    </a>
                    <a href="{{ route('page') }}" class="btn btn-outline-main btn-sm rounded-pill">
                        🌐 Nous suivre
                    </a>
                </div>
            @endauth

            <!-- Panier -->
            <a href="{{ route('cart.index') }}" class="position-relative ms-3 text-secondary" aria-label="Panier">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                @if(session('panier') && count(session('panier')) > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ count(session('panier')) }}
                    </span>
                @endif
            </a>
        </div>

        <!-- Navigation principale -->
        <nav class="bg-light">
            <div class="container d-flex overflow-auto py-2 nav-category">
                @foreach (['Toutes', 'Mode & Accessoires', 'Pour Hommes', 'Pour Femmes'] as $cat)
                    <a href="{{ route('produits.index', ['category' => $cat == 'Toutes' ? null : $cat]) }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </nav>
    </header>

    <!-- Section Pourquoi choisir -->
    @yield('banner')

    <!-- Contenu principal -->
    <main class="flex-grow-1 container my-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-auto bg-light text-secondary small">
        <div class="container py-5">
            <div class="row gy-4">
                <div class="col-12 col-md-3">
                    <h5 class="fw-semibold text-dark mb-3">Suivez-nous</h5>
                    <div class="d-flex gap-3 text-main fs-5">
                        <a href="https://whatsapp.com/channel/0029VbAh2wrGZNCxxKYwbN3Q" target="_blank" aria-label="WhatsApp" class="text-success">
                            <!-- WhatsApp icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M..."/></svg>
                        </a>
                        <a href="https://www.instagram.com/globaldrop2025" target="_blank" aria-label="Instagram" class="text-danger">
                            <!-- Instagram icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="..."/></svg>
                        </a>
                        <a href="https://www.facebook.com/share/19BrbhLzb2/" target="_blank" aria-label="Facebook" class="text-primary">
                            <!-- Facebook icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                        </a>
                        <a href="http://www.tiktok.com/@globaldrop41" target="_blank" aria-label="TikTok" class="text-dark">
                            <!-- TikTok icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                        </a>
                    </div>
                </div>
                <!-- Tu peux ajouter d’autres colonnes ici -->
            </div>
        </div>
        <div class="bg-secondary bg-opacity-10 text-center py-3">
            &copy; {{ date('Y') }} Global Drop - La qualité au bout du clic, la sécurité en plus.
        </div>
    </footer>

    <!-- Bootstrap 5 JS bundle (Popper + Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Placeholder scripts si besoin -->
    <script>
        // Ici tu peux ajouter des scripts JS pour animations/carousel
    </script>
</body>
</html>
