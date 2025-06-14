<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ParrainageController extends Controller
{
    //
    public function index()
{
        // Dans le ParrainageController@index
$user = Auth::user();
$lien = route('invite', ['ref' => $user->referral_code]);

return view('parrainage.index', compact('lien'));

}
// ParrainageController.php
public function invite(Request $request)
{
    $refCode = $request->query('ref');

    if ($refCode && $parrain = User::where('referral_code', $refCode)->first()) {
        // Sauvegarder dans session (ou cookie) le parrain pour la prochaine inscription
        session(['referral' => $parrain->id]);
    }

    // Rediriger vers le groupe WhatsApp
    return redirect('https://whatsapp.com/channel/0029VbAh2wrGZNCxxKYwbN3Q');
}


}
