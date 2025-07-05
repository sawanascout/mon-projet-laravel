<x-guest-layout>
    <div class="shadow-sm card card-custom">
        <div class="p-4 text-center card-body">
            <img src="{{ asset('images/globaldrop.jpg') }}" alt="Logo GlobalDrop" class="mx-auto mb-3" style="width: 96px; height: 96px; object-fit: contain;">
            <h1 class="mb-2 h4 text-primary fw-bold">Réinitialisation du mot de passe</h1>
            <p class="mb-4 text-secondary">
                Vous avez oublié votre mot de passe ?<br>
                Pour des raisons de sécurité, merci de <strong>contacter l’administrateur</strong> afin de réinitialiser votre mot de passe.
            </p>

            <!-- Lien de retour -->
            <p class="mt-4 mb-0 text-secondary small">
                <a href="{{ route('login') }}" class="link-primary text-decoration-underline">Retour à la connexion</a>
            </p>
        </div>
    </div>
</x-guest-layout>
