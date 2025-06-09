<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Commandes;
use App\Models\Produits;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Paniers;
use Exception;

class AdminController extends Controller
{
    /**
     * Affiche le tableau de bord de l'administrateur.
     */
    protected $databaseName = 'global_drop';

        public function dashboard()
        {
                if (Auth::user()->role !== 'admin') {
                        abort(403, 'Accès refusé.');
                    }
                $totalProduits = Produits::count();
                $produits = Produits::all();
                $commandes = Commandes::all();
                $categories = Categories::all();
                $totalUtilisateurs = User::count();
                $totalCommandes =Commandes::count();


                return view('admin.dashboard',
                    compact('totalProduits', 
                            'totalUtilisateurs', 
                            'totalCommandes',
                            'produits',
                            'commandes', 
                            'categories'
                    ));
        }
        // Affiche le formulaire de création d'un nouvel admin
        public function createAdmin()
        {
            return view('admin.admins.create');
        }
     public function destroyAdmin($id)
{
    $admin = User::where('role', 'admin')->findOrFail($id);
    $admin->delete();

    return redirect()->route('admin.admins.index')->with('success', 'Admin supprimé avec succès.');
}


        // Traite la création du nouvel admin
        public function storeAdmin(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'segment' => 'required|string',
                'password' => 'required|string|min:8|confirmed',
                'telephone' => 'required|number|unique:users,telephone',
            ]);
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'segment'=> $request->segment,
                'password' => bcrypt($request->password),
                'telephone'=> $request->telephone,
                'role' => 'admin',  // forcer le rôle admin
                // Ajoute d'autres champs si besoin
            ]);
          

            return redirect()->route('admin.admins.create')->with('success', 'Admin créé avec succès.');
        }

        public function commandesParSegment(Request $request)
        {
            $request->validate([
                'start_date' => 'required|date',
                'end_date'   => 'required|date|after_or_equal:start_date',
                'segment'    => 'required|string',
            ]);

            $commandesParJour = DB::table('commandes')
                ->join('users', 'commandes.user_id', '=', 'users.id')
                ->select(DB::raw('DATE(commandes.created_at) as date'), DB::raw('COUNT(commandes.id) as total'))
                ->whereBetween('commandes.created_at', [$request->start_date, $request->end_date])
                ->where('users.segment', $request->segment)
                ->groupBy(DB::raw('DATE(commandes.created_at)'))
                ->orderBy('date')
                ->get();

            $labels = $commandesParJour->pluck('date')->toArray();
            $data = $commandesParJour->pluck('total')->toArray();

            return view('admin.commandes-par-segment', [
                'start_date' => $request->start_date,
                'end_date'   => $request->end_date,
                'segment'    => $request->segment,
                'labels'     => $labels,
                'data'       => $data,
            ]);
        }


        public function commandesParDate(Request $request)
        {
                $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            // Récupérer les commandes groupées par jour
            $commandesParJour = DB::table('commandes')
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
                ->whereBetween('created_at', [$request->start_date, $request->end_date])
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy('date')
                ->get();
              $commandes = Commandes::whereBetween('created_at', [
                $request->start_date,
                $request->end_date
            ])->get();

            // Convertir pour le graphique
            $labels = $commandesParJour->pluck('date')->toArray();
            $data = $commandesParJour->pluck('total')->toArray();

            return view('admin.commandes-par-date', [
                'commandes'=>$commandes,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'labels' => $labels,
                'data' => $data,
    ]);
        }
        public function utilisateursParSegmentEtDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $start = Carbon::parse($request->start_date)->startOfDay();
        $end = Carbon::parse($request->end_date)->endOfDay();

        $utilisateurs = User::where('role', 'client')
            ->whereBetween('created_at', [$start, $end])
            ->selectRaw('segment, COUNT(*) as total')
            ->groupBy('segment')
            ->orderBy('segment')
            ->get();

        // Exemple : passer les données à une vue
        return view('admin.utilisateurs-par-segment', [
            'utilisateurs' => $utilisateurs,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    }
        public function clientsAyantCommandeParSegment()
        {
            $clients = User::where('role', 'client')
                ->whereHas('commandes') // clients avec au moins 1 commande
                ->select('segment', DB::raw('COUNT(DISTINCT users.id) as total'))
                ->groupBy('segment')
                ->orderBy('segment')
                ->get();

            return view('admin.clients-par-segment', [
                'clients' => $clients,
            ]);
            }
           public function avisGraphique($produitId)
        {
            // Récupérer le produit (optionnel, pour infos dans la vue)
            $produit = Produits::findOrFail($produitId);

            // Récupérer la répartition des notes (1 à 5) pour ce produit
            $avisParNote = DB::table('avis')
                ->select('note', DB::raw('count(*) as total'))
                ->where('produits_id', $produitId)
                ->groupBy('note')
                ->orderBy('note')
                ->pluck('total', 'note');

            // Initialiser toutes les notes à 0 si aucune donnée pour une note
            $notes = [1, 2, 3, 4, 5];
            $avisCounts = [];
            foreach ($notes as $note) {
                $avisCounts[] = $avisParNote->get($note, 0);
            }
            $totalAvis = array_sum($avisCounts);
                $sommeNotes = 0;
                foreach ($notes as $index => $note) {
                    $sommeNotes += $note * $avisCounts[$index];
                }

                $moyenne = $totalAvis > 0 ? $sommeNotes / $totalAvis : 0;

                // Calcul du taux de satisfaction en %
                $tauxSatisfaction = round(($moyenne / 5) * 100, 2);

            return view('admin.avis-graphique', [
                'produit' => $produit,
                'notes' => $notes,
                'avisCounts' => $avisCounts,
                'tauxSatisfaction' => $tauxSatisfaction,
                'moyenne' => round($moyenne, 2),
            ]);
        }
        public function utilisateursAvecCommandes()
            {
                // récupère les utilisateurs qui ont au moins 1 commande
                 $utilisateurs = User::has('commandes')
                    ->orderBy('segment')
                    ->with('commandes')
                    ->get()
                    ->groupBy('segment'); // on groupe par segment ici

                 $nombreParSegment = $utilisateurs->mapWithKeys(function ($users, $segment) {
        return [$segment => $users->count()];
    });

                // tu peux ensuite les retourner à une vue
                return view('admin.utilisateurs-commandes', compact('utilisateurs', 'nombreParSegment'));
            }
            public function clientsParSegmentEtRole()
        {
            // Récupérer tous les utilisateurs, triés par segment et rôle
            $clients = User::orderBy('segment')->orderBy('role')->get();

            // Grouper d'abord par segment, puis par rôle
            $clientsGroupes = $clients->groupBy(['segment', 'role']);

            return view('admin.utilisateurs', compact('clientsGroupes'));
        }




}

