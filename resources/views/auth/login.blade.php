<x-guest-layout>
    <div class="shadow-sm card card-custom">
        <div class="p-4 text-center card-body">
            <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop Logo" class="mx-auto mb-3" style="width: 96px; height: 96px; object-fit: contain;">
            <h1 class="mb-2 h3 text-primary fw-bold">Connectez-vous</h1>
            <p class="mb-4 text-secondary">Bienvenue chez GlobalDrop !</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3 text-start">
                    <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password avec icône d'œil -->
                <div class="mb-3 text-start">
                    <label for="password" class="form-label fw-semibold">{{ __('Mot de passe') }}</label>
                    <div class="input-group">
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="form-control @error('password') is-invalid @enderror">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="bi bi-eye" id="icon-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember me -->
                <div class="mb-4 form-check text-start">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label" for="remember_me">{{ __('Se souvenir de moi') }}</label>
                </div>

                <!-- Actions -->
                <!-- Remplace cette partie -->
@if (Route::currentRouteName() === 'client.login')
    <!-- <a href="{{ route('password.request') }}" class="link-primary small">Mot de passe oublié ?</a> -->
    <span class="text-muted small">Mot de passe oublié ? Veuillez contacter l’administrateur.</span>
@endif



                    <button type="submit" class="px-4 py-2 btn btn-primary fw-semibold">{{ __('Se connecter') }}</button>
                </div>
            </form>

            <p class="mt-4 mb-0 text-secondary small">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="link-primary fw-semibold text-decoration-underline">Inscrivez-vous</a>
            </p>
        </div>
    </div>

    <!-- Script pour afficher/masquer le mot de passe -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const icon = document.querySelector('#icon-eye');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });
    </script>

    <!-- Bootstrap Icons (si non inclus) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</x-guest-layout>
