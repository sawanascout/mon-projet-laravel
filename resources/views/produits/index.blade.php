@extends('layouts.client')

@section('content')
<div class="py-5 container-fluid">

    <!-- Grille des produits -->
    <div class="row">
        @forelse ($produits as $produit)
            <div class="mb-4 col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="overflow-hidden shadow-sm card h-100 product-card position-relative">
                    @if ($produit->ancien_prix && $produit->ancien_prix > $produit->prix)
                        <div class="top-0 m-2 position-absolute end-0 z-3">
                            <span class="badge bg-danger">
                                <i class="fas fa-percent me-1"></i>Promo
                            </span>
                        </div>
                    @endif

                    <div class="overflow-hidden position-relative">
                        <a href="{{ route('produits.show', $produit->id) }}" class="text-decoration-none">
                            <img
                                src="{{ $produit->photo ? asset('storage/' . $produit->photo) : asset('images/default.jpg') }}"
                                alt="{{ $produit->nom }}"
                                class="card-img-top product-image"
                                style="height: 200px; object-fit: cover; transition: transform 0.3s ease;"
                            >
                        </a>
                        <div class="top-0 opacity-0 product-overlay position-absolute start-0 w-100 h-100 d-flex align-items-center justify-content-center">
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

                    <div class="p-3 card-body d-flex flex-column">
                        <h6 class="mb-2 card-title text-truncate" title="{{ $produit->nom }}">
                            {{ $produit->nom }}
                        </h6>

                        <div class="mb-2 d-flex align-items-center">
                            <div class="text-warning me-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $i <= round($produit->rating ?? 0) ? '' : '-o' }}"></i>
                                @endfor
                            </div>
                            <small class="text-muted">({{ number_format($produit->rating ?? 0, 1) }})</small>
                        </div>

                        <p class="mb-3 card-text small text-muted" style="font-size: 0.875rem;">
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
                                <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-purple btn-sm" title="Voir les détails">
                                    <i class="fas fa-shopping-cart me-1"></i>
                                    <span class="d-inline">Ajouter</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="py-5 text-center">
                    <div class="mb-4">
                        <i class="fas fa-box-open fa-3x text-muted"></i>
                    </div>
                    <h4 class="text-muted">Aucun produit trouvé</h4>
                    <p class="text-muted">Essayez de modifier vos critères de recherche</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($produits->hasPages())
        <div class="mt-5 row">
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

.btn-purple {
    background-color: #6f42c1;
    border-color: #6f42c1;
    color: white;
}

.btn-purple:hover {
    background-color: #5a32a3;
    border-color: #512d94;
    color: white;
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
            <button type="button" class="m-auto btn-close btn-close-white me-2" data-bs-dismiss="toast"></button>
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
