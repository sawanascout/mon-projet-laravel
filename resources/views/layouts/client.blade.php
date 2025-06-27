<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>GlobalDrop - @yield('title', 'Accueil')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])    

    <style>
        :root {
            --main-color: #ab3fd6;
            --main-hover: #952dbf;
            --light-bg: #f8f9fa;
        }
        body {
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: white;
            color: #222;
            margin: 0;
        }
        main {
            flex: 1 0 auto;
        }

        /* Couleurs principales */
        .main-color {
            color: var(--main-color) !important;
        }
        .bg-main-color {
            background-color: var(--main-color) !important;
        }
        .border-main-color {
            border-color: var(--main-color) !important;
        }
        .btn-main-outline {
            color: var(--main-color);
            border-color: var(--main-color);
            transition: all 0.3s ease;
        }
        .btn-main-outline:hover,
        .btn-main-outline:focus {
            background-color: var(--main-color);
            color: white;
            border-color: var(--main-color);
        }
        .btn-main {
            background-color: var(--main-color);
            border-color: var(--main-color);
            color: white;
            transition: background-color 0.3s ease;
        }
        .btn-main:hover,
        .btn-main:focus {
            background-color: var(--main-hover);
            border-color: var(--main-hover);
            color: white;
        }
        /* Sticky header */
        .sticky-top {
            position: sticky;
            top: 0;
            z-index: 1030;
            background: white;
            box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
        }

        /* Badge panier */
        .cart-badge {
            position: absolute;
            top: 2px;
            right: 0;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 7px;
            font-size: 11px;
            font-weight: 700;
            line-height: 1;
        }

        /* Social icons */
        .social-icon svg {
            width: 24px;
            height: 24px;
            color: var(--main-color);
            transition: color 0.3s ease;
        }
        .social-icon:hover svg {
            color: var(--main-hover);
        }

        /* WhatsApp flottant */
        .whatsapp-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
            background-color: #25d366;
            color: white;
            border-radius: 50px;
            padding: 10px 18px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            user-select: none;
            transition: background-color 0.3s ease;
        }
        .whatsapp-float:hover {
            background-color: #128c7e;
            text-decoration: none;
            color: white;
        }

        /* Banner vidéo */
        .video-ad-banner {
            position: fixed;
            top: 56px; /* hauteur header */
            left: 0;
            width: 100%;
            z-index: 1040;
            display: flex;
            justify-content: center;
            padding: 10px 15px;
        }
        .video-container {
            position: relative;
            max-width: 600px;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            background: black;
        }
        .video-close-btn,
        .video-sound-btn {
            position: absolute;
            z-index: 20;
            background-color: rgba(0,0,0,0.6);
            border: none;
            border-radius: 50%;
            color: white;
            width: 34px;
            height: 34px;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s ease;
        }
        .video-close-btn:hover,
        .video-sound-btn:hover {
            background-color: rgba(0,0,0,0.9);
        }
        .video-close-btn {
            top: 10px;
            right: 10px;
        }
        .video-sound-btn {
            bottom: 10px;
            right: 10px;
            border-radius: 20px;
            width: auto;
            padding: 4px 12px;
            font-size: 14px;
        }
        .video-overlay {
            position: absolute;
            inset: 0;
            background-color: rgba(0,0,0,0.4);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
            user-select: none;
        }
        .video-overlay h2 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 6px;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.8);
        }
        .video-overlay p {
            font-size: 1.1rem;
            font-weight: 500;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
        }

        /* Section pourquoi choisir */
        .feature-card {
            background-color: var(--light-bg);
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            transition: box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            gap: 12px;
            align-items: center;
        }
        .feature-card:hover {
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        .feature-icon {
            background-color: rgba(171, 63, 214, 0.1);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
        }
        .feature-icon svg {
            width: 26px;
            height: 26px;
            color: var(--main-color);
        }

        /* Header : formulaire recherche adaptatif */
        @media (max-width: 767.98px) {
            header .col-md-4 {
                display: none !important;
            }
            header .col-md-5 {
                justify-content: flex-end !important;
            }
            .search-mobile {
                display: block;
                padding: 0 15px 10px 15px;
                background-color: var(--light-bg);
            }
            .search-mobile form input {
                width: 100%;
                border-radius: 30px;
                border: 1.5px solid var(--main-color);
                padding: 10px 15px;
                font-size: 14px;
            }
        }
        @media (min-width: 768px) {
            .search-mobile {
                display: none;
            }
        }
    </style>
</head>
<body>

<!-- Barre d'annonces -->
<div class="py-2 text-center text-white bg-main-color small">
    <div class="container">
        <span id="carousel-text">Livraison rapide & Paiement 100% sécurisé au Togo 🇹🇬</span>
    </div>
</div>

<!-- Header -->
<header class="sticky-top">
    <div class="py-3 bg-white shadow-sm container-fluid">
        <div class="row align-items-center gx-3">
            <div class="col-6 col-md-3">
                <a href="{{ route('produits.index') }}">
                    <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop" class="img-fluid" style="height: 40px;">
                </a>
            </div>

            <div class="col-md-4 d-none d-md-block">
                <form action="{{ route('produits.index') }}" method="GET" role="search">
                    <input type="search" name="search" placeholder="Rechercher un produit..." class="form-control rounded-pill border-main-color" />
                </form>
            </div>

            <div class="flex-wrap gap-2 col-md-5 col-6 d-flex justify-content-end align-items-center">
                @auth
                    <span class="small fw-semibold text-muted d-none d-sm-inline">👋 Bonjour, <span class="main-color">{{ auth()->user()->name }}</span></span>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-success btn-sm">Dashboard</a>
                    @endif
                    <a href="{{ route('commandes.mes-commandes') }}" class="btn btn-main-outline btn-sm rounded-pill">📦 Mes commandes</a>
                    <a href="{{ route('Parrainage.index') }}" class="btn btn-outline-success btn-sm rounded-pill">🎁 Mon lien de parrainage</a>
                    <a href="{{ route('page') }}" class="btn btn-main-outline btn-sm rounded-pill">🌐 Nous suivre</a>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="small text-decoration-underline main-color">
                        Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-main btn-sm rounded-pill">Se connecter</a>
                    <a href="{{ route('Parrainage.index') }}" class="btn btn-outline-success btn-sm rounded-pill">🎁 Mon lien de parrainage</a>
                    <a href="{{ route('page') }}" class="btn btn-main-outline btn-sm rounded-pill">🌐 Nous suivre</a>
                @endauth
                <a href="{{ route('cart.index') }}" class="position-relative text-dark text-decoration-none" aria-label="Panier">
                    <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 00.9 1.3h10.9a1 1 0 00.9-1.3L17 13M7 13V6h10v7" />
                    </svg>
                    @if(session('panier') && count(session('panier')) > 0)
                        <span class="cart-badge" aria-live="polite">{{ count(session('panier')) }}</span>
                    @endif
                </a>
            </div>
        </div>

        <!-- Recherche mobile -->
        <div class="mt-2 search-mobile">
            <form action="{{ route('produits.index') }}" method="GET" role="search">
                <input type="search" name="search" placeholder="Rechercher un produit..." autocomplete="off" />
            </form>
        </div>
    </div>

    <!-- Menu catégories -->
    <nav class="bg-light border-top border-bottom">
        <div class="container gap-3 py-2 overflow-auto d-flex">
            @foreach(['Toutes', 'Mode & Accessoires', 'Pour Hommes', 'Pour Femmes'] as $cat)
                <a href="{{ route('produits.index', ['category' => $cat === 'Toutes' ? null : $cat]) }}"
                   class="border-0 btn btn-sm rounded-pill fw-bold text-truncate text-nowrap"
                   style="min-width: 110px; color:#555;"
                   onmouseover="this.style.backgroundColor='var(--main-color)'; this.style.color='white';"
                   onmouseout="this.style.backgroundColor=''; this.style.color='#555';">
                    {{ $cat }}
                </a>
            @endforeach
        </div>
    </nav>
</header>

<main class="container my-4">
    @yield('content')
</main>

<!-- Pourquoi choisir GlobalDrop -->
<section class="py-5 bg-white border-top border-bottom">
    <div class="container">
        <h2 class="mb-4 text-center fw-bold">
            Pourquoi <span class="main-color">choisir GlobalDrop</span> ?
        </h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M3 16l4-4H3V8l5-5h11a2 2 0 012 2v12a2 2 0 01-2 2H5l-2 2v-4z"/>
                        </svg>
                    </div>
                    <div>
                        <h5 class="mb-1 fw-semibold text-dark">Livraison rapide</h5>
                        <p class="mb-0 small text-muted">Nous livrons rapidement partout au Togo grâce à notre logistique performante.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 8c-1.657 0-3 1.343-3 3v3h6v-3c0-1.657-1.343-3-3-3z"/>
                            <path d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6"/>
                        </svg>
                    </div>
                    <div>
                        <h5 class="mb-1 fw-semibold text-dark">Prix compétitifs</h5>
                        <p class="mb-0 small text-muted">Profitez des meilleurs tarifs sur des produits tendance et de qualité.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 11c.828 0 1.5-.672 1.5-1.5S12.828 8 12 8s-1.5.672-1.5 1.5S11.172 11 12 11z"/>
                            <path d="M4 6h16M4 10h16M10 14h4"/>
                        </svg>
                    </div>
                    <div>
                        <h5 class="mb-1 fw-semibold text-dark">Paiement sécurisé</h5>
                        <p class="mb-0 small text-muted">Notre plateforme garantit des paiements sûrs et protégés à 100 %.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="py-4 mt-auto bg-light">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-3">
                <h5 class="mb-3 fw-semibold">Suivez-nous</h5>
                <div class="gap-3 d-flex">
                    <a href="https://whatsapp.com/channel/0029VbAh2wrGZNCxxKYwbN3Q" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" class="social-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20.52 3.48a11.91 11.91 0 0 0-16.84 0 11.91 11.91 0 0 0-2.55 12.93L2 21l4.69-1.23a11.92 11.92 0 0 0 13.83-16.29zM12 19a7 7 0 0 1-3.68-1.03l-.26-.15-2.21.58.59-2.15-.16-.27A7 7 0 1 1 12 19z"/>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/globaldrop" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="social-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37a4 4 0 1 1-7.94 1.06 4 4 0 0 1 7.94-1.06z"/>
                            <line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/globaldrop" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="social-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M22 12a10 10 0 1 0-11.5 9.87v-7h-2v-3h2v-2a3 3 0 0 1 3-3h2v3h-2a1 1 0 0 0-1 1v2h3l-1 3h-2v7A10 10 0 0 0 22 12z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-md-9 text-muted small">
                &copy; 2025 GlobalDrop. Tous droits réservés.
            </div>
        </div>
    </div>
</footer>

<!-- WhatsApp flottant -->
<a href="https://wa.me/22898300220" class="whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Contact WhatsApp">
    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" aria-hidden="true" style="width:20px; height:20px;">
        <path d="M20.52 3.48a11.91 11.91 0 0 0-16.84 0 11.91 11.91 0 0 0-2.55 12.93L2 21l4.69-1.23a11.92 11.92 0 0 0 13.83-16.29zM12 19a7 7 0 0 1-3.68-1.03l-.26-.15-2.21.58.59-2.15-.16-.27A7 7 0 1 1 12 19z"/>
    </svg>
    Contact WhatsApp
</a>

<!-- Bannière vidéo publicitaire -->
<div class="video-ad-banner" id="videoAdBanner" aria-live="polite" aria-label="Vidéo publicitaire">
    <div class="video-container" role="region" aria-label="Vidéo publicitaire GlobalDrop">
        <video id="adVideo" muted autoplay loop playsinline>
            <source src="{{ asset('videos/ban_video.mp4') }}" type="video/mp4" />
            Votre navigateur ne supporte pas la lecture vidéo.
        </video>
        <button type="button" class="video-close-btn" aria-label="Fermer la vidéo" onclick="closeAdVideo()">&times;</button>
        <button type="button" class="video-sound-btn" aria-pressed="false" aria-label="Activer le son" onclick="toggleSound()">
            🔇
        </button>
        <div class="video-overlay">
            <h2>Livraison gratuite au Togo 🇹🇬</h2>
            <p>Paiement 100% sécurisé & 3x sans frais</p>
        </div>
    </div>
</div>

<script>
    const videoBanner = document.getElementById('videoAdBanner');
    const adVideo = document.getElementById('adVideo');
    const soundBtn = document.querySelector('.video-sound-btn');

    // Fermer la vidéo
    function closeAdVideo() {
        videoBanner.style.display = 'none';
        adVideo.pause();
    }

    // Activer / désactiver le son
    function toggleSound() {
        if(adVideo.muted){
            adVideo.muted = false;
            soundBtn.textContent = '🔊';
            soundBtn.setAttribute('aria-pressed', 'true');
            soundBtn.setAttribute('aria-label', 'Désactiver le son');
        } else {
            adVideo.muted = true;
            soundBtn.textContent = '🔇';
            soundBtn.setAttribute('aria-pressed', 'false');
            soundBtn.setAttribute('aria-label', 'Activer le son');
        }
    }

    // Affiche la vidéo après 2s seulement
    window.addEventListener('load', () => {
        setTimeout(() => {
            videoBanner.style.display = 'flex';
        }, 2000);
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
