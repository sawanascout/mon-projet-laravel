@extends('layouts.client')

@section('content')
<div class="container mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6">Votre Panier</h1>

    @php
        $total = 0;
        $cart = session('cart', []);
    @endphp

    @if(count($cart) > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-xl shadow-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">Produit</th>
                        <th class="px-4 py-3 text-left">Prix unitaire</th>
                        <th class="px-4 py-3 text-left">Quantité</th>
                        <th class="px-4 py-3 text-left">Sous-total</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $productId => $product)
                        @if(is_array($product)) {{-- 🛡️ vérifie que c’est bien un tableau --}}
                            @php
                                $subtotal = $product['price'] * $product['quantity'];
                                $total += $subtotal;
                            @endphp
                            <tr class="border-t">
                                <td class="px-4 py-4 flex items-center gap-4">
                                    @if(!empty($product['image']))
                                        <img src="{{ asset('storage/' . $product['image']) }}"
                                             alt="{{ $product['name'] }}"
                                             class="w-12 h-12 object-cover rounded shadow">
                                    @endif
                                    <span>{{ $product['name'] }}</span>
                                </td>
                                <td class="px-4 py-4">{{ number_format($product['price'], 0, ',', ' ') }} FCFA</td>
                                <td class="px-4 py-4">{{ $product['quantity'] }}</td>
                                <td class="px-4 py-4">{{ number_format($subtotal, 0, ',', ' ') }} FCFA</td>
                                <td class="px-4 py-4 text-center">
                                    <form action="{{ route('cart.remove', $productId) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:underline" onclick="return confirm('Supprimer ce produit ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total -->
        <div class="mt-6 text-right text-lg font-semibold">
            Total : {{ number_format($total, 0, ',', ' ') }} FCFA
        </div>

        <div class="mt-6 text-right">
    @auth
        <a href="{{ route('commandes.create') }}" class="bg-[#ab3fd6] hover:bg-[#922ebc] text-white px-6 py-3 rounded-lg font-medium transition">
            Finaliser la commande
        </a>
    @else
        <a href="{{ route('login') }}" class="bg-[#ab3fd6] hover:bg-[#922ebc] text-white px-6 py-3 rounded-lg font-medium transition">
            Se connecter pour commander
        </a>
    @endauth
</div>

    @else
        <div class="text-center text-gray-600">
            Votre panier est vide.
        </div>
    @endif

    <div class="mt-8">
        <a href="{{ route('produits.index') }}" class="text-[#ab3fd6] hover:underline">← Continuer les achats</a>
    </div>
</div>
@endsection
