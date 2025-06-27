@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="py-2 text-white bg-main-color">
    <div class="text-center container-fluid">
        <small id="carousel-text">Livraison rapide & Paiement 100% sécurisé au Togo 🇹🇬</small>
    </div>
</div>

<header class="bg-white sticky-top header-shadow">
    <div class="py-3 container-fluid">
        <div class="row align-items-center">
            <div class="col-md-3 col-6">
                <a href="{{ route('produits.index') }}">
                    <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop" class="img-fluid" style="height: 40px;">
                </a>
            </div>
            <div class="col-md-4 d-none d-md-block">
                <form action="{{ route('produits.index') }}" method="GET">
                    <input type="text" name="search" class="form-control rounded-pill border-main-color" placeholder="Rechercher un produit...">
                </form>
            </div>
            <div class="col-md-5 col-6">
                <div class="flex-wrap gap-2 d-flex justify-content-end align-items-center">
                    @auth
                        <span class="small fw-semibold text-muted">👋 Bonjour, <span class="main-color">{{ auth()->user()->name }}</span></span>
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-success btn-sm">Dashboard</a>
                        @endif
                        <a href="{{ route('commandes.mes-commandes') }}" class="btn btn-main-outline btn-sm rounded-pill">📦 Mes commandes</a>
                        <a href="{{ route('Parrainage.index') }}" class="btn btn-outline-success btn-sm rounded-pill">
                            🏱 Mon lien de parrainage
                        </a>
                        <a href="{{ route('page') }}" class="btn btn-main-outline btn-sm rounded-pill">
                            🌐 Nous suivre
                        </a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="small text-decoration-underline main-color">Déconnexion</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-main btn-sm rounded-pill">Se connecter</a>
                        <a href="{{ route('Parrainage.index') }}" class="btn btn-outline-success btn-sm rounded-pill">
                            🏱 Mon lien de parrainage
                        </a>
                        <a href="{{ route('page') }}" class="btn btn-main-outline btn-sm rounded-pill">
                            🌐 Nous suivre
                        </a>
                    @endauth
                    <a href="{{ route('cart.index') }}" class="position-relative text-decoration-none text-dark">
                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 00.9 1.3h10.9a1 1 0 00.9-1.3L17 13M7 13V6h10v7" />
                        </svg>
                        @if(session('panier') && count(session('panier')) > 0)
                            <span class="cart-badge">{{ count(session('panier')) }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
    <nav class="bg-gray-100">
        <div class="flex px-4 py-2 mx-auto space-x-3 overflow-x-auto text-sm max-w-7xl">
            @foreach ([
                'Toutes',
                'Mode & Accessoires',
                'Pour Hommes',
                'Pour Femmes'
            ] as $cat)
                <a href="{{ route('produits.index', ['category' => $cat == 'Toutes' ? null : $cat]) }}"
                   class="px-3 py-1 text-gray-700 transition-all border border-transparent fw-bold text-decoration-none rounded-pill hover:text-white hover:bg-purple-700">
                    {{ $cat }}
                </a>
            @endforeach
        </div>
    </nav>
</header>

<section class="py-4 mt-4 bg-white border-top border-bottom">
    <div class="container">
        <h2 class="mb-4 text-center fw-bold">
            Pourquoi <span class="main-color">choisir GlobalDrop</span> ?
        </h2>
        <div class="row g-4">
            <x-feature title="Livraison rapide" description="Nous livrons rapidement partout au Togo grâce à notre logistique performante." icon="message-circle" />
            <x-feature title="Prix compétitifs" description="Profitez des meilleurs tarifs sur des produits tendance et de qualité." icon="shield" />
            <x-feature title="Paiement sécurisé" description="Notre plateforme garantit des paiements sûrs et protégés à 100 %." icon="credit-card" />
        </div>
    </div>
</section>

<main>
    @yield('page-content')
</main>

<footer class="py-4 mt-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <h5 class="mb-3 fw-semibold text-dark">Suivez-nous</h5>
                <x-social-icons />
            </div>
        </div>
        <div class="pt-3 mt-4 text-center border-top">
            <small class="text-muted">
                &copy; {{ date('Y') }} Global Drop - La qualité au bout du clic, la sécurité en plus.
            </small>
        </div>
    </div>
</footer>

<a href="https://wa.me/22890171119" target="_blank" class="whatsapp-float">
    <x-icons.whatsapp />
    Contactez nous
</a>
@endsection
