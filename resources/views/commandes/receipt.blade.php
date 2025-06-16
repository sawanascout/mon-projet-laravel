@extends('layouts.client')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">🛒 Finalisez votre commande</h1>

    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('commandes.store') }}" method="POST" class="space-y-6 bg-white shadow-lg p-6 rounded-lg border">
        @csrf

        <!-- Infos client -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="customer_name" class="block font-semibold text-gray-700 mb-1">👤 Nom complet</label>
                <input type="text" name="customer_name" id="customer_name" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label for="city" class="block font-semibold text-gray-700 mb-1"> Ville</label>
                <input type="text" name="city" id="city" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">

                
            </div>

            <div>
                <label for="phone_code" class="block font-semibold text-gray-700 mb-1"> Indicatif pays</label>
                <select name="phone_code" id="phone_code" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="" disabled selected>Choisissez l'indicatif</option>
                    <option value="+228">+228 (Togo)</option>
                </select>
            </div>

            <div>
                <label for="whatsapp_number" class="block font-semibold text-gray-700 mb-1"> Numéro WhatsApp</label>
                <input type="text" name="whatsapp_number" id="whatsapp_number" placeholder="Ex: 90000000" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-purple-500">
                <small class="text-gray-500">Entrez le numéro sans indicatif.</small>
            </div>
        </div>

        <!-- Panier -->
        <h2 class="text-2xl font-semibold text-gray-800 mt-10 mb-4 border-b pb-2"> Contenu du panier</h2>

        <ul class="space-y-6">
            @foreach($cart as $key => $item)
                <li class="bg-gray-50 border rounded-lg p-4 shadow-sm">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-medium text-gray-800">{{ $item['name'] }}</h3>
                        <span class="text-sm text-gray-600">x{{ $item['quantity'] }}</span>
                    </div>

                    <div class="flex justify-between text-sm text-gray-600 mb-3">
                        <span>Prix unitaire :</span>
                        <span>{{ number_format($item['price'], 2, ',', ' ') }} FCFA</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"> Couleur</label>
                            <input type="text" name="cart[{{ $key }}][color]" value="{{ $item['color'] ?? '' }}" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dimension</label>
                            <input type="text" name="cart[{{ $key }}][size]" value="{{ $item['size'] ?? '' }}" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        <!-- Total -->
        <div class="text-right text-xl font-bold text-purple-700 mt-6">
            Total : {{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']), 2, ',', ' ') }} FCFA
        </div>

        <!-- Boutons -->
        <div class="flex flex-col sm:flex-row justify-between items-center mt-6 gap-4">
            <a href="{{ route('produits.index') }}" class="text-purple-600 hover:text-purple-800 underline">
                ← Continuer mes achats
            </a>

            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg shadow-md transition duration-200">
                ✅ Confirmer la commande
            </button>
        </div>
    </form>
</div>
@endsection