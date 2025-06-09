@extends('layouts.app')

@section('content')
<div class="baniere-info" style="overflow: hidden;">
    <marquee behavior="scroll" direction="left">
        🎉 Livraison gratuite! | 📞 Service client 7j/7 | 🛍️ Nouveautés chaque semaine sur GLOBALDROP !
    </marquee>
</div>

<!-- TikTok SDK -->
<script async src="https://www.tiktok.com/embed.js"></script>


<style>
  :root {
  --couleur-primaire: #7B4BB7; /* Mauve */
  --couleur-secondaire: #556B2F; /* Vert treillis */
  --couleur-fond: #f8f9fa;
  --couleur-texte: #333;
}
#tiktok-widget {
  transition: all 0.3s ease-in-out;
}

#tiktok-widget:hover {
  box-shadow: 0 0 15px rgba(123, 75, 183, 0.3);
}

body {
  background-color: var(--couleur-fond);
  color: var(--couleur-texte);
  font-family: 'Segoe UI', sans-serif;
}

.btn-primary {
  background-color: var(--couleur-primaire);
  border-color: var(--couleur-primaire);
}

.btn-primary:hover {
  background-color: #6b3ca5;
  border-color: #6b3ca5;
}

.btn-outline-secondary {
  color: var(--couleur-secondaire);
  border-color: var(--couleur-secondaire);
}

.btn-outline-secondary:hover {
  background-color: var(--couleur-secondaire);
  color: white;
}

.card {
  border: 1px solid #ddd;
  transition: transform 0.2s ease;
}

.card:hover {
  transform: scale(1.02);
  box-shadow: 0 0 10px rgba(123, 75, 183, 0.2);
}

.navbar {
  background-color: var(--couleur-secondaire);
}

.navbar .nav-link,
.navbar .navbar-brand {
  color: white;
}

.navbar .nav-link:hover {
  color: #ddd;
}

.badge.bg-danger {
  background-color: #d9534f !important;
}

/* Bannière défilante */
.banniere-info {
  background-color: var(--couleur-primaire);
  color: white;
  padding: 0.5rem;
  overflow: hidden;
  white-space: nowrap;
}

.banniere-info span {
  display: inline-block;
  padding-left: 100%;
  animation: defilement 15s linear infinite;
}

@keyframes defilement {
  0% {
    transform: translateX(0%);
  }
  100% {
    transform: translateX(-100%);
  }
}
.text-mauve {
    color: #7B4BB7;
}

.btn-mauve {
    background-color: #7B4BB7;
    color: white;
    border: none;
    transition: background-color 0.3s ease;
}

.btn-mauve:hover {
    background-color: #693aa5;
}

.btn-outline-mauve {
    border: 2px solid #7B4BB7;
    color: #7B4BB7;
    background-color: transparent;
    transition: all 0.3s ease;
}

.btn-outline-mauve:hover {
    background-color: #7B4BB7;
    color: white;
}

.produit-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease, border 0.3s ease;
    border: 2px solid transparent;
    border-top: 4px solid #3B8D54; /* Bordure supérieure verte */
}

.produit-card:hover {
    transform: scale(1.03); /* Légère élévation */
    box-shadow: 0 8px 20px rgba(123, 75, 183, 0.2); /* Ombre douce */
    border: 2px solid var(--couleur-primaire); /* Bordure mauve visible au survol */
}
.card-body {
    transition: background-color 0.3s ease;
}

.produit-card:hover .card-body {
    background-color: rgba(123, 75, 183, 0.03); /* Légère touche de mauve */
}

#tiktok-banner {
  background: #fff;
  padding: 0.5rem;
  border-left: 5px solid var(--couleur-primaire);
  transition: transform 0.3s ease;
}

#tiktok-banner:hover {
  transform: scale(1.01);
}
</style>

<div class="container mt-5">  {{-- Conteneur principal --}}
<!-- Vidéo TikTok flottante -->
<div id="tiktok-float" class="position-fixed top-0 start-50 translate-middle-x bg-white border rounded shadow p-2 zindex-tooltip" style="z-index: 1050; max-width: 300px; margin-top: 10px;">
    <button onclick="document.getElementById('tiktok-float').remove()" class="btn-close position-absolute top-0 end-0 m-1" aria-label="Fermer"></button>
    <a href="https://www.tiktok.com/@globaldrop41" target="_blank" class="d-block text-decoration-none">
        <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@globaldrop41/video/0000000000000000000" data-video-id="0000000000000000000" style="max-width: 100%;">
            <section>Loading...</section>
        </blockquote>
    </a>
</div>
<script async src="https://www.tiktok.com/embed.js"></script>


<script async src="https://www.tiktok.com/embed.js"></script>

    <h1>Bienvenue sur GLOBALDROP !</h1>
    <p>Découvrez nos derniers produits :</p>

    {{-- Section Produits --}}
  <div class="row mb-5 produit-highlight ">
    @forelse($produits->take(4) as $produit)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm border-0 produit-card">
                @if($produit->photo)
                    <img src="{{ asset('storage/' . $produit->photo) }}" class="card-img-top rounded-top" alt="Photo du produit">
                @endif
                <div class="card-body">
                    <h5 class="card-title text-mauve">{{ $produit->nom }}</h5>
                    <p class="text-muted">Prix : {{ number_format($produit->prix, 2) }} €</p>
                    <p class="text-muted">Catégorie : {{ $produit->categorie->nom ?? 'N/A' }}</p>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('produits.show', $produit) }}" class="btn btn-sm btn-mauve">Voir détails</a>
                </div>
            </div>
        </div>
    @empty
        <p>Aucun produit disponible actuellement.</p>
    @endforelse

    <div class="text-center mt-4">
        <a href="{{ route('produits.index') }}" class="btn btn-outline-mauve">Voir tous les produits</a>
    </div>
</div>


    </div>

    {{-- Section Présentation --}}
    <div class="mb-5 p-4 bg-light rounded shadow-sm">
        <h2>À propos de Global Drop</h2>
        <p>Global Drop est une entreprise dédiée à vous offrir les meilleurs produits de qualité à des prix compétitifs. Notre mission est de faciliter vos achats avec un service client exceptionnel.</p>
    </div>


  
</div>
@endsection
