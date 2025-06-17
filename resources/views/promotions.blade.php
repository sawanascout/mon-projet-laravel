@extends('layouts.client')

@section('content')
<div class="container mx-auto px-4 py-10">

    <h1 class="text-2xl font-bold text-center mb-10 text-[#ab3fd6]">Promotions</h1>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($produits as $produit)
            <div class="group relative bg-white rounded-xl border shadow-sm hover:shadow-xl transition duration-300 transform hover:-translate-y-1 flex flex-col">
                
                <!-- Badge promo -->
                <div class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full z-10">
                    Promo
                </div>

                <a href="{{ route('produits.show', $produit->id) }}">
                    <img 
                        src="{{ $produit->photo ? asset('storage/' . $produit->photo) : asset('images/default.jpg') }}" 
                        alt="{{ $produit->nom }}" 
                        class="w-full h-48 object-cover rounded-t-xl group-hover:scale-105 transition duration-300"
                    >
                </a>

                <div class="flex flex-col flex-grow p-4">
                    <h2 class="text-base font-semibold mb-1 text-gray-800">{{ $produit->name }}</h2>

                    <!-- Notation étoilée -->
                    <div class="flex items-center mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= round($produit->note) ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        @endfor
                        <span class="text-xs text-gray-500 ml-2">{{ number_format($produit->note, 1) }}/5</span>
                    </div>

                    <!-- Description -->
                    <p class="text-sm text-gray-600 mb-4">{{ Str::limit($produit->description, 60) }}</p>

                    <div class="mt-auto flex justify-between items-end">
                        <div>
                            <span class="text-sm text-gray-400 line-through">
                                {{ number_format($produit->ancien_prix, 0, ',', ' ') }} FCFA
                            </span><br>
                            <span class="text-[#ab3fd6] font-bold text-lg">
                                {{ number_format($produit->prix, 0, ',', ' ') }} FCFA
                            </span>
                        </div>

                        <a href="{{ route('produits.show', $produit->id) }}" 
                        class="bg-[#ab3fd6] hover:bg-purple-700 text-white text-sm px-3 py-1 rounded flex items-center gap-1 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 00.9 1.3h10.9a1 1 0 00.9-1.3L17 13M7 13V6h10v7" />
                            </svg>
                            Ajouter
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">
                Aucun produit en promotion actuellement.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-10 flex justify-center">
        {{ $produits->appends(request()->query())->links() }}
    </div>
</div>
@endsection
