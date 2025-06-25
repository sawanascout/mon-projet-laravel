@extends('layouts.client')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Votre Panier</h1>

    @php
        $total = 0;
        $panier = session('panier', []);
    @endphp

    @if(count($panier) > 0)
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
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
                                <td class="d-flex align-items-center gap-3">
                                    @if(!empty($produit['photo']))
                                        <img src="{{ asset('storage/' . $produit['photo']) }}" 
                                             alt="{{ $produit['nom'] }}" 
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 0.5rem;">
                                    @endif
                                    <span>{{ $produit['nom'] }}</span>
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

        <div class="d-flex justify-content-end align-items-center mt-4">
            <h4 class="me-3">Total :</h4>
            <h4 class="text-primary fw-bold">{{ number_format($total, 0, ',', ' ') }} FCFA</h4>
        </div>

        <div class="d-flex justify-content-end mt-4">
            @auth
                <a href="{{ route('commandes.create') }}" class="btn btn-primary px-4 py-2">
                    Finaliser la commande
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2">
                    Se connecter pour commander
                </a>
            @endauth
        </div>

    @else
        <div class="alert alert-info text-center" role="alert">
            Votre panier est vide.
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('produits.index') }}" class="text-decoration-none text-primary">
            ← Continuer les achats
        </a>
    </div>
</div>
@endsection
