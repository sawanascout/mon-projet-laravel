@extends('layouts.app')

@section('content')
<h1>Modifier le produit personnalisé</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('produits_personnalises.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label>Nom complet :</label><br>
        <input type="text" name="nom_complet" value="{{ old('nom_complet', $produit->nom_complet) }}" required>
    </div>
    <div>
        <label>Genre :</label><br>
        <input type="text" name="genre" value="{{ old('genre', $produit->genre) }}" required>
    </div>
    <div>
        <label>Description :</label><br>
        <textarea name="description" rows="4">{{ old('description', $produit->description) }}</textarea>
    </div>
    <div>
        <label>Image actuelle :</label><br>
        @if($produit->image)
            <img src="{{ asset('storage/' . $produit->image) }}" alt="Image produit" style="max-width: 200px;">
        @else
            Aucune image
        @endif
    </div>
    <div>
        <label>Changer l'image :</label><br>
        <input type="file" name="image" accept="image/*">
    </div>
    <button type="submit">Mettre à jour</button>
</form>

<a href="{{ route('produits_personnalises.index') }}">Retour à la liste</a>
@endsection
