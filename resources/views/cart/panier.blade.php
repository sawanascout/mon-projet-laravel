@extends('layouts.client')

@section('content')
<div class="container px-3 py-4">
    <h1 class="mb-4 text-center fs-3 text-md-start">Votre Panier</h1>

    @php
        $total = 0;
        $panier = session('panier', []);
    @endphp

    @if(count($panier) > 0)
        <div class="mb-4 table-responsive">
            <table class="table align-middle table-bordered text-nowrap">
                <thead class="table-light">
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($panier as $produitId => $produit)
                        @if(is_array($produit))
                            @php
                                $subtotal = $produit['prix'] * $produit['quantite'];
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>
                                    <div class="gap-2 d-flex flex-column flex-md-row align-items-md-center">
                                        @if(!empty($produit['photo']))
                                            <img src="{{ asset('storage/' . $produit['photo']) }}"
                                                alt="{{ $produit['nom'] }}"
                                                class="rounded"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @endif
                                        <span class="fw-semibold">{{ $produit['nom'] }}</span>
                                    </div>
                                </td>
                                <td>{{ number_format($produit['prix'], 0, ',', ' ') }} FCFA</td>
                                <td>{{ $produit['quantite'] }}</td>
                                <td>{{ number_format($subtotal, 0, ',', ' ') }} FCFA</td>
                                <td class="text-center">
                                    <form action="{{ route('cart.remove', $produitId) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
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
        <div class="gap-3 d-flex flex-column flex-md-row justify-content-md-end align-items-md-center">
            <h4 class="mb-0">Total :</h4>
            <h4 class="mb-0 text-primary fw-bold">{{ number_format($total, 0, ',', ' ') }} FCFA</h4>
        </div>

        <!-- Bouton Commander -->
        <div class="mt-3 d-flex justify-content-md-end">
            @auth
                <a href="{{ route('commandes.create') }}" class="px-4 py-2 text-center btn btn-primary w-100 w-md-auto">
                    Finaliser la commande
                </a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-center btn btn-primary w-100 w-md-auto">
                    Se connecter pour commander
                </a>
            @endauth
        </div>

    @else
        <div class="my-5 text-center alert alert-info" role="alert">
            Votre panier est vide.
        </div>
    @endif

    <div class="mt-4 text-center text-md-start">
        <a href="{{ route('produits.index') }}" class="text-decoration-none text-primary">
            ← Continuer les achats
        </a>
    </div>
</div>
@endsection
