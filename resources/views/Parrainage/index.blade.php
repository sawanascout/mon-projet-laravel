@extends('layouts.client')

@section('title', 'Mon parrainage')

@section('content')
<div class="container my-5" style="max-width: 768px;">
    <div class="bg-white rounded shadow p-4 p-md-5">

        <h1 class="text-center text-success fw-bold mb-4 fs-3">🎉 Gagnez des récompenses avec le parrainage !</h1>

        <!-- Bloc incitatif -->
        <div class="border-start border-4 border-warning bg-warning bg-opacity-10 p-3 mb-4">
            <p class="fw-semibold text-warning mb-2 fs-5">Parrainez vos amis et soyez récompensé !</p>
            <ul class="list-unstyled ms-3 small">
                <li>• <strong>Pour chaque filleul inscrit :</strong> gagnez des <span class="fw-bold text-success">points de fidélité</span> ou des <span class="fw-bold text-success">réductions exclusives</span>.</li>
                <li>• <strong>Vos amis profitent aussi</strong> d’un bonus de bienvenue dès leur première commande.</li>
                <li>• Plus vous parrainez, plus vous gagnez. C’est simple et rapide ! 💸</li>
            </ul>
        </div>

        <!-- Lien de parrainage -->
        <div class="border border-success rounded bg-success bg-opacity-10 p-3 mb-4">
            <p class="fw-semibold text-success mb-2">🎁 Votre lien de parrainage :</p>

            <div class="d-flex gap-2 mb-3">
                <input
                    type="text"
                    readonly
                    value="{{ $lien }}"
                    id="referralLink"
                    class="form-control border border-success bg-success bg-opacity-25"
                    title="Cliquez pour copier le lien"
                    onclick="this.select();document.execCommand('copy'); alert('Lien copié dans le presse-papiers ✅')"
                >
                <a href="{{ $lien }}" target="_blank" class="btn btn-link text-success text-decoration-underline align-self-center">Visiter</a>
            </div>

            <!-- Bouton WhatsApp -->
            <button
                type="button"
                onclick="shareWhatsApp()"
                class="btn btn-success d-inline-flex align-items-center gap-2"
                aria-label="Partager sur WhatsApp"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-whatsapp" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M13.601 2.326a7.495 7.495 0 0 0-10.597 10.6l-.938 3.422 3.51-.921a7.48 7.48 0 0 0 7.527-12.343zM8 13.22a5.22 5.22 0 0 1-2.651-.758l-.19-.11-1.566.412.416-1.523-.13-.2A5.22 5.22 0 1 1 8 13.22zm.144-3.993c.107-.017.42-.166.47-.184a.498.498 0 0 0 .243-.179.284.284 0 0 0 .031-.251c-.016-.049-.15-.123-.3-.193a.998.998 0 0 0-.328-.097c-.095-.012-.18-.014-.258-.004a.187.187 0 0 0-.108.046c-.057.053-.142.173-.276.36-.103.142-.201.187-.286.23a.442.442 0 0 0-.191.26.3.3 0 0 0 .105.259c.106.092.226.15.348.206.124.055.3.113.427.143z"/>
                </svg>
                Partager sur WhatsApp
            </button>

            <p class="text-muted small mt-2">📋 Cliquez dans la zone pour copier automatiquement le lien ou utilisez le bouton pour l’envoyer à vos contacts via WhatsApp.</p>
        </div>
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
