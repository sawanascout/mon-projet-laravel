<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commandes;
use App\Models\Paniers;
use App\Models\Elements_Paniers;
use App\Models\Ligne_Commandes;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CommandesController extends Controller
{
    /**
     * Affiche la liste des commandes du client connecté.
     */
    public function index()
    {
        $commandes = Commandes::where('user_id', Auth::id())->with('lignes.produit')->latest()->get();

        return view('client.commandes-index', compact('commandes'));
    }
public function Afficher_Tout()
    {
         if (!Auth::user()->is_admin) {
        abort(403);
    }
        $commandes = Commandes::all();

        return view('admin.commandes-index', compact('commandes'));
    }
    /**
     * Affiche les détails d'une commande spécifique.
     */
    public function show($id)
    {
        $commande = Commandes::with('lignes.produit')->findOrFail($id);

        if ($commande->user_id !== Auth::id()) {
            abort(403);
        }

        return view('client.commandes-show', compact('commande'));
    }

    /**
     * Crée une commande à partir du panier de l'utilisateur.
     */
    public function store(Request $request)
    {
         $request->validate([
        'ville' => 'required|string|max:255',
        'commentaire' => 'nullable|string|max:1000',
        'methode'=> 'required|string|max:1000',
        ]);
        $user = Auth::user();
        $panier = $user->panier;

        if (!$panier || $panier->elements->isEmpty()) {
            return redirect()->back()->with('error', 'Votre panier est vide.');
        }

        $total = $panier->elements->sum(function ($e) {
            return $e->quantite * $e->prix;
        });
        $orderNumber = 'CMD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));

        DB::transaction(function () use ($user, $panier, $total, $request, $orderNumber) {
        $commande = Commandes::create([
            'order_number' => $orderNumber,
            'user_id' => $user->id,
            'statut' => 'en attente',
            'city' => $request->ville,
            'commentaire' => $request->commentaire,
            'total' => $total,
            'methode_paiement' => $request->methode,
        ]);

        foreach ($panier->elements as $element) {
            Ligne_Commandes::create([
                'commandes_id' => $commande->id,
                'produits_id' => $element->produits_id,
                'couleur'=>$element->couleur,
                'taille'=>$element->taille,
                'quantite' => $element->quantite,
                'prix' => $element->prix,
            ]);
        }
        Paiement::create([
        'commandes_id' => $commande->id,
        'montant' => $commande->total,
        'methode' => $request->methode,
        'statut' => 'en attente', // ou 'payé' si déjà validé
]);


        // Vider le panier
        $panier->elements()->delete();
          });
        return redirect()->route('client.profil')->with('success', 'Commande passée avec succès.');
    }
    public function commandesParDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $start = Carbon::parse($request->start_date)->startOfDay();
        $end = Carbon::parse($request->end_date)->endOfDay();

        $commandes = Commandes::whereBetween('created_at', [$start, $end])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Préparer les données pour le graphique
        $dates = $commandes->pluck('date');
        $totals = $commandes->pluck('total');

        return view('admin.commandes-graphique', [
            'dates' => $dates,
            'totals' => $totals,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    }
    public function suivreParNumero($orderNumber)
    {
        $commande = Commandes::where('order_number', $orderNumber)
            ->with('lignes.produit')
            ->firstOrFail();

        return view('client.commandes-suivi', compact('commande'));
    }
        public function mesCommandes()
{
    $userId = Auth::id();

    $orders = Commandes::where('user_id', $userId)->latest()->paginate(10);


    return view('client.profil', compact('orders'));
}

}
