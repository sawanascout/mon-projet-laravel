@extends('layouts.client')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-xl">
    <h1 class="text-2xl font-bold mb-6">Passer une commande</h1>

    @if(isset($product))
        <div class="mb-6 border p-4 rounded-lg bg-gray-50 shadow">
            <h2 class="text-lg font-semibold mb-2">Produit sélectionné :</h2>
            <div class="flex items-center space-x-4">
                
<img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default.jpg') }}"
     alt="{{ $product->name }}"
     class="w-full h-48 object-cover rounded-t-lg">                <div>
                    <p class="font-bold">{{ $product->name }}</p>
                    <p class="text-indigo-600 font-semibold">{{ $product->price }} FCFA</p>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('commandes.store') }}" method="POST" class="space-y-4">
        @csrf

        @if(isset($product))
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        @endif

        <div>
            <label for="fullname" class="block font-medium">Nom complet</label>
            <input type="text" name="fullname" id="fullname" class="w-full p-3 border rounded-lg" required>
        </div>

        <div>
            <label for="country_code" class="block font-medium">Indicatif du pays</label>
            <select name="country_code" id="country_code" class="w-full p-3 border rounded-lg" required>
                <option value="+228">Togo (+228)</option>
                <option value="+229">Bénin (+229)</option>
                <option value="+225">Côte d'Ivoire (+225)</option>
                <option value="+237">Cameroun (+237)</option>
            </select>
        </div>

        <div>
            <label for="phone" class="block font-medium">Numéro WhatsApp</label>
            <input type="text" name="phone" id="phone" class="w-full p-3 border rounded-lg" required>
        </div>

        <div>
            <label for="city" class="block font-medium">Ville</label>
            <input type="text" name="city" id="city" class="w-full p-3 border rounded-lg" required>
        </div>

        <div>
            <label for="address" class="block font-medium">Adresse de livraison</label>
            <textarea name="address" id="address" class="w-full p-3 border rounded-lg" required></textarea>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg">
            <p class="text-sm text-gray-700">
                <strong>Instructions de paiement :</strong><br>
                Veuillez effectuer le paiement via Mixx by Yas en composant <strong>*145*5#</strong> ou en utilisant l'application mobile Mixx by Yas. <br>
                Envoyez le montant total à ce numéro : <strong>+228 90 00 00 00</strong> (exemple).<br>
                Après le paiement, veuillez télécharger et envoyer une capture d'écran de la transaction.
            </p>
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white p-3 rounded-lg hover:bg-indigo-700">Confirmer la commande</button>
    </form>
</div>
@endsection
