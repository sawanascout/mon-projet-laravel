@extends('layouts.client')

@section('content')
<div class="container my-5" style="max-width: 900px;">
    <h1 class="text-center text-purple-700 mb-4 fw-bold fs-3">
        🛍️ Historique de mes commandes
    </h1>

    @if($commandes->isEmpty())
        <div class="text-center text-secondary fs-5">
            <p>Vous n'avez pas encore passé de commande.</p>
            <a href="{{ route('produits.index') }}"
               class="btn btn-purple px-4 py-2 mt-3">
                🔎 Explorer les produits
            </a>
        </div>
    @else
        <div class="d-flex flex-column gap-4">
            @foreach($commandes as $commande)
                <div class="border rounded-3 p-4 bg-purple-50 hover-shadow transition">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="mb-3 mb-md-0">
                            <p class="fs-5 fw-bold text-dark">
                                📦 Commande <span class="text-purple-700">{{ $commande->order_number }}</span>
                            </p>
                            <p class="text-muted mb-0">
                                📅 Passée le {{ $commande->created_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>

                        <div class="d-flex flex-column flex-md-row align-items-center gap-3">
                            <span class="badge text-white fs-6
                                @switch($commande->statut)
                                    @case('pending') bg-warning @break
                                    @case('processing') bg-primary @break
                                    @case('completed') bg-success @break
                                    @case('cancelled') bg-danger @break
                                    @default bg-secondary
                                @endswitch
                            ">
                                @switch($commande->statut)
                                    @case('pending') ⏳ En attente @break
                                    @case('processing') 🔄 En cours @break
                                    @case('completed') ✅ Livrée @break
                                    @case('cancelled') ❌ Annulée @break
                                    @default {{ ucfirst($commande->statut) }}
                                @endswitch
                            </span>

                            <a href="{{ route('commandes.receipt', $commande->id) }}"
                               class="btn btn-outline-purple btn-sm">
                                🧾 Voir le reçu
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $commandes->links() }}
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('produits.index') }}" class="text-purple-600 text-decoration-underline fw-semibold">
                ⬅️ Retour à la boutique
            </a>
        </div>
    @endif

    @if ($totalSpent >= 30000)
    <div class="mt-5 p-4 bg-warning bg-opacity-25 border border-warning rounded-3 text-center">
        <h2 class="mb-2 fw-bold fs-4">🏆 Félicitations !</h2>
        <p class="mb-3 text-dark">
            Vous avez dépensé un total de <strong>{{ number_format($totalSpent, 0, ',', ' ') }} FCFA</strong>.<br>
            Rejoignez notre groupe VIP pour clients fidèles et profitez d’avantages exclusifs !
        </p>
        <a href="https://chat.whatsapp.com/K7EdZFjch2M2UFmz08f8tN" target="_blank"
           class="btn btn-warning fw-bold px-4 py-2">
            👑 Devenir VIP
        </a>
    </div>
    @else
    <div class="mt-5 text-center text-secondary small">
        🕓 Vous devez cumuler au moins <strong>30 000 FCFA</strong> d’achats pour accéder au groupe VIP.<br>
        Total actuel : <strong>{{ number_format($totalSpent, 0, ',', ' ') }} FCFA</strong>
    </div>
    @endif
</div>

<style>
    .btn-purple {
        background-color: #ab3fd6;
        color: white;
    }
    .btn-purple:hover {
        background-color: #922ebc;
        color: white;
    }
    .btn-outline-purple {
        border-color: #ab3fd6;
        color: #ab3fd6;
    }
    .btn-outline-purple:hover {
        background-color: #ab3fd6;
        color: white;
        border-color: #ab3fd6;
    }
    .hover-shadow:hover {
        box-shadow: 0 0 12px rgba(171, 63, 214, 0.5);
    }
</style>
@endsection
