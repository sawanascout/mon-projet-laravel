@extends('layouts.app')

@section('content')
<div class="banniere-container mb-4 rounded shadow">
    <div class="banniere-animée">
        <img src="{{ asset('images/baniere.png') }}" alt="Bannière animée">
    </div>
</div>


<!-- TikTok SDK -->
<script async src="https://www.tiktok.com/embed.js"></script>

<style>
  .banniere-container {
    background-color: #6f42c1; /* Violet Bootstrap (ou change selon ta charte) */
    overflow: hidden;
    position: relative;
    height: 200px; /* Hauteur de la bannière */
}

.banniere-animée {
    position: absolute;
    white-space: nowrap;
    animation: defilement 5s linear infinite;
}

.banniere-animée img {
    height: 100%;
    object-fit: cover;
}
@keyframes defilement {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
}
  :root {
  --primary-color: #7B4BB7; /* Mauve */
  --secondary-color: #3B8D54; /* Vert */
  --background-color: #f8f9fa;
  --text-color: #333;
}

body {
  background-color: var(--background-color);
  color: var(--text-color);
  font-family: 'Segoe UI', sans-serif;
}

/* Boutons */
.btn-primary {
  background-color: var(--primary-color);
  border-color: var(--primary-color);
  transition: all 0.3s ease;
}

.btn-primary:hover {
  background-color: #693aa5;
}

.btn-outline-secondary {
  color: var(--secondary-color);
  border-color: var(--secondary-color);
  transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
  background-color: var(--secondary-color);
  color: white;
}

/* Cartes Produits */
.card {
  border: 1px solid #ddd;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
  transform: scale(1.03);
  box-shadow: 0 10px 25px rgba(123, 75, 183, 0.2);
}

/* Bannière défilante */
.banniere-info {
  background-color: var(--primary-color);
  color: white;
  text-align: center;
  padding: 0.6rem;
}

.text-mauve {
  color: var(--primary-color);
}

.produit-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease, border 0.3s ease;
  border-top: 4px solid var(--secondary-color);
}

.produit-card:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 25px rgba(123, 75, 183, 0.2);
  border-color: var(--primary-color);
}

</style>

<div class="container mt-5">
    <h1>Bienvenue sur GLOBALDROP !</h1>
    
    <section class="mt-6 py-6">
        <div class="max-w-6xl mx-auto px-4 md:px-8">
            <h2 class="text-2xl font-bold text-center mb-6">
                Pourquoi <span class="text-mauve">choisir GlobalDrop</span> ?
            </h2>
            
            <div class="d-flex flex-wrap justify-content-center">
                <!-- Item 1 -->
                <div class="produit-card p-3 m-2 shadow-sm rounded">
                    <h3>🚚 Livraison rapide</h3>
                    <p>Expédition rapide grâce à notre logistique performante.</p>
                </div>
                
                <!-- Item 2 -->
                <div class="produit-card p-3 m-2 shadow-sm rounded">
                    <h3>💰 Prix compétitifs</h3>
                    <p>Des tarifs abordables sur des produits tendance.</p>
                </div>
                
                <!-- Item 3 -->
                <div class="produit-card p-3 m-2 shadow-sm rounded">
                    <h3>🔒 Paiement sécurisé</h3>
                    <p>Plateforme protégée pour des transactions sûres.</p>
                </div>
            </div>
        </div>
    </section>

    <p>Découvrez nos derniers produits :</p>

    {{-- Produits --}}
    <div class="row mb-5 produit-highlight">
        @forelse($produits->take(4) as $produit)
            <div class="col-md-3 mb-4">
                <div class="card produit-card">
                    @if($produit->photo)
                        <img src="{{ asset('storage/' . $produit->photo) }}" class="card-img-top" alt="Photo du produit">
                    @endif
                    <div class="card-body">
                        <h5 class="text-mauve">{{ $produit->nom }}</h5>
                        <p>Prix : {{ number_format($produit->prix, 2) }} €</p>
                        <p>Catégorie : {{ $produit->categorie->nom ?? 'N/A' }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('produits.show', $produit) }}" class="btn btn-primary">Voir détails</a>
                    </div>
                </div>
            </div>
        @empty
            <p>Aucun produit disponible actuellement.</p>
        @endforelse

        <div class="text-center mt-4">
            <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary">Voir tous les produits</a>
        </div>
    </div>
</div>
@endsection
