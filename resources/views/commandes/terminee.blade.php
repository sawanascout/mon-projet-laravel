@extends('layouts.client')

@section('content')
<div class="max-w-2xl p-6 mx-auto mt-10 text-center bg-white rounded-lg shadow-lg">
    <h1 class="mb-4 text-4xl font-bold text-green-600"> Merci pour votre commande !</h1>

    <p class="mb-2 text-lg text-gray-800">
        Votre commande <span class="font-semibold text-purple-600">#{{ $commande->order_number }}</span> a bien été enregistrée.
    </p>
    
    <p class="mb-6 text-gray-700">
        Un membre de notre équipe vous contactera prochainement pour organiser la livraison.
    </p>

    <div class="p-4 mb-6 text-yellow-700 bg-yellow-100 border-l-4 border-yellow-500 rounded">
        <p class="font-semibold">⚠️ Important :</p>
        <p>
            Veuillez <strong>envoyer une capture d'écran de votre reçu de paiement</strong> via le bouton WhatsApp présent sur cette page.
            Cela permet de valider votre commande plus rapidement.
        </p>
    </div>

    <div class="flex flex-col justify-center gap-4 mb-6 sm:flex-row">
        <a href="{{ route('produits.index') }}"
            class="px-6 py-3 text-white transition bg-purple-700 rounded-md hover:bg-purple-800">
            🏠 Retour à la boutique
        </a>

        <a href="{{ route('commandes.mes-commandes') }}"
            class="px-6 py-3 text-purple-700 transition bg-gray-100 border border-purple-300 rounded-md hover:bg-purple-200">
             Suivre mes commandes
        </a>
    </div>

    <hr class="my-8">

    <form action="{{ route('commandes.feedback', $commande->id) }}" method="POST" class="text-left">
        @csrf
        <label for="commentaire" class="block mb-2 font-medium text-gray-800">
            💬 Que pensez-vous de votre expérience sur GlobalDrop ?
        </label>
        <textarea name="commentaire" id="commentaire" rows="4"
            class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
            placeholder="Votre avis nous aide à nous améliorer... (facultatif)"></textarea>

        <button type="submit"
            class="px-5 py-2 mt-4 font-semibold text-white transition bg-purple-600 rounded-md hover:bg-purple-700">
            Envoyer mon avis
        </button>
    </form>
</div>
@endsection
