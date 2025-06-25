<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlobalDrop - @yield('title', 'Accueil')</title>

    <!-- ✅ Tailwind via CDN proprement -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- ✅ Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- ✅ Lucide icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- ✅ Custom styles -->
    <style>
        :root {
            --main-color: #ab3fd6;
        }
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen text-gray-900 bg-white">
    
    <!-- ✅ Barre d'annonces -->
    <div class="bg-[color:var(--main-color)] text-white text-sm py-2">
        <div class="flex items-center justify-center px-4 mx-auto max-w-7xl">
            <span id="carousel-text">Livraison gratuite sur toutes les commandes</span>
        </div>
    </div>

    <!-- ✅ Header -->
    <header class="sticky top-0 z-50 bg-white shadow">
        <div class="flex items-center justify-between px-4 py-3 mx-auto max-w-7xl">
            <!-- Logo -->
            <a href="{{ route('produits.index') }}" class="text-2xl font-bold text-[color:var(--main-color)]">
                <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop" class="w-auto h-10">
            </a>

            <!-- Recherche -->
            <form action="{{ route('produits.index') }}" method="GET" class="flex-1 hidden mx-4 md:flex">
                <input type="text" name="search" placeholder="Rechercher un produit..." class="w-full border border-gray-300 py-2 px-4 rounded-full focus:outline-none focus:ring-2 focus:ring-[color:var(--main-color)]">
            </form>

            <!-- Icônes utilisateur / Connexion / Liens -->
            @auth
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-semibold text-gray-700">👋 Bienvenue, <span class="text-violet-700">{{ auth()->user()->name }}</span></span>

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-3 py-1 text-sm font-semibold text-green-700 bg-green-100 rounded hover:bg-green-200">Dashboard</a>
                    @endif

                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-sm font-medium underline text-violet-600 hover:text-violet-800">Déconnexion</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>

                    <a href="{{ route('commandes.mes-commandes') }}" class="inline-flex items-center gap-2 text-[color:var(--main-color)] border border-[color:var(--main-color)] px-4 py-2 rounded-full hover:bg-[color:var(--main-color)] hover:text-white">📋 Mes commandes</a>
                    <a href="{{ route('parrainage.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-green-600 border border-green-600 rounded-full hover:bg-green-600 hover:text-white">🎁 Mon lien de parrainage</a>
                    <a href="{{ route('page') }}" class="inline-flex items-center gap-2 text-[#ab3fd6] border border-[#ab3fd6] px-4 py-2 rounded-full hover:bg-[#ab3fd6] hover:text-white">🌐 Nous suivre</a>
                </div>
            @else
                <div class="flex space-x-2">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-white bg-[color:var(--main-color)] px-4 py-2 rounded-full shadow-md hover:brightness-110">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v4m-5 10H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4m7 7l5 5m0 0l-5 5m5-5H9"/></svg>
                        Se connecter
                    </a>
                    <a href="{{ route('parrainage.index') }}" class="inline-flex items-center gap-2 px-4 py-2 text-green-600 border border-green-600 rounded-full hover:bg-green-600 hover:text-white">🎁 Mon lien de parrainage</a>
                    <a href="{{ route('page') }}" class="inline-flex items-center gap-2 text-[#ab3fd6] border border-[#ab3fd6] px-4 py-2 rounded-full hover:bg-[#ab3fd6] hover:text-white">🌐 Nous suivre</a>
                </div>
            @endauth

            <!-- Panier -->
            <a href="{{ route('cart.index') }}" class="relative ml-4">
                <svg class="w-6 h-6 text-gray-700 hover:text-[color:var(--main-color)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 00.9 1.3h10.9a1 1 0 00.9-1.3L17 13M7 13V6h10v7" />
                </svg>
                @if(session('panier') && count(session('panier')) > 0)
                    <span class="absolute px-1 text-xs font-bold text-white bg-red-500 rounded-full -top-1 -right-1">
                        {{ count(session('panier')) }}
                    </span>
                @endif
            </a>
        </div>

        <!-- Navigation principale -->
        <nav class="bg-gray-100">
            <div class="flex px-4 py-2 mx-auto space-x-4 overflow-x-auto text-sm text-gray-700 max-w-7xl">
                @foreach (['Toutes', 'Mode & Accessoires', 'Pour Hommes', 'Pour Femmes'] as $cat)
                    <a href="{{ route('produits.index', ['category' => $cat == 'Toutes' ? null : $cat]) }}" class="font-bold hover:text-[color:var(--main-color)] whitespace-nowrap">{{ $cat }}</a>
                @endforeach
            </div>
        </nav>
    </header>

    <!-- Section Pourquoi choisir -->
    @yield('banner')

    <!-- Contenu principal -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="w-full mt-12 text-xs bg-gray-100">
        <div class="grid grid-cols-1 gap-8 px-4 py-8 mx-auto text-sm text-gray-600 max-w-7xl md:grid-cols-4">
            <div>
                <h3 class="mb-2 font-semibold text-gray-800">Suivez-nous</h3>
                <div class="flex space-x-4 text-[color:var(--main-color)]">
                    <!-- WhatsApp -->
                    <a href="https://whatsapp.com/channel/0029VbAh2wrGZNCxxKYwbN3Q" target="_blank" class="hover:text-green-600" aria-label="WhatsApp">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="..." /></svg>
                    </a>
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/globaldrop2025" target="_blank" class="hover:text-pink-500" aria-label="Instagram">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="..." /></svg>
                    </a>
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/share/19BrbhLzb2/" target="_blank" class="hover:text-blue-600" aria-label="Facebook">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="..." /></svg>
                    </a>
                    <!-- TikTok -->
                    <a href="http://www.tiktok.com/@globaldrop41" target="_blank" class="hover:text-black" aria-label="TikTok">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="..." /></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="py-4 text-center text-gray-500 bg-gray-200">
            &copy; {{ date('Y') }} Global Drop - La qualité au bout du clic, la sécurité en plus.
        </div>
    </footer>

    <!-- Scripts supplémentaires -->
    <script>
        // Placeholder pour animations/carousel si besoin
    </script>
</body>
</html>
