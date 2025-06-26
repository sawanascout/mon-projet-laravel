@extends('layouts.client')

@section('content')
<div class="container my-5" style="max-width: 700px;">
    <div class="p-4 bg-white border border-purple-100 shadow-lg rounded-3 p-md-5">
        <h1 class="mb-4 text-center text-purple-700 fw-extrabold fs-2">Commande confirmée !</h1>

        <!-- Détails de la commande -->
        <div class="p-3 mb-4 border border-purple-200 bg-purple-50 rounded-3 fs-5">
            <p><strong>Numéro de commande :</strong> {{ $commande->order_number }}</p>
            <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>🙍 Nom :</strong> {{ $commande->customer_name }}</p>
            <p><strong>WhatsApp :</strong> {{ $commande->whatsapp_number ?? 'Non renseigné' }}</p>
            <p><strong>Ville :</strong> {{ $commande->city }}</p>
            <p><strong>Total à payer :</strong>
                <span class="text-purple-900 fw-bold">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</span>
            </p>
        </div>

        <!-- Détails des articles -->
        <div class="mb-4">
            <h2 class="mb-3 text-purple-700 fw-bold fs-4">Vos articles</h2>
            <ul class="border border-gray-100 list-group rounded-3">
                @foreach($commande->lignes as $ligne)
                    <li class="list-group-item d-flex flex-column bg-light hover-shadow">
                        <div class="d-flex justify-content-between fw-medium">
                            <span>{{ $ligne->nom }} <small class="fw-normal">x{{ $ligne->quantite }}</small></span>
                        </div>
                        <div class="mt-1 text-muted ms-2 small">
                            <p class="mb-1">Couleur : {{ $ligne->couleur ?? 'Non précisée' }}</p>
                            <p class="mb-0">Dimension : {{ $ligne->taille ?? 'Non précisée' }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Paiement requis -->
        <div class="p-3 mb-4 border bg-success bg-opacity-10 border-warning rounded-3">
            <p class="mb-1 text-success fw-semibold fs-5">Paiement requis :</p>
            <p>Un acompte de <strong>25% du montant total</strong> est nécessaire pour valider votre commande.</p>
            <p class="mb-0 text-muted small">Le reste sera à régler à la livraison.</p>
        </div>

        <!-- Choix de paiement -->
        <div>
            <h3 class="mb-3 text-purple-700 fw-bold fs-5">💰 Choisissez un mode de paiement :</h3>

            <!-- Paiement partiel obligatoire -->
            <div class="p-3 mb-3 border border-purple-200 bg-purple-50 rounded-3">
                <div class="form-check">
                    <input class="form-check-input text-purple" type="checkbox" id="cod-agree">
                    <label class="form-check-label" for="cod-agree">
                        J’accepte de verser 25% pour valider la commande.
                    </label>
                </div>

                <!-- Montant affiché dynamiquement -->
                <div id="partial-info" class="mt-3 text-muted d-none">
                    <p><strong>Montant total :</strong> {{ number_format($commande->total, 0, ',', ' ') }} FCFA</p>
                    <p><strong>25% à payer maintenant :</strong>
                        <span class="text-purple-900 fw-semibold" id="partial-amount"></span>
                    </p>
                </div>
            </div>

            <!-- Choix du moyen de paiement -->
            <div id="payment-methods" class="d-none">
                <!-- Mix By Yas -->
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input text-purple" type="radio" name="payment_method" id="yas" value="yas">
                        <label class="form-check-label" for="yas">Mix By Yas</label>
                    </div>
                    <div class="mt-2 ms-4 d-none" id="yas-info">
                        <ul class="text-muted small list-unstyled ps-3">
                            <li>Tapez *145# et suivez les procédures de transfert.</li>
                            <li><strong>Numéro :</strong> +228 90 17 11 19</li>
                            <li><strong>Bénéficiaire :</strong></li>
                        </ul>
                        <div class="mt-3 mb-0 alert alert-warning small" role="alert">
                            ⚠️ <strong>Important :</strong> Après votre paiement, <u>il est obligatoire</u> d’envoyer une capture d’écran sur WhatsApp pour que votre transaction soit validée.
                        </div>
                    </div>
                </div>

                <!-- Flooz -->
                <div>
                    <div class="form-check">
                        <input class="form-check-input text-purple" type="radio" name="payment_method" id="flooz" value="flooz">
                        <label class="form-check-label" for="flooz">Flooz</label>
                    </div>
                    <div class="mt-2 ms-4 d-none" id="flooz-info">
                        <ul class="text-muted small list-unstyled ps-3">
                            <li>Tapez *155# et suivez les procédures de transfert.</li>
                            <li><strong>Numéro :</strong> +228 98 30 47 69</li>
                            <li><strong>Bénéficiaire :</strong></li>
                        </ul>
                        <div class="mt-3 mb-0 alert alert-warning small" role="alert">
                            ⚠️ <strong>Important :</strong> Après votre paiement, <u>il est obligatoire</u> d’envoyer une capture d’écran sur WhatsApp pour que votre transaction soit validée.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire -->
        <form action="{{ route('commandes.terminee', $commande->id) }}" method="GET" class="mt-4">
            @csrf
            <input type="hidden" name="payment_method" id="payment_method_selected" value="">
            <div class="text-center">
                <button
                    type="submit"
                    id="confirm-button"
                    class="px-5 py-2 shadow btn btn-gradient-purple fw-semibold"
                >
                    ✅ Confirmer la commande
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .text-purple {
        color: #ab3fd6 !important;
    }
    .btn-gradient-purple {
        background: linear-gradient(90deg, #6b21a8, #ab3fd6);
        color: white;
        border: none;
        border-radius: 50px;
        transition: transform 0.3s ease;
    }
    .btn-gradient-purple:hover {
        background: linear-gradient(90deg, #4c1d95, #922ebc);
        color: white;
        transform: scale(1.05);
    }
    .hover-shadow:hover {
        box-shadow: 0 0 12px rgba(171, 63, 214, 0.5);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const codAgree = document.getElementById('cod-agree');
        const partialInfo = document.getElementById('partial-info');
        const partialAmount = document.getElementById('partial-amount');
        const confirmButton = document.getElementById('confirm-button');
        const paymentMethodField = document.getElementById('payment_method_selected');

        const yasRadio = document.getElementById('yas');
        const floozRadio = document.getElementById('flooz');
        const yasInfo = document.getElementById('yas-info');
        const floozInfo = document.getElementById('flooz-info');
        const paymentMethods = document.getElementById('payment-methods');

        const total = {{ $commande->total }};
        const partial = Math.round(total * 0.25);

        codAgree.addEventListener('change', function () {
            if (codAgree.checked) {
                partialAmount.innerText = partial.toLocaleString('fr-FR') + " FCFA";
                partialInfo.classList.remove('d-none');
                paymentMethods.classList.remove('d-none');
            } else {
                partialInfo.classList.add('d-none');
                paymentMethods.classList.add('d-none');
                yasInfo.classList.add('d-none');
                floozInfo.classList.add('d-none');
                paymentMethodField.value = '';
                yasRadio.checked = false;
                floozRadio.checked = false;
            }
        });

        yasRadio.addEventListener('change', function () {
            paymentMethodField.value = 'yas';
            yasInfo.classList.remove('d-none');
            floozInfo.classList.add('d-none');
        });

        floozRadio.addEventListener('change', function () {
            paymentMethodField.value = 'flooz';
            floozInfo.classList.remove('d-none');
            yasInfo.classList.add('d-none');
        });

        confirmButton.addEventListener('click', function (e) {
            if (!codAgree.checked) {
                e.preventDefault();
                alert("Veuillez accepter de payer 25% pour activer les options de paiement.");
            } else if (!yasRadio.checked && !floozRadio.checked) {
                e.preventDefault();
                alert("Veuillez sélectionner un mode de paiement.");
            }
        });
    });
</script>
@endsection
