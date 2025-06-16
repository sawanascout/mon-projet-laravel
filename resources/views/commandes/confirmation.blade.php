@extends('layouts.client')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-xl rounded-2xl mt-10 border border-purple-100">
    <h1 class="text-4xl font-extrabold mb-8 text-center text-purple-700">Commande confirmée !</h1>

    <!-- Détails de la commande -->
    <div class="space-y-3 text-lg bg-purple-50 p-4 rounded-lg border border-purple-200">
        <p><strong>Numéro de commande :</strong> {{ $order->order_number }}</p>
        <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>🙍 Nom :</strong> {{ $order->customer_name }}</p>
        <p><strong>WhatsApp :</strong> {{ $order->whatsapp_number ?? 'Non renseigné' }}</p>
        <p><strong>Ville :</strong> {{ $order->city }}</p>
        <p><strong>Total à payer :</strong> <span class="font-bold text-purple-900">{{ number_format($order->total, 0, ',', ' ') }} FCFA</span></p>
    </div>

    <!-- Détails des articles -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4 text-purple-700">Vos articles</h2>
        <ul class="divide-y divide-gray-200 rounded-lg overflow-hidden border border-gray-100">
            @foreach($order->items as $item)
                <li class="px-4 py-3 bg-gray-50 hover:bg-gray-100 transition">
                    <div class="flex justify-between font-medium">
                        <span>{{ $item->name }} <span class="text-sm font-normal">x{{ $item->quantity }}</span></span>
                    </div>
                    <div class="text-sm text-gray-600 ml-2 mt-1">
                        <p>Couleur : {{ $item->color ?? 'Non précisée' }}</p>
                        <p>Dimension : {{ $item->size ?? 'Non précisée' }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Paiement requis -->
    <div class="mt-8 bg-green-50 p-5 rounded-lg border-l-4 border-yellow-400">
        <p class="text-green-800 font-semibold text-lg">Paiement requis :</p>
        <p class="mt-1">Un acompte de <strong>25% du montant total</strong> est nécessaire pour valider votre commande.</p>
        <p class="text-sm text-gray-700 mt-2">Le reste sera à régler à la livraison.</p>
    </div>

    <!-- Choix de paiement -->
    <div class="mt-6">
        <h3 class="text-xl font-bold mb-4 text-purple-700">💰 Choisissez un mode de paiement :</h3>

        <!-- Paiement partiel obligatoire -->
        <div class="mb-3 bg-purple-50 p-4 rounded-lg border border-purple-200">
            <label class="flex items-start space-x-2 text-sm mb-2">
                <input type="checkbox" id="cod-agree" class="form-checkbox mt-1 text-purple-600">
                <span>J’accepte de verser 25% pour valider la commande.</span>
            </label>

            <!-- Montant affiché dynamiquement -->
            <div id="partial-info" class="text-sm text-gray-700 mt-3 hidden">
                <p><strong>Montant total :</strong> {{ number_format($order->total, 0, ',', ' ') }} FCFA</p>
                <p><strong>25% à payer maintenant :</strong> <span class="text-purple-900 font-semibold" id="partial-amount"></span></p>
            </div>
        </div>

        <!-- Choix du moyen de paiement -->
        <div id="payment-methods" class="hidden">
            <!-- Mix By Yas -->
            <div class="mb-3">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="payment_method" id="yas" value="yas" class="form-radio text-purple-600">
                    <span class="ml-3">Mix By Yas</span>
                </label>
                <div class="ml-6 mt-2 hidden" id="yas-info">
                    <ul class="text-sm text-gray-700 list-disc list-inside">
                        <p>Tapez *145# et suivez les procédures de transfert.</p>
                        <li><strong>Numéro :</strong> +228 90 17 11 79</li>
                        <li><strong>Bénéficiaire :</strong>  </li>
                    </ul>
<p class="mt-4 text-sm text-yellow-800 bg-yellow-100 border-l-4 border-yellow-500 p-3 rounded">
    ⚠️ <strong>Important :</strong> Après votre paiement, <u>il est obligatoire</u> d’envoyer une capture d’écran sur WhatsApp pour que votre transaction soit validée.
</p>
                </div>
            </div>

            <!-- Flooz -->
            <div class="mb-3">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" name="payment_method" id="flooz" value="flooz" class="form-radio text-purple-600">
                    <span class="ml-3">Flooz</span>
                </label>
                <div class="ml-6 mt-2 hidden" id="flooz-info">
                    <ul class="text-sm text-gray-700 list-disc list-inside">
                        <p>Tapez *155# et suivez les procédures de transfert.</p>
                        <li><strong>Numéro :</strong> +228 98 30 47 69</li>
                        <li><strong>Bénéficiaire :</strong> </li>
                    </ul>
<p class="mt-4 text-sm text-yellow-800 bg-yellow-100 border-l-4 border-yellow-500 p-3 rounded">
    ⚠️ <strong>Important :</strong> Après votre paiement, <u>il est obligatoire</u> d’envoyer une capture d’écran sur WhatsApp pour que votre transaction soit validée.
</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire -->
    <form action="{{ route('commandes.terminee', $order->id) }}" method="GET">
        @csrf
        <input type="hidden" name="payment_method" id="payment_method_selected" value="">
        <div class="text-center mt-8">
            <button
                type="submit"
                id="confirm-button"
                class="bg-gradient-to-r from-purple-600 to-purple-800 text-white px-8 py-3 rounded-full font-semibold shadow hover:shadow-lg transition-all hover:scale-105"
            >
                ✅ Confirmer la commande
            </button>
        </div>
    </form>
</div>

<!-- JS -->
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

        const total = {{ $order->total }};
        const partial = Math.round(total * 0.25);

        codAgree.addEventListener('change', function () {
            if (codAgree.checked) {
                partialAmount.innerText = partial.toLocaleString('fr-FR') + " FCFA";
                partialInfo.classList.remove('hidden');
                paymentMethods.classList.remove('hidden');
            } else {
                partialInfo.classList.add('hidden');
                paymentMethods.classList.add('hidden');
                yasInfo.classList.add('hidden');
                floozInfo.classList.add('hidden');
            }
        });

        yasRadio.addEventListener('change', function () {
            paymentMethodField.value = 'yas';
            yasInfo.classList.remove('hidden');
            floozInfo.classList.add('hidden');
        });

        floozRadio.addEventListener('change', function () {
            paymentMethodField.value = 'flooz';
            floozInfo.classList.remove('hidden');
            yasInfo.classList.add('hidden');
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