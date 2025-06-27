<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GlobalDrop - @yield('title', 'Accueil')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
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
        /* Custom dropdown panier */
        .dropdown-cart {
            min-width: 300px;
            max-height: 350px;
            overflow-y: auto;
        }
        .dropdown-cart .item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }
        .dropdown-cart .item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
        }
        .dropdown-cart .item-details {
            flex-grow: 1;
        }
        .dropdown-cart .item-title {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 2px;
        }
        .dropdown-cart .item-qty-price {
            font-size: 0.85rem;
            color: #666;
        }
        .dropdown-cart .empty-text {
            padding: 20px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <span id="carousel-text">Livraison rapide & Paiement 100% sécurisé au Togo 🇹🇬</span>
    </div>

    <!-- Navbar amélioré -->
    <nav class="bg-white shadow-sm navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('produits.index') }}">
                <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop" height="40" class="rounded shadow-sm me-2" />
                <span class="fw-bold text-dark">GlobalDrop</span>
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="gap-2 navbar-nav ms-auto align-items-lg-center">
                    @auth
                        <li class="nav-item">
                            <span class="nav-link">👋 Bonjour, <strong class="text-primary">{{ auth()->user()->name }}</strong></span>
                        </li>
                        @if (auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}" class="nav-link">📊 Dashboard</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('commandes.mes-commandes') }}">📦 Commandes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Parrainage.index') }}">🎁 Parrainage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('page') }}">🌐 Nous suivre</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link text-danger"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >🚪 Déconnexion</a
                            >
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">@csrf</form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-sm btn-main me-2" href="{{ route('login') }}">🔐 Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-sm btn-outline-dark me-2" href="{{ route('Parrainage.index') }}">🎁 Parrainage</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-sm btn-outline-dark" href="{{ route('page') }}">🌐 Nous suivre</a>
                        </li>
                    @endauth

                    <!-- Panier Dropdown -->
                    <li class="nav-item dropdown">
                        <a
                            class="btn btn-outline-dark position-relative dropdown-toggle d-flex align-items-center"
                            href="#"
                            id="cartDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            aria-haspopup="true"
                        >
                            <i class="bi bi-cart3 fs-5"></i>
                            <span class="ms-1">Panier</span>
                            @if(session('panier') && count(session('panier')) > 0)
                                <span
                                    class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger"
                                    style="font-size: 0.75rem;"
                                >
                                    {{ count(session('panier')) }}
                                    <span class="visually-hidden">articles dans le panier</span>
                                </span>
                            @endif
                        </a>
                        <ul class="p-3 dropdown-menu dropdown-menu-end dropdown-cart" aria-labelledby="cartDropdown">
                            @if(session('panier') && count(session('panier')) > 0)
                                @foreach(session('panier') as $id => $item)
                                    <li class="item">
                                        <img src="{{ $item['image'] ?? asset('images/default-product.png') }}" alt="{{ $item['name'] }}" />
                                        <div class="item-details">
                                            <div class="item-title">{{ $item['name'] }}</div>
                                            <div class="item-qty-price">
                                                {{ $item['quantity'] }} × {{ number_format($item['price'], 0, ',', ' ') }} FCFA
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                <li class="mt-3 text-center">
                                    <a href="{{ route('cart.index') }}" class="px-4 btn btn-primary btn-sm rounded-pill">Voir mon panier</a>
                                </li>
                            @else
                                <li class="empty-text">Votre panier est vide.</li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Barre catégories + recherche -->
    <div class="py-2 bg-light border-top border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <!-- Catégories -->
                <div class="col-12 col-md-8">
                    <div class="flex-row overflow-auto d-flex flex-nowrap">
                        @foreach (['Toutes', 'Mode & Accessoires', 'Pour Hommes', 'Pour Femmes'] as $cat)
                            <a
                                href="{{ route('produits.index', ['category' => $cat == 'Toutes' ? null : $cat]) }}"
                                class="btn btn-outline-primary btn-sm rounded-pill me-2 text-nowrap"
                                >{{ $cat }}</a
                            >
                        @endforeach
                    </div>
                </div>

                <!-- Barre de recherche -->
                <div class="mt-2 col-12 col-md-4 mt-md-0">
                    <form action="{{ route('produits.index') }}" method="GET" class="d-flex">
                        <input
                            type="text"
                            name="search"
                            class="form-control rounded-pill border-primary"
                            placeholder="Rechercher un produit..."
                        />
                        <button type="submit" class="btn btn-primary ms-2 rounded-pill">🔍</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Pourquoi choisir GlobalDrop -->
    <section class="py-4 mt-4 bg-white border-top border-bottom">
        <div class="container">
            <h2 class="mb-4 text-center fw-bold">
                Pourquoi <span class="main-color">choisir GlobalDrop</span> ?
            </h2>

            <div class="row g-4">
                <!-- Item 1 -->
                <div class="col-md-4">
                    <div class="feature-card h-100">
                        <div class="gap-3 d-flex">
                            <div class="feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 16l4-4H3V8l5-5h11a2 2 0 012 2v12a2 2 0 01-2 2H5l-2 2v-4z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-semibold text-dark">Livraison rapide</h5>
                                <p class="mb-0 small text-muted">
                                    Nous livrons rapidement partout au Togo grâce à notre logistique performante.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="col-md-4">
                    <div class="feature-card h-100">
                        <div class="gap-3 d-flex">
                            <div class="feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8c-1.657 0-3 1.343-3 3v3h6v-3c0-1.657-1.343-3-3-3z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6"
                                    />
                                </svg>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-semibold text-dark">Prix compétitifs</h5>
                                <p class="mb-0 small text-muted">
                                    Profitez des meilleurs tarifs sur des produits tendance et de qualité.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="col-md-4">
                    <div class="feature-card h-100">
                        <div class="gap-3 d-flex">
                            <div class="feature-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 11c.828 0 1.5-.672 1.5-1.5S12.828 8 12 8s-1.5.672-1.5 1.5S11.172 11 12 11z"
                                    />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M10 14h4" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-semibold text-dark">Paiement sécurisé</h5>
                                <p class="mb-0 small text-muted">
                                    Notre plateforme garantit des paiements sûrs et protégés à 100 %.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="main">@yield('content')</main>

    <footer class="py-4 mt-auto bg-light">
        <div class="container text-center">
            <div class="gap-4 mb-3 d-flex justify-content-center">
                <a
                    href="https://wa.me/22890171119"
                    target="_blank"
                    class="text-dark social-icon"
                    aria-label="WhatsApp"
                >
                    <i class="bi bi-whatsapp" style="font-size: 1.5rem"></i>
                </a>
                <a
                    href="https://www.instagram.com/globaldroptg"
                    target="_blank"
                    class="text-dark social-icon"
                    aria-label="Instagram"
                >
                    <i class="bi bi-instagram" style="font-size: 1.5rem"></i>
                </a>
                <a
                    href="https://www.facebook.com/share/19BrbhLzb2"
                    target="_blank"
                    class="text-dark social-icon"
                    aria-label="Facebook"
                >
                    <i class="bi bi-facebook" style="font-size: 1.5rem"></i>
                </a>
                <a
                    href="https://www.tiktok.com/@globaldrop2428"
                    target="_blank"
                    class="text-dark social-icon"
                    aria-label="TikTok"
                >
                    <i class="bi bi-tiktok" style="font-size: 1.5rem"></i>
                </a>
            </div>
            <small class="text-muted">&copy; {{ date('Y') }} GlobalDrop - La qualité au bout du clic.</small>
        </div>
    </footer>

    <a href="https://wa.me/22890171119" class="whatsapp-float" aria-label="Contact WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
            <path
                d="M20.52 3.48a11.91 11.91 0 0 0-16.84 0 11.91 11.91 0 0 0-2.55 12.93L2 21l4.69-1.23a11.92 11.92 0 0 0 13.83-16.29z"
            />
        </svg>
        Contact
    </a>

    <script>
        const messages = [
            "Livraison gratuite sur toutes les commandes",
            "Retour facile sous 30 jours",
            "Nouvelle collection disponible maintenant",
            "Profitez de 10% de réduction avec le code WELCOME",
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
