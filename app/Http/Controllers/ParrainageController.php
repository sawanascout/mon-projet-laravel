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

        // Vérifier si le code de parrain existe
        if ($refCode && $parrain = User::where('referral_code', $refCode)->first()) {

            // 1. Sauvegarde en session (utile si tu veux lier l’inscription au parrain)
            session(['referral' => $parrain->id]);

            // 2. Enregistrement du clic dans la base
            Referral_click::create([
                'user_id' => $parrain->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        // 3. Redirection vers le groupe WhatsApp
        return redirect('https://whatsapp.com/channel/0029VbAh2wrGZNCxxKYwbN3Q');
    }


}
