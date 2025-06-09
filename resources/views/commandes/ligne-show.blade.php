@extends('layouts.app')

@section('content')
<h1>Détail de la ligne de commande #{{ $ligne->id }}</h1>

<ul>
    <li><strong>Produit :</strong> {{ $ligne->produit->nom ?? 'Produit supprimé' }}</li>
    <li><strong>Couleur :</strong> {{ $ligne->couleur }}</li>
    <li><strong>Taille :</strong> {{ $ligne->taille }}</li>
    <li><strong>Quantité :</strong> {{ $ligne->quantite }}</li>
    <li><strong>Prix unitaire :</strong> {{ number_format($ligne->prix, 2) }} €</li>
    <li><strong>Total :</strong> {{ number_format($ligne->prix * $ligne->quantite, 2) }} €</li>
</ul>

<a href="{{ url()->previous() }}">Retour</a>

@endsection
