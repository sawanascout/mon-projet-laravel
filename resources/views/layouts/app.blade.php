<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>{{ config('app.name', 'GLOBALDROP') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net" />
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

  <style>
    :root {
  --main-color: #ab3fd6; /* Mauve */
  --main-color-dark: #6a1b9a; /* Mauve foncé */
  --secondary-color: #3a5a40; /* Vert treillis foncé */
  --secondary-color-light: #5e8a4f; /* Vert treillis clair */
  --background-light: #f9f7fc;
}

body {
  font-family: 'Figtree', sans-serif;
  background-color: var(--background-light);
  color: #333;
  padding-bottom: 70px; /* Pour que le footer fixe ne cache rien */
}

header {
  background-color: white;
  border-bottom: 2px solid var(--main-color);
}

.navbar-brand img {
  max-height: 40px;
}

.navbar-nav .nav-link {
  color: var(--secondary-color);
  font-weight: 600;
  transition: color 0.3s ease;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.active {
  color: var(--main-color);
  text-decoration: underline;
}

.navbar-nav .btn-primary {
  background-color: var(--main-color);
  border: none;
  font-weight: 700;
}
.navbar {
  z-index: 1050; /* pour être au-dessus du contenu normal */
}


.navbar-nav .btn-primary:hover {
  background-color: var(--main-color-dark);
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

a {
  transition: color 0.3s ease;
}

a:hover {
  color: var(--main-color-dark);
}

/* Bouton WhatsApp */
.fixed.bottom-4.right-4 {
  background: linear-gradient(135deg, #25d366, #128c7e);
  box-shadow: 0 4px 10px rgba(18, 140, 126, 0.6);
}

/* Formulaire, cards, boutons : padding et arrondis plus doux */
.card, .btn {
  border-radius: 0.5rem !important;
  box-shadow: 0 3px 8px rgb(171 63 214 / 0.2);
}

/* Animation légère sur hover */
.navbar-nav .nav-link:hover,
.btn:hover {
  transform: scale(1.05);
}

/* Responsive tweaks */
@media (max-width: 576px) {
  header {
    padding: 0 10px;
  }
  footer {
    font-size: 0.7rem;
  }
}
      
table { border-collapse: collapse; width: 100%; }
th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
.btn-purple {
    background-color: #6f42c1;
    border-color: #6f42c1;
}
.btn-purple:hover {
    background-color:rgb(29, 155, 153);
    border-color:rgb(53, 156, 105);
}

  </style>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

  <!-- Styles et Scripts compilés avec Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
 <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand fw-bold text-[color:var(--main-color)]" href="{{ route('admin.dashboard') }}">
      <img src="{{ asset('images/logo.png') }}" alt="GlobalDrop" height="30" class="d-inline-block align-text-top">
      GlobalDrop
    </a>

    <!-- Bouton hamburger -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
      aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenu de la navbar -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <!-- Liens visibles pour tous -->
        <li class="nav-item">
          <a class="btn btn-success text-white mx-1" href="{{ route('admin.dashboard') }}">Tableau de bord</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-primary text-white mx-1" href="{{ route('admin.produits') }}">Voir produits</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-success text-white mx-1" href="{{ route('admin.categories.index') }}">Voir catégories</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-warning text-dark mx-1" href="{{ route('admin.commandes.index') }}">Voir commandes</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-secondary text-dark mx-1" href="{{ route('page') }}">Nous suivre</a>
        </li>

        <!-- Authentifié -->
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark mx-2" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Bonjour, {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
            @if(auth()->user()->role === 'admin')
              <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @endif
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Déconnexion
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </li>
        @else
        <!-- Non connecté -->
        <li class="nav-item">
          <a class="btn btn-primary text-white mx-2" href="{{ route('login') }}">Se connecter</a>
        </li>
        @endauth

      </ul>
    </div>
  </div>
</nav>





  @yield('content')

  <!-- Bouton WhatsApp flottant -->
<a href="https://wa.me/22890171179" target="_blank"
   class="btn position-fixed d-flex align-items-center justify-content-center"
   style="bottom: 90px; right: 20px; background: linear-gradient(135deg, #25d366, #128c7e); color: white; border-radius: 50%; width: 55px; height: 55px; box-shadow: 0 4px 10px rgba(18, 140, 126, 0.6); z-index: 1050;"
   aria-label="Contact WhatsApp">
  <i class="fab fa-whatsapp fa-lg"></i>
</a>


  @stack('scripts')

  <footer class="fixed bottom-0 left-0 w-full text-center py-4 text-xs" style="background: linear-gradient(to left, #ab3fd6, #6a1b9a); color: white;">
    &copy; {{ date('Y') }} Global Drop - La qualité au bout du clic, la sécurité en plus.
  </footer>
  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.getElementById('navbarContent');
    console.log("Navbar visible ?", navbar?.offsetHeight > 0);
  });
</script>

</body>
</html>
