@extends('layouts.app')

@section('content')
<h1>Détails de la Catégorie : {{ $category->nom }}</h1>

<h3>Produits associés :</h3>
<ul>
    @forelse($category->produits as $produit)
        <li>{{ $produit->nom }}</li>
    @empty
        <li>Aucun produit pour cette catégorie.</li>
    @endforelse
</ul>

<a href="{{ route('admin.categories-index') }}" class="btn btn-secondary mt-3">Retour</a>
@endsection
