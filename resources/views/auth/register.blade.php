<x-guest-layout>
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center"
         style="background: linear-gradient(90deg, #4f46e5 0%, #8b5cf6 50%, #ec4899 100%); padding: 1rem;">
        <div class="w-100" style="max-width: 400px;">
            <div class="rounded shadow card">
                <div class="p-4 text-center card-body">
                    <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop Logo" class="mx-auto mb-3" style="width: 96px; height: 96px;">
                    <h1 class="mb-2 h3 text-primary fw-bold">Créer un compte</h1>
                    <p class="mb-4 text-secondary">Rejoignez GlobalDrop aujourd'hui !</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3 text-start">
                            <label for="name" class="form-label fw-semibold">Nom complet</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                                class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Segment -->
                        <div class="mb-3 text-start">
                            <label for="segment" class="form-label fw-semibold">Segment</label>
                            <select name="segment" id="segment" required class="form-select @error('segment') is-invalid @enderror">
                                <option value="" disabled selected>Choisissez votre segment</option>
                                <option value="homme" {{ old('segment') == 'homme' ? 'selected' : '' }}>Homme</option>
                                <option value="femme" {{ old('segment') == 'femme' ? 'selected' : '' }}>Femme</option>
                                <option value="jeune fille" {{ old('segment') == 'jeune fille' ? 'selected' : '' }}>Jeune Fille</option>
                            </select>
                            @error('segment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3 text-start position-relative">
                            <label for="password" class="form-label fw-semibold">Mot de passe</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="form-control @error('password') is-invalid @enderror">
                            <button type="button" class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2"
                                    onclick="toggleRegisterPassword('password')">
                                👁️
                            </button>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3 text-start position-relative">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirmer mot de passe</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="form-control @error('password_confirmation') is-invalid @enderror">
                            <button type="button" class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2"
                                    onclick="toggleRegisterPassword('password_confirmation')">
                                👁️
                            </button>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- WhatsApp Number -->
                        <div class="mb-4 text-start">
                            <label for="whatsapp" class="form-label fw-semibold">Numéro WhatsApp</label>
                            <div class="input-group">
                                <select name="country_code" id="country_code" class="form-select @error('country_code') is-invalid @enderror" style="max-width: 100px;">
                                    <option value="212" {{ old('country_code') == '212' ? 'selected' : '' }}>+212 🇲🇦</option>
                                    <option value="228" {{ old('country_code') == '228' ? 'selected' : '' }}>+228 🇹🇬</option>
                                    <option value="229" {{ old('country_code') == '229' ? 'selected' : '' }}>+229 🇧🇯</option>
                                    <option value="226" {{ old('country_code') == '226' ? 'selected' : '' }}>+226 🇧🇫</option>
                                    <option value="221" {{ old('country_code') == '221' ? 'selected' : '' }}>+221 🇸🇳</option>
                                    <option value="225" {{ old('country_code') == '225' ? 'selected' : '' }}>+225 🇨🇮</option>
                                </select>
                                <input id="whatsapp" type="text" name="whatsapp" placeholder="ex: 672345678"
                                    value="{{ old('whatsapp') }}" required autocomplete="tel"
                                    class="form-control @error('whatsapp') is-invalid @enderror" />
                                @error('whatsapp')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('login') }}" class="link-primary small fw-semibold">Déjà inscrit ? Connectez-vous</a>
                            <button type="submit" class="px-4 py-2 btn btn-primary fw-semibold">S’inscrire</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JS pour afficher/masquer les mots de passe -->
    <script>
        function toggleRegisterPassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</x-guest-layout>
