@extends('layouts.client')

@section('title', 'GlobalDrop - Descriptions des Chaînes')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 20px;
        position: relative;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .header {
        text-align: center;
        color: white;
        margin-bottom: 40px;
        position: relative;
    }

    .header h1 {
        font-size: 3em;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .header p {
        font-size: 1.2em;
        opacity: 0.9;
    }

    .channels-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }

    .channel-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 30px;
        color: white;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .channel-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        background: rgba(255, 255, 255, 0.15);
    }

    .channel-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(45deg, #25d366, #128c7e);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
    }

    .channel-title {
        font-size: 1.5em;
        font-weight: bold;
        margin-bottom: 15px;
        color: #25d366;
    }

    .channel-description {
        line-height: 1.6;
        margin-bottom: 25px;
        opacity: 0.9;
    }

    .channel-features {
        list-style: none;
        margin-bottom: 25px;
    }

    .channel-features li {
        padding: 8px 0;
        position: relative;
        padding-left: 25px;
    }

    .channel-features li::before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #25d366;
        font-weight: bold;
    }

    .connect-btn {
        background: linear-gradient(45deg, #25d366, #128c7e);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-size: 1.1em;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
    }

    .connect-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
    }

    .footer {
        text-align: center;
        color: white;
        margin-top: 50px;
        opacity: 0.8;
    }
</style>

<div class="container">
    <div class="header">
        <h1>GlobalDrop</h1>
        <p>Vos achats internationaux simplifiés - Livraison au Togo 🇹🇬</p>
    </div>

    <div class="channels-grid">
        {{-- Carte 1 --}}
        <div class="channel-card">
            <div class="channel-icon">📱</div>
            <h2 class="channel-title">Canal Principal Togo</h2>
            <p class="channel-description">
                Notre canal officiel pour tous les Togolais ! Découvrez les nouveautés internationales, promotions exclusives et actualités GlobalDrop.
            </p>
            <ul class="channel-features">
                <li>Nouveautés internationales</li>
                <li>Promotions spéciales Togo</li>
                <li>Paiement sécurisé (acompte + solde)</li>
                <li>Livraison gratuite à Lomé</li>
            </ul>
            <a href="https://whatsapp.com/channel/0029VbAh2wrGZNCxxKYwbN3Q" class="connect-btn" target="_blank">
                Rejoindre 🇹🇬
            </a>
        </div>

        {{-- Carte 2 --}}
        <div class="channel-card">
            <div class="channel-icon">💼</div>
            <h2 class="channel-title">Produits par Catégories</h2>
            <p class="channel-description">
                Accédez directement aux produits qui vous intéressent : Mode, Électronique, Maison, Beauté, Outils et Produits enfants.
            </p>
            <ul class="channel-features">
                <li>Mode & Accessoires</li>
                <li>Électronique & Technologies</li>
                <li>Maison & Décoration</li>
                <li>Beauté & Bien-être</li>
            </ul>
            <a href="{{ route('produits.index') }}" class="connect-btn" target="_blank">
                Découvrir 🛍
            </a>
        </div>

        

        {{-- Carte 3 --}}
        <div class="channel-card">
            <div class="channel-icon">🎯</div>
            <h2 class="channel-title">Marketing & Promotions</h2>
            <p class="channel-description">
                Ne manquez aucune promotion, offre spéciale ou campagne marketing exclusive de GlobalDrop.
            </p>
            <ul class="channel-features">
                <li>Offres exclusives</li>
                <li>Codes promo</li>
                <li>Campagnes limitées</li>
                <li>Réductions membres</li>
            </ul>
            <a href="{{ route('promotions') }}" class="connect-btn" target="_blank">
                Profiter 🎁
            </a>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Global Drop - La qualité au bout du clic, la sécurité en plus.</p>
        <p>Rejoignez notre communauté et restez connectés !</p>
    </div>
</div>

<script>
    document.querySelectorAll('.channel-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) rotate(1deg)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) rotate(0deg)';
        });
    });
</script>
@endsection
