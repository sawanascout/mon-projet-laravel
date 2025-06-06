<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;

class OrderController extends Controller
{
    public function mesCommandes()
{
    $userId = Auth::id();

    $orders = Order::where('user_id', $userId)->latest()->paginate(10);


    return view('commandes.mes-commandes', compact('orders'));
}




    public function create(Request $request)
    {
        if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vous devez vous connecter pour finaliser votre commande.');
    }

    $cart = session()->get('cart', []);
    return view('commandes.create', compact('cart'));
    }

    public function store(Request $request)
{
    if (!Auth::check()) {
    return redirect()->route('login')->with('error', 'Vous devez vous connecter pour finaliser votre commande.');
}
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'whatsapp_number' => 'nullable|string|max:20',
        'city' => 'required|string|max:100',
        'cart' => 'required|array',
    ]);

    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->back()->with('error', 'Votre panier est vide.');
    }

    $total = 0;

    foreach ($cart as $productId => $item) {
        if (!isset($item['price']) || !isset($item['quantity'])) {
            return redirect()->back()->with('error', 'Produit invalide dans le panier.');
        }

        $total += $item['price'] * $item['quantity'];

        // Mettre à jour les infos du panier avec color et size envoyés par le formulaire
        $item['color'] = $request->input("cart.$productId.color");
        $item['size'] = $request->input("cart.$productId.size");

        $cart[$productId] = $item;
    }

    $now = Carbon::now();
$year = $now->format('Y');      // Exemple: 2025
$month = $now->format('m');     // Exemple: 06

// Compter combien de commandes ont été passées ce mois
$countThisMonth = Order::whereYear('created_at', $year)
                       ->whereMonth('created_at', $month)
                       ->count();

$increment = str_pad($countThisMonth + 1, 2, '0', STR_PAD_LEFT); // Ex: 01, 02...
$orderNumber = 'GD' . $year . $month . $increment;

$order = Order::create([
    'user_id' => Auth::id(),
    'customer_name' => $request->customer_name,
    'whatsapp_number' => $request->whatsapp_number,
    'city' => $request->city,
    'total' => $total,
    'status' => 'pending',
    'order_number' => $orderNumber,
]);

    foreach ($cart as $productId => $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productId,
            'quantity' => $item['quantity'],
            'unit_price' => $item['price'],
            'color' => $item['color'] ?? null,
            'size' => $item['size'] ?? null,
        ]);
    }

    session()->forget('cart');

    return redirect()->route('commandes.confirmation', ['id' => $order->id]);
}


public function finaliser(Request $request, $id)
{
    $order = Order::findOrFail($id);

    // Valider le moyen de paiement
    $request->validate([
        'payment_method' => 'required|in:cod,yas',
    ]);

    // Mettre à jour la commande
    $order->payment_method = $request->payment_method;
    $order->status = 'confirmed';
    $order->save();

    // Rediriger vers la page de confirmation
    return redirect()->route('commandes.terminee', ['id' => $order->id])
    ->with('success', 'Votre commande a été finalisée avec succès.');

}

public function feedback(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $request->validate([
        'commentaire' => 'nullable|string|max:1000',
    ]);

    $order->commentaire = $request->commentaire;
    $order->save();

    return back()->with('success', 'Merci pour votre avis !');
}


public function terminee($id)
{
    $order = Order::findOrFail($id);
    return view('commandes.terminee', compact('order'));
}




    public function downloadReceipt($id)
{
    $order = Order::with('items.product')->findOrFail($id);

    // Générer le HTML avec Blade
    $html = View::make('commandes.receipt', compact('order'))->render();

    // Initialiser Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // (Optionnel) configurer la taille et orientation
    $dompdf->setPaper('A4', 'portrait');

    // Rendre le PDF
    $dompdf->render();

    // Envoyer le PDF en téléchargement
    return response($dompdf->output(), 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="recu_commande_'.$order->id.'.pdf"');
    }

public function confirmation($id)
{
    $order = Order::findOrFail($id);
    return view('commandes.confirmation', compact('order'));
}

}
