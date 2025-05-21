@extends('layouts.client')

@section('content')
<div class="container mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">🛒 Produits disponibles</h1>

    <!-- Formulaire de recherche et de filtre -->
    <form method="GET" action="{{ route('produits.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="🔍 Rechercher un produit..." 
            class="p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-2 focus:ring-indigo-500"
        >

        <select name="category" class="p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-2 focus:ring-indigo-500">
            <option value="">📁 Toutes les catégories</option>
            <option value="habit femme" {{ request('category') == 'habit femme' ? 'selected' : '' }}>👗 Habit Femme</option>
            <option value="chaussure homme" {{ request('category') == 'chaussure homme' ? 'selected' : '' }}>👞 Chaussure Homme</option>
            <option value="électronique" {{ request('category') == 'électronique' ? 'selected' : '' }}>💻 Électronique</option>
            <option value="accessoires" {{ request('category') == 'accessoires' ? 'selected' : '' }}>👜 Accessoires</option>
        </select>

        <button type="submit" class="bg-indigo-600 text-white font-semibold rounded-lg px-4 py-2 hover:bg-indigo-700 transition w-full">
            🔎 Filtrer
        </button>
    </form>

    <!-- Grille des produits -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($products as $product)
            <div class="bg-white rounded-xl border shadow group hover:shadow-xl transition flex flex-col">
                <a href="{{ route('produits.show', $product->id) }}">
                    <img 
                        src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default.jpg') }}" 
                        alt="{{ $product->name }}" 
                        class="w-full h-48 object-cover rounded-t-xl group-hover:scale-105 transition duration-300"
                    >
                </a>

                <div class="p-4 flex flex-col flex-grow">
                    <h2 class="text-base font-semibold mb-1 text-gray-800">{{ $product->name }}</h2>

                    <!-- Notation étoilée -->
                    <div class="flex items-center mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= round($product->rating))
                                <span class="text-yellow-400">★</span>
                            @else
                                <span class="text-gray-300">★</span>
                            @endif
                        @endfor
                        <span class="text-xs text-gray-500 ml-2">{{ number_format($product->rating, 1) }}/5</span>
                    </div>





                    <!-- Description -->
                    <p class="text-sm text-gray-600 mb-4">{{ Str::limit($product->description, 60) }}</p>

                    <!-- Prix et bouton -->
                    <div class="flex justify-between items-center mt-auto">
                        <span class="text-indigo-600 font-bold text-lg">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>

                        <a href="{{ route('produits.show', $product->id) }}" class="bg-green-500 text-white text-sm px-3 py-1 rounded hover:bg-green-600 text-center">
    🛒 
</a>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">
                Aucun produit trouvé.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-10 flex justify-center">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endsection
