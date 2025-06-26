<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlobalDrop - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #a5b4fc;
            --secondary-color: #f59e0b;
            --accent-color: #10b981;
            --dark-color: #1f2937;
            --light-gray: #f8fafc;
            --medium-gray: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            --gradient-secondary: linear-gradient(135deg, var(--secondary-color) 0%, #ea580c 100%);
            --gradient-accent: linear-gradient(135deg, var(--accent-color) 0%, #059669 100%);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #ffffff;
            color: var(--dark-color);
            line-height: 1.6;
            font-weight: 400;
        }

        /* Utility Classes */
        .primary-color { color: var(--primary-color) !important; }
        .bg-primary-color { background: var(--gradient-primary) !important; }
        .border-primary-color { border-color: var(--primary-color) !important; }
        .text-gradient {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Enhanced Button Styles */
        .btn-primary-custom {
            background: var(--gradient-primary);
            border: none;
            color: white;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: white;
        }

        .btn-outline-primary-custom {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .btn-outline-primary-custom:hover {
            background: var(--gradient-primary);
            border-color: transparent;
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-success-custom {
            background: var(--gradient-accent);
            border: none;
            color: white;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        /* Header Styles */
        .announcement-bar {
            background: var(--gradient-primary);
            color: white;
            padding: 0.75rem 0;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .announcement-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .header-main {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 1030;
            transition: all 0.3s ease;
        }

        .header-main.scrolled {
            box-shadow: var(--shadow-lg);
            background: rgba(255, 255, 255, 0.98);
        }

        .logo-container {
            transition: transform 0.3s ease;
        }

        .logo-container:hover {
            transform: scale(1.05);
        }

        .search-container {
            position: relative;
        }

        .search-input {
            border: 2px solid var(--border-color);
            border-radius: 1rem;
            padding: 0.75rem 1rem 0.75rem 3rem;
            transition: all 0.3s ease;
            background: var(--light-gray);
            font-weight: 400;
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
            background: white;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--medium-gray);
            pointer-events: none;
        }

        /* Cart Icon */
        .cart-container {
            position: relative;
            transition: transform 0.3s ease;
        }

        .cart-container:hover {
            transform: scale(1.1);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--gradient-secondary);
            color: white;
            border-radius: 50%;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            min-width: 1.5rem;
            text-align: center;
            box-shadow: var(--shadow-md);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        /* Navigation */
        .nav-categories {
            background: var(--light-gray);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
        }

        .nav-link-custom {
            color: var(--dark-color);
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            white-space: nowrap;
        }

        .nav-link-custom:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Feature Cards */
        .features-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 4rem 0;
        }

        .feature-card {
            background: white;
            border-radius: 1.5rem;
            padding: 2rem;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 4rem;
            height: 4rem;
            background: var(--gradient-primary);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .feature-icon svg {
            width: 2rem;
            height: 2rem;
            color: white;
        }

        /* Welcome Box */
        .welcome-box {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 1rem;
            padding: 1rem 1.5rem;
            font-weight: 500;
        }

        /* Video Ad Banner */
        .video-ad-banner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .video-container {
            position: relative;
            max-width: 800px;
            width: 100%;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            background: white;
        }

        .video-close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 10;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            border: none;
            border-radius: 50%;
            width: 3rem;
            height: 3rem;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .video-close-btn:hover {
            background: rgba(0, 0, 0, 0.9);
            transform: scale(1.1);
        }

        .video-sound-btn {
            position: absolute;
            bottom: 1rem;
            right: 1rem;
            z-index: 10;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            border: none;
            border-radius: 2rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .video-sound-btn:hover {
            background: rgba(0, 0, 0, 0.9);
        }

        .video-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, rgba(0,0,0,0.6), rgba(99, 102, 241, 0.3));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            padding: 2rem;
        }

        .video-overlay h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
        }

        .video-overlay p {
            font-size: 1.25rem;
            font-weight: 500;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
        }

        /* WhatsApp Float */
        .whatsapp-float {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
            background: var(--gradient-accent);
            color: white;
            border-radius: 3rem;
            padding: 1rem 1.5rem;
            text-decoration: none;
            box-shadow: var(--shadow-xl);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .whatsapp-float:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            color: white;
            text-decoration: none;
        }

        /* Footer */
        .footer-main {
            background: linear-gradient(135deg, var(--dark-color) 0%, #374151 100%);
            color: white;
            padding: 3rem 0 1rem;
        }

        .social-icon {
            width: 3rem;
            height: 3rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .social-icon:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .announcement-bar {
                padding: 0.5rem 0;
                font-size: 0.875rem;
            }

            .header-main {
                padding: 1rem 0;
            }

            .search-container {
                margin: 1rem 0;
            }

            .nav-categories {
                padding: 0.5rem 0;
            }

            .nav-link-custom {
                font-size: 0.875rem;
                padding: 0.5rem 0.75rem;
            }

            .features-section {
                padding: 2rem 0;
            }

            .feature-card {
                padding: 1.5rem;
                margin-bottom: 1rem;
            }

            .feature-icon {
                width: 3rem;
                height: 3rem;
                margin-bottom: 1rem;
            }

            .feature-icon svg {
                width: 1.5rem;
                height: 1.5rem;
            }

            .video-overlay h2 {
                font-size: 1.5rem;
            }

            .video-overlay p {
                font-size: 1rem;
            }

            .whatsapp-float {
                bottom: 1rem;
                right: 1rem;
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
            }

            .welcome-box {
                text-align: center;
                margin: 0.5rem 0;
            }

            .btn-sm {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
                margin: 0.25rem;
            }
        }

        @media (max-width: 576px) {
            .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .feature-card {
                padding: 1rem;
            }

            .video-ad-banner {
                padding: 1rem;
            }

            .video-container {
                border-radius: 1rem;
            }
        }

        /* Loading Animation */
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Focus styles for accessibility */
        *:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* Main content area */
        main {
            flex: 1;
            padding-top: 2rem;
        }
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
                        <a href="{{ route('commandes.mes-commandes') }}" class="btn btn-main-outline btn-sm rounded-pill">
                                📋 Mes commandes
                            </a>

                            <a href="{{ route('Parrainage.index') }}" class="btn btn-outline-success btn-sm rounded-pill">
                                🎁 Mon lien de parrainage
                            </a>

                            <a href="{{ route('page') }}" class="btn btn-main-outline btn-sm rounded-pill">
                                🌐 Nous suivre
                            </a>

                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="small text-decoration-underline main-color">Déconnexion</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-main btn-sm rounded-pill">Se connecter</a>
                        <a href="{{ route('Parrainage.index') }}" class="btn btn-outline-success btn-sm rounded-pill">
                                🎁 Mon lien de parrainage
                            </a>

                            <a href="{{ route('page') }}" class="btn btn-main-outline btn-sm rounded-pill">
                                🌐 Nous suivre
                            </a>
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
    <nav class="bg-gray-100">
    <div class="flex px-4 py-2 mx-auto space-x-4 overflow-x-auto text-sm text-gray-700 max-w-7xl">
        @foreach (['Toutes', 'Mode & Accessoires', 'Pour Hommes', 'Pour Femmes'] as $cat)
            <a href="{{ route('produits.index', ['category' => $cat == 'Toutes' ? null : $cat]) }}"
               class="font-bold hover:text-[#9F7AEA] whitespace-nowrap">
                {{ $cat }}
            </a>
        @endforeach
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