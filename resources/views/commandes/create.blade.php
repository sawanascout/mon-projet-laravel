@extends('layouts.client')

@section('content')
<div class="max-w-4xl px-4 py-8 mx-auto">
    <h1 class="mb-8 text-3xl font-bold text-center text-gray-800">🛒 Finalisez votre commande</h1>

    @if(session('error'))
        <div class="px-4 py-3 mb-6 text-red-800 bg-red-100 border border-red-300 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('commandes.store') }}" method="POST" class="p-6 space-y-6 bg-white border rounded-lg shadow-lg" x-data>
        @csrf

        <!-- Infos client -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label class="block mb-1 font-semibold text-gray-700"> Nom complet</label>
                <input type="text" name="customer_name" required class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-purple-500">
            </div>
            <div>
                <label class="block mb-1 font-semibold text-gray-700"> Ville</label>
                <input type="text" name="city" required class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-purple-500">
            </div>
            <div>
                <label class="block mb-1 font-semibold text-gray-700"> Indicatif</label>
                <select name="phone_code" required class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-purple-500">
                    <option value="" disabled selected>Choisissez l'indicatif</option>
                    <option value="+228">+228 (Togo)</option>
                </select>
            </div>
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Numéro WhatsApp</label>
                <input type="text" name="whatsapp_number" placeholder="Ex: 90000000" class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-purple-500">
                <small class="text-gray-500">Sans indicatif</small>
            </div>
        </div>

        <!-- Panier -->
        <h2 class="pb-2 mt-10 mb-4 text-2xl font-semibold text-gray-800 border-b">🧺 Mon panier</h2>

        <ul class="space-y-4">
            @foreach($panier as $key => $ligne)
                <li class="p-4 border rounded-lg shadow-sm bg-gray-50">
                    <div class="flex flex-col justify-between md:flex-row md:items-center">
                        <div class="mb-2 md:mb-0">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $ligne['nom'] }}</h3>
                            <p class="text-sm text-gray-600">Quantité : x{{ $ligne['quantite'] }}</p>
                            <p class="text-sm text-gray-600">Prix unitaire : {{ number_format($ligne['prix'], 0, ',', ' ') }} FCFA</p>
                        </div>

                        <div class="flex flex-col gap-4 mt-4 sm:flex-row md:mt-0" x-data="{ couleurAutre: false, tailleAutre: false }">
                            <!-- Couleur -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">🎨 Couleur</label>
                                <select @change="couleurAutre = $event.target.value === 'autre'" name="panier[{{ $key }}][couleur_select]" class="w-full p-2 border border-gray-300 rounded sm:w-40 focus:ring-2 focus:ring-purple-500">
                                    <option value="">Sélectionner</option>
                                    <option value="Noir">Noir</option>
                                    <option value="Blanc">Blanc</option>
                                    <option value="Rouge">Rouge</option>
                                    <option value="Bleu">Bleu</option>
                                    <option value="autre">Autre...</option>
                                </select>
                                <input type="text" name="panier[{{ $key }}][couleur]" placeholder="Votre couleur" x-show="couleurAutre" class="w-full p-2 mt-2 border border-gray-300 rounded sm:w-40 focus:ring-2 focus:ring-purple-500">
                            </div>

                            <!-- Taille -->
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-700">📏 Dimension</label>
                                <select @change="tailleAutre = $event.target.value === 'autre'" name="panier[{{ $key }}][taille_select]" class="w-full p-2 border border-gray-300 rounded sm:w-40 focus:ring-2 focus:ring-purple-500">
                                    <option value="">Sélectionner</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="autre">Autre...</option>
                                </select>
                                <input type="text" name="panier[{{ $key }}][taille]" placeholder="Votre taille" x-show="tailleAutre" class="w-full p-2 mt-2 border border-gray-300 rounded sm:w-40 focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        <!-- Total -->
        <div class="mt-6 text-xl font-bold text-right text-purple-700">
            Total : {{ number_format(collect($panier)->sum(fn($ligne) => $ligne['prix'] * $ligne['quantite']), 0, ',', ' ') }} FCFA
        </div>

        <!-- Actions -->
        <div class="flex flex-col items-center justify-between gap-4 mt-6 sm:flex-row">
            <a href="{{ route('produits.index') }}" class="text-purple-600 underline hover:text-purple-800">
                ← Continuer mes achats
            </a>

            <button type="submit" class="px-6 py-3 text-white transition bg-purple-600 rounded-lg shadow hover:bg-purple-700">
                ✅ Confirmer la commande
            </button>
        </div>
    </form>
</div>

<!-- Alpine.js CDN -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection
