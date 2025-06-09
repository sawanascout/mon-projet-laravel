@extends('layouts.app')

@section('content')
<h1>Ajouter un produit</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label>Nom :</label><br>
        <input type="text" name="nom" value="{{ old('nom') }}" required>
    </div>
    <div>
        <label>Prix :</label><br>
        <input type="number" step="0.01" name="prix" value="{{ old('prix') }}" required>
    </div>
    <div>
        <label>Ancien prix (optionnel) :</label><br>
        <input type="number" step="0.01" name="ancien_prix" value="{{ old('ancien_prix') }}">
    </div>
    <div>
        <label>Description :</label><br>
        <textarea name="description">{{ old('description') }}</textarea>
    </div>
    <div>
        <label>Catégorie :</label><br>
        <select name="categories_id" required>
            <option value="">-- Choisir une catégorie --</option>
            @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}" {{ old('categories_id') == $categorie->id ? 'selected' : '' }}>
                    {{ $categorie->nom }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Photo :</label><br>
        <input type="file" name="photo" accept="image/*" required>
    </div>
    <div>
        <label>Disponible :</label><br>
        <select name="disponible">
            <option value="oui" {{ old('disponible') === 'oui' ? 'selected' : '' }}>Oui</option>
            <option value="non" {{ old('disponible') === 'non' ? 'selected' : '' }}>Non</option>
        </select>
    </div>
    <button type="submit">Ajouter</button>
</form>

<a href="{{ route('produits.index') }}">Retour à la liste</a>
@endsection
