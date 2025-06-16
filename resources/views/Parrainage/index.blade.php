@extends('layouts.client')

@section('title', 'Mon parrainage')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mt-8">
    <h1 class="text-2xl font-bold mb-6 text-center text-green-700">🎁 Mon Parrainage</h1>

    <!-- Lien de parrainage -->
    <div class="mb-8 p-4 bg-green-100 border border-green-300 rounded">
        <p class="mb-2 font-semibold">Votre lien de parrainage :</p>

        <!-- Champ copiable et cliquable -->
        <div class="flex items-center gap-2">
            <input type="text" readonly
                value="{{ $lien }}"
                class="w-full px-3 py-2 border border-green-400 rounded text-sm bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500"
                id="referralLink"
                onclick="this.select();document.execCommand('copy'); alert('Lien copié !')"
                title="Cliquez pour copier le lien">
            <a href="{{ $lien }}" target="_blank" class="text-green-700 underline text-sm hover:text-green-900">Visiter</a>
        </div>

        <!-- Bouton WhatsApp -->
        <div class="mt-4">
            <button
                onclick="shareWhatsApp()"
                class="inline-flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition shadow"
                aria-label="Partager sur WhatsApp">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.472 14.382a9.044 9.044 0 01-4.949 1.598 9.123 9.123 0 01-4.108-1.1l-3.422.895.895-3.421a9.142 9.142 0 01-1.1-4.108 9.045 9.045 0 011.598-4.949 8.967 8.967 0 016.337-3.507c4.97 0 9 4.03 9 9a8.967 8.967 0 01-3.507 6.337z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15.23 9.37a.75.75 0 00-1.06-1.06l-1.88 1.88-1.12-1.12a.75.75 0 00-1.06 1.06l1.59 1.59a.75.75 0 001.06 0l2.41-2.41z"/>
                </svg>
                Partager sur WhatsApp
            </button>
        </div>

        <p class="text-xs text-gray-600 mt-1">Cliquez dans la zone pour copier automatiquement le lien ou utilisez le bouton pour envoyer directement sur WhatsApp.</p>
    </div>
</div>

<script>
function shareWhatsApp() {
    const link = document.getElementById('referralLink').value;
    const text = `${link}\n\n🎁 Rejoins Global Drop et gagne des avantages exclusifs grâce à mon parrainage !`;
    const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(text)}`;
    window.open(whatsappUrl, '_blank');
}

</script>
@endsection