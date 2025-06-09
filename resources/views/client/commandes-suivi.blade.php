@extends('layouts.app')
@section('content')
<h1>Suivi de commande : {{ $commande->order_number }}</h1>
<p>Statut : {{ $commande->statut }}</p>
<p>Ville : {{ $commande->city }}</p>
<p>Total : {{ $commande->total }}€</p>
@endsection
