@extends('layouts.app')

@section('content')
<h1>Historique de vos commandes</h1>

@if($commandes->isEmpty())
    <p>Aucune commande trouvée.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Nom de l'administrateur</th>
                <th>Produits</th>
                <th>Catégories</th>
                <th>Prix total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        @foreach($commandes as $commande)
            <tr>
                <td>{{ $commande->Numcommande }}</td>
                <td>{{ $commande->user->name ?? 'Admin inconnu' }}</td>
                <td>{{ $commande->NbrProduits }}</td>
                <td>{{ $commande->NbrCategories }}</td>
                <td>{{ number_format($commande->prix, 2) }} CFA</td>
                <td>{{ $commande->created_at->format('d/m/Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
@endsection
