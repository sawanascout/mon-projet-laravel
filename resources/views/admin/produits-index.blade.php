@extends('layouts.app') <!-- Ou admin selon ta structure -->

@section('content')
<div class="container">
    <h1>Liste des produits</h1>

    @foreach($categories as $categorie)
    <h2>{{ $categorie->category_name}}</h2>

    <table class="table table-striped table-hover shadow">

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
            @foreach($produits->where('category_id', $categorie->id) as $produit)

                @include('admin.produits-edit', ['produit' => $produit])

                <tr>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->prix }} CFA</td>
                    <td>{{ $produit->ancien_prix }} CFA</td>
                    <td>{{ $produit->description }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $produit->photo) }}" onerror="this.src='{{ asset('images/default.png') }}'" alt="photo" width="60">

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