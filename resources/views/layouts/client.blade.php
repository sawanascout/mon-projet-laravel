<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlobalDrop - La Qualité au Bout du Clic</title>
    <meta name="description" content="Découvrez GlobalDrop : livraison rapide, paiement sécurisé et produits tendance au meilleur prix au Togo.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --main-color: #ab3fd6;
        }
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-color { color: var(--main-color) !important; }
        .bg-main-color { background-color: var(--main-color) !important; }
        .border-main-color { border-color: var(--main-color) !important; }
        .btn-main-outline {
            color: var(--main-color);
            border-color: var(--main-color);
        }
        .btn-main-outline:hover {
            background-color: var(--main-color);
            border-color: var(--main-color);
            color: white;
        }
        .btn-main {
            background-color: var(--main-color);
            border-color: var(--main-color);
            color: white;
        }
        .btn-main:hover {
            filter: brightness(1.1);
        }
        .sticky-top { position: sticky; top: 0; z-index: 1020; }
        .header-shadow { box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 10px;
            font-weight: bold;
        }
        .social-icon {
            width: 24px;
            height: 24px;
            color: var(--main-color);
            transition: color 0.3s;
        }
        .social-icon:hover { text-decoration: none; }
        .whatsapp-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background-color: #25d366;
            color: white;
            border-radius: 50px;
            padding: 12px 20px;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .whatsapp-float:hover {
            background-color: #128c7e;
            color: white;
            text-decoration: none;
        }
        main { flex: 1; }
    </style>
</head>
<body class="bg-white text-dark">
<!-- Barre d'annonces -->
<div class="py-2 text-white bg-main-color">
    <div class="text-center container-fluid">
        <small id="carousel-text">Livraison rapide & Paiement 100% sécurisé au Togo 🇹🇬</small>
    </div>
</div>

