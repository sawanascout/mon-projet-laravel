@extends('layouts.client')

@section('content')
<h2>Laisser un avis pour : {{ $produit->nom }}</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('avis.store', $produit->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="note">Note</label>
        <select name="note" class="form-control" required>
            <option value="">Choisir une note</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}/5</option>
            @endfor
        </select>
    </div>

    <div class="form-group mt-3">
        <label for="commentaire">Commentaire (optionnel)</label>
        <textarea name="commentaire" class="form-control">{{ old('commentaire') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success mt-3">Envoyer</button>
</form>

<a href="{{ route('produits.show', $produit->id) }}" class="btn btn-secondary mt-3">Retour au produit</a>
@endsection
