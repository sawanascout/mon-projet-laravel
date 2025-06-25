<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>GlobalDrop - @yield('title', 'Accueil')</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
  <script src="https://unpkg.com/lucide@latest"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    :root {
      --main-color: #ab3fd6;
    }
    body {
      font-family: 'Roboto', sans-serif;
    }
    .main-color {
      color: var(--main-color);
    }
    .bg-main-color {
      background-color: var(--main-color);
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100 text-dark bg-white">

<!-- Barre d'annonces -->
<div class="bg-main-color text-white text-small py-2">
  <div class="container d-flex justify-content-center">
    <span id="carousel-text">Livraison gratuite sur toutes les commandes</span>
  </div>
</div>

<!-- Header -->
<header class="sticky-top bg-white shadow-sm">
  <div class="container d-flex align-items-center justify-content-between py-3">

    <!-- Logo -->
    <a href="{{ route('produits.index') }}" class="text-decoration-none fw-bold main-color fs-3 d-flex align-items-center">
      <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop" style="height: 40px; width: auto;" />
    </a>

    <!-- Barre de recherche -->
    <form action="{{ route('produits.index') }}" method="GET" class="flex-grow-1 mx-3 d-none d-md-flex">
      <input type="text" name="search" placeholder="Rechercher un produit..." class="form-control rounded-pill border-secondary" />
    </form>

    <!-- Icônes et liens -->
    @auth()
      <div class="d-flex align-items-center gap-3 bg-violet-50 rounded px-3 py-2 max-w-sm">
        <span class="text-secondary fw-semibold small">
          👋 Bienvenue, 
          <span class="text-violet-700 fw-semibold cursor-pointer hover-text-violet-900">{{ auth()->user()->name }}</span>
        </span>

        @if (auth()->user()->role === 'admin')
          <a href="{{ route('admin.dashboard') }}" class="btn btn-success btn-sm fw-semibold">
            Dashboard
          </a>
        @endif

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        <a href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          class="small text-decoration-underline text-violet-600 hover-text-violet-800">
          Déconnexion
        </a>
      </div>

      <a href="{{ route('commandes.mes-commandes') }}" class="btn btn-outline-main-color rounded-pill ms-3 shadow-sm">
        📋 Mes commandes
      </a>
      <a href="{{ route('parrainage.index') }}" class="btn btn-outline-success rounded-pill ms-2 shadow-sm">
        🎁 Mon lien de parrainage
      </a>
      <a href="{{ route('page') }}" class="btn btn-outline-purple rounded-pill ms-2 shadow-sm" style="--bs-btn-border-color: #ab3fd6; --bs-btn-color: #ab3fd6;">
        🌐 Nous suivre
      </a>

    @else
      <div class="d-flex gap-2">
        <a href="{{ route('login') }}" class="btn btn-main-color text-white rounded-pill shadow-sm d-flex align-items-center gap-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-box-arrow-in-right" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 6 3z"/>
            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708L9.707 5.5a.5.5 0 1 0-.708.708L10.293 8 8.999 9.293a.5.5 0 0 0 .708.708l2.147-2.147z"/>
          </svg>
          Se connecter
        </a>
        <a href="{{ route('parrainage.index') }}" class="btn btn-outline-success rounded-pill shadow-sm">
          🎁 Mon lien de parrainage
        </a>
        <a href="{{ route('page') }}" class="btn btn-outline-purple rounded-pill shadow-sm" style="--bs-btn-border-color: #ab3fd6; --bs-btn-color: #ab3fd6;">
          🌐 Nous suivre
        </a>
      </div>
    @endauth

    <a href="{{ route('cart.index') }}" class="position-relative ms-3">
      <svg class="bi bi-cart3 text-secondary fs-4 hover-main-color" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 24px; height: 24px;">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 00.9 1.3h10.9a1 1 0 00.9-1.3L17 13M7 13V6h10v7" />
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
    <div class="container d-flex overflow-auto py-2 text-secondary small">
      @foreach (['Toutes', 'Mode & Accessoires', 'Pour Hommes', 'Pour Femmes'] as $cat)
        <a href="{{ route('produits.index', ['category' => $cat === 'Toutes' ? null : $cat]) }}" class="fw-bold text-nowrap me-3 text-decoration-none text-secondary-hover-main-color">
          {{ $cat }}
        </a>
      @endforeach
    </div>
  </nav>
</header>

<!-- Pourquoi choisir GlobalDrop - Style TEMU -->
<section class="py-5 mt-4 border-top border-bottom bg-white">
  <div class="container">
    <h2 class="mb-4 text-center fw-bold fs-3 text-dark">
      Pourquoi <span class="main-color">choisir GlobalDrop</span> ?
    </h2>

    <div class="row g-4 justify-content-between">
      <!-- Item 1 -->
      <div class="col-md d-flex bg-light rounded-3 shadow-sm p-3 align-items-start gap-3 border-hover-main-color">
        <div class="flex-shrink-0 bg-main-color bg-opacity-10 rounded-circle d-flex justify-content-center align-items-center" style="width: 48px; height: 48px;">
          <svg xmlns="http://www.w3.org/2000/svg" class="text-main-color" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:24px; height:24px;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16l4-4H3V8l5-5h11a2 2 0 012 2v12a2 2 0 01-2 2H5l-2 2v-4z" />
          </svg>
        </div>
        <div>
          <h3 class="fw-semibold fs-6 text-dark mb-1">Livraison rapide</h3>
          <p class="text-muted small mb-0">Nous livrons rapidement partout au Togo grâce à notre logistique performante.</p>
        </div>
      </div>

      <!-- Item 2 -->
      <div class="col-md d-flex bg-light rounded-3 shadow-sm p-3 align-items-start gap-3 border-hover-main-color">
        <div class="flex-shrink-0 bg-main-color bg-opacity-10 rounded-circle d-flex justify-content-center align-items-center" style="width: 48px; height: 48px;">
          <svg xmlns="http://www.w3.org/2000/svg" class="text-main-color" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:24px; height:24px;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v4h4V7m1 5a1 1 0 10-2 0v2h2v-2zm-6 4h8a2 2 0 002-2v-2H6v2a2 2 0 002 2z" />
          </svg>
        </div>
        <div>
          <h3 class="fw-semibold fs-6 text-dark mb-1">Paiement sécurisé</h3>
          <p class="text-muted small mb-0">Vos transactions sont protégées grâce à nos systèmes de paiement fiables et sécurisés.</p>
        </div>
      </div>

      <!-- Item 3 -->
      <div class="col-md d-flex bg-light rounded-3 shadow-sm p-3 align-items-start gap-3 border-hover-main-color">
        <div class="flex-shrink-0 bg-main-color bg-opacity-10 rounded-circle d-flex justify-content-center align-items-center" style="width: 48px; height: 48px;">
          <svg xmlns="http://www.w3.org/2000/svg" class="text-main-color" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:24px; height:24px;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <div>
          <h3 class="fw-semibold fs-6 text-dark mb-1">Satisfaction garantie</h3>
          <p class="text-muted small mb-0">Notre priorité est votre satisfaction avec un service client disponible et réactif.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="mt-auto bg-light py-4">
  <div class="container text-center text-muted small">
    &copy; {{ date('Y') }} Global Drop - La qualité au bout du clic, la sécurité en plus.
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
