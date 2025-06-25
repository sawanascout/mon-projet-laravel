<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    AuthController,
    ClientController,
    AdminController,
    LigneCommandesController,
    ProfilController,
    CategoriesController,
    ElementsPaniersController,
    HistoriqueCommandesController,
    PaiementController,
    AdminParrainageController
    
};

use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\PaniersController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\ParrainageController;

// ================= ADMIN ===================
Route::prefix('admin')->middleware(['auth', 'is_admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Paiements
    Route::resource('paiements', PaiementController::class)->except(['create'])->names('paiements');

    // Utilisateurs & admins
    Route::post('/ajout-admin', [AdminController::class, 'store'])->name('ajout');
    Route::post('/grant', [AdminController::class, 'addPrivileges'])->name('grant');
    Route::delete('/admins/{id}', [AdminController::class, 'destroyAdmin'])->name('admins.destroy');
    Route::post('/admins', [AdminController::class, 'storeAdmin'])->name('admins.storeAdmin');
Route::get('/admin/parrainage/clics', [AdminParrainageController::class, 'index'])->name('parrainages.index');

    // Commandes
    Route::resource('commandes', CommandesController::class)->only(['index','update']);
    Route::post('/commandes/dates', [AdminController::class, 'commandesParDate'])->name('commandes.dates');
    Route::get('/commandes/json', [AdminController::class, 'getCommandesBetweenDates'])->name('commandes.json');
    Route::post('/commandes/statistiques', [CommandesController::class, 'commandesParDate'])->name('commandes-graphique');
    Route::post('/commandes/segments', [AdminController::class, 'commandesParSegment'])->name('commandes.segments');
    Route::put('/admin/commandes/{id}/statut', [CommandesController::class, 'updateStatus'])
    ->name('commandes.updateStatus');
    // Statistiques utilisateurs
    Route::post('/utilisateurs/segment', [AdminController::class, 'utilisateursParSegmentEtDate'])->name('utilisateurs.segment');
    Route::get('/clients-par-segment', [AdminController::class, 'clientsAyantCommandeParSegment'])->name('clients.segment');
    Route::get('/utilisateurs-commandes', [AdminController::class, 'utilisateursAvecCommandes'])->name('utilisateurs.commandes');
    Route::get('/clients-segment-role', [AdminController::class, 'clientsParSegmentEtRole'])->name('clients.segment.role');

    // Produits, catégories, avis, historique
    Route::get('produits-admin', [ProduitsController::class, 'indexadmin'])->name('produits');
    Route::resource('produits', ProduitsController::class)->names('produits');
    Route::resource('categories', CategoriesController::class)->names('categories');
    Route::resource('historiqueCommandes', HistoriqueCommandesController::class)->names('historique');
    Route::resource('produits.avis', AvisController::class)->only(['index'])->names('avis');

    // Graphique avis
    Route::get('/avis-graphique/{produitId}', [AdminController::class, 'avisGraphique'])->name('avis.graphique');
});
Route::middleware('auth')->group(function () {
    Route::post('/produits/{produit}/avis', [AvisController::class, 'store'])->name('avis.store');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');

//////////////client///////////////




Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');


// Page d’accueil (produits)
Route::get('/', [ProduitsController::class, 'index'])->name('produits.index');

// --------- PRODUITS ---------
Route::prefix('produits')->group(function () {
    Route::get('/{id}', [ProduitsController::class, 'show'])->name('produits.show');
});
Route::get('/promotions', [ProduitsController::class, 'promotions'])->name('promotions');
Route::get('/categorie/{slug}', [ProduitsController::class, 'byCategory'])->name('category.products');


Route::get('/categorie/{category}', [ProduitsController::class, 'byCategory'])->name('produits.category');

// --------- COMMANDES ---------


Route::view('/commande/succes', 'client.orders.success')->name('commandes.success');

// --------- PRODUITS PERSONNALISÉS ---------


// --------- PANIER ---------
Route::prefix('cart')->group(function () {
    Route::get('/', [PaniersController::class, 'index'])->name('cart.index');
});
Route::post('/cart/add/{id}', [PaniersController::class, 'add'])->name('cart.add');
    Route::post('/update/{id}', [PaniersController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{id}', [PaniersController::class, 'remove'])->name('cart.remove');
    Route::get('/clear', [PaniersController::class, 'clear'])->name('cart.clear');


// --------- AVIS PRODUITS ---------
Route::post('/produits/{produit}/avis', [AvisController::class, 'store'])->name('avis.store');
// web.php



Route::get('/mon-parrainage', [ParrainageController::class, 'index'])->name('Parrainage.index');
Route::get('/invite', [ParrainageController::class, 'invite'])->name('invite');
Route::get('/nous-suivre', function () {
    return view('page'); // page.blade.php
})->name('page');


// --------- ROUTES PROTÉGÉES (si besoin) ---------
Route::middleware(['auth'])->group(function () {
Route::get('/create/{product?}', [CommandesController::class, 'create'])->name('commandes.create');
    Route::post('/', [CommandesController::class, 'store'])->name('commandes.store');
    Route::get('/confirmation/{id}', [CommandesController::class, 'confirmation'])->name('commandes.confirmation');
    Route::get('/{id}/recu', [CommandesController::class, 'downloadReceipt'])->name('commandes.receipt');
    Route::post('/{id}/finaliser', [CommandesController::class, 'finaliser'])->name('commandes.finaliser');
    Route::get('/terminee/{id}', [CommandesController::class, 'terminee'])->name('commandes.terminee');
    Route::post('/commandes/feedback/{id}', [CommandesController::class, 'feedback'])->name('commandes.feedback');

Route::get('/mes-commandes', [CommandesController::class, 'mesCommandes'])->name('commandes.mes-commandes');
Route::get('/mon-parrainage', [ParrainageController::class, 'index'])->name('Parrainage.index');

});


Route::get('/dashboard', function () {
    return redirect()->route('produits.index');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
