@extends('layouts.client')

@section('content')
<div class="py-5 container-fluid">

    <!-- Statistiques des promotions -->
    <div class="mb-5 text-white row">
        <div class="mb-3 col-md-3 col-6">
            <div class="text-center border-0 card bg-purple-light h-100">
                <div class="card-body">
                    <i class="mb-2 fas fa-fire fa-2x"></i>
                    <h5 class="card-title">{{ $produits->count() }}</h5>
                    <p class="card-text small">Produits en promo</p>
                </div>
            </div>
        </div>
        <div class="mb-3 col-md-3 col-6">
            <div class="text-center border-0 card bg-purple-dark h-100">
                <div class="card-body">
                    <i class="mb-2 fas fa-percentage fa-2x"></i>
                    <h5 class="card-title">70%</h5>
                    <p class="card-text small">Réduction max</p>
                </div>
            </div>
        </div>
        <div class="mb-3 col-md-3 col-6">
            <div class="text-center border-0 card bg-purple-medium h-100">
                <div class="card-body">
                    <i class="mb-2 fas fa-clock fa-2x"></i>
                    <h5 class="card-title">7J</h5>
                    <p class="card-text small">Temps restant</p>
                </div>
            </div>
        </div>
        <div class="mb-3 col-md-3 col-6">
            <div class="text-center border-0 card bg-purple-soft h-100">
                <div class="card-body">
                    <i class="mb-2 fas fa-shipping-fast fa-2x"></i>
                    <h5 class="card-title">Gratuite</h5>
                    <p class="card-text small">Livraison</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et tri -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="border-0 shadow-sm card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="mb-3 col-md-4 mb-md-0">
                            <h5 class="mb-0">
                                <i class="fas fa-filter me-2 text-purple"></i>
                                Filtrer les promotions
                            </h5>
                        </div>
                        <div class="col-md-8">
                            <div class="row g-2">
                                <div class="col-sm-4">
                                    <select class="form-select form-select-sm">
                                        <option>Toutes les réductions</option>
                                        <option>-10% à -30%</option>
                                        <option>-30% à -50%</option>
                                        <option>Plus de -50%</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-select form-select-sm">
                                        <option>Toutes catégories</option>
                                        <option>Électronique</option>
                                        <option>Mode</option>
                                        <option>Maison</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select class="form-select form-select-sm">
                                        <option>Trier par réduction</option>
                                        <option>Prix croissant</option>
                                        <option>Prix décroissant</option>
                                        <option>Fin de promo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grille des produits en promotion -->
    <div class="row">
        @forelse ($produits as $produit)
            <div class="mb-4 col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="border-0 shadow-sm card h-100 promo-card position-relative">
                    <!-- Badge promo avec pourcentage -->
                    <div class="top-0 position-absolute end-0 z-3">
                        <div class="promo-badge">
                            @php
                                $reduction = $produit->ancien_prix > 0 ? 
                                    round((($produit->ancien_prix - $produit->prix) / $produit->ancien_prix) * 100) : 0;
                            @endphp
                            <span class="p-2 text-white badge bg-purple fs-6 rounded-start-0">
                                <i class="fas fa-fire me-1"></i>-{{ $reduction }}%
                            </span>
                        </div>
                    </div>

                    <!-- Badge "Hot Deal" -->
                    @if($reduction >= 50)
                        <div class="top-0 m-2 position-absolute start-0 z-3">
                            <span class="badge bg-purple-light text-dark pulse-animation">
                                <i class="fas fa-star me-1"></i>HOT
                            </span>
                        </div>
                    @endif

                    <!-- Temps restant -->
                    <div class="bottom-0 m-2 position-absolute start-0 z-3">
                        <small class="bg-opacity-75 badge bg-dark">
                            <i class="fas fa-clock me-1"></i>J-7
                        </small>
                    </div>

                    <!-- Image du produit -->
                    <div class="overflow-hidden position-relative rounded-top">
                        <a href="{{ route('produits.show', $produit->id) }}" class="text-decoration-none">
                            <img
                                src="{{ $produit->photo ? asset('storage/' . $produit->photo) : asset('images/default.jpg') }}"
                                alt="{{ $produit->name ?? $produit->nom }}"
                                class="card-img-top promo-image rounded-top"
                                style="height: 200px; object-fit: cover; transition: all 0.3s ease;"
                            >
                        </a>
                        <!-- Overlay promo -->
                        <div class="top-0 promo-overlay position-absolute start-0 w-100 h-100 d-flex align-items-center justify-content-center rounded-top">
                            <div class="text-center">
                                <h4 class="mb-2 text-white fw-bold">-{{ $reduction }}%</h4>
                                <p class="mb-0 text-white small">Économisez {{ number_format($produit->ancien_prix - $produit->prix, 0, ',', ' ') }} FCFA</p>
                            </div>
                        </div>
                    </div>

                    <!-- Corps de la carte -->
                    <div class="p-3 card-body d-flex flex-column">
                        <!-- Nom du produit -->
                        <h6 class="mb-2 card-title text-truncate" title="{{ $produit->name ?? $produit->nom }}">
                            {{ $produit->name ?? $produit->nom }}
                        </h6>

                        <!-- Notation étoilée -->
                        <div class="mb-2 d-flex align-items-center">
                            <div class="text-warning me-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= round($produit->note ?? $produit->rating ?? 0) ? '' : '-o' }}" style="font-size: 0.8rem;"></i>
                                @endfor
                            </div>
                            <small class="text-muted">
                                ({{ number_format($produit->note ?? $produit->rating ?? 0, 1) }})
                            </small>
                        </div>

                        <!-- Description -->
                        <p class="mb-3 card-text small text-muted" style="font-size: 0.875rem; line-height: 1.3;">
                            {{ Str::limit($produit->description ?? '', 45) }}
                        </p>

                        <!-- Prix avec économie -->
                        <div class="mt-auto">
                            <div class="mb-3">
                                <!-- Ancien prix -->
                                <div class="mb-1 d-flex align-items-center">
                                    <small class="text-decoration-line-through text-muted me-2">
                                        {{ number_format($produit->ancien_prix, 0, ',', ' ') }} FCFA
                                    </small>
                                    <small class="badge bg-purple-light text-purple">
                                        -{{ number_format($produit->ancien_prix - $produit->prix, 0, ',', ' ') }}
                                    </small>
                                </div>
                                <!-- Nouveau prix -->
                                <div class="fw-bold text-purple fs-6">
                                    {{ number_format($produit->prix, 0, ',', ' ') }} FCFA
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="gap-2 d-grid">
                                <a href="{{ route('produits.show', $produit->id) }}" 
                                   class="btn btn-purple btn-sm">
                                    <i class="fas fa-shopping-cart me-1"></i>
                                    <span class="d-none d-sm-inline">Profiter</span>
                                    <span class="d-sm-none">+</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Message si aucune promotion -->
            <div class="col-12">
                <div class="py-5 text-center">
                    <div class="mb-4">
                        <i class="opacity-50 fas fa-percentage fa-4x text-muted"></i>
                    </div>
                    <h4 class="mb-3 text-muted">Aucune promotion actuellement</h4>
                    <p class="mb-4 text-muted">
                        Revenez bientôt pour découvrir nos nouvelles offres exceptionnelles !
                    </p>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="border-0 card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-bell me-2"></i>Être notifié des prochaines promos
                                    </h6>
                                    <div class="input-group">
                                        <input id="promo-email" type="email" class="form-control" placeholder="Votre email">
                                        <button onclick="subscribeToPromos(document.getElementById('promo-email').value)" class="btn btn-purple" type="button">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('produits.index') }}" class="btn btn-purple me-2">
                            <i class="fas fa-home me-1"></i>Accueil
                        </a>
                        <a href="{{ route('produits.index') }}" class="btn btn-outline-purple">
                            <i class="fas fa-shopping-bag me-1"></i>Tous les produits
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($produits->hasPages())
        <div class="mt-5 row">
            <div class="col-12">
                <nav aria-label="Navigation des promotions">
                    <div class="d-flex justify-content-center">
                        {{ $produits->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </nav>
            </div>
        </div>
    @endif

    
</div>

<!-- Styles spécifiques violet clair -->
<style>
    :root {
        --purple: #8a2be2;
        --purple-light: #dcd6f7;
        --purple-medium: #b39ddb;
        --purple-dark: #5e35b1;
        --purple-soft: #ede7f6;
    }

    .text-purple {
        color: var(--purple) !important;
    }

    .bg-purple {
        background-color: var(--purple) !important;
    }

    .bg-purple-light {
        background-color: var(--purple-light) !important;
    }

    .bg-purple-medium {
        background-color: var(--purple-medium) !important;
    }

    .bg-purple-dark {
        background-color: var(--purple-dark) !important;
    }

    .bg-purple-soft {
        background-color: var(--purple-soft) !important;
    }

    .btn-purple {
        background-color: var(--purple);
        color: white;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-purple:hover, .btn-purple:focus {
        background-color: var(--purple-dark);
        color: white;
    }

    .alert-purple {
        background-color: var(--purple-light);
        color: var(--purple-dark);
        border: none;
        font-weight: 600;
    }

    .promo-badge {
        border-radius: 0 0 0 0.375rem;
    }

    .promo-overlay {
        background: rgba(138, 43, 226, 0.75);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .promo-card:hover .promo-overlay {
        opacity: 1;
    }

    .pulse-animation {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.15);
            opacity: 0.7;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>

<script>
    function subscribeToPromos(email) {
        if (!email || !email.includes('@')) {
            alert('Veuillez entrer un email valide.');
            return;
        }
        alert('Merci pour votre inscription ! Vous serez notifié des prochaines promotions.');
        // Ici, un appel AJAX peut être réalisé pour enregistrer l'email.
    }
</script>
@endsection
