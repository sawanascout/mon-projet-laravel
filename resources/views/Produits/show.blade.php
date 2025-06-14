@extends('layouts.client')

@section('content')
<div class="container mx-auto px-4 py-10">
    
    <!-- Message de succès -->
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Carte produit -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
        
        <!-- 🖼️ Image -->
        <div class="flex items-center justify-center">
            <img 
                src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/default.jpg') }}" 
                alt="{{ $product->name }}" 
                class="w-full h-[400px] object-contain rounded-xl transition hover:scale-105 duration-300"
            >
        </div>

        <!-- Infos produit -->
        <div class="flex flex-col justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>

                <!-- ⭐ Note moyenne -->
                <div class="flex items-center text-yellow-500 mb-4">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= round($averageRating))
                            ★
                        @else
                            <span class="text-gray-300">★</span>
                        @endif
                    @endfor
                    <span class="ml-2 text-sm text-gray-600">{{ number_format($averageRating, 1) }}/5</span>
                </div>

                <!-- 💰 Prix -->
                <div class="text-2xl font-bold text-[#ab3fd6] mb-4">
                    {{ number_format($product->price, 0, ',', ' ') }} FCFA
                </div>

                <!-- 📃 Description -->
                <p class="text-gray-700 leading-relaxed mb-6">
                    {{ $product->description }}
                </p>
            </div>

            <!-- ➕ Ajouter au panier -->
            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                @csrf
                <div class="flex items-center gap-4">
                    <label for="quantity" class="text-gray-600 font-medium">Quantité :</label>
                    <input 
                        type="number" 
                        name="quantity" 
                        id="quantity" 
                        value="1" 
                        min="1" 
                        class="w-20 px-3 py-2 border border-gray-300 rounded-lg text-center focus:outline-none focus:ring-2 focus:ring-[#ab3fd6]"
                    >

                    <button 
                        type="submit" 
                        class="flex items-center gap-2 bg-[#ab3fd6] hover:bg-[#922ebc] text-white font-medium px-6 py-2 rounded-xl transition duration-300 shadow"
                    >
                        🛒 Ajouter au panier
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('produits.index') }}" class="text-[#ab3fd6] hover:underline">← Retour à la boutique</a>
    </div>

    <!-- ✍️ Laisser un avis -->
<div class="mt-12 border-t pt-8">
    <h2 class="text-xl font-semibold mb-4">Laisser un avis</h2>

    <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700 font-medium mb-1">Note :</label>
            <div id="star-rating" class="flex space-x-1 text-2xl cursor-pointer text-gray-300">
                @for ($i = 1; $i <= 5; $i++)
                    <span data-value="{{ $i }}">★</span>
                @endfor
            </div>
            <input type="hidden" name="rating" id="rating" value="0">
        </div>

        <div>
            <label for="comment" class="block text-gray-700 font-medium">Commentaire :</label>
            <textarea name="comment" id="comment" rows="3" class="w-full mt-1 p-2 border border-gray-300 rounded-md"></textarea>
        </div>

        <button type="submit" class="bg-[#ab3fd6] hover:bg-[#922ebc] text-white px-4 py-2 rounded">
            ✅ Envoyer l'avis
        </button>
    </form>
</div>
<!-- ⭐ Script d’interaction étoiles -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('#star-rating span');
        const ratingInput = document.getElementById('rating');

        stars.forEach(star => {
            star.addEventListener('mouseover', () => {
                const val = parseInt(star.getAttribute('data-value'));
                highlightStars(val);
            });

            star.addEventListener('click', () => {
                const val = parseInt(star.getAttribute('data-value'));
                ratingInput.value = val;
                highlightStars(val);
            });

            star.addEventListener('mouseout', () => {
                const currentRating = parseInt(ratingInput.value);
                highlightStars(currentRating);
            });
        });

        function highlightStars(rating) {
            stars.forEach(star => {
                const val = parseInt(star.getAttribute('data-value'));
                if (val <= rating) {
                    star.classList.add('text-yellow-500');
                    star.classList.remove('text-gray-300');
                } else {
                    star.classList.remove('text-yellow-500');
                    star.classList.add('text-gray-300');
                }
            });
        }
    });
</script>

    <!-- 🗣️ Liste des avis -->
    @if ($product->reviews->count() > 0)
        <div class="mt-12">
            <h2 class="text-xl font-semibold mb-4">Avis des clients</h2>

            @foreach ($product->reviews->sortByDesc('created_at') as $review)
                <div class="border-t py-4">
                    <div class="flex items-center mb-1 text-yellow-500">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                ★
                            @else
                                <span class="text-gray-300">★</span>
                            @endif
                        @endfor
                    </div>
                    <p class="text-sm text-gray-700">{{ $review->comment }}</p>
                    <p class="text-xs text-gray-400">Posté le {{ $review->created_at->format('d/m/Y à H:i') }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
