<?php

namespace App\Http\Controllers;

use App\Models\Commandes;
use App\Models\Ligne_Commandes;
use App\Models\Produits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;

class CommandesController extends Controller
{
    public function index(){
       $commandes = Commandes::all();
       return view('admin.commandes-index', compact('commandes'));
    }
    public function mesCommandes()
    {
        $userId = Auth::id();

        $commandes = Commandes::where('user_id', $userId)->latest()->paginate(10);
        $commandeCount = $commandes->count();
        $totalSpent = Commandes::where('user_id', $userId)->sum('total');

        return view('commandes.mes-commandes', compact('commandes', 'commandeCount', 'totalSpent'));
    }
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'statut' => 'required|string|in:en cours,expédiée,livrée,annulée',
    ]);

    $commande = Commandes::findOrFail($id);

    if (auth()->user()->role !== 'admin') {
        abort(403, "Accès refusé");
    }

    $commande->statut = $request->statut;
    $commande->save();

    return redirect()->back()->with('success', "Le statut de la commande {$commande->order_number} a été mis à jour.");
}

    public function create(Request $request)
    {
        if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vous devez vous connecter pour finaliser votre commande.');
    }

    $panier = session()->get('panier', []);
    return view('commandes.create', compact('panier'));
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
        'panier' => 'required|array',
    ]);

    $panier = session()->get('panier', []);

    if (empty($panier)) {
        return redirect()->back()->with('error', 'Votre panier est vide.');
    }

    $total = 0;

    foreach ($panier as $productId => $item) {
        if (!isset($item['prix']) || !isset($item['quantite'])) {
            return redirect()->back()->with('error', 'Produit invalide dans le panier.');
        }

        $total += $item['prix'] * $item['quantite'];

        // Mettre à jour les infos du panier avec color et size envoyés par le formulaire
        $item['couleur'] = $request->input("panier.$productId.couleur");
        $item['taille'] = $request->input("panier.$productId.taille");

        $panier[$productId] = $item;
    }

    $now = Carbon::now();
$year = $now->format('Y');      
$month = $now->format('m');
$day = $now->format('d');

// Compter combien de commandes ont été passées ce jour-là
$countToday = Commandes::whereDate('created_at', $now->toDateString())->count();

$increment = str_pad($countToday + 1, 2, '0', STR_PAD_LEFT); 
$orderNumber = 'GD' . $year . $month . $day . $increment;

$commande = Commandes::create([
    'user_id' => Auth::id(),
    'customer_name' => $request->customer_name,
    'whatsapp_number' => $request->whatsapp_number,
    'city' => $request->city,
    'total' => $total,
    'statut' => 'pending',
    'order_number' => $orderNumber,
]);

    foreach ($panier as $productId => $item) {
        Ligne_Commandes::create([
            'commandes_id' => $commande->id,
            'produits_id' => $productId,
            'quantite' => $item['quantite'],
            'unit_price' => $item['prix'],
            'couleur' => $item['couleur'] ?? null,
            'taille' => $item['taille'] ?? null,
        ]);
    }

    session()->forget('panier');

    return redirect()->route('commandes.confirmation', ['id' => $commande->id]);
}

    public function feedback(Request $request, $id)
    {
        $commande = Commandes::findOrFail($id);

        $request->validate([
            'commentaire' => 'nullable|string|max:1000',
        ]);

        $commande->commentaire = $request->commentaire;
        $commande->save();

        return back()->with('success', 'Merci pour votre avis !');
    }

    public function terminee(Request $request, $id)
    {
        $commande = Commandes::findOrFail($id);

        $request->validate([
            'payment_method' => 'required|in:cod,yas,flooz',
        ]);

        $commande->payment_method = $request->payment_method;
        $commande->statut = 'confirmed';
        $commande->save();

        return view('commandes.terminee', compact('commande'));
    }

    public function downloadReceipt($id)
{
    $commande = Commandes::with('lignes.produit')->findOrFail($id);

    $pdf = Pdf::loadView('commandes.receipt', compact('commande'))->setPaper('A4', 'portrait');

    return $pdf->stream('recu_commande_' . $commande->id . '.pdf');

}

    public function confirmation($id)
    {
        $commande = Commandes::findOrFail($id);
        return view('commandes.confirmation', compact('commande'));
    }
}
