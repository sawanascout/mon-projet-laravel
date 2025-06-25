@extends('layouts.client')

@section('content')
<div class="container-fluid py-5">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="text-center">
                <div class="mb-4">
                    <i class="fas fa-percent fa-3x text-danger"></i>
                </div>
                <h1 class="display-4 fw-bold text-primary mb-3">
                    <span class="text-danger">🔥</span> Promotions Exceptionnelles
                </h1>
                <p class="lead text-muted mb-4">
                    Profitez de nos offres limitées avec des réductions jusqu'à 70%
                </p>
                <div class="alert alert-warning d-inline-block" role="alert">
                    <i class="fas fa-clock me-2"></i>
                    <strong>Offres limitées !</strong> Dépêchez-vous avant qu'il ne soit trop tard
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques des promotions -->
    <div class="row mb-5">
        <div class="col-md-3 col-6 mb-3">
            <div class="card text-center border-0 bg-danger text-white h-100">
                <div class="card-body">
                    <i class="fas fa-fire fa-2x mb-2"></i>
                    <h5 class="card-title">{{ $produits->count() }}</h5>
                    <p class="card-text small">Produits en promo</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card text-center border-0 bg-success text-white h-100">
                <div class="card-body">
                    <i class="fas fa-percentage fa-2x mb-2"></i>
                    <h5 class="card-title">70%</h5>
                    <p class="card-text small">Réduction max</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card text-center border-0 bg-warning text-white h-100">
                <div class="card-body">
                    <i class="fas fa-clock fa-2x mb-2"></i>
                    <h5 class="card-title">7J</h5>
                    <p class="card-text small">Temps restant</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card text-center border-0 bg-info text-white h-100">
                <div class="card-body">
                    <i class="fas fa-shipping-fast fa-2x mb-2"></i>
                    <h5 class="card-title">Gratuite</h5>
                    <p class="card-text small">Livraison</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et tri -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <h5 class="mb-0">
                                <i class="fas fa-filter me-2 text-primary"></i>
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
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 mb-4">
                <div class="card h-100 shadow-sm promo-card position-relative border-0">
                    <!-- Badge promo avec pourcentage -->
                    <div class="position-absolute top-0 end-0 z-3">
                        <div class="promo-badge">
                            @php
                                $reduction = $produit->ancien_prix > 0 ? 
                                    round((($produit->ancien_prix - $produit->prix) / $produit->ancien_prix) * 100) : 0;
                            @endphp
                            <span class="badge bg-danger fs-6 p-2 rounded-start-0">
                                <i class="fas fa-fire me-1"></i>-{{ $reduction }}%
                            </span>
                        </div>
                    </div>

                    <!-- Badge "Hot Deal" -->
                    @if($reduction >= 50)
                        <div class="position-absolute top-0 start-0 z-3 m-2">
                            <span class="badge bg-warning text-dark pulse-animation">
                                <i class="fas fa-star me-1"></i>HOT
                            </span>
                        </div>
                    @endif

                    <!-- Temps restant -->
                    <div class="position-absolute bottom-0 start-0 z-3 m-2">
                        <small class="badge bg-dark bg-opacity-75">
                            <i class="fas fa-clock me-1"></i>J-7
                        </small>
                    </div>

                    <!-- Image du produit -->
                    <div class="position-relative overflow-hidden">
                        <a href="{{ route('produits.show', $produit->id) }}" class="text-decoration-none">
                            <img
                                src="{{ $produit->photo ? asset('storage/' . $produit->photo) : asset('images/default.jpg') }}"
                                alt="{{ $produit->name ?? $produit->nom }}"
                                class="card-img-top promo-image"
                                style="height: 200px; object-fit: cover; transition: all 0.3s ease;"
                            >
                        </a>
                        <!-- Overlay promo -->
                        <div class="promo-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <h4 class="text-white fw-bold mb-2">-{{ $reduction }}%</h4>
                                <p class="text-white small mb-0">Économisez {{ number_format($produit->ancien_prix - $produit->prix, 0, ',', ' ') }} FCFA</p>
                            </div>
                        </div>
                    </div>

                    <!-- Corps de la carte -->
                    <div class="card-body d-flex flex-col p-3">
                        <!-- Nom du produit -->
                        <h6 class="card-title text-truncate mb-2" title="{{ $produit->name ?? $produit->nom }}">
                            {{ $produit->name ?? $produit->nom }}
                        </h6>

                        <!-- Notation étoilée -->
                        <div class="d-flex align-items-center mb-2">
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
                        <p class="card-text small text-muted mb-3" style="font-size: 0.875rem; line-height: 1.3;">
                            {{ Str::limit($produit->description ?? '', 45) }}
                        </p>

                        <!-- Prix avec économie -->
                        <div class="mt-auto">
                            <div class="mb-3">
                                <!-- Ancien prix -->
                                <div class="d-flex align-items-center mb-1">
                                    <small class="text-decoration-line-through text-muted me-2">
                                        {{ number_format($produit->ancien_prix, 0, ',', ' ') }} FCFA
                                    </small>
                                    <small class="badge bg-success">
                                        -{{ number_format($produit->ancien_prix - $produit->prix, 0, ',', ' ') }}
                                    </small>
                                </div>
                                <!-- Nouveau prix -->
                                <div class="fw-bold text-danger fs-6">
                                    {{ number_format($produit->prix, 0, ',', ' ') }} FCFA
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('produits.show', $produit->id) }}" 
                                   class="btn btn-danger btn-sm">
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
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-percentage fa-4x text-muted opacity-50"></i>
                    </div>
                    <h4 class="text-muted mb-3">Aucune promotion actuellement</h4>
                    <p class="text-muted mb-4">
                        Revenez bientôt pour découvrir nos nouvelles offres exceptionnelles !
                    </p>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-bell me-2"></i>Être notifié des prochaines promos
                                    </h6>
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Votre email">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary me-2">
                            <i class="fas fa-home me-1"></i>Accueil
                        </a>
                        <a href="{{ route('produits.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-shopping-bag me-1"></i>Tous les produits
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($produits->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <nav aria-label="Navigation des promotions">
                    <div class="d-flex justify-content-center">
                        {{ $produits->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </nav>
            </div>
        </div>
    @endif

    <!-- Section d'urgence -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card bg-gradient-danger text-white border-0 shadow-lg">
                <div class="card-body text-center py-5">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="card-title mb-3">
                                <i class="fas fa-bolt me-2"></i>Vente Flash - Dernières heures !
                            </h3>
                            <p class="card-text lead mb-0">
                                Les plus gros rabais de l'année se terminent bientôt
                            </p>
                        </div>
                        <div class="col-md-4 mt-3 mt-md-0">
                            <div class="countdown-timer bg-white text-dark rounded p-3">
                                <div class="row text-center">
                                    <div class="col-3">
                                        <div class="fw-bold fs-4">06</div>
                                        <small>Jours</small>
                                    </div>
                                    <div class="col-3">
                                        <div class="fw-bold fs-4">23</div>
                                        <small>Heures</small>
                                    </div>
                                    <div class="col-3">
                                        <div class="fw-bold fs-4">45</div>
                                        <small>Min</small>
                                    </div>
                                    <div class="col-3">
                                        <div class="fw-bold fs-4">12</div>
                                        <small>Sec</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles CSS personnalisés -->
<style>
.bg-gradient-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
}

.promo-card {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.promo-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(220, 53, 69, 0.3) !important;
    border-color: #dc3545;
}

.promo-card:hover .promo-image {
    transform: scale(1.1);
}

.promo-overlay {
    background: linear-gradient(45deg, rgba(220, 53, 69, 0.9), rgba(200, 35, 51, 0.9));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.promo-card:hover .promo-overlay {
    opacity: 1;
}

.promo-badge {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-5px);
    }
    60% {
        transform: translateY(-3px);
    }
}

.pulse-animation {
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(255, 193, 7, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(255, 193, 7, 0);
    }
}

.countdown-timer {
    border: 2px solid rgba(255,255,255,0.3);
}

/* Responsive */
@media (max-width: 576px) {
    .promo-card .card-body {
        padding: 0.75rem;
    }
    
    .display-4 {
        font-size: 2rem !important;
    }
    
    .promo-badge .badge {
        font-size: 0.7rem !important;
        padding: 0.4rem !important;
    }
}

@media (max-width: 375px) {
    .col-6 {
        padding-left: 0.25rem;
        padding-right: 0.25rem;
    }
    
    .promo-card .card-title {
        font-size: 0.85rem;
    }
}

/* Animation d'entrée */
.promo-card {
    animation: slideInUp 0.6s ease-out;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Style pour les statistiques */
.card:hover {
    transform: translateY(-2px);
    transition: transform 0.2s ease;
}
</style>

<!-- JavaScript pour les interactions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes au scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    });

    document.querySelectorAll('.promo-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
    });

    // Compteur de temps (exemple)
    function updateCountdown() {
        // Cette fonction peut être connectée à une vraie logique de countdown
        const timeElements = document.querySelectorAll('.countdown-timer .fw-bold');
        if (timeElements.length > 0) {
            // Simulation d'un décompte
            setInterval(() => {
                // Logique de décompte ici
            }, 1000);
        }
    }

    updateCountdown();
});

// Fonction pour notification des promotions
function subscribeToPromos(email) {
    // Logique AJAX pour s'abonner aux notifications
    console.log('Abonnement aux promos pour:', email);
    
    const toast = `
        <div class="toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3" role="alert" style="z-index: 9999;">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check me-2"></i>Vous serez notifié des prochaines promotions !
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', toast);
    const toastElement = new bootstrap.Toast(document.querySelector('.toast:last-child'));
    toastElement.show();
}
</script>
@endsection