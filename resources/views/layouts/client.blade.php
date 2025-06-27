<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GlobalDrop - @yield('title', 'Accueil')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --gd-primary: #ab3fd6;
            --gd-primary-dark: #7b26a3;
            --gd-white: #fff;
            --gd-light-gray: #f8f9fa;
            --gd-text-dark: #333;
            --gd-text-muted: #666;
            --gd-border-light: #ddd;
            --gd-radius-lg: 25px;
            --gd-radius-sm: 6px;
            --gd-font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Reset and base */
        body {
            font-family: var(--gd-font-family);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            background-color: var(--gd-white);
            color: var(--gd-text-dark);
        }

        /* Top bar */
        .gd-topbar {
            background-color: var(--gd-primary);
            color: var(--gd-white);
            padding: 0.5rem 1rem;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Navbar */
        nav.gd-navbar {
            background-color: var(--gd-white);
            box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
            position: sticky;
            top: 0;
            z-index: 1030;
        }
        nav.gd-navbar .gd-navbar-container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .gd-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: var(--gd-text-dark);
            font-weight: 700;
            font-size: 1.25rem;
            user-select: none;
        }
        .gd-logo img {
            height: 40px;
            border-radius: var(--gd-radius-sm);
            box-shadow: 0 2px 6px rgb(0 0 0 / 0.15);
        }

        /* Navbar toggler */
        .gd-navbar-toggler {
            border: none;
            background: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gd-primary);
            display: none;
        }

        /* Search bar */
        .gd-searchbar {/*
            flex: 1 1 300px;
            max-width: 400px;
            display: flex;
            margin: 0.5rem 1rem;*/
            flex-grow: 1;
            max-width: 300px;
            margin: 0.5rem 1rem;
            flex: 1 1 300px;


        }
        .gd-searchbar input[type="text"] {
            flex-grow: 1;
            padding: 0.5rem 1rem;
            border: 2px solid var(--gd-primary);
            border-right: none;
            border-radius: var(--gd-radius-lg) 0 0 var(--gd-radius-lg);
            font-size: 1rem;
            outline-offset: 2px;
            transition: box-shadow 0.3s ease;
        }
        .gd-searchbar input[type="text"]:focus {
            box-shadow: 0 0 8px var(--gd-primary);
            border-color: var(--gd-primary-dark);
        }
        .gd-searchbar button {
            background-color: var(--gd-primary);
            color: var(--gd-white);
            border: 2px solid var(--gd-primary);
            border-radius: 0 var(--gd-radius-lg) var(--gd-radius-lg) 0;
            padding: 0 1rem;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .gd-searchbar button:hover,
        .gd-searchbar button:focus {
            background-color: var(--gd-primary-dark);
            border-color: var(--gd-primary-dark);
        }

        /* Nav menu */
        .gd-nav-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: nowrap;
        }
        .gd-nav-item {
            list-style: none;
        }
        .gd-nav-link {
            text-decoration: none;
            color: var(--gd-text-dark);
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .gd-nav-link:hover,
        .gd-nav-link:focus {
            color: var(--gd-primary);
            outline: none;
        }
        .gd-btn-primary {
            background-color: var(--gd-primary);
            color: var(--gd-white);
            border-radius: var(--gd-radius-lg);
            padding: 0.35rem 1rem;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .gd-btn-primary:hover,
        .gd-btn-primary:focus {
            background-color: var(--gd-primary-dark);
            outline: none;
        }
        .gd-btn-outline-primary {
            border: 2px solid var(--gd-primary);
            color: var(--gd-primary);
            border-radius: var(--gd-radius-lg);
            padding: 0.35rem 1rem;
            background: transparent;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .gd-btn-outline-primary:hover,
        .gd-btn-outline-primary:focus {
            background-color: var(--gd-primary);
            color: var(--gd-white);
            outline: none;
        }

        /* Badge panier */
        .gd-cart-icon {
            position: relative;
            font-size: 1.5rem;
            color: var(--gd-text-dark);
            cursor: pointer;
        }
        .gd-cart-badge {
            position: absolute;
            top: -6px;
            right: -10px;
            background-color: #dc3545;
            color: var(--gd-white);
            border-radius: 50%;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 2px 6px;
            user-select: none;
        }

        /* Categories pills */
        .gd-category-nav {
            background-color: var(--gd-light-gray);
            border-top: 1px solid var(--gd-border-light);
            border-bottom: 1px solid var(--gd-border-light);
            padding: 0.5rem 0;
            overflow-x: auto;
        }
        .gd-category-list {
            display: flex;
            gap: 1rem;
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 1rem;
            white-space: nowrap;
        }
        .gd-category-link {
            padding: 0.4rem 1rem;
            border-radius: var(--gd-radius-lg);
            text-decoration: none;
            font-weight: 600;
            color: var(--gd-text-muted);
            background-color: transparent;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            user-select: none;
            display: inline-block;
        }
        .gd-category-link.active,
        .gd-category-link:hover,
        .gd-category-link:focus {
            background-color: var(--gd-primary);
            border-color: var(--gd-primary);
            color: var(--gd-white);
            outline: none;
        }

        /* Features section */
        .gd-features {
            padding: 3rem 1rem;
            max-width: 1140px;
            margin: 0 auto;
            background-color: var(--gd-white);
            border-top: 1px solid var(--gd-border-light);
            border-bottom: 1px solid var(--gd-border-light);
        }
        .gd-features h2 {
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            color: var(--gd-primary);
            font-size: 2rem;
        }
        .gd-feature-card {
            background: #fff;
            border-radius: var(--gd-radius-sm);
            box-shadow: 0 1px 6px rgb(0 0 0 / 0.1);
            padding: 1.5rem;
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            transition: box-shadow 0.3s ease;
            height: 100%;
        }
        .gd-feature-card:hover,
        .gd-feature-card:focus-within {
            box-shadow: 0 4px 12px rgb(171 63 214 / 0.3);
            outline: none;
        }
        .gd-feature-icon svg {
            width: 36px;
            height: 36px;
            stroke: var(--gd-primary);
            flex-shrink: 0;
        }
        .gd-feature-content h5 {
            margin: 0 0 0.25rem;
            font-weight: 700;
            color: var(--gd-text-dark);
        }
        .gd-feature-content p {
            margin: 0;
            color: var(--gd-text-muted);
            font-size: 0.9rem;
            line-height: 1.3;
        }

        /* Footer */
        footer.gd-footer {
            background-color: var(--gd-light-gray);
            padding: 1.5rem 1rem;
            margin-top: auto;
            text-align: center;
            font-size: 0.9rem;
            color: var(--gd-text-muted);
            user-select: none;
        }
        footer.gd-footer .gd-social-icons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 1rem;
        }
        footer.gd-footer .gd-social-icon {
            color: var(--gd-primary);
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }
        footer.gd-footer .gd-social-icon:hover,
        footer.gd-footer .gd-social-icon:focus {
            color: var(--gd-primary-dark);
            outline: none;
        }

        /* WhatsApp floating button */
        .gd-whatsapp-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25d366;
            color: white;
            padding: 10px 16px;
            border-radius: 40px;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 3px 6px rgb(0 0 0 / 0.3);
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            user-select: none;
            z-index: 1100;
            transition: background-color 0.3s ease;
        }
        .gd-whatsapp-float:hover,
        .gd-whatsapp-float:focus {
            background-color: #1ebe57;
            outline: none;
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .gd-navbar-toggler {
                display: block;
            }
            .gd-navbar-collapse {
                flex-basis: 100%;
                display: none;
                margin-top: 0.5rem;
            }
            .gd-navbar-collapse.show {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }
            .gd-nav-menu {
                flex-direction: column;
                gap: 0.75rem;
                margin-top: 0.5rem;
            }
            .gd-searchbar {
                max-width: 100%;
                margin: 0;
            }
        }

        /* Cart badge small on mobile */
        @media (max-width: 575.98px) {
            .gd-cart-badge {
                font-size: 0.6rem;
                padding: 1px 4px;
                top: -4px;
                right: -6px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="gd-topbar" role="region" aria-label="Informations importantes">
            <span id="gd-carousel-text" aria-live="polite">Livraison rapide & Paiement 100% sécurisé au Togo 🇹🇬</span>
        </div>

        <nav class="gd-navbar" role="navigation" aria-label="Navigation principale">
            <div class="gd-navbar-container">
                <a href="{{ route('produits.index') }}" class="gd-logo">
                    <img src="{{ asset('images/globaldrop.jpg') }}" alt="Logo GlobalDrop" />
                    GlobalDrop
                </a>

                <button class="gd-navbar-toggler" type="button" aria-expanded="false" aria-controls="gd-navbar-menu" aria-label="Basculer le menu de navigation">
                    <i class="bi bi-list"></i>
                </button>

                <div class="gd-navbar-collapse" id="gd-navbar-menu">
                    <form action="{{ route('produits.index') }}" method="GET" class="gd-searchbar" role="search" aria-label="Recherche de produit">
                        <input
                            type="text"
                            name="search"
                            placeholder="Rechercher un produit..."
                            value="{{ request('search') }}"
                            aria-label="Champ de recherche"
                            autocomplete="off"
                        />
                        <button type="submit" aria-label="Lancer la recherche">🔍</button>
                    </form>

                    <ul class="gd-nav-menu" role="menubar">
                        @auth
                            <li class="gd-nav-item" role="none">
                                <span class="gd-nav-link" role="menuitem" tabindex="0">👋 Bonjour, <strong class="text-primary">{{ auth()->user()->name }}</strong></span>
                            </li>
                            @if (auth()->user()->role === 'admin')
                                <li class="gd-nav-item" role="none">
                                    <a href="{{ route('admin.dashboard') }}" class="gd-nav-link" role="menuitem" tabindex="0">Dashboard</a>
                                </li>
                            @endif
                            <li class="gd-nav-item" role="none">
                                <a href="{{ route('commandes.mes-commandes') }}" class="gd-nav-link" role="menuitem" tabindex="0">Commandes</a>
                            </li>
                            <li class="gd-nav-item" role="none">
                                <a href="{{ route('Parrainage.index') }}" class="gd-nav-link" role="menuitem" tabindex="0">Parrainage</a>
                            </li>
                            <li class="gd-nav-item" role="none">
                                <a href="{{ route('page') }}" class="gd-nav-link" role="menuitem" tabindex="0">🌐 Nous suivre</a>
                            </li>
                            <li class="gd-nav-item" role="none">
                                <a
                                    href="{{ route('logout') }}"
                                    class="gd-nav-link text-danger"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    role="menuitem"
                                    tabindex="0"
                                >Déconnexion</a>
                                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">@csrf</form>
                            </li>
                        @else
                            <li class="gd-nav-item" role="none">
                                <a href="{{ route('login') }}" class="gd-btn-primary" role="menuitem" tabindex="0">Connexion</a>
                            </li>
                            <li class="gd-nav-item" role="none">
                                <a href="{{ route('Parrainage.index') }}" class="gd-btn-outline-primary" role="menuitem" tabindex="0">🎁 Parrainage</a>
                            </li>
                            <li class="gd-nav-item" role="none">
                                <a href="{{ route('page') }}" class="gd-btn-outline-primary" role="menuitem" tabindex="0">🌐 Nous suivre</a>
                            </li>
                        @endauth

                        <li class="gd-nav-item" role="none">
                            <a href="{{ route('cart.index') }}" class="gd-cart-icon" role="menuitem" tabindex="0" aria-label="Voir le panier">
                                <i class="bi bi-cart3"></i>
                                @if(session('panier') && count(session('panier')) > 0)
                                    <span class="gd-cart-badge" aria-live="polite">{{ count(session('panier')) }}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <nav class="gd-category-nav" aria-label="Navigation catégories">
            <ul class="gd-category-list" role="menubar">
                @php
                    $currentCategory = request('category') ?? 'Toutes';
                @endphp
                @foreach (['Toutes', 'Mode & Accessoires', 'Pour Hommes', 'Pour Femmes'] as $cat)
                    <li role="none">
                        <a
                            href="{{ route('produits.index', ['category' => $cat === 'Toutes' ? null : $cat]) }}"
                            class="gd-category-link @if($cat === $currentCategory) active @endif"
                            role="menuitem"
                            tabindex="0"
                        >
                            {{ $cat }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </header>

    <section class="gd-features" aria-label="Pourquoi choisir GlobalDrop">
        <h2>Pourquoi <span>choisir GlobalDrop</span> ?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <article class="gd-feature-card" tabindex="0" aria-label="Livraison rapide">
                    <div class="gd-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" focusable="false">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16l4-4H3V8l5-5h11a2 2 0 012 2v12a2 2 0 01-2 2H5l-2 2v-4z" />
                        </svg>
                    </div>
                    <div class="gd-feature-content">
                        <h5>Livraison rapide</h5>
                        <p>Nous livrons rapidement partout au Togo grâce à notre logistique performante.</p>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <article class="gd-feature-card" tabindex="0" aria-label="Prix compétitifs">
                    <div class="gd-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" focusable="false">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3v3h6v-3c0-1.657-1.343-3-3-3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6" />
                        </svg>
                    </div>
                    <div class="gd-feature-content">
                        <h5>Prix compétitifs</h5>
                        <p>Profitez des meilleurs tarifs sur des produits tendance et de qualité.</p>
                    </div>
                </article>
            </div>
            <div class="col-md-4">
                <article class="gd-feature-card" tabindex="0" aria-label="Paiement sécurisé">
                    <div class="gd-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" focusable="false">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c.828 0 1.5-.672 1.5-1.5S12.828 8 12 8s-1.5.672-1.5 1.5S11.172 11 12 11z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M10 14h4" />
                        </svg>
                    </div>
                    <div class="gd-feature-content">
                        <h5>Paiement sécurisé</h5>
                        <p>Notre plateforme garantit des paiements sûrs et protégés à 100 %.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <main class="gd-main-content">@yield('content')</main>

    <footer class="gd-footer" role="contentinfo">
        <div class="gd-social-icons" role="list">
            <a href="https://wa.me/22890171119" target="_blank" class="gd-social-icon" aria-label="WhatsApp" role="listitem" rel="noopener noreferrer">
                <i class="bi bi-whatsapp"></i>
            </a>
            <a href="https://www.instagram.com/globaldroptg" target="_blank" class="gd-social-icon" aria-label="Instagram" role="listitem" rel="noopener noreferrer">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="https://www.facebook.com/share/19BrbhLzb2" target="_blank" class="gd-social-icon" aria-label="Facebook" role="listitem" rel="noopener noreferrer">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="https://www.tiktok.com/@globaldrop2428" target="_blank" class="gd-social-icon" aria-label="TikTok" role="listitem" rel="noopener noreferrer">
                <i class="bi bi-tiktok"></i>
            </a>
        </div>
        <small>&copy; {{ date('Y') }} GlobalDrop - La qualité au bout du clic.</small>
    </footer>

    <a href="https://wa.me/22890171119" class="gd-whatsapp-float" aria-label="Contact WhatsApp GlobalDrop" target="_blank" rel="noopener noreferrer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false">
            <path d="M20.52 3.48a11.91 11.91 0 0 0-16.84 0 11.91 11.91 0 0 0-2.55 12.93L2 21l4.69-1.23a11.92 11.92 0 0 0 13.83-16.29z" />
        </svg>
        Contact
    </a>

    <script>
        // Navbar toggler mobile
        const toggler = document.querySelector('.gd-navbar-toggler');
        const menu = document.getElementById('gd-navbar-menu');

        toggler.addEventListener('click', () => {
            const expanded = toggler.getAttribute('aria-expanded') === 'true' || false;
            toggler.setAttribute('aria-expanded', !expanded);
            menu.classList.toggle('show');
        });

        // Carousel text messages
        const messages = [
            "Livraison gratuite sur toutes les commandes",
            "Retour facile sous 30 jours",
            "Nouvelle collection disponible maintenant",
            "Profitez de 10% de réduction avec le code WELCOME",
        ];
        let currentIndex = 0;
        const carouselText = document.getElementById('gd-carousel-text');

        setInterval(() => {
            currentIndex = (currentIndex + 1) % messages.length;
            carouselText.textContent = messages[currentIndex];
        }, 4000);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
