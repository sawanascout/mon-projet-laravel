@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Mon Profil</h1>

    <div class="card mb-4">
        <div class="card-header">Informations personnelles</div>
        <div class="card-body">
            <p><strong>Nom :</strong> {{ $client->name }}</p>
            <p><strong>Email :</strong> {{ $client->email }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Mon panier</div>
        <div class="card-body">
            @if ($elements->isEmpty())
                <p>Votre panier est vide.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($elements as $element)
                            <tr>
                                <td>{{ $element->produit->nom }}</td>
                                <td>{{ $element->quantite }}</td>
                                <td>{{ number_format($element->produit->prix, 2) }} €</td>
                                <td>{{ number_format($element->quantite * $element->produit->prix, 2) }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-header">Mes commandes</div>
        <div class="card-body">
            @if ($commandes->isEmpty())
                <p>Aucune commande passée.</p>
            @else
                @foreach ($commandes as $commande)
                    <div class="mb-4">
                        <h5>Commande #{{ $commande->id }} du {{ $commande->created_at->format('d/m/Y') }}</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix unitaire</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commande->lignes as $ligne)
                                    <tr>
                                        <td>{{ $ligne->produit->nom }}</td>
                                        <td>{{ $ligne->quantite }}</td>
                                        <td>{{ number_format($ligne->prix_unitaire, 2) }} €</td>
                                        <td>{{ number_format($ligne->quantite * $ligne->prix_unitaire, 2) }} €</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
