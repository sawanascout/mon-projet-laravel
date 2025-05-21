<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Afficher tous les produits
    public function index(Request $request)
{
    $query = Product::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    $products = $query->latest()->paginate(12); // pagination si tu veux

    // Avec moyenne des notes (rating)
    $products = $query->withAvg('reviews', 'rating')->paginate(12);

    // Renommer l'attribut pour le Blade
    // 'reviews_avg_rating' est généré par withAvg()
    $products->getCollection()->transform(function ($product) {
        $product->rating = $product->reviews_avg_rating ?? 0;
        return $product;
    });

    return view('produits.index', compact('products'));
}


    // Afficher les produits par catégorie
    public function byCategory($category)
    {
        $products = Product::where('category', $category)->where('available', true)->get();
        return view('produits.category', compact('products', 'category'));
    }

    // Afficher un produit spécifique
    public function show($id)
{
    $product = Product::with('reviews')->findOrFail($id);
    $averageRating = $product->averageRating();

    return view('produits.show', compact('product', 'averageRating'));
}

}
