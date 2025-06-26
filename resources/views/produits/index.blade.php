@extends('layouts.client')

@section('content')
<div class="py-5 container-fluid">
    <!-- En-tête de section -->
    <div class="mb-5 text-center">
        <h2 class="mb-3 display-6 fw-bold text-gradient">Nos Produits</h2>
        <div class="mx-auto divider-custom"></div>
        <p class="lead text-muted">Découvrez notre sélection de produits d'exception</p>
    </div>

    <!-- Grille des produits -->
    <div class="row g-4">
        @forelse ($produits as $produit)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="overflow-hidden shadow-elegant card h-100 product-card position-relative">
                    @if ($produit->ancien_prix && $produit->ancien_prix > $produit->prix)
                        <div class="top-0 m-3 position-absolute end-0 z-3">
                            <span class="badge bg-gradient-danger pulse-animation">
                                <i class="fas fa-percent me-1"></i>
                                -{{ round((($produit->ancien_prix - $produit->prix) / $produit->ancien_prix) * 100) }}%
                            </span>
                        </div>
                    @endif

                    <div class="overflow-hidden position-relative product-image-container">
                        <a href="{{ route('produits.show', $produit->id) }}" class="text-decoration-none">
                            <img
                                src="{{ $produit->photo ? asset('storage/' . $produit->photo) : asset('images/default.jpg') }}"
                                alt="{{ $produit->nom }}"
                                class="card-img-top product-image"
                                loading="lazy"
                            >
                        </a>
                        <div class="top-0 opacity-0 product-overlay position-absolute start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                            <div class="btn-group-vertical" role="group">
                                <a href="{{ route('produits.show', $produit->id) }}" 
                                   class="mb-2 btn btn-light btn-floating" 
                                   title="Voir le produit"
                                   data-bs-toggle="tooltip">
                                    <i class="fas fa-eye text-primary"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-light btn-floating" 
                                        onclick="addToWishlist({{ $produit->id }})" 
                                        title="Ajouter aux favoris"
                                        data-bs-toggle="tooltip">
                                    <i class="fas fa-heart text-danger"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Indicateur de stock -->
                        <div class="bottom-0 m-2 position-absolute start-0">
                            <span class="badge bg-success bg-gradient stock-badge">
                                <i class="fas fa-check-circle me-1"></i>En stock
                            </span>
                        </div>
                    </div>

                    <div class="p-4 card-body d-flex flex-column">
                        <div class="mb-3">
                            <h6 class="mb-2 card-title fw-bold product-title" title="{{ $produit->nom }}">
                                {{ $produit->nom }}
                            </h6>
                            
                            <!-- Évaluation avec design amélioré -->
                            <div class="mb-3 d-flex align-items-center rating-container">
                                <div class="stars-rating me-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= round($produit->rating ?? 0) ? ' star-filled' : ' star-empty' }}"></i>
                                    @endfor
                                </div>
                                <small class="text-muted rating-text">
                                    ({{ number_format($produit->rating ?? 0, 1) }})
                                </small>
                            </div>

                            <p class="card-text text-muted product-description">
                                {{ Str::limit($produit->description ?? 'Description du produit non disponible', 60) }}
                            </p>
                        </div>

                        <div class="mt-auto">
                            <!-- Prix avec design moderne -->
                            <div class="mb-3 price-section">
                                @if ($produit->ancien_prix && $produit->ancien_prix > $produit->prix)
                                    <div class="old-price text-muted">
                                        <small class="text-decoration-line-through">
                                            {{ number_format($produit->ancien_prix, 0, ',', ' ') }} FCFA
                                        </small>
                                    </div>
                                @endif
                                <div class="current-price fw-bold text-primary">
                                    {{ number_format($produit->prix, 0, ',', ' ') }} <span class="currency">FCFA</span>
                                </div>
                            </div>

                            <!-- Bouton d'action moderne -->
                            <div class="d-grid">
                                <a href="{{ route('produits.show', $produit->id) }}" 
                                   class="btn btn-primary-gradient btn-add-to-cart" 
                                   title="Voir les détails">
                                    <i class="fas fa-shopping-bag me-2"></i>
                                    <span>Découvrir</span>
                                    <i class="fas fa-arrow-right ms-2 btn-arrow"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="py-5 text-center empty-state">
                    <div class="mb-4 empty-icon">
                        <i class="opacity-50 fas fa-shopping-bag fa-4x text-primary"></i>
                    </div>
                    <h4 class="mb-3 text-dark">Aucun produit disponible</h4>
                    <p class="mb-4 text-muted">Il semble qu'aucun produit ne corresponde à vos critères de recherche.</p>
                    
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination moderne -->
    @if($produits->hasPages())
        <div class="mt-5 row">
            <div class="col-12">
                <nav aria-label="Navigation des produits" class="pagination-container">
                    <div class="d-flex justify-content-center">
                        {{ $produits->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </nav>
            </div>
        </div>
    @endif
</div>

<style>
:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --danger-gradient: linear-gradient(135deg, #ff6b6b 0%, #ee5a5a 100%);
    --success-gradient: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
    --shadow-elegant: 0 10px 30px rgba(0,0,0,0.1);
    --shadow-hover: 0 20px 40px rgba(0,0,0,0.15);
    --border-radius: 16px;
    --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

/* En-tête de section */
.text-gradient {
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.divider-custom {
    width: 80px;
    height: 4px;
    background: var(--primary-gradient);
    border-radius: 2px;
    margin: 0 auto 1rem;
}

/* Cartes produits */
.product-card {
    border: none;
    border-radius: var(--border-radius);
    transition: var(--transition-smooth);
    background: #fff;
    position: relative;
    overflow: hidden;
}

.product-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 49%, rgba(255,255,255,0.1) 50%, transparent 51%);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
    z-index: 1;
}

.product-card:hover::before {
    opacity: 1;
}

.shadow-elegant {
    box-shadow: var(--shadow-elegant);
}

.product-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: var(--shadow-hover);
}

/* Image produit */
.product-image-container {
    height: 220px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition-smooth);
}

