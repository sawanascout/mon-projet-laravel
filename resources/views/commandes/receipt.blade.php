<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Reçu de commande #{{ $order->id }} - GlobalDrop</title>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #ab3fd6;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header h1 {
            color: #ab3fd6;
            margin: 0 0 5px 0;
            font-size: 28px;
        }
        .header p {
            font-weight: 600;
            font-size: 16px;
            margin: 0;
            color: #555;
        }
        h2 {
            color: #ab3fd6;
            margin-bottom: 10px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h4 {
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 12px;
            color: #ab3fd6;
        }
        p {
            margin: 6px 0;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
            margin: 0;
        }
        ul li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .item-title {
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }
        .item-details {
            font-size: 13px;
            color: #555;
            margin-top: 4px;
        }
        .total {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin-top: 15px;
            text-align: right;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-style: italic;
            color: #666;
            font-size: 13px;
        }
        .whatsapp-link {
            color: #25d366;
            text-decoration: none;
            font-weight: 600;
        }
        .whatsapp-link:hover {
            text-decoration: underline;
        }
        .contact-info {
            font-size: 13px;
            color: #999;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>GlobalDrop</h1>
            <p>Votre plateforme d’achats internationaux</p>
        </div>

        <div class="section">
            <h2>Reçu de Commande {{ $order->order_number }}</h2>
            <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="section">
            <h4>Détails du client</h4>
            <p><strong>Nom :</strong> {{ $order->customer_name }}</p>
            <p><strong>WhatsApp :</strong> {{ $order->whatsapp_number ?? 'Non renseigné' }}</p>
            <p><strong>Ville :</strong> {{ $order->city }}</p>
        </div>

        <div class="section">
            <h4>Produits commandés</h4>
            <ul>
                @foreach($order->items as $item)
                    <li>
                        <div class="item-title">
                            <span>{{ $item->quantity }} x {{ $item->name }}</span>
                            <span>{{ number_format($item->unit_price * $item->quantity, 0, ',', ' ') }} FCFA</span>
                        </div>
                        <div class="item-details">
                            Couleur : {{ $item->color ?? 'Non précisée' }}<br>
                            Taille : {{ $item->size ?? 'Non précisée' }}
                        </div>
                    </li>
                @endforeach
            </ul>
            <p class="total">Total : {{ number_format($order->total, 0, ',', ' ') }} FCFA</p>
        </div>

        <div class="footer">
            <p>Merci pour votre commande chez GlobalDrop !</p>
            <p>Pour envoyer la capture de votre paiement, cliquez ici :
                <a 
                   href="https://wa.me/212723455155?text=Bonjour%2C%20je%20vous%20envoie%20la%20capture%20de%20ma%20transaction%20pour%20la%20commande%20%23{{ $order->id }}." 
                   target="_blank" 
                   class="whatsapp-link"
                >
                    Envoyer sur WhatsApp
                </a>
            </p>
        </div>

        <div class="contact-info">
            <p>GlobalDrop – Tél : +228 90000000 – Email : globaldrop2428@gmail.com</p>
            <p>© {{ date('Y') }} Global Drop - La qualité au bout du clic, la sécurité en plus.</p>
        </div>
    </div>
</body>
</html>
