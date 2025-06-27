<x-guest-layout>
    <div class="card card-custom">
        <div class="p-4 text-center card-body">
            <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop Logo" class="mx-auto mb-3" style="width: 96px; height: 96px; object-fit: contain;">
            <h1 class="mb-2 h3 text-primary fw-bold">Connectez-vous</h1>
            <p class="mb-4 text-secondary">Bienvenue chez GlobalDrop !</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3 text-start">
                    <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password with toggle -->
                <div class="mb-3 text-start position-relative">
                    <label for="password" class="form-label fw-semibold">{{ __('Mot de passe') }}</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control @error('password') is-invalid @enderror">
                    <button type="button" class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePassword()">
                        👁️
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-4 form-check text-start">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label" for="remember_me">{{ __('Se souvenir de moi') }}</label>
                </div>

                <div class="mb-3 d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="link-primary small">{{ __('Mot de passe oublié ?') }}</a>
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
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        }
    </script>
</x-guest-layout>
