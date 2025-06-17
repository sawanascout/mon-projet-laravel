<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $referral = Cookie::get('referral_code');
$parrainId = null;

if ($referral) {
    $parrain = User::where('referral_code', $referral)->first();
    if ($parrain) {
        $parrainId = $parrain->id;
    }
}

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'segment' => $request->segment, // 👈 ajouter cette ligne
            'password' => Hash::make($request->password),
            'referral_code' => strtoupper(Str::random(8)), // Ex : FJ38KD9A
            'parrain_id' => $parrainId, // ⬅️ Ajout du parrain ici
            'whatsapp' => $request->whatsapp,

        ]);
        session()->forget('referral');
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
