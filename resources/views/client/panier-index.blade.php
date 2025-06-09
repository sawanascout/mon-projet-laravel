@extends('layouts.app')

@section('content')
<h1>Votre Panier</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($elements->isEmpty())
    <p>Votre panier est vide.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Couleur</th>
                <th>Taille</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($elements as $element)
            <tr>
                <td>{{ $element->produit->nom ?? 'Produit supprimé' }}</td>
                <td>{{ $element->couleur }}</td>
                <td>{{ $element->taille }}</td>
                <td>
                    <form action="{{ route('client.panier.mettreAJourQuantite', $element->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <input type="number" name="quantite" value="{{ $element->quantite }}" min="1" style="width:60px;">
                        <button type="submit">Modifier</button>
                    </form>
                </td>
                <td>{{ number_format($element->produit->prix, 2) }} €</td>
                <td>{{ number_format($element->produit->prix * $element->quantite, 2) }} €</td>
                <td>
                    <form action="{{ route('client.panier.supprimer', $element->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p><strong>Total panier : </strong> 
        {{ number_format($elements->reduce(function($carry, $item) {
            return $carry + ($item->produit->prix * $item->quantite);
        }, 0), 2) }} €
    </p>

    <form action="{{ route('client.panier.vider') }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment vider votre panier ?');">
        @csrf
        @method('DELETE')
        <button type="submit">Vider le panier</button>
    </form>

    <a href="{{ route('produits.index') }}">Continuer vos achats</a>
@endif
@endsection
