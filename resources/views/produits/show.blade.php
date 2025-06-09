@extends('layouts.app')

@section('content')
<h1>Détail du produit</h1>

<p><strong>Nom :</strong> {{ $produit->nom }}</p>
<p><strong>Prix :</strong> {{ number_format($produit->prix, 2) }} €</p>
<p><strong>Ancien Prix :</strong> {{ $produit->ancien_prix ? number_format($produit->ancien_prix, 2) . ' €' : '-' }}</p>
<p><strong>Description :</strong><br>{{ $produit->description }}</p>
<p><strong>Catégorie :</strong> {{ $produit->categorie->nom ?? 'N/A' }}</p>
<p><strong>Disponible :</strong> {{ ucfirst($produit->disponible) }}</p>

@if($produit->photo)
    <p><img src="{{ asset('storage/' . $produit->photo) }}" alt="Photo produit" style="max-width: 300px;"></p>
@endif

<a href="{{ route('produits.index') }}">Retour à la liste</a>
@endsection
