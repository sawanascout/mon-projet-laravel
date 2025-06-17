<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlobalDrop - @yield('title', 'Accueil')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])    
    <style>
        :root {
            --main-color: #ab3fd6; 
        }
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-gray-900 flex flex-col min-h-screen">
<!-- Barre d'annonces -->
<div class="bg-[color:var(--main-color)] text-white text-sm py-2">
    <div class="max-w-7xl mx-auto px-4 flex justify-center items-center">
        <span id="carousel-text">Livraison gratuite sur toutes les commandes</span>
    </div>
    
</div>

<!-- Header -->
<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('produits.index') }}" class="text-2xl font-bold text-[color:var(--main-color)]">
            <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop" class="h-10 w-auto">       
         </a>

        <!-- Barre de recherche -->
        <form action="{{ route('produits.index') }}" method="GET" class="flex-1 mx-4 hidden md:flex">
            <input type="text" name="search" placeholder="Rechercher un produit..." class="w-full border border-gray-300 py-2 px-4 rounded-full focus:outline-none focus:ring-2 focus:ring-[color:var(--main-color)]">
        </form>

        <!-- Icônes -->
        <div class="flex items-center space-x-4">
            @auth
                <div class="flex items-center space-x-4 bg-violet-50 px-4 py-2 rounded-lg max-w-sm mx-auto">
    <span class="text-sm text-gray-700 font-semibold">
        👋 Bienvenue, <span class="text-violet-700 hover:text-violet-900 cursor-pointer transition">{{ auth()->user()->name }}</span>
    </span>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="text-sm text-violet-600 hover:text-violet-800 font-medium underline decoration-violet-400 hover:decoration-violet-600 transition cursor-pointer">
         Déconnexion
    </a>
</div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                        <a href="{{ route('commandes.mes-commandes') }}" class="inline-flex items-center gap-2 text-[color:var(--main-color)] border border-[color:var(--main-color)] px-4 py-2 rounded-full hover:bg-[color:var(--main-color)] hover:text-white transition shadow-md">📋 Mes commandes</a>
<a href="{{ route('parrainage.index') }}" class="inline-flex items-center gap-2 text-green-600 border border-green-600 px-4 py-2 rounded-full hover:bg-green-600 hover:text-white transition shadow-md">
    🎁 Mon lien de parrainage
</a>
<a href="{{ route('page') }}" class="inline-flex items-center gap-2 text-[#ab3fd6] border border-[#ab3fd6] px-4 py-2 rounded-full hover:bg-[#ab3fd6] hover:text-white transition shadow-md">
    🌐 Nous suivre
</a>

            @else
    <div class="flex space-x-2">
        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-white bg-[color:var(--main-color)] px-4 py-2 rounded-full shadow-md hover:brightness-110 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v4m-5 10H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4m7 7l5 5m0 0l-5 5m5-5H9" /></svg>
            Se connecter
        </a>
        
        <a href="{{ route('parrainage.index') }}" class="inline-flex items-center gap-2 text-green-600 border border-green-600 px-4 py-2 rounded-full hover:bg-green-600 hover:text-white transition shadow-md">
    🎁 Mon lien de parrainage
</a>
        <a href="{{ route('page') }}" class="inline-flex items-center gap-2 text-[#ab3fd6] border border-[#ab3fd6] px-4 py-2 rounded-full hover:bg-[#ab3fd6] hover:text-white transition shadow-md">
    🌐 Nous suivre
</a>

    </div>
    