.product-card:hover .product-image {
    transform: scale(1.08);
}

/* Overlay moderne */
.product-overlay {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
    backdrop-filter: blur(10px);
    transition: var(--transition-smooth);
}

.product-card:hover .product-overlay {
    opacity: 1 !important;
}

.btn-floating {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    border: none;
    transition: var(--transition-smooth);
}

.btn-floating:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(0,0,0,0.3);
}

/* Badges */
.badge {
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 20px;
    padding: 6px 12px;
}

.bg-gradient-danger {
    background: var(--danger-gradient);
    border: none;
}

.pulse-animation {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.stock-badge {
    background: var(--success-gradient) !important;
    font-size: 0.7rem;
}

/* Contenu de la carte */
.product-title {
    color: #2d3748;
    font-size: 1rem;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.rating-container .stars-rating {
    font-size: 0.9rem;
}

.star-filled {
    color: #ffd700;
    text-shadow: 0 0 3px rgba(255, 215, 0, 0.5);
}

.star-empty {
    color: #e2e8f0;
}

.rating-text {
    font-size: 0.8rem;
    font-weight: 500;
}

.product-description {
    font-size: 0.85rem;
    line-height: 1.5;
    height: 3em;
    overflow: hidden;
}

/* Section prix */
.price-section {
    padding: 12px 0;
    border-top: 1px solid rgba(0,0,0,0.05);
}

.current-price {
    font-size: 1.25rem;
    color: #667eea;
}

.currency {
    font-size: 0.9rem;
    font-weight: normal;
}

.old-price {
    font-size: 0.9rem;
    margin-bottom: 4px;
}

/* Bouton d'action */
.btn-primary-gradient {
    background: var(--primary-gradient);
    border: none;
    border-radius: 25px;
    padding: 12px 24px;
    font-weight: 600;
    color: white;
    transition: var(--transition-smooth);
    position: relative;
    overflow: hidden;
}

.btn-primary-gradient::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-primary-gradient:hover::before {
    left: 100%;
}

.btn-primary-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    color: white;
}

.btn-arrow {
    transition: transform 0.3s ease;
}

.btn-primary-gradient:hover .btn-arrow {
    transform: translateX(4px);
}

/* État vide */
.empty-state {
    padding: 60px 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: var(--border-radius);
    margin: 20px 0;
}

.empty-icon {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

/* Pagination */
.pagination-container {
    margin-top: 40px;
    padding: 20px 0;
}

.pagination-container .pagination {
    gap: 8px;
}

.pagination-container .page-link {
    border: none;
    border-radius: 8px;
    padding: 12px 16px;
    color: #667eea;
    font-weight: 500;
    transition: var(--transition-smooth);
}

.pagination-container .page-link:hover {
    background: var(--primary-gradient);
    color: white;
    transform: translateY(-2px);
}

.pagination-container .page-item.active .page-link {
    background: var(--primary-gradient);
    border: none;
}

/* Animations d'entrée */
.product-card {
    animation: fadeInUp 0.6s ease-out backwards;
}

.product-card:nth-child(1) { animation-delay: 0.1s; }
.product-card:nth-child(2) { animation-delay: 0.2s; }
.product-card:nth-child(3) { animation-delay: 0.3s; }
.product-card:nth-child(4) { animation-delay: 0.4s; }
.product-card:nth-child(5) { animation-delay: 0.5s; }
.product-card:nth-child(6) { animation-delay: 0.6s; }

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .product-image-container {
        height: 180px;
    }
    
    .product-card .card-body {
        padding: 1rem;
    }
    
    .current-price {
        font-size: 1.1rem;
    }
    
    .btn-primary-gradient {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .btn-group-vertical {
        flex-direction: row;
        gap: 8px;
    }
    
    .btn-floating {
        width: 40px;
        height: 40px;
    }
}
</style>

<script>
function addToWishlist(productId) {
    console.log('Ajout aux favoris du produit:', productId);

    const toast = document.createElement('div');
    toast.className = 'toast align-items-center text-white border-0 position-fixed top-0 end-0 m-3';
    toast.style.cssText = `
        z-index: 9999;
        background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    `;
    toast.role = 'alert';
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body fw-semibold">
                <i class="fas fa-heart me-2 text-danger"></i>
                Produit ajouté aux favoris !
            </div>
            <button type="button" class="m-auto btn-close btn-close-white me-2" data-bs-dismiss="toast"></button>
        </div>
    `;

    document.body.appendChild(toast);
    const toastInstance = new bootstrap.Toast(toast, {
        autohide: true,
        delay: 3000
    });
    toastInstance.show();

    // Animation d'entrée
    toast.style.transform = 'translateX(100%)';
    toast.style.transition = 'transform 0.3s ease';
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 100);

    // Nettoyage après disparition
    setTimeout(() => {
        if (toast.parentNode) {
            toast.remove();
        }
    }, 4000);
}

// Initialisation des tooltips et animations
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les tooltips Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Animation d'apparition progressive des cartes
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Observer toutes les cartes produits
    document.querySelectorAll('.product-card').forEach((card, index) => {
        if (index > 5) { // Seulement pour les cartes après les 6 premières
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            observer.observe(card);
        }
    });

    // Effet de parallaxe léger sur scroll (optionnel)
    let ticking = false;
    function updateParallax() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.product-card');
        
        parallaxElements.forEach((element, index) => {
            const rate = scrolled * -0.02;
            if (index % 2 === 0) {
                element.style.transform = `translateY(${rate}px)`;
            }
        });
        ticking = false;
    }

    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    });
});
</script>
@endsection