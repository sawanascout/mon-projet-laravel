<?php
namespace App\Http\Controllers;

use App\Models\Produits;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProduitsController extends Controller
{
   public function index()
{
    $produits = Produits::with('categorie')->latest()->get(); 
    $categories = Categories::all(); 
    return view('produits.index', compact('produits', 'categories'));
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
        $request->validate([
              'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'description' => 'required|string',
            'ancien_prix' => 'required|string',
            'categories_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|max:2048',
            'disponible' => 'required|string',
            'taille' => 'nullable|array',
            'couleur' => 'nullable|array',

        ]);
        $disponible = $request->disponible ?? 'oui';

        $path = $request->file('photo') ? $request->file('photo')->store('photos', 'public') : null;

        Produits::create([
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

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
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
public function show(Produits $produit)
{
    // Charge les avis avec leurs utilisateurs
    $produit->load('avis.user');

    return view('produits.show', compact('produit'));
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
}
