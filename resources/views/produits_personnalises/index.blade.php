@extends('layouts.app')

@section('content')
<h1>Mes Produits Personnalisés</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('produits_personnalises.create') }}">Créer un nouveau produit personnalisé</a>

@if($produits->isEmpty())
    <p>Vous n'avez aucun produit personnalisé.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Nom complet</th>
                <th>Genre</th>
                <th>Description</th>
                <th>Image</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produits as $produit)
                <tr>
                    <td>{{ $produit->nom_complet }}</td>
                    <td>{{ $produit->genre }}</td>
                    <td>{{ Str::limit($produit->description, 50) }}</td>
                    <td>
                        @if($produit->image)
                            <img src="{{ asset('storage/' . $produit->image) }}" alt="Image produit" style="max-width: 100px;">
                        @else
                            Aucune image
                        @endif
                    </td>
                    <td>{{ ucfirst($produit->statut) }}</td>
                    <td>
                        <a href="{{ route('produits_personnalises.show', $produit->id) }}">Voir</a> |
                        <a href="{{ route('produits_personnalises.edit', $produit->id) }}">Modifier</a> |
                        <form action="{{ route('produits_personnalises.destroy', $produit->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection
