@extends('layouts.client')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">
    <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Demander un produit personnalisé</h1>

    <form action="{{ route('custom.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        @csrf

        <!-- Nom complet -->
        <div>
            <label for="fullname" class="block mb-2 font-semibold text-gray-700">Nom complet <span class="text-red-500">*</span></label>
            <input type="text" name="fullname" id="fullname" value="{{ old('fullname') }}" required
                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('fullname') border-red-500 @enderror">
            @error('fullname')
                <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Genre -->
        <div>
            <label for="gender" class="block mb-2 font-semibold text-gray-700">Genre <span class="text-red-500">*</span></label>
            <select name="gender" id="gender" required
                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('gender') border-red-500 @enderror">
                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>-- Choisir --</option>
                <option value="homme" {{ old('gender') == 'homme' ? 'selected' : '' }}>Homme</option>
                <option value="femme" {{ old('gender') == 'femme' ? 'selected' : '' }}>Femme</option>
            </select>
            @error('gender')
                <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Image du produit -->
        <div>
            <label for="image_path" class="block mb-2 font-semibold text-gray-700">Image du produit <span class="text-red-500">*</span></label>
            <input type="file" name="image_path" id="image_path" accept="image/*" required
                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('image_path') border-red-500 @enderror">
            @error('image_path')
                <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block mb-2 font-semibold text-gray-700">Description (optionnel)</label>
            <textarea name="description" id="description" rows="4" placeholder="Décrivez ici votre demande personnalisée..."
                class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bouton -->
        <div>
            <button type="submit"
                class="w-full bg-green-600 text-white p-4 rounded-lg font-semibold hover:bg-green-700 transition">
                Envoyer la demande
            </button>
            
    </form>
    <div class="mt-8">
        <a href="{{ route('produits.index') }}" class="text-indigo-600 hover:underline">← Continuer les achats</a>
    </div>
</div>
@endsection
