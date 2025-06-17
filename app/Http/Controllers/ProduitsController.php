<?php
namespace App\Http\Controllers;

use App\Models\Produits;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProduitsController extends Controller
{
   public function index(Request $request)
{
    $query = Produits::query();

    if ($request->filled('category')) {
    $category = Category::where('category_name', $request->category)->first();

    if ($category) {
        $query->where('category_id', $category->id);
    }
}
elseif ($request->filled('search')) {
    $query->where('name', 'like', '%' . $request->search . '%');
}
// 🔥 Ce bloc ne s'exécute que si aucun filtre ET pas de "all" explicitement demandé
elseif (Auth::check() && Auth::user()->segment && !$request->boolean('all')) {
    $segment = strtolower(trim(Auth::user()->segment));
    $query->whereHas('category', function ($q) use ($segment) {
        $q->whereRaw('LOWER(category_name) LIKE ?', ['%' . $segment . '%']);
    });
}


    // Toujours filtrer sur les produits disponibles
    $query->where('disponible', true);

    // Charger la moyenne des notes et trier par date descendante
    $produits = $query->withAvg('avis', 'note')
                  ->latest()
                  ->paginate(12)
                  ->appends($request->all());

/** @var \Illuminate\Pagination\LengthAwarePaginator $produits */

    // Ajouter la propriété rating pour chaque produit (0 si null)
    $produits->getCollection()->transform(function ($produit) {
    $produit->rating = $produit->avis_avg_note ?? 0;
    return $produit;
});


    return view('produits.index', compact('produits'));

}
   public function indexadmin()
{
    $produits = Produits::with('categorie')->latest()->get(); 
    $categories = Categories::all(); 
    return view('admin.produits-index', compact('produits', 'categories'));
}

    public function create()
    {
        $categories = Categories::all();
        return view('admin.produits-create', compact('categories'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prix' => 'required|numeric',
        'description' => 'nullable|string',
        'ancien_prix' => 'nullable|string',
        'categories_id' => 'required|exists:categories,id',
        'photo' => 'nullable|image|max:2048',
        'disponible' => 'required|string',
        'taille' => 'required|array',
        'couleur' => 'required|array',
    ]);

    // Gérer l'upload de la photo
    $path = $request->file('photo') ? $request->file('photo')->store('photos', 'public') : null;
 $disponible = $request->has('disponible') ? 1 : 0;
    // Créer le produit
    Produits::create([
        'nom' => $validated['nom'],
        'prix' => $validated['prix'],
        'description' => $validated['description'] ?? null,
        'ancien_prix' => $validated['ancien_prix'] ?? null,
        'categories_id' => $validated['categories_id'],
        'photo' => $path,
        'disponible' => $disponible,
        'taille' => $validated['taille'],
        'couleur' => $validated['couleur'],
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Produit ajouté avec succès.');
}


   public function edit(Produits $produit)
{
    if (auth()->user()->role !== 'admin') {
        abort(403, "Accès interdit");
    }

    $categories = Categories::all();
    return view('admin.produits-edit', compact('produit', 'categories'));
}


    public function update(Request $request, Produits $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'description' => 'nullabe|string',
            'ancien_prix' => 'nullable|string',
            'categories_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|max:2048',
            'disponible' => 'required|string',
            'taille' => 'required|array',
            'couleur' => 'required|array',
        ]);

        if ($request->hasFile('photo')) {
            if ($produit->photo) {
                Storage::disk('public')->delete($produit->photo);
            }
            $produit->photo = $request->file('photo')->store('photos', 'public');
        }

        $produit->update([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'description' => $request->description,
            'ancien_prix' => $request->ancien_prix,
            'categories_id' => $request->categories_id,
            'photo' => $produit->photo,
            'disponible' =>$request->disponible,
            'taille' => $request->taille,
        'couleur' =>$request->couleur,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
    }
public function show($id)
{
    $produit = Produits::with('avis')->findOrFail($id);

    $averageRating = $produit->avis->avg('note') ?? 0; // note est le champ dans la table `avis`

    return view('Produits.show', compact('produit', 'averageRating'));
}


public function find(Request $request)
{
    $nom = $request->input('nom');

    $produits = Produits::with('categorie')
        ->where('nom', 'like', '%' . $nom . '%')
        ->get();

    $categories = Categories::all();

    return view('produits.index', compact('produits', 'categories'));
}
public function rechercher(Request $request)
{
    $nom = $request->input('nom');

    $produits = DB::table("produits")
        ->where('nom', 'like', '%' . $nom  . '%')
        ->get();

    // Facultatif : récupérer aussi les catégories si ta vue les utilise
    $categories = Categories::with('produits')->get();

    return view('produits.index', compact('produits', 'categories'));
}
    public function destroy(Produits $produit)
    {
        if ($produit->photo) {
            Storage::disk('public')->delete($produit->photo);
        }

        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
    public function promotions()
{
    $produits = Produits::whereNotNull('ancien_prix')
        ->whereColumn('ancien_prix', '>', 'prix')
        ->paginate(12);

    return view('promotions', compact('produits'));
}

}
