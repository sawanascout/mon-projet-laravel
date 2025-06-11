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
    <table class="table table-bordered table-striped">
        <thead class="thead-light">
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
        @if ($element->produit)
            <td>{{ $element->produit->nom }}</td>
            <td>{{ ucfirst($element->couleur) }}</td>
            <td>{{ strtoupper($element->taille) }}</td>
            <td>{{ number_format($element->quantite) }}</td>
            <td>{{ number_format($element->produit->prix, 2) }} CFA</td>
            <td>{{ number_format($element->produit->prix * $element->quantite, 2) }} CFA</td>
        @else
            <td colspan="5" class="text-danger">Produit supprimé</td>
        @endif
        <td>
            <form action="{{ route('client.panier.supprimer', $element->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
            </form>
            <form action="{{ route('client.panier-elements.update', $element->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-sm btn-primary">Modifier</button>
            </form>
        </td>
    </tr>
@endforeach

        </tbody>
    </table>

<p class="mt-4"><strong>Total panier : </strong> 
    {{ number_format($elements->reduce(function($carry, $item) {
        return $item->produit ? $carry + ($item->produit->prix * $item->quantite) : $carry;
    }, 0), 2) }} €
</p>

<form action="{{ route('client.panier.vider') }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment vider votre panier ?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-warning">Vider le panier</button>
</form>

<a href="{{ route('produits.index') }}" class="btn btn-secondary mt-2">Continuer vos achats</a>

@endif
@endsection
