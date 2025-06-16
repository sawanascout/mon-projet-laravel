@extends('layouts.client')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded mt-8 text-center">
    <h1 class="text-3xl font-extrabold mb-4 text-purple-600">Merci pour votre commande !</h1>

    <p class="text-lg mb-4">Votre commande <strong>{{ $order->order_number }}</strong> a été enregistrée avec succès.</p>

    <p class="text-gray-700 mb-6">Nous vous contacterons bientôt pour la livraison. </p>
    <p class="text-gray-700 mb-6">Cliquer sur le watsapp de la page pour envoyer votre capture de payement </p>

    <div class="flex justify-center gap-4">
        <a href="{{ route('produits.index') }}" class="bg-purple-700 hover:bg-purple-800 text-white px-5 py-2 rounded">
            Retour à l'accueil
        </a>
    </div>
    <div>
        <a href="{{ route('commandes.mes-commandes') }}"
    class="mt-6 inline-block bg-gray-100 text-purple-700 px-4 py-2 rounded border border-purple-300 hover:bg-purple-200">
     suivre mes commandes
</a>
    </div>
    

    <form action="{{ route('commandes.feedback', $order->id) }}" method="POST" class="mt-6">
    @csrf
    <label for="commentaire" class="block mb-2 font-semibold text-gray-700">Que pensez-vous de GlobalDrop ?</label>
    <textarea name="commentaire" id="commentaire" rows="3"
        class="w-full border rounded p-3" placeholder="Votre avis (facultatif)..."></textarea>

    <button type="submit"
        class="mt-3 bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
        Envoyer le commentaire
    </button>
</form>

</div>
@endsection