<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
class OrderController extends Controller
{
    // Afficher le formulaire de création de commande
    public function create()
{
    $cart = session('cart', []); // panier dans la session

    $cartItems = [];
    foreach ($cart as $productId => $quantity) {
        $product = Product::find($productId);
        if ($product && $quantity > 0) {
            $cartItems[] = ['product' => $product, 'quantity' => $quantity];
        }
    }

    return view('commandes.create', compact('cartItems'));
}



    // Enregistrer la commande
    public function store(Request $request)
    {       
        $request->validate([
            'fullname' => 'required|string|max:255',
            'country_code' => 'required|string|max:5',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'address' => 'required|string',
            'products' => 'required|array',
            'products.*' => 'integer|min:1',
        ]);

        $fullPhone = $request->country_code . $request->phone;

        $order = Order::create([
            'customer_name' => $request->fullname,
            'whatsapp_number' => $fullPhone,
            'city' => $request->city,
            'address' => $request->address,
            'status' => 'pending',
            'total' => 0,
        ]);

        $total = 0;

        foreach ($request->products as $productId => $quantity) {
            $product = Product::findOrFail($productId);
            $subtotal = $product->price * $quantity;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $product->price,
            ]);

            $total += $subtotal;
        }

        $order->update(['total' => $total]);

        // Redirection vers la page confirmation
    return redirect()->route('commandes.confirmation', $order->id);
    }

    // Afficher la page de confirmation avec détails et instructions paiement
    public function confirmation($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('commandes.confirmation', compact('order'));
    }

    // Télécharger le reçu PDF
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
}
