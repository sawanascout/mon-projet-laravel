<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
  use App\Models\Referral_click;

class AdminParrainageController extends Controller
{
  

public function index()
{
    // Récupère tous les clics avec le parrain associé
    $clics = Referral_click::with('user')->latest()->get();

    return view('admin.parrainages.index', compact('clics'));
}

}
