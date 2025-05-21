@extends('layouts.client')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Confirmation de commande</h1>

    <p><strong>Numéro de commande :</strong> #{{ $order->id }}</p>
    <p><strong>Nom :</strong> {{ $order->customer_name }}</p>
    <p><strong>WhatsApp :</strong> {{ $order->whatsapp_number }}</p>
    <p><strong>Ville :</strong> {{ $order->city }}</p>
    <p><strong>Adresse :</strong> {{ $order->address }}</p>
    <p><strong>Total :</strong> {{ $order->total }} FCFA</p>

    <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 mt-4">
        <p><strong>Paiement :</strong> Veuillez envoyer <strong>{{ $order->total }} FCFA</strong> au numéro <strong>+228 90000000</strong> via Mixx by Yas.</p>
        <p>Vous pouvez payer via l’application mobile ou en composant <strong>*145*5#</strong>.</p>
        <p>Après paiement, envoyez une capture d’écran de la transaction au même numéro WhatsApp.</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('commandes.receipt', $order->id) }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Télécharger le reçu
        </a>
    </div>
</div>
@endsection
