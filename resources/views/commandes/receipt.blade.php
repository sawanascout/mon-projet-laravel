<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reçu de commande</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .section { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reçu de Commande</h2>
    </div>

    <div class="section">
        <p><strong>Nom :</strong> {{ $order->customer_name }}</p>
        <p><strong>WhatsApp :</strong> {{ $order->whatsapp_number }}</p>
        <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="section">
        <h4>Produits :</h4>
        <ul>
            @foreach($order->items as $item)
                <li>{{ $item->quantity }} x {{ $item->product->name }} — {{ $item->unit_price * $item->quantity }} FCFA</li>
            @endforeach
        </ul>
        <p><strong>Total :</strong> {{ $order->total }} FCFA</p>
    </div>

    <p style="margin-top: 30px;">Merci pour votre commande !</p>
</body>
</html>
