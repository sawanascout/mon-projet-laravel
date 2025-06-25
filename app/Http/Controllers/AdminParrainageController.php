<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
  use App\Models\ReferralClick;

class AdminParrainageController extends Controller
{
  

public function index()
{
    // Récupère tous les clics avec le parrain associé
    $clics = ReferralClick::with('user')->latest()->get();

    return view('admin.parrainages.index', compact('clics'));
}

}
