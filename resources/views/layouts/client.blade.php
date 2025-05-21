<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Drop - @yield('title', 'Accueil')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-900">

    <!-- Header -->
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('produits.index') }}" class="text-2xl font-bold text-indigo-600 flex-shrink-0">Global Drop</a>

            <!-- Search bar (centrée) -->
            <div class="flex-1 mx-4 hidden md:block">
                <form action="{{ route('produits.index') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Rechercher un produit..." class="w-full border border-gray-300 rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <svg class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16.65 10.5a6.15 6.15 0 11-12.3 0 6.15 6.15 0 0112.3 0z" />
                        </svg>
                    </div>
                </form>
            </div>

            <!-- Navigation -->
            <nav class="space-x-4 hidden md:flex items-center">
                <a href="{{ route('produits.index') }}" class="text-gray-700 hover:text-indigo-600 transition font-medium">Produits</a>
                <a href="{{ route('commandes.create') }}" class="text-gray-700 hover:text-indigo-600 transition font-medium">Commander</a>
                <a href="{{ route('custom.create') }}" class="text-gray-700 hover:text-indigo-600 transition font-medium">Demande perso</a>
                <a href="https://wa.me/212723455155" target="_blank" class="text-green-600 font-semibold">WhatsApp</a>
            </nav>

            <!-- Menu hamburger mobile -->
            <div class="md:hidden">
                <button id="menu-toggle" class="text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Menu mobile dropdown (optionnel à activer via JS plus tard) -->
        <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
            <a href="{{ route('produits.index') }}" class="block py-2 text-gray-700">Produits</a>
            <a href="{{ route('custom.create') }}" class="block py-2 text-gray-700">Demande perso</a>
            <a href="https://wa.me/212723455155" class="block py-2 text-green-600 font-semibold">WhatsApp</a>
        </div>
    </header>

    <!-- Contenu -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-12">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm text-gray-600">
            &copy; {{ date('Y') }} Global Drop. Tous droits réservés.
        </div>
    </footer>

    <!-- Script pour menu mobile -->
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

</body>
</html>