<!-- Header -->
<header class="bg-white sticky-top header-shadow">
    <div class="py-3 container-fluid">
        <div class="row align-items-center">
            <div class="col-md-3 col-6">
                <a href="{{ route('produits.index') }}">
                    <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop" class="img-fluid" style="height: 40px;">
                </a>
            </div>
            <div class="col-md-4 d-none d-md-block">
                <form action="{{ route('produits.index') }}" method="GET">
                    <input type="text" name="search" class="form-control rounded-pill border-main-color" placeholder="Rechercher un produit...">
                </form>
            </div>
            <div class="col-md-5 col-6">
                <div class="flex-wrap gap-2 d-flex justify-content-end align-items-center">
                    @auth
                        <span class="small fw-semibold text-muted">👋 Bonjour, <span class="main-color">{{ auth()->user()->name }}</span></span>
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-success btn-sm">Dashboard</a>
                        @endif
                        <a href="{{ route('commandes.mes-commandes') }}" class="btn btn-main-outline btn-sm rounded-pill">📦 Mes commandes</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="small text-decoration-underline main-color">Déconnexion</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-main btn-sm rounded-pill">Se connecter</a>
                    @endauth
                    <a href="{{ route('cart.index') }}" class="position-relative text-decoration-none text-dark">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 00.9 1.3h10.9a1 1 0 00.9-1.3L17 13M7 13V6h10v7" />
                        </svg>
                        @if(session('panier') && count(session('panier')) > 0)
                            <span class="cart-badge">{{ count(session('panier')) }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
    <nav class="bg-light border-top">
        <div class="container-fluid">
            <div class="gap-3 py-2 overflow-auto d-flex">
                @foreach (['Toutes', 'Mode & Accessoires', 'Hommes', 'Femmes'] as $cat)
                    <a href="{{ route('produits.index', $cat == 'Toutes' ? ['all' => true] : ['category' => $cat]) }}" class="fw-bold main-color text-nowrap text-decoration-none">{{ $cat }}</a>
                @endforeach
            </div>
        </div>
    </nav>
</header>


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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16l4-4H3V8l5-5h11a2 2 0 012 2v12a2 2 0 01-2 2H5l-2 2v-4z" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-semibold text-dark">Livraison rapide</h5>
                            <p class="mb-0 small text-muted">Nous livrons rapidement partout au Togo grâce à notre logistique performante.</p>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3v3h6v-3c0-1.657-1.343-3-3-3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-semibold text-dark">Prix compétitifs</h5>
                            <p class="mb-0 small text-muted">Profitez des meilleurs tarifs sur des produits tendance et de qualité.</p>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c.828 0 1.5-.672 1.5-1.5S12.828 8 12 8s-1.5.672-1.5 1.5S11.172 11 12 11z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M10 14h4" />
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
    </div>
</section>

<div class="py-3 text-center bg-light">
    <small class="text-muted">
        &copy; {{ date('Y') }} Global Drop - La qualité au bout du clic, la sécurité en plus.
    </small>
</div>

<main>
    @yield('content')
</main>

<!-- Footer -->
<footer class="py-4 mt-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <!-- Réseaux sociaux -->
            <div class="col-md-3">
                <h5 class="mb-3 fw-semibold text-dark">Suivez-nous</h5>
                <div class="gap-3 d-flex">
                    <!-- WhatsApp -->
                    <a href="https://whatsapp.com/channel/0029VbAh2wrGZNCxxKYwbN3Q" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" class="social-icon text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.52 3.48a11.91 11.91 0 0 0-16.84 0 11.91 11.91 0 0 0-2.55 12.93L2 21l4.69-1.23a11.92 11.92 0 0 0 13.83-16.29zM12 19a7 7 0 0 1-3.68-1.03l-.26-.15-2.21.58.59-2.15-.17-.28A7 7 0 1 1 12 19zm3.44-4.33c-.2-.1-1.18-.58-1.36-.65s-.31-.1-.44.1-.51.65-.62.78-.23.15-.43.05a5.7 5.7 0 0 1-1.68-1.04 6.37 6.37 0 0 1-1.18-1.46c-.12-.2 0-.31.08-.41s.19-.23.29-.34a.5.5 0 0 0 .07-.46c-.07-.15-.44-1.06-.6-1.46s-.32-.34-.44-.34-.26-.02-.4-.02a.83.83 0 0 0-.6.29 2.55 2.55 0 0 0-.77 1.83 4.42 4.42 0 0 0 .84 2.11 9.14 9.14 0 0 0 4.32 3.71 5.09 5.09 0 0 0 2.26.39 3.54 3.54 0 0 0 2.26-1.44 3.68 3.68 0 0 0 .25-1.42c0-.24-.18-.34-.38-.44z"/>
                        </svg>
                    </a>

                    <!-- Instagram -->
                    <a href="https://www.instagram.com/globaldrop2025?igsh=bDNkMnVsc3R3YW9m&utm_source=qr" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="social-icon text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/>
                        </svg>
                    </a>

                    <!-- Facebook -->
                    <a href="https://www.facebook.com/share/19BrbhLzb2/" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="social-icon text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 5.006 3.657 9.128 8.438 9.878v-6.987H7.898v-2.89h2.54V9.845c0-2.507 1.493-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.772-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 17.006 22 12z"/>
                        </svg>
                    </a>

                    <!-- TikTok -->
                    <a href="http://www.tiktok.com/@globaldrop41" target="_blank" rel="noopener noreferrer" aria-label="TikTok" class="social-icon text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9.5 3C8.119 3 7 4.119 7 5.5v13C7 19.881 8.119 21 9.5 21s2.5-1.119 2.5-2.5v-5.671c.416.112.855.171 1.309.171 2.485 0 4.5-2.015 4.5-4.5V4h-2v4.5c0 1.378-1.122 2.5-2.5 2.5S11 9.878 11 8.5V5.5C11 4.119 9.881 3 8.5 3h-1z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-3 mt-4 text-center border-top">
        <small class="text-muted">
            &copy; {{ date('Y') }} Global Drop - La qualité au bout du clic, la sécurité en plus.
        </small>
    </div>
</footer>

<!-- Banner vidéo publicitaire -->
<div id="videoAdBanner" class="video-ad-banner d-none">
    <div class="px-4 container-fluid">
        <div class="border video-container border-primary">
            <!-- Bouton de fermeture -->
            <button id="closeVideoAd" class="video-close-btn">&times;</button>
            
            <!-- Bouton volume -->
            <button id="toggleSound" class="video-sound-btn">🔇 Son</button>

            <!-- Bloc cliquable -->
            <a href="http://www.tiktok.com/@globaldrop41" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                <video id="adVideo" autoplay muted loop class="w-100" style="max-height: 400px; object-fit: cover;">
                    <source src="{{ asset('videos/ma-video.mp4') }}" type="video/mp4">
                    Votre navigateur ne prend pas en charge la lecture vidéo.
                </video>

                <!-- Texte superposé -->
                <div class="video-overlay">
                    <h2>🔥 Découvrez nos offres exclusives sur TikTok !</h2>
                    <p>⚡ Dépêchez-vous, les stocks sont limités !</p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Bouton WhatsApp flottant -->
<a href="https://wa.me/22890171179" target="_blank" class="whatsapp-float">
    <!-- Icône WhatsApp -->
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
        <path d="M20.52 3.48a11.91 11.91 0 0 0-16.84 0 11.91 11.91 0 0 0-2.55 12.93L2 21l4.69-1.23a11.92 11.92 0 0 0 13.83-16.29zM12 19a7 7 0 0 1-3.68-1.03l-.26-.15-2.21.58.59-2.15-.17-.28A7 7 0 1 1 12 19zm3.44-4.33c-.2-.1-1.18-.58-1.36-.65s-.31-.1-.44.1-.51.65-.62.78-.23.15-.43.05a5.7 5.7 0 0 1-1.68-1.04 6.37 6.37 0 0 1-1.18-1.46c-.12-.2 0-.31.08-.41s.19-.23.29-.34a.5.5 0 0 0 .07-.46c-.07-.15-.44-1.06-.6-1.46s-.32-.34-.44-.34-.26-.02-.4-.02a.83.83 0 0 0-.6.29 2.55 2.55 0 0 0-.77 1.83 4.42 4.42 0 0 0 .84 2.11 9.14 9.14 0 0 0 4.32 3.71 5.09 5.09 0 0 0 2.26.39 3.54 3.54 0 0 0 2.26-1.44 3.68 3.68 0 0 0 .25-1.42c0-.24-.18-.34-.38-.44z"/>
    </svg>
    Contactez nous
</a>

<!-- Scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Scripts personnalisés -->
<script>
    // Carousel des messages
    const messages = [
        "Livraison gratuite sur toutes les commandes",
        "Retour facile sous 30 jours",
        "Nouvelle collection disponible maintenant",
        "Profitez de 10% de réduction avec le code WELCOME"
    ];

    let currentMessage = 0;
    const carouselElement = document.getElementById("carousel-text");

    function rotateMessages() {
        currentMessage = (currentMessage + 1) % messages.length;
        if (carouselElement) {
            carouselElement.textContent = messages[currentMessage];
        }
    }

    setInterval(rotateMessages, 4000); // Change toutes les 4 secondes

    // Gestion de la bannière vidéo
    const adBanner = document.getElementById('videoAdBanner');
    const closeBtn = document.getElementById('closeVideoAd');
    const toggleSoundBtn = document.getElementById('toggleSound');
    const video = document.getElementById('adVideo');

    // Affiche la pub après 15 secondes
    setTimeout(() => {
        adBanner.classList.remove('d-none');
    }, 15000);

    // Fermer la pub et la faire réapparaître après 60 secondes
    closeBtn.addEventListener('click', () => {
        adBanner.classList.add('d-none');
        setTimeout(() => {
            adBanner.classList.remove('d-none');
        }, 60000);
    });

    // Activer/Désactiver le son
    toggleSoundBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        if (video.muted) {
            video.muted = false;
            video.volume = 1;
            video.play(); // redémarrer pour assurer la prise en compte
            toggleSoundBtn.textContent = '🔊 Muet';
        } else {
            video.muted = true;
            toggleSoundBtn.textContent = '🔇 Son';
        }
    });
</script>

@stack('scripts')

</body>
</html>