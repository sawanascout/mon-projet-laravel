@extends('layout.app')

@section('content')
<div class="container mt-5">
    <h3>Mon Panier</h3>
    @if($panier && $panier->elements->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($panier->elements as $element)
                    <tr>
                        <td>{{ $element->produit->nom }}</td>
                        <td>{{ $element->quantité }}</td>
                        <td>{{ number_format($element->prix, 2, ',', ' ') }} €</td>
                        <td>{{ number_format($element->prix * $element->quantité, 2, ',', ' ') }} €</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-end"><strong>Total Panier :</strong></td>
                    <td><strong>{{ number_format($panier->elements->sum(fn($e) => $e->prix * $e->quantité), 2, ',', ' ') }} €</strong></td>
                </tr>
            </tbody>
        </table>
    @else
        <p>Votre panier est vide.</p>
    @endif

    <hr>

    <h3>Mes Commandes</h3>
    @if($commandes && $commandes->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Commande #</th>
                    <th>Date</th>
                    <th>Prix Total</th>
                    <th>Statut</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                    <tr>
                        <td>{{ $commande->id }}</td>
                        <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                        <td>{{ number_format($commande->prix_total, 2, ',', ' ') }} €</td>
                        <td>{{ ucfirst($commande->statut) }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $commande->id }}" aria-expanded="false" aria-controls="details-{{ $commande->id }}">
                                Voir produits
                            </button>
                        </td>
                    </tr>
                    <tr class="collapse" id="details-{{ $commande->id }}">
                        <td colspan="5">
                            <ul>
                                @foreach($commande->lignes as $ligne)
                                    <li>{{ $ligne->produit->nom }} - {{ $ligne->quantité }} x {{ number_format($ligne->prix, 2, ',', ' ') }} €</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Vous n'avez aucune commande pour le moment.</p>
    @endif
    <h3>
        <a href="{{ route('produits.index') }}" class="btn btn-link mt-3">← Retour à la boutique</a>
    <a class="nav-link" href="{{ route('logout') }}">Deconnexion</a>
    </h3>
</div>
@endsection
