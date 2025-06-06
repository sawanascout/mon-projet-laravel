@extends('layouts.client')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-xl mt-10">
    <h1 class="text-3xl font-bold text-purple-700 mb-8 text-center">
        🛍️ Historique de mes commandes
    </h1>

    @if($orders->isEmpty())
        <div class="text-center text-gray-500 text-lg">
            <p>Vous n'avez pas encore passé de commande.</p>
            <a href="{{ route('produits.index') }}"
               class="mt-4 inline-block text-white bg-purple-600 hover:bg-purple-700 px-5 py-3 rounded-full font-semibold transition">
                🔎 Explorer les produits
            </a>
        </div>
    @else
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="border border-purple-100 bg-purple-50 rounded-xl p-5 hover:shadow-md transition duration-200">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                        <div class="mb-4 md:mb-0">
                            <p class="text-xl font-bold text-gray-800">📦 Commande <span class="text-purple-700">{{$order->order_number }}</span></p>
                            <p class="text-sm text-gray-500">📅 Passée le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
                        </div>

                        <div class="flex flex-col md:flex-row md:items-center md:space-x-6">
                            <div class="mb-3 md:mb-0">
                                <span class="text-sm px-3 py-1 rounded-full font-medium text-white 
                                    @switch($order->status)
                                        @case('pending') bg-yellow-500 @break
                                        @case('processing') bg-blue-500 @break
                                        @case('completed') bg-green-600 @break
                                        @case('cancelled') bg-red-600 @break
                                        @default bg-gray-500
                                    @endswitch">
                                    @switch($order->status)
                                        @case('pending') ⏳ En attente @break
                                        @case('processing') 🔄 En cours @break
                                        @case('completed') ✅ Livrée @break
                                        @case('cancelled') ❌ Annulée @break
                                        @default {{ ucfirst($order->status) }}
                                    @endswitch
                                </span>
                            </div>

                            <a href="{{ route('commandes.receipt', $order->id) }}"
                               class="text-sm bg-white text-purple-700 border border-purple-600 hover:bg-purple-100 px-4 py-2 rounded-full transition">
                                🧾 Voir le reçu
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
    <div class="mt-6">
        {{ $orders->links() }}
    </div>

        <div class="mt-10 text-center">
            <a href="{{ route('produits.index') }}"
               class="text-purple-600 hover:underline font-semibold">
                ⬅️ Retour à la boutique
            </a>
        </div>
    @endif
</div>
@endsection
