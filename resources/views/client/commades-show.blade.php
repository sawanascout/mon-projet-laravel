@extends('layouts.app')
@section('content')
<h1>Détails de la commande {{ $commande->order_number }}</h1>
<ul>
@foreach($commande->lignes as $ligne)
    <li>{{ $ligne->produit->nom }} - {{ $ligne->quantite }} x {{ $ligne->prix }}€</li>
@endforeach
</ul>
<p>Total : {{ $commande->total }}€</p>
@endsection
