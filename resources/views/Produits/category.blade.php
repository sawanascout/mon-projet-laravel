@extends('layouts.client')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Catégorie : {{ $categoryName }}</h1>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($products as $product)
            <div class="border rounded-lg shadow hover:shadow-lg transition">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t-lg">
                <div class="p-4">
                    <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-600">{{ Str::limit($product->description, 60) }}</p>
                    <div class="mt-2 text-indigo-600 font-bold">{{ $product->price }} FCFA</div>
                    <a href="{{ route('produits.show', $product->id) }}" class="mt-3 inline-block bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600">Voir</a>
                </div>
            </div>
        @empty
            <p>Aucun produit trouvé dans cette catégorie.</p>
        @endforelse
    </div>
</div>
@endsection