@endauth


            <a href="{{ route('cart.index') }}" class="relative">
                <svg class="w-6 h-6 text-gray-700 hover:text-[color:var(--main-color)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 00.9 1.3h10.9a1 1 0 00.9-1.3L17 13M7 13V6h10v7" />
                </svg>
                @if(session('panier') && count(session('panier')) > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full px-1">
                        {{ count(session('panier')) }}
                    </span>
                @endif
            </a>
        </div>
        <!-- Bouton Aide avec menu déroulant au survol -->

</div>

</div>


    </div>

    <!-- Navigation principale -->
    <!-- 🧭 Navigation catégories -->
        <nav class="bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 py-2 flex space-x-4 overflow-x-auto text-sm text-gray-700">
        @foreach (['Toutes', 'Mode & Accessoires', 'Pour Hommes', 'Pour Femmes'] as $cat)
            <a href="{{ route('produits.index', ['category' => $cat = 'Toutes' ? $cat : null]) }}"
                class="font-bold hover:text-[color:var(--main-color)] whitespace-nowrap">{{ $cat }}</a>
        @endforeach
    </div>
</nav>

</header>
<!-- Pourquoi choisir GlobalDrop - Style TEMU -->
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

<div class="bg-gray-200 text-center py-4 text-xs text-gray-500">
        &copy; {{ date('Y') }} Global Drop - La qualité au bout du clic, la sécurité en plus.
    </div>
<main class="flex-grow">
    @yield('content')
</main>


<!-- Footer -->
<footer class="bg-gray-100 mt-12">
    <div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-4 gap-8 text-sm text-gray-600">


        <!-- Réseaux sociaux -->
<div>
    <h3 class="text-gray-800 font-semibold mb-2">Suivez-nous</h3>
    <div class="flex space-x-4 text-[color:var(--main-color)]">

        <!-- WhatsApp -->
        <a href="https://whatsapp.com/channel/0029VbAh2wrGZNCxxKYwbN3Q" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" class="hover:text-green-600">
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
<a href="https://www.facebook.com/share/19BrbhLzb2/" 
   target="_blank" rel="noopener noreferrer" aria-label="Facebook" 
   class="hover:text-blue-600 ml-4">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 5.006 3.657 9.128 8.438 9.878v-6.987H7.898v-2.89h2.54V9.845c0-2.507 1.493-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.772-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 17.006 22 12z"/>
    </svg>
</a>
<!-- TikTok -->
<a href="http://www.tiktok.com/@globaldrop41" 
   target="_blank" rel="noopener noreferrer" aria-label="TikTok" 
   class="hover:text-black ml-4">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M9.5 3C8.119 3 7 4.119 7 5.5v13C7 19.881 8.119 21 9.5 21s2.5-1.119 2.5-2.5v-5.671c.416.112.855.171 1.309.171 2.485 0 4.5-2.015 4.5-4.5V4h-2v4.5c0 1.378-1.122 2.5-2.5 2.5S11 9.878 11 8.5V5.5C11 4.119 9.881 3 8.5 3h-1z"/>
    </svg>
</a>

        
    </div>
</div>


        
    </div>
    <div class="bg-gray-200 text-center py-4 text-xs text-gray-500">
        &copy; {{ date('Y') }} Global Drop - La qualité au bout du clic, la sécurité en plus.
    </div>
</footer>

<!-- Scripts -->
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


<div id="videoAdBanner" class="fixed top-[50px] left-0 w-full bg-white-800 text-white z-50 flex justify-center items-center px-4 py-3 shadow-lg hidden">
  <div class="relative w-full max-w-xl rounded-xl overflow-hidden shadow-2xl border border-purple-60">
    
    <!-- Bouton de fermeture -->
    <button id="closeVideoAd" class="absolute top-2 right-2 text-white text-2xl font-bold bg-black bg-opacity-70 px-2 rounded-full z-20 hover:bg-opacity-90">&times;</button>
    
    <!-- Bouton volume -->
    <button id="toggleSound" class="absolute bottom-2 right-2 text-white bg-black bg-opacity-60 px-2 py-1 rounded-full z-20 text-sm hover:bg-opacity-90">
      🔇 Son
    </button>

    <!-- Bloc cliquable -->
    <a href="http://www.tiktok.com/@globaldrop41" target="_blank" rel="noopener noreferrer" class="block relative z-10 cursor-pointer">
      <video id="adVideo" autoplay muted loop class="w-full max-h-[400px] rounded-xl object-cover">
  <source src="{{ asset('videos/ma-video.mp4') }}" type="video/mp4">
  Votre navigateur ne prend pas en charge la lecture vidéo.
</video>


      <!-- Texte superposé -->
      <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-4 bg-black bg-opacity-40 text-white">
        <h2 class="text-2xl font-bold mb-2 drop-shadow-lg">🔥 Découvrez nos offres exclusives sur TikTok !</h2>
        <p class="text-lg font-medium drop-shadow-sm">⚡ Dépêchez-vous, les stocks sont limités !</p>
      </div>
    </a>
  </div>
</div>


<script>
  const adBanner = document.getElementById('videoAdBanner');
  const closeBtn = document.getElementById('closeVideoAd');
  const toggleSoundBtn = document.getElementById('toggleSound');
  const video = document.getElementById('adVideo');

  // Affiche la pub après 2 secondes
  setTimeout(() => {
    adBanner.classList.remove('hidden');
  }, 15000);

  // Fermer la pub et la faire réapparaître après 15 secondes
  closeBtn.addEventListener('click', () => {
    adBanner.classList.add('hidden');
    setTimeout(() => {
      adBanner.classList.remove('hidden');
    }, 60000);
  });

  // Activer/Désactiver le son
  toggleSoundBtn.addEventListener('click', () => {
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





<!-- Bouton WhatsApp flottant -->
<a href="https://wa.me/22890171179" target="_blank" class="fixed bottom-4 right-4 z-50 bg-green-500 hover:bg-green-600 text-white p-3 rounded-full shadow-lg flex items-center justify-center">
    <!-- Icône WhatsApp -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M20.52 3.48a11.91 11.91 0 0 0-16.84 0 11.91 11.91 0 0 0-2.55 12.93L2 21l4.69-1.23a11.92 11.92 0 0 0 13.83-16.29zM12 19a7 7 0 0 1-3.68-1.03l-.26-.15-2.21.58.59-2.15-.17-.28A7 7 0 1 1 12 19zm3.44-4.33c-.2-.1-1.18-.58-1.36-.65s-.31-.1-.44.1-.51.65-.62.78-.23.15-.43.05a5.7 5.7 0 0 1-1.68-1.04 6.37 6.37 0 0 1-1.18-1.46c-.12-.2 0-.31.08-.41s.19-.23.29-.34a.5.5 0 0 0 .07-.46c-.07-.15-.44-1.06-.6-1.46s-.32-.34-.44-.34-.26-.02-.4-.02a.83.83 0 0 0-.6.29 2.55 2.55 0 0 0-.77 1.83 4.42 4.42 0 0 0 .84 2.11 9.14 9.14 0 0 0 4.32 3.71 5.09 5.09 0 0 0 2.26.39 3.54 3.54 0 0 0 2.26-1.44 3.68 3.68 0 0 0 .25-1.42c0-.24-.18-.34-.38-.44z"/>
    </svg>
    Contactez nous
</a>
@stack('scripts')


</body>
</html>

