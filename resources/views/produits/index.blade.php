@extends('layouts.client')

@section('content')
<div class="container px-4 py-10 mx-auto">

    <!-- Grille des produits -->
<div class="grid grid-cols-2 gap-6 mt-16 md:grid-cols-3 lg:grid-cols-4">
    @forelse ($products as $product)
        <div class="relative flex flex-col transition duration-300 transform bg-white border shadow-sm group rounded-xl hover:shadow-xl hover:-translate-y-1">
            
            <!-- Badge promo -->
            @if ($product->old_price && $product->old_price > $product->price)
                <div class="absolute z-10 px-2 py-1 text-xs text-white bg-red-500 rounded-full top-2 right-2">
                    Promo
                </div>
            @endif

            <a href="{{ route('produits.show', $product->id) }}">
                <img 
                    src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default.jpg') }}" 
                    alt="{{ $product->name }}" 
                    class="object-cover w-full h-48 transition duration-300 rounded-t-xl group-hover:scale-105"
                >
            </a>

            <div class="flex flex-col flex-grow p-4">
                <h2 class="mb-1 text-base font-semibold text-gray-800">{{ $product->name }}</h2>

                <!-- Notation étoilée -->
                <div class="flex items-center mb-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="{{ $i <= round($product->rating) ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                    @endfor
                    <span class="ml-2 text-xs text-gray-500">{{ number_format($product->rating, 1) }}/5</span>
                </div>

                <!-- Description -->
                <p class="mb-4 text-sm text-gray-600">{{ Str::limit($product->description, 60) }}</p>

                <!-- Prix et bouton bien alignés en bas -->
                <div class="flex items-end justify-between mt-auto">
                    <div>
                        @if ($product->old_price && $product->old_price > $product->price)
                            <span class="text-sm text-gray-400 line-through">
                                {{ number_format($product->old_price, 0, ',', ' ') }} FCFA
                            </span><br>
                        @endif
                        <span class="text-[#ab3fd6] font-bold text-lg">
                            {{ number_format($product->price, 0, ',', ' ') }} FCFA
                        </span>
                    </div>
                    
                    <a href="{{ route('produits.show', $product->id) }}" 
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
        <div class="text-center text-gray-500 col-span-full">
            Aucun produit trouvé.
        </div>
    @endforelse
</div>


    <!-- Pagination -->
    <div class="flex justify-center mt-10">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endsection
