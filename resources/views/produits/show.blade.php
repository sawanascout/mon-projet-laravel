@extends('layouts.client')

@section('content')
<div class="container py-5">

    {{-- Message succès --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    {{-- Détails produit --}}
    <div class="card shadow mb-5">
        <div class="row g-0">
            {{-- Image --}}
            <div class="col-md-6 d-flex align-items-center justify-content-center p-3">
                <img 
                    src="{{ $produit->photo ? asset('storage/' . $produit->photo) : asset('images/default.jpg') }}" 
                    alt="{{ $produit->nom }}" 
                    class="img-fluid rounded"
                    style="max-height: 400px; object-fit: contain;"
                    loading="lazy"
                >
            </div>

            {{-- Infos + Achat --}}
            <div class="col-md-6 p-4 d-flex flex-column justify-content-between">
                <div>
                    <h1 class="h3 fw-bold mb-3">{{ $produit->nom }}</h1>

                    {{-- Étoiles + note moyenne --}}
                    <div class="mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= round($averageRating))
                                <span class="text-warning fs-4">★</span>
                            @else
                                <span class="text-muted fs-4">★</span>
                            @endif
                        @endfor
                        <small class="text-muted ms-2">{{ number_format($averageRating, 1) }}/5</small>
                    </div>

                    <h2 class="text-primary fw-bold mb-4">
                        {{ number_format($produit->prix, 0, ',', ' ') }} FCFA
                    </h2>

                    <p class="mb-4">{{ $produit->description }}</p>
                </div>

                {{-- Formulaire ajout au panier --}}
                <form method="POST" action="{{ route('cart.add', $produit->id) }}" class="d-flex align-items-center gap-3">
                    @csrf
                    <label for="quantity" class="form-label mb-0 fw-medium">Quantité :</label>
                    <input 
                        type="number" 
                        name="quantity" 
                        id="quantity" 
                        value="1" 
                        min="1" 
                        class="form-control w-25"
                    >

                    <button type="submit" class="btn btn-primary flex-grow-1 flex-md-grow-0">
                        🛒 Ajouter au panier
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Retour boutique --}}
    <div class="mb-5">
        <a href="{{ route('produits.index') }}" class="text-primary text-decoration-none">&larr; Retour à la boutique</a>
    </div>

    {{-- Formulaire laisser un avis --}}
    <section class="mb-5" style="max-width: 600px;">
        <h2 class="h4 mb-4">Laisser un avis</h2>

        <form action="{{ route('avis.store', $produit->id) }}" method="POST">
            @csrf

            {{-- Note --}}
            <div class="mb-3">
                <label class="form-label fw-medium">Note :</label>
                <div id="star-rating" class="fs-3 text-muted" style="cursor: pointer; user-select: none;">
                    @for ($i = 1; $i <= 5; $i++)
                        <span data-value="{{ $i }}">★</span>
                    @endfor
                </div>
                <input type="hidden" name="note" id="rating" value="0">
            </div>

            {{-- Commentaire --}}
            <div class="mb-4">
                <label for="commentaire" class="form-label fw-medium">Commentaire :</label>
                <textarea name="commentaire" id="commentaire" rows="4" class="form-control" placeholder="Votre avis..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">✅ Envoyer l'avis</button>
        </form>
    </section>

    {{-- Liste des avis --}}
    @if ($produit->avis->count())
        <section style="max-width: 600px;">
            <h2 class="h4 mb-4">Avis des clients</h2>

            <div class="list-group">
                @foreach ($produit->avis->sortByDesc('created_at') as $avis)
                    <div class="list-group-item mb-3 rounded shadow-sm">
                        <div class="mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $avis->note)
                                    <span class="text-warning fs-5">★</span>
                                @else
                                    <span class="text-muted fs-5">★</span>
                                @endif
                            @endfor
                        </div>
                        <p class="mb-2">{{ $avis->commentaire }}</p>
                        <small class="text-muted">Posté le {{ $avis->created_at->format('d/m/Y à H:i') }}</small>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Script interaction étoiles --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('#star-rating span');
            const ratingInput = document.getElementById('rating');

            stars.forEach(star => {
                star.addEventListener('mouseover', () => {
                    highlightStars(parseInt(star.dataset.value));
                });

                star.addEventListener('click', () => {
                    ratingInput.value = star.dataset.value;
                    highlightStars(parseInt(star.dataset.value));
                });

                star.addEventListener('mouseout', () => {
                    highlightStars(parseInt(ratingInput.value));
                });
            });

            function highlightStars(rating) {
                stars.forEach(star => {
                    if (parseInt(star.dataset.value) <= rating) {
                        star.classList.add('text-warning');
                        star.classList.remove('text-muted');
                    } else {
                        star.classList.remove('text-warning');
                        star.classList.add('text-muted');
                    }
                });
            }
        });
    </script>

</div>
@endsection
