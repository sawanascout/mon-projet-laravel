@extends('layouts.admin')
@section('content')
<h1>Commandes (admin)</h1>
@foreach($commandes as $commande)
    <div>
        <strong>{{ $commande->order_number }}</strong> - Utilisateur #{{ $commande->user_id }} - {{ $commande->created_at->format('d/m/Y') }}
    </div>
@endforeach
@endsection
