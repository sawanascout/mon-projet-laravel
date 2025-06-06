<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 px-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-900 rounded-xl shadow-lg p-8">
            <div class="mb-6 text-center">
                <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop Logo" class="mx-auto w-24 h-24 mb-2">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Créer un compte</h1>
                <p class="text-gray-600 dark:text-gray-300 mt-1">Rejoignez GlobalDrop aujourd'hui !</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nom complet')" class="font-semibold" />
                    <x-text-input id="name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-600" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="font-semibold" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600" />
                </div>

                <!-- Segment -->
                <div class="mb-4">
                    <label for="segment" class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">Segment</label>
                    <select name="segment" id="segment" required class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                        <option value="homme">Homme</option>
                        <option value="femme">Femme</option>
                        <option value="jeune fille">Jeune Fille</option>
                    </select>
                    <x-input-error :messages="$errors->get('segment')" class="mt-1 text-red-600" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Mot de passe')" class="font-semibold" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirmer mot de passe')" class="font-semibold" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-600" />
                </div>
                <!-- WhatsApp Number -->
<div class="mb-4">
    <x-input-label for="whatsapp" :value="__('Numéro WhatsApp')" class="font-semibold" />

    <div class="flex">
        <!-- Sélecteur d'indicatif -->
        <select name="country_code" id="country_code" class="rounded-l-md border-gray-300 bg-white dark:bg-gray-800 dark:text-white dark:border-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <option value="212" {{ old('country_code') == '212' ? 'selected' : '' }}>+212 🇲🇦</option>
            <option value="228" {{ old('country_code') == '228' ? 'selected' : '' }}>+228 🇹🇬</option>
            <option value="229" {{ old('country_code') == '229' ? 'selected' : '' }}>+229 🇧🇯</option>
            <option value="226" {{ old('country_code') == '226' ? 'selected' : '' }}>+226 🇧🇫</option>
            <option value="221" {{ old('country_code') == '221' ? 'selected' : '' }}>+221 🇸🇳</option>
            <option value="225" {{ old('country_code') == '225' ? 'selected' : '' }}>+225 🇨🇮</option>
            <!-- Ajoute d'autres pays si tu veux -->
        </select>

        <!-- Champ WhatsApp -->
        <x-text-input
            id="whatsapp"
            class="block w-full rounded-r-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white"
            type="text"
            name="whatsapp"
            placeholder="ex: 672345678"
            :value="old('whatsapp')"
            required
            autocomplete="tel"
        />
    </div>

    <x-input-error :messages="$errors->get('whatsapp')" class="mt-1 text-red-600" />
</div>



                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Déjà inscrit ? Connectez-vous</a>
                    <x-primary-button class="ml-4 px-6 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-md font-semibold">
                        S’inscrire
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
