@extends('layouts.client')

@section('content')
<div class="container py-5" style="max-width: 800px;">
    <h1 class="mb-5 text-center fw-bold">🛒 Finalisez votre commande</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('commandes.store') }}" method="POST" class="p-4 bg-white border rounded shadow-sm">
        @csrf

        <!-- Infos client -->
        <div class="row g-3">
            <div class="col-md-6">
                <label for="customer_name" class="form-label fw-semibold">Nom complet</label>
                <input type="text" id="customer_name" name="customer_name" required class="form-control">
            </div>
            <div class="col-md-6">
                <label for="city" class="form-label fw-semibold">Ville</label>
                <input type="text" id="city" name="city" required class="form-control">
            </div>
            <div class="col-md-6">
                <label for="phone_code" class="form-label fw-semibold">Indicatif</label>
                <select id="phone_code" name="phone_code" required class="form-select">
                    <option value="" disabled selected>Choisissez l'indicatif</option>
                    <option value="+228">+228 (Togo)</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="whatsapp_number" class="form-label fw-semibold">Numéro WhatsApp</label>
                <input type="text" id="whatsapp_number" name="whatsapp_number" placeholder="Ex: 90000000" class="form-control">
                <small class="text-muted">Sans indicatif</small>
            </div>
        </div>

        <!-- Panier -->
        <h2 class="mt-5 mb-4 border-bottom pb-2 fw-semibold">🧺 Mon panier</h2>

        <ul class="list-group mb-4">
            @foreach($panier as $key => $ligne)
                <li class="list-group-item">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div>
                            <h5 class="mb-1">{{ $ligne['nom'] }}</h5>
                            <small class="text-muted">Quantité : x{{ $ligne['quantite'] }}</small><br>
                            <small class="text-muted">Prix unitaire : {{ number_format($ligne['prix'], 0, ',', ' ') }} FCFA</small>
                        </div>

                        <div class="d-flex gap-3 mt-3 mt-md-0 flex-wrap">
                            <!-- Couleur -->
                            <div class="me-2">
                                <label class="form-label fw-semibold mb-1">🎨 Couleur</label>
                                <select name="panier[{{ $key }}][couleur_select]" class="form-select couleur-select" data-target="#couleur-autre-{{ $key }}">
                                    <option value="">Sélectionner</option>
                                    <option value="Noir">Noir</option>
                                    <option value="Blanc">Blanc</option>
                                    <option value="Rouge">Rouge</option>
                                    <option value="Bleu">Bleu</option>
                                    <option value="autre">Autre...</option>
                                </select>
                                <input type="text" name="panier[{{ $key }}][couleur]" id="couleur-autre-{{ $key }}" placeholder="Votre couleur" class="form-control mt-2 d-none">
                            </div>

                            <!-- Taille -->
                            <div>
                                <label class="form-label fw-semibold mb-1">📏 Dimension</label>
                                <select name="panier[{{ $key }}][taille_select]" class="form-select taille-select" data-target="#taille-autre-{{ $key }}">
                                    <option value="">Sélectionner</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="autre">Autre...</option>
                                </select>
                                <input type="text" name="panier[{{ $key }}][taille]" id="taille-autre-{{ $key }}" placeholder="Votre taille" class="form-control mt-2 d-none">
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        <!-- Total -->
        <div class="text-end fw-bold fs-5 text-primary mb-4">
            Total : {{ number_format(collect($panier)->sum(fn($ligne) => $ligne['prix'] * $ligne['quantite']), 0, ',', ' ') }} FCFA
        </div>

        <!-- Actions -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
            <a href="{{ route('produits.index') }}" class="text-primary text-decoration-underline">
                ← Continuer mes achats
            </a>
            <button type="submit" class="btn btn-primary px-4 py-2">
                ✅ Confirmer la commande
            </button>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('.couleur-select').forEach(select => {
        select.addEventListener('change', function () {
            const target = document.querySelector(this.dataset.target);
            if (this.value === 'autre') {
                target.classList.remove('d-none');
            } else {
                target.classList.add('d-none');
                target.value = '';
            }
        });
    });

    document.querySelectorAll('.taille-select').forEach(select => {
        select.addEventListener('change', function () {
            const target = document.querySelector(this.dataset.target);
            if (this.value === 'autre') {
                target.classList.remove('d-none');
            } else {
                target.classList.add('d-none');
                target.value = '';
            }
        });
    });
</script>
@endsection
