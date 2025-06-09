@extends('layouts.app') <!-- Ou admin selon ta structure -->

@section('content')
<div class="container">
    <h1>Liste des produits</h1>

    @foreach($categories as $categorie)
    <h3>{{ $categorie->nom }}</h3>

    <table class="table table-bordered mb-5">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Ancien Prix</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Disponible</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produits->where('categories_id', $categorie->id) as $produit)
                <tr>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->prix }} CFA</td>
                    <td>{{ $produit->ancien_prix }} CFA</td>
                    <td>{{ $produit->description }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $produit->photo) }}" alt="photo" width="60">
                    </td>
                    <td>{{ $produit->disponible ? 'Oui' : 'Non' }}</td>
                    <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $produit->id }}">
                        Modifier
                    </button>
                        <form action="{{ route('admin.produits.destroy', $produit->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach

</div>
@endsection 