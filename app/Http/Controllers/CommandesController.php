<?php

namespace App\Http\Controllers;

use App\Models\Commandes;
use App\Models\Ligne_Commandes;
use App\Models\Produits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
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

    $commande = Commande::findOrFail($id);

    if (auth()->user()->role !== 'admin') {
        abort(403, "Accès refusé");
    }

    $commande->statut = $request->statut;
    $commande->save();

    return redirect()->back()->with('success', "Le statut de la commande {$commande->order_number} a été mis à jour.");
}

    public function create()
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
            'commentaire'=> 'nullable|string|max:100',
        ]);

        $panier = session()->get('panier', []);

        if (empty($panier)) {
            return redirect()->back()->with('error', 'Votre panier est vide.');
        }

        $total = 0;

        foreach ($panier as $produitId => $item) {
            if (!isset($item['prix'], $item['quantite'])) {
                return redirect()->back()->with('error', 'Produit invalide dans le panier.');
            }

            $total += $item['prix'] * $item['quantite'];
            $item['couleur'] = $request->input("cart.$produitId.couleur");
            $item['taille'] = $request->input("cart.$produitId.taille");
            $cart[$produitId] = $item;
        }

        $now = Carbon::now();
        $orderNumber = 'GD' . $now->format('Ymd') . str_pad(Commandes::whereDate('created_at', $now->toDateString())->count() + 1, 2, '0', STR_PAD_LEFT);

        $commande = Commandes::create([
            'user_id' => Auth::id(),
            'order_number' => $orderNumber,
            'statut' => 'En attente',
            'city' => $request->city,
            'commentaire'=> $request->commentaire,
            'total' => $total,
            'statut' => 'pending',
        ]);

        foreach ($panier as $produitId => $item) {
            Ligne_Commandes::create([
                'commandes_id' => $commande->id,
                'produits_id' => $produitId,
                'quantite' => $item['quantite'],
                'prix' => $item['prix'],
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

        $commande->methode_paiement = $request->payment_method;
        $commande->statut = 'confirmed';
        $commande->save();

        return view('commandes.terminee', compact('commande'));
    }

    public function downloadReceipt($id)
    {
        $commande = Commandes::with('lignes.produit')->findOrFail($id);

        $html = View::make('commandes.receipt', compact('commande'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="recu_commande_' . $commande->id . '.pdf"');
    }

    public function confirmation($id)
    {
        $commande = Commandes::findOrFail($id);
        return view('commandes.confirmation', compact('commande'));
    }
}
