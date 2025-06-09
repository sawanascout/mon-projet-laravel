@extends('layouts.app')

@section('content')
<h1>Détail du produit personnalisé</h1>

<p><strong>Nom complet :</strong> {{ $produit->nom_complet }}</p>
<p><strong>Genre :</strong> {{ $produit->genre }}</p>
<p><strong>Description :</strong><br>{{ $produit->description }}</p>

@if($produit->image)
    <p><img src="{{ asset('storage/' . $produit->image) }}" alt="Image produit" style="max-width: 300px;"></p>
@else
    <p>Aucune image disponible.</p>
@endif

<p><strong>Statut :</strong> {{ ucfirst($produit->statut) }}</p>

<a href="{{ route('produits_personnalises.edit', $produit->id) }}">Modifier</a> |
<a href="{{ route('produits_personnalises.index') }}">Retour à la liste</a>
@endsection
