<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{

public function index(Request $request)
{
    $query = Product::query();

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
    $query->where('available', true);

    // Charger la moyenne des notes et trier par date descendante
    $products = $query->withAvg('reviews', 'rating')
                      ->latest()
                      ->paginate(12)
                      ->appends($request->all());

    // Ajouter la propriété rating pour chaque produit (0 si null)
    $products->getCollection()->transform(function ($product) {
        $product->rating = $product->reviews_avg_rating ?? 0;
        return $product;
    });

    return view('produits.index', compact('products'));
}



    

    // Affiche les produits par catégorie spécifique
    public function byCategory($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();

    $products = Product::where('category_id', $category->id)
        ->where('available', true)
        ->withAvg('reviews', 'rating')
        ->get()
        ->transform(function ($product) {
            $product->rating = $product->reviews_avg_rating ?? 0;
            return $product;
        });

    return view('produits.category', [
        'products' => $products,
        'category' => $category->name,
    ]);
}


    // Détail d'un produit
    public function show($id)
    {
        $product = Product::with('reviews')->findOrFail($id);
        $averageRating = $product->averageRating();

        return view('produits.show', compact('product', 'averageRating'));
    }
    public function promotions()
{
    $products = Product::whereNotNull('old_price')
        ->whereColumn('old_price', '>', 'price')
        ->paginate(12);

    return view('promotions', compact('products'));
}


}
