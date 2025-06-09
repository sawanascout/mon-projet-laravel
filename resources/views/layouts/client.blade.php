<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GLOBALDROP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS CDN (ou en local si tu préfères) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Tes propres styles optionnels --}}
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            padding-top: 70px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="bg-white text-gray-900 flex flex-col min-h-screen">

    {{-- Barre de navigation --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Mon E-commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client.profil') }}">Mon Profil</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit">Déconnexion</button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
<div class="bg-[color:var(--main-color)] text-white text-sm py-2">
    <div class="max-w-7xl mx-auto px-4 flex justify-center items-center">
        <span id="carousel-text">Livraison gratuite sur toutes les commandes</span>
    </div>
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
</script>
    <section class="mt-6 py-6 bg-white border-t border-b border-gray-200">
    <div class="max-w-6xl mx-auto px-4 md:px-8">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 text-center mb-6">
            Pourquoi <span class="text-[#ab3fd6]">choisir GlobalDrop</span> ?
        </h2>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <!-- Item 1 -->
            <div class="flex items-start gap-4 bg-gray-50 rounded-xl p-4 shadow-sm flex-1 border hover:shadow-md transition">
                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-[#ab3fd6]/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#ab3fd6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16l4-4H3V8l5-5h11a2 2 0 012 2v12a2 2 0 01-2 2H5l-2 2v-4z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-800 mb-1">Livraison rapide</h3>
                    <p class="text-xs text-gray-600">Nous livrons rapidement partout au Togo grâce à notre logistique performante.</p>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="flex items-start gap-4 bg-gray-50 rounded-xl p-4 shadow-sm flex-1 border hover:shadow-md transition">
                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-[#ab3fd6]/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#ab3fd6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3v3h6v-3c0-1.657-1.343-3-3-3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-800 mb-1">Prix compétitifs</h3>
                    <p class="text-xs text-gray-600">Profitez des meilleurs tarifs sur des produits tendance et de qualité.</p>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="flex items-start gap-4 bg-gray-50 rounded-xl p-4 shadow-sm flex-1 border hover:shadow-md transition">
                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-[#ab3fd6]/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#ab3fd6]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c.828 0 1.5-.672 1.5-1.5S12.828 8 12 8s-1.5.672-1.5 1.5S11.172 11 12 11z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M10 14h4" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-800 mb-1">Paiement sécurisé</h3>
                    <p class="text-xs text-gray-600">Notre plateforme garantit des paiements sûrs et protégés à 100 %.</p>
                </div>
            </div>

        </div>
    </div>
</section>
    
</div>
    {{-- Contenu principal --}}
    <main class="container">
        @yield('content')
    </main>
    <div>
    <h3 class="text-gray-800 font-semibold mb-2">Suivez-nous</h3>
    <div class="flex space-x-4 text-[color:var(--main-color)]">
        <!-- TikTok -->
        <a href="http://www.tiktok.com/@globaldrop41" target="_blank" rel="noopener noreferrer" aria-label="TikTok" class="hover:text-pink-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                <path d="M9.5 3h3v12.79a3.21 3.21 0 1 1-3-3v-9.79z"/>
                <path d="M15.5 6.54a6 6 0 0 0 3 5.43v3.5a9 9 0 1 1-9-9v2a6 6 0 0 0 3 1.57z"/>
            </svg>
        </a>

        <!-- WhatsApp -->
        <a href="https://wa.me/212723455155" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" class="hover:text-green-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.52 3.48a11.91 11.91 0 0 0-16.84 0 11.91 11.91 0 0 0-2.55 12.93L2 21l4.69-1.23a11.92 11.92 0 0 0 13.83-16.29zM12 19a7 7 0 0 1-3.68-1.03l-.26-.15-2.21.58.59-2.15-.17-.28A7 7 0 1 1 12 19zm3.44-4.33c-.2-.1-1.18-.58-1.36-.65s-.31-.1-.44.1-.51.65-.62.78-.23.15-.43.05a5.7 5.7 0 0 1-1.68-1.04 6.37 6.37 0 0 1-1.18-1.46c-.12-.2 0-.31.08-.41s.19-.23.29-.34a.5.5 0 0 0 .07-.46c-.07-.15-.44-1.06-.6-1.46s-.32-.34-.44-.34-.26-.02-.4-.02a.83.83 0 0 0-.6.29 2.55 2.55 0 0 0-.77 1.83 4.42 4.42 0 0 0 .84 2.11 9.14 9.14 0 0 0 4.32 3.71 5.09 5.09 0 0 0 2.26.39 3.54 3.54 0 0 0 2.26-1.44 3.68 3.68 0 0 0 .25-1.42c0-.24-.18-.34-.38-.44z"/>
            </svg>
        </a>

        <!-- Instagram -->
        <a href="https://www.instagram.com/globaldrop2025?igsh=bDNkMnVsc3R3YW9m&utm_source=qr" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="hover:text-pink-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                <line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/>
            </svg>
        </a>

        <!-- Facebook -->
        <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="hover:text-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12a9.94 9.94 0 0 0 7.21 9.68v-6.85H6.9v-2.83h2.31v-2.17c0-2.28 1.36-3.54 3.45-3.54.99 0 2.03.18 2.03.18v2.23h-1.14c-1.13 0-1.48.7-1.48 1.42v1.88h2.52l-.4 2.83h-2.12v6.85A9.94 9.94 0 0 0 22 12z"/>
            </svg>
        </a>
    </div>
</div>

    {{-- Bootstrap JS (nécessaire pour le menu burger) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Bouton WhatsApp flottant -->
<a href="https://wa.me/212723455155" target="_blank" class="fixed bottom-4 right-4 z-50 bg-green-500 hover:bg-green-600 text-white p-3 rounded-full shadow-lg flex items-center justify-center">
    <!-- Icône WhatsApp -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M20.52 3.48a11.91 11.91 0 0 0-16.84 0 11.91 11.91 0 0 0-2.55 12.93L2 21l4.69-1.23a11.92 11.92 0 0 0 13.83-16.29zM12 19a7 7 0 0 1-3.68-1.03l-.26-.15-2.21.58.59-2.15-.17-.28A7 7 0 1 1 12 19zm3.44-4.33c-.2-.1-1.18-.58-1.36-.65s-.31-.1-.44.1-.51.65-.62.78-.23.15-.43.05a5.7 5.7 0 0 1-1.68-1.04 6.37 6.37 0 0 1-1.18-1.46c-.12-.2 0-.31.08-.41s.19-.23.29-.34a.5.5 0 0 0 .07-.46c-.07-.15-.44-1.06-.6-1.46s-.32-.34-.44-.34-.26-.02-.4-.02a.83.83 0 0 0-.6.29 2.55 2.55 0 0 0-.77 1.83 4.42 4.42 0 0 0 .84 2.11 9.14 9.14 0 0 0 4.32 3.71 5.09 5.09 0 0 0 2.26.39 3.54 3.54 0 0 0 2.26-1.44 3.68 3.68 0 0 0 .25-1.42c0-.24-.18-.34-.38-.44z"/>
    </svg>
    Contactez nous
</a>
</body>
</html>
