@extends('layouts.app')

@section('content')
<h1>Créer un produit personnalisé</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('produits_personnalises.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label>Nom complet :</label><br>
        <input type="text" name="nom_complet" value="{{ old('nom_complet') }}" required>
    </div>
    <div>
        <label>Genre :</label><br>
        <input type="text" name="genre" value="{{ old('genre') }}" required>
    </div>
    <div>
        <label>Description :</label><br>
        <textarea name="description" rows="4">{{ old('description') }}</textarea>
    </div>
    <div>
        <label>Image (optionnel) :</label><br>
        <input type="file" name="image" accept="image/*">
    </div>
    <button type="submit">Créer</button>
</form>

<a href="{{ route('produits_personnalises.index') }}">Retour à la liste</a>
@endsection
