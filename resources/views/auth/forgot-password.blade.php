<x-guest-layout>
    <div class="shadow-sm card card-custom">
        <div class="p-4 text-center card-body">
            <img src="{{ asset('images/globaldrop.jpg') }}" alt="Logo GlobalDrop" class="mx-auto mb-3" style="width: 96px; height: 96px; object-fit: contain;">
            <h1 class="mb-2 h4 text-primary fw-bold">Réinitialisation du mot de passe</h1>
            <p class="mb-4 text-secondary">
                Vous avez oublié votre mot de passe ? Pas de panique.<br>
                Entrez simplement votre adresse e-mail et nous vous enverrons un lien pour en créer un nouveau.
            </p>

            <!-- Affichage du message de succès -->
            <x-auth-session-status class="mb-4 text-success fw-semibold" :status="session('status')" />

            <!-- Formulaire -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3 text-start">
                    <label for="email" class="form-label fw-semibold">Adresse e-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="exemple@domaine.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Bouton -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary fw-semibold">
                        Envoyer le lien de réinitialisation
                    </button>
                </div>
            </form>

            <!-- Lien de retour -->
            <p class="mt-4 mb-0 text-secondary small">
                <a href="{{ route('login') }}" class="link-primary text-decoration-underline">Retour à la connexion</a>
            </p>
        </div>
    </div>
</x-guest-layout>
