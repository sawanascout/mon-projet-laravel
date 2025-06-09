@extends('layouts.admin')

@section('content')
<h1>Liste des Catégories</h1>

<a href="{{ route('admin.categories-create') }}" class="btn btn-primary mb-3">Ajouter une catégorie</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Produits</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->nom }}</td>
                <td>{{ $category->produits->count() }}</td>
                <td>
                    <a href="{{ route('admin.categories-show', $category) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('admin.categories-edit', $category) }}" class="btn btn-warning btn-sm">Éditer</a>
                    <form action="{{ route('admin.categories-destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
