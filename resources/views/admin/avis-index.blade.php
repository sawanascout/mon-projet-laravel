@extends('layouts.admin')

@section('content')
<h1>Avis pour le produit : {{ $produit->nom }}</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Utilisateur</th>
            <th>Note</th>
            <th>Commentaire</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($avis as $a)
            <tr>
                <td>{{ $a->user->name }}</td>
                <td>{{ $a->note }}/5</td>
                <td>{{ $a->commentaire }}</td>
                <td>{{ $a->created_at->format('d/m/Y') }}</td>
                <td>
                    <form action="{{ route('avis.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('admin.produits.index') }}" class="btn btn-secondary mt-3">Retour</a>
@endsection
