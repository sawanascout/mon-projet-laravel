<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>{{ config('app.name', 'GLOBALDROP') }}</title>

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.bunny.net" />
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

  <!-- Vite assets -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Styles -->
  <style>
    :root {
      --main-color: #ab3fd6;
      --main-color-dark: #6a1b9a;
      --secondary-color: #3a5a40;
      --secondary-color-light: #5e8a4f;
      --background-light: #f9f7fc;
    }

    body {
      font-family: 'Figtree', sans-serif;
      background-color: var(--background-light);
      color: #333;
      padding-bottom: 70px;
    }

    a { transition: color 0.3s ease; }
    a:hover { color: var(--main-color-dark); }

    .navbar {
      z-index: 1050;
      background-color: white;
      border-bottom: 2px solid var(--main-color);
    }
    .navbar-brand img { max-height: 40px; }
    .navbar-nav .nav-link,
    .navbar-nav .btn { font-weight: 600; }

    .btn-primary { background-color: var(--main-color); border: none; }
    .btn-primary:hover { background-color: var(--main-color-dark); }

    .btn-custom {
      border-radius: 0.6rem;
      font-weight: 600;
      box-shadow: 0 3px 6px rgba(171, 63, 214, 0.2);
      transition: all 0.3s ease;
      padding: 0.5rem 1.2rem;
    }
    .btn-mauve {
      background-color: var(--main-color);
      color: white;
    }
    .btn-mauve:hover {
      background-color: var(--main-color-dark);
      transform: scale(1.03);
    }
    .btn-gradient-violet {
      background: linear-gradient(45deg, var(--main-color), var(--main-color-dark));
      color: white;
    }
    .btn-gradient-violet:hover {
      opacity: 0.9;
      transform: scale(1.03);
    }
    .nav-pills .nav-link {
  color: var(--secondary-color);
  font-weight: 600;
  margin-right: 0.5rem;
  transition: all 0.2s ease;
}

.nav-pills .nav-link.active {
  background-color: var(--main-color);
  color: white;
}

    .card, .btn {
      border-radius: 0.5rem !important;
      box-shadow: 0 3px 8px rgb(171 63 214 / 0.2);
    }

    footer {
      background: linear-gradient(to left, var(--main-color), var(--main-color-dark));
      color: white;
      font-size: 0.8rem;
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      padding: 12px 0;
      text-align: center;
      box-shadow: 0 -3px 8px rgba(107, 45, 145, 0.7);
    }

    @media (max-width: 576px) {
      footer { font-size: 0.7rem; }
    }
    .dashboard-navbar {
  background: linear-gradient(90deg, var(--main-color), var(--main-color-dark));
  border-radius: 0.75rem;
  box-shadow: 0 4px 10px rgba(171, 63, 214, 0.25);
}

.dashboard-navbar .nav-link {
  color: white;
  font-weight: 500;
  margin-right: 0.5rem;
  transition: all 0.2s ease-in-out;
  border-radius: 1.5rem;
  padding: 0.4rem 1rem;
}

.dashboard-navbar .nav-link.active,
.dashboard-navbar .nav-link:hover {
  background-color: rgba(255, 255, 255, 0.2);
  color: #fff;
}

  </style>
</head>

<body>
  {{-- Navbar secondaire Dashboard --}}
<nav class="px-4 py-2 mb-4 rounded shadow nav nav-pills dashboard-navbar">
  <a class="text-white navbar-brand fw-bold me-4" href="{{ route('produits.index') }}">
    <img src="{{ asset('images/logo.png') }}" alt="GlobalDrop" height="30" class="me-2">
    GlobalDrop
  </a>

  <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
    <i class="fas fa-chart-line me-1"></i> Dashboard
  </a>

  <a class="nav-link {{ request()->routeIs('admin.produits') ? 'active' : '' }}" href="{{ route('admin.produits') }}">
    <i class="fas fa-boxes me-1"></i> Produits
  </a>

  <a class="nav-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
    <i class="fas fa-tags me-1"></i> Catégories
  </a>

  <a class="nav-link {{ request()->routeIs('admin.commandes.index') ? 'active' : '' }}" href="{{ route('admin.commandes.index') }}">
    <i class="fas fa-shopping-cart me-1"></i> Commandes
  </a>

  <a class="nav-link {{ request()->routeIs('admin.historique.index') ? 'active' : '' }}" href="{{ route('admin.historique.index') }}">
    <i class="fas fa-history me-1"></i> Historique
  </a>

  <a class="nav-link {{ request()->routeIs('admin.parrainages.index') ? 'active' : '' }}" href="{{ route('admin.parrainages.index') }}">
    <i class="fas fa-user-friends me-1"></i> Parrainages
  </a>

 <!-- Bouton cliquable -->
<a class="ms-auto btn btn-outline-light btn-sm" href="{{ route('logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
  <i class="fas fa-sign-out-alt me-1"></i> Se Déconnecter
</a>

<!-- Formulaire POST caché -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
  @csrf
</form>

</nav>




  {{-- CONTENU --}}
  @yield('content')

  {{-- WHATSAPP FLOATING BUTTON --}}
  <a href="https://wa.me/22890171119" target="_blank"
     class="btn position-fixed d-flex align-items-center justify-content-center"
     style="bottom: 90px; right: 20px; background: linear-gradient(135deg, #25d366, #128c7e); color: white; border-radius: 50%; width: 55px; height: 55px; box-shadow: 0 4px 10px rgba(18, 140, 126, 0.6); z-index: 1050;"
     aria-label="Contact WhatsApp">
    <i class="fab fa-whatsapp fa-lg"></i>
  </a>

  {{-- FOOTER --}}
  <footer>
    &copy; {{ date('Y') }} Global Drop – La qualité au bout du clic, la sécurité en plus.
  </footer>

  {{-- JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
