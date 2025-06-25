@extends('layouts.client')

@section('content')
<div class="container-fluid py-5">
    <!-- Filtres et Tri -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="card-title mb-3 mb-md-0">
                                <i class="fas fa-filter me-2"></i>Filtres
                            </h5>
                        </div>
                        <div class="col-md-6">
                            <div class="row g-2">
                                <div class="col-sm-6">
                                    <select class="form-select form-select-sm" name="categorie" onchange="this.form.submit()">
                                        <option value="">Toutes les catégories</option>
                                        <option value="electronique">Électronique</option>
                                        <option value="vetements">Vêtements</option>
                                        <option value="maison">Maison</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-select form-select-sm" name="tri" onchange="this.form.submit()">
                                        <option value="">Trier par</option>
                                        <option value="prix_croissant">Prix croissant</option>
                                        <option value="prix_decroissant">Prix décroissant</option>
                                        <option value="nouveautes">Nouveautés</option>
                                        <option value="popularite">Popularité</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grille des produits -->
    <div class="row">
        @forelse ($produits as $produit)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2 mb-4">
                <div class="card h-100 shadow-sm product-card position-relative overflow-hidden">
                    @if ($produit->ancien_prix && $produit->ancien_prix > $produit->prix)
                        <div class="position-absolute top-0 end-0 m-2 z-3">
                            <span class="badge bg-danger">
                                <i class="fas fa-percent me-1"></i>Promo
                            </span>
                        </div>
                    @endif

                    <div class="position-relative overflow-hidden">
                        <a href="{{ route('produits.show', $produit->id) }}" class="text-decoration-none">
                            <img
                                src="{{ $produit->photo ? asset('storage/' . $produit->photo) : asset('images/default.jpg') }}"
                                alt="{{ $produit->nom }}"
                                class="card-img-top product-image"
                                style="height: 200px; object-fit: cover; transition: transform 0.3s ease;"
                            >
                        </a>
                        <div class="product-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center opacity-0">
                            <div class="btn-group" role="group">
                                <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-primary btn-sm" title="Voir le produit">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-success btn-sm" onclick="addToWishlist({{ $produit->id }})" title="Ajouter aux favoris">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column p-3">
                        <h6 class="card-title text-truncate mb-2" title="{{ $produit->nom }}">
                            {{ $produit->nom }}
                        </h6>

                        <div class="d-flex align-items-center mb-2">
                            <div class="text-warning me-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= round($produit->rating ?? 0) ? '' : '-o' }}"></i>
                                @endfor
                            </div>
                            <small class="text-muted">({{ number_format($produit->rating ?? 0, 1) }})</small>
                        </div>

                        <p class="card-text small text-muted mb-3" style="font-size: 0.875rem;">
                            {{ Str::limit($produit->description ?? '', 50) }}
                        </p>

                        <div class="mt-auto">
                            <div class="mb-3">
                                @if ($produit->ancien_prix && $produit->ancien_prix > $produit->prix)
                                    <small class="text-decoration-line-through text-muted d-block">
                                        {{ number_format($produit->ancien_prix, 0, ',', ' ') }} FCFA
                                    </small>
                                @endif
                                <div class="fw-bold text-primary fs-6">
                                    {{ number_format($produit->prix, 0, ',', ' ') }} FCFA
                                </div>
                            </div>

                            <div class="d-grid">
                                <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-shopping-cart me-1"></i>
                                    <span class="d-none d-sm-inline">Ajouter</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-box-open fa-3x text-muted"></i>
                    </div>
                    <h4 class="text-muted">Aucun produit trouvé</h4>
                    <p class="text-muted">Essayez de modifier vos critères de recherche</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Retour à l'accueil
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($produits->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <nav aria-label="Navigation des produits">
                    <div class="d-flex justify-content-center">
                        {{ $produits->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </nav>
            </div>
        </div>
    @endif
</div>

<style>
.product-card {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.08);
    animation: fadeInUp 0.6s ease-out;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.product-card:hover .product-overlay {
    opacity: 1 !important;
    background: rgba(0,0,0,0.5);
}

.product-overlay {
    transition: opacity 0.3s ease;
}

.badge {
    font-size: 0.7rem;
}

@media (max-width: 375px) {
    .col-6 {
        padding-left: 0.25rem;
        padding-right: 0.25rem;
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
function addToWishlist(productId) {
    console.log('Ajout aux favoris du produit:', productId);

    const toast = document.createElement('div');
    toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3';
    toast.style.zIndex = 9999;
    toast.role = 'alert';
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-heart me-2"></i>Produit ajouté aux favoris !
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;

    document.body.appendChild(toast);
    const toastInstance = new bootstrap.Toast(toast);
    toastInstance.show();

    setTimeout(() => {
        toastInstance.hide();
        toast.remove();
    }, 3000);
}

document.addEventListener('DOMContentLoaded', function() {
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

    document.querySelectorAll('.product-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
    });
});
</script>
@endsection
