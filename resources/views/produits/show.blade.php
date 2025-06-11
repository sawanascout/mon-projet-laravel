@extends('layouts.app')

@section('content')
<h1>Détail du produit</h1>
@if($produit->photo)
    <p><img src="{{ asset('storage/' . $produit->photo) }}" alt="Photo produit" style="max-width: 300px;"></p>
@endif
<hr>

<p><strong>Nom :</strong> {{ $produit->nom }}</p>
<p><strong>Prix :</strong> {{ number_format($produit->prix, 2) }} CFA</p>
<p><strong>Ancien Prix :</strong> {{ $produit->ancien_prix ? number_format($produit->ancien_prix, 2) . ' CFA' : '-' }}</p>
<p><strong>Description :</strong><br>{{ $produit->description }}</p>
<p><strong>Catégorie :</strong> {{ $produit->categorie->nom ?? 'N/A' }}</p>
<p><strong>Disponible :</strong> {{ ucfirst($produit->disponible) }}</p>

<form action="{{ route('client.panier.ajouter', $produit->id) }}" method="POST" class="mb-4">
    @csrf
    <div class="row g-3 align-items-end">
        <div class="col-auto">
            <label for="couleur" class="form-label">Couleur</label>
            <select name="couleur" id="couleur" class="form-select" required>
                <option value="" disabled selected>Choisir une couleur</option>
                @foreach($produit->couleur ?? [] as $couleur)
                    <option value="{{ $couleur }}">{{ ucfirst($couleur) }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-auto">
            <label for="taille" class="form-label">Taille</label>
            <select name="taille" id="taille" class="form-select" required>
                <option value="" disabled selected>Choisir une taille</option>
                @foreach($produit->taille ?? [] as $taille)
                    <option value="{{ $taille }}">{{ strtoupper($taille) }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-auto">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control" value="1" min="1" max="1000" required>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-success" @if(!$produit->disponible) disabled @endif>
                Ajouter au panier
            </button>
        </div>
    </div>
</form>


<h3>Avis des clients</h3>

@if($produit->avis->isEmpty())
    <p>Aucun avis pour ce produit.</p>
@else
    @foreach($produit->avis as $avis)
        <div class="card mb-3">
            <div class="card-body">
                {{-- Affichage des étoiles pour la note --}}
                <p>
                   <p class="star-rating">
    @for ($i = 1; $i <= 5; $i++)
        <span class="{{ $i <= $avis->note ? 'filled' : '' }}">&#9733;</span>
    @endfor
</p>

                </p>

                {{-- Commentaire --}}
                <p>{{ $avis->commentaire }}</p>

                {{-- Auteur + date --}}
                <p class="text-muted">
                    Par <strong>{{ $avis->user->name ?? 'Utilisateur' }}</strong> 
                    le {{ $avis->created_at->format('d/m/Y') }}
                </p>
            </div>
        </div>
    @endforeach
@endif


<a href="{{ route('produits.index') }}">Retour à la liste</a>
@endsection
