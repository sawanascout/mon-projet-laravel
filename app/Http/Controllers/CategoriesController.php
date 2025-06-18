<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Afficher la liste des catégories.
     */
    public function index()
    {
        $categories = Categories::with('produits')->get();
        return view('admin.categories-index', compact('categories'));
    }

    /**
     * Afficher le formulaire de création d'une catégorie.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Enregistrer une nouvelle catégorie.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        Categories::create($request->all());

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Afficher une catégorie spécifique.
     */
    public function show(Categories $category)
    {
        $category->load('produits');
        return view('admin.categories-show', compact('category'));
    }

    /**
     * Afficher le formulaire d'édition d'une catégorie.
     */
    public function edit(Categories $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Mettre à jour une catégorie.
     */
public function update(Request $request, Categories $category)
{
    $validated = $request->validate([
        'category_name' => 'required|string|max:255',
    ]);

    $category->update($validated);

    return redirect()->route('admin.categories.index')
                     ->with('success', 'Catégorie mise à jour avec succès.');
}


    /**
     * Supprimer une catégorie.
     */
    public function destroy(Categories $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Catégorie supprimée avec succès.');
    }
}
