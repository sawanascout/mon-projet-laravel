@extends('layouts.app')

@section('content')
<h1>Lignes de la commande #{{ $commandeId }}</h1>

@if($lignes->isEmpty())
    <p>Aucune ligne de commande trouvée.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Couleur</th>
                <th>Taille</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Total</th>
                <th>Détails</th>
            </tr>
        </thead>
        <tbody>
        @foreach($lignes as $ligne)
            <tr>
                <td>{{ $ligne->produit->nom ?? 'Produit supprimé' }}</td>
                <td>{{ $ligne->couleur }}</td>
                <td>{{ $ligne->taille }}</td>
                <td>{{ $ligne->quantite }}</td>
                <td>{{ number_format($ligne->prix, 2) }} €</td>
                <td>{{ number_format($ligne->prix * $ligne->quantite, 2) }} €</td>
                <td><a href="{{ route('lignes.show', $ligne->id) }}">Voir</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

<a href="{{ url()->previous() }}">Retour</a>

@endsection
