@extends('layouts.client')

@section('content')
<div class="container my-5" style="max-width: 600px;">
    <div class="bg-white rounded-3 shadow-lg p-4 p-md-5 text-center">
        <h1 class="mb-4 fs-1 fw-bold text-success">Merci pour votre commande !</h1>

        <p class="mb-2 fs-5 text-secondary">
            Votre commande <span class="fw-semibold text-purple-600">#{{ $commande->order_number }}</span> a bien été enregistrée.
        </p>
        
        <p class="mb-5 text-muted fs-6">
            Un membre de notre équipe vous contactera prochainement pour organiser la livraison.
        </p>

        <div class="alert alert-warning text-warning border-warning rounded-3 mb-5" role="alert" style="text-align: left;">
            <p class="fw-semibold mb-2">⚠️ Important :</p>
            <p>
                Veuillez <strong>envoyer une capture d'écran de votre reçu de paiement</strong> via le bouton WhatsApp présent sur cette page.
                Cela permet de valider votre commande plus rapidement.
            </p>
        </div>

        <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mb-5">
            <a href="{{ route('produits.index') }}" class="btn btn-purple px-4 py-2">
                🏠 Retour à la boutique
            </a>

            <a href="{{ route('commandes.mes-commandes') }}" class="btn btn-outline-purple px-4 py-2">
                Suivre mes commandes
            </a>
        </div>

        <hr class="my-4">

        <form action="{{ route('commandes.feedback', $commande->id) }}" method="POST" class="text-start">
            @csrf
            <label for="commentaire" class="form-label fw-semibold text-secondary fs-6">
                💬 Que pensez-vous de votre expérience sur GlobalDrop ?
            </label>
            <textarea
                name="commentaire"
                id="commentaire"
                rows="4"
                class="form-control mb-3"
                placeholder="Votre avis nous aide à nous améliorer... (facultatif)"
            ></textarea>

            <button type="submit" class="btn btn-purple fw-semibold px-4 py-2">
                Envoyer mon avis
            </button>
        </form>
    </div>
</div>

<style>
    .btn-purple {
        background: #6b21a8;
        color: white;
        border-radius: 0.375rem;
        transition: background-color 0.3s ease;
        border: none;
    }
    .btn-purple:hover {
        background: #581c87;
        color: white;
    }
    .btn-outline-purple {
        color: #6b21a8;
        border: 2px solid #6b21a8;
        border-radius: 0.375rem;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .btn-outline-purple:hover {
        background: #6b21a8;
        color: white;
    }
</style>
@endsection
