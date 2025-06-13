<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    AuthController,
    ClientController,
    AdminController,
    ProduitsController,
    PaniersController,
    CommandesController,
    LigneCommandesController,
    AvisController,
    CategoriesController,
    ElementsPaniersController,
    HistoriqueCommandesController,
    ParrainageController
};

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
     Route::get('paiements', [PaiementController::class, 'index'])->name('admin.paiements.index');
    Route::get('paiements/{id}', [PaiementController::class, 'show'])->name('admin.paiements.show');
    Route::get('paiements/{id}/edit', [PaiementController::class, 'edit'])->name('admin.paiements.edit');
    Route::put('paiements/{id}', [PaiementController::class, 'update'])->name('admin.paiements.update');
    Route::delete('paiements/{id}', [PaiementController::class, 'destroy'])->name('admin.paiements.destroy');
    // Admins
    Route::post('/ajout-admin', [AdminController::class, 'store'])->name('admin.ajout-admin');
    Route::post('/grant', [AdminController::class, 'addPrivileges'])->name('admin.grant');

    // Statistiques commandes
    Route::post('/commandes/dates', [AdminController::class, 'commandesParDate'])->name('admin.commandes.dates');
    Route::get('/commandes/json', [AdminController::class, 'getCommandesBetweenDates'])->name('admin.commandes.json');
    Route::post('/commandes/statistiques', [CommandesController::class, 'commandesParDate'])->name('admin.commandes-graphique');

    // Clients & utilisateurs
    Route::post('/utilisateurs/segment', [AdminController::class, 'utilisateursParSegmentEtDate'])->name('admin.utilisateurs.segment');
    Route::get('/clients-par-segment', [AdminController::class, 'clientsAyantCommandeParSegment'])->name('admin.clients.segment');

    // Avis graphiques
    Route::get('/avis-graphique/{produitId}', [AdminController::class, 'avisGraphique'])->name('admin.avis.graphique');
    // Ressources
    Route::get('produits-admin', [ProduitsController::class, 'indexadmin'])->name('admin.produits');

    Route::resource('categories', CategoriesController::class)->names('admin.categories');
    Route::resource('historiqueCommandes', HistoriqueCommandesController::class)->names('admin.historique');
    Route::resource('produits', ProduitsController::class)->names('admin.produits');
    Route::resource('commandes', CommandesController::class)->only(['index','update'])->names('admin.commandes');
    Route::resource('produits.avis', AvisController::class)->only(['index'])->names('admin.avis');
    Route::post('/commandes/segments', [AdminController::class, 'commandesParSegment'])->name('admin.commandes.segments');
    Route::get('/utilisateurs-commandes', [AdminController::class, 'utilisateursAvecCommandes'])->name('admin.utilisateurs.commandes');
    Route::get('/admin/clients-segment-role', [AdminController::class, 'clientsParSegmentEtRole'])->name('admin.clients.segment.role');
    Route::post('/admin/admins', [AdminController::class, 'storeAdmin'])->name('admin.admins.storeAdmin');
    Route::delete('/admins/{id}', [AdminController::class, 'destroyAdmin'])->name('admin.admins.destroy');


});
Route::prefix('client')->middleware(['auth', 'is_client'])->group(function () {

    Route::get('/profil', [ClientController::class, 'profil'])->name('client.profil');

    Route::get('/suivi/{orderNumber}', [CommandesController::class, 'suivreParNumero'])->name('client.commandes-suivi');

    // Commandes
    Route::resource('commandes', CommandesController::class)->only(['index', 'store', 'show'])->names('client.commandes');
Route::get('paiements/create/{commande_id}', [PaiementController::class, 'create'])->name('client.paiements.create');
    Route::post('paiements', [PaiementController::class, 'store'])->name('client.paiements.store');
    // Panier (éléments)
    Route::resource('panier/elements', ElementsPaniersController::class)
        ->only(['update', 'destroy'])
        ->names('client.panier-elements');
        Route::get('/mes-commandes', [CommandesController::class, 'mesCommandes'])->name('client.commandes');
        Route::get('/mon-parrainage', [ParrainageController::class, 'index'])->name('parrainage.index');
        Route::get('/invite', [ParrainageController::class, 'invite'])->name('invite');
        Route::get('/parametres', [ClientController::class, 'parametres'])->name('client.parametres');
    
    Route::get('/panier', [PaniersController::class, 'index'])->name('client.panier-index');
    Route::post('/panier/ajouter/{produit_id}', [PaniersController::class, 'store'])->name('client.panier.ajouter');
    Route::delete('/panier/supprimer/{id}', [PaniersController::class, 'supprimer'])->name('client.panier.supprimer');
    Route::post('/panier/vider', [PaniersController::class, 'vider'])->name('client.panier.vider');
    Route::put('/panier/quantite/{id}', [PaniersController::class, 'mettreAJourQuantite'])->name('client.panier.quantite');
});
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.client-login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.client-register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/password/reset', [AuthController::class, 'showPasswordResetForm'])->name('auth.password.request');
    Route::post('/password/email', [AuthController::class, 'sendResetLink'])->name('auth.password.email');

    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('social.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

    Route::get('/auth/apple', [AuthController::class, 'redirectToApple'])->name('social.apple');
    Route::get('/auth/apple/callback', [AuthController::class, 'handleAppleCallback']);

Route::middleware('auth')->group(function () {
    Route::get('/produits/{produit_id}/avis/create', [AvisController::class, 'create'])->name('avis.create');
    Route::post('/produits/{produit_id}/avis', [AvisController::class, 'store'])->name('avis.store');
    Route::delete('/avis/{id}', [AvisController::class, 'destroy'])->name('avis.destroy');
});

Route::get('/produits/recherche', [ProduitsController::class, 'find'])->name('produits.find');
Route::get('/produits/rechercher/{nom}', [ProduitsController::class, 'rechercher'])->name('produits.rechercher');

Route::resource('produits', ProduitsController::class)->except(['create', 'edit']);
Route::resource('produits-personnalises', ProduitPersonnaliseController::class);

Route::get('/commandes/{commandeId}/lignes', [LigneCommandesController::class, 'index'])->name('commandes.lignes.index');
Route::get('/lignes-commandes/{id}', [LigneCommandesController::class, 'show'])->name('commandes.lignes.show');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produits/rechercher', [ProduitsController::class, 'rechercher'])->name('produits.rechercher');

