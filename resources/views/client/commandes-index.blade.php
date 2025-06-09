@extends('layouts.app')
@section('content')
<h1>Mes Commandes</h1>
@foreach($commandes as $commande)
    <div>
        <strong>{{ $commande->order_number }}</strong> - {{ $commande->created_at->format('d/m/Y') }}
        <a href="{{ route('client.commandes.show', $commande->id) }}">Voir</a>
    </div>
@endforeach
@endsection
