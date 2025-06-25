@extends('layouts.client')

@section('title', 'Mon parrainage')

@section('content')
<div class="max-w-4xl p-6 mx-auto mt-8 bg-white rounded shadow">
    <h1 class="mb-6 text-3xl font-bold text-center text-green-700">🎉 Gagnez des récompenses avec le parrainage !</h1>

    <!-- Bloc incitatif -->
    <div class="p-4 mb-6 text-yellow-900 border-l-4 border-yellow-400 rounded bg-yellow-50">
        <p class="text-lg font-semibold">Parrainez vos amis et soyez récompensé !</p>
        <ul class="mt-2 ml-5 text-sm list-disc">
            <li><strong>Pour chaque filleul inscrit :</strong> gagnez des <span class="font-bold text-green-700">points de fidélité</span> ou des <span class="font-bold text-green-700">réductions exclusives</span>.</li>
            <li><strong>Vos amis profitent aussi</strong> d’un bonus de bienvenue dès leur première commande.</li>
            <li>Plus vous parrainez, plus vous gagnez. C’est simple et rapide ! 💸</li>
        </ul>
    </div>

    <!-- Lien de parrainage -->
    <div class="p-4 mb-8 bg-green-100 border border-green-300 rounded">
        <p class="mb-2 font-semibold text-green-800">🎁 Votre lien de parrainage :</p>

        <div class="flex items-center gap-2">
            <input type="text" readonly
                value="{{ $lien }}"
                class="w-full px-3 py-2 text-sm border border-green-400 rounded bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500"
                id="referralLink"
                onclick="this.select();document.execCommand('copy'); alert('Lien copié dans le presse-papiers ✅')"
                title="Cliquez pour copier le lien">
            <a href="{{ $lien }}" target="_blank" class="text-sm text-green-700 underline hover:text-green-900">Visiter</a>
        </div>

        <!-- Bouton WhatsApp -->
        <div class="mt-4">
            <button
                onclick="shareWhatsApp()"
                class="inline-flex items-center gap-2 px-4 py-2 text-white transition bg-green-600 rounded shadow hover:bg-green-700"
                aria-label="Partager sur WhatsApp">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.472 14.382a9.044 9.044 0 01-4.949 1.598 9.123 9.123 0 01-4.108-1.1l-3.422.895.895-3.421a9.142 9.142 0 01-1.1-4.108 9.045 9.045 0 011.598-4.949 8.967 8.967 0 016.337-3.507c4.97 0 9 4.03 9 9a8.967 8.967 0 01-3.507 6.337z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15.23 9.37a.75.75 0 00-1.06-1.06l-1.88 1.88-1.12-1.12a.75.75 0 00-1.06 1.06l1.59 1.59a.75.75 0 001.06 0l2.41-2.41z"/>
                </svg>
                Partager sur WhatsApp
            </button>
        </div>

        <p class="mt-2 text-xs text-gray-600">📋 Cliquez dans la zone pour copier automatiquement le lien ou utilisez le bouton pour l’envoyer à vos contacts via WhatsApp.</p>
    </div>
</div>

<script>
function shareWhatsApp() {
    const link = document.getElementById('referralLink').value;
    const text = `🎁 Rejoins-moi sur Global Drop !\nGrâce à ce lien, tu auras un bonus de bienvenue et moi aussi je suis récompensé 🎉👇\n${link}`;
    const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(text)}`;
    window.open(whatsappUrl, '_blank');
}
</script>
@endsection
