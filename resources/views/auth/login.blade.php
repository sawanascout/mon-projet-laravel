<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 px-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-900 rounded-xl shadow-lg p-8">
            <div class="mb-6 text-center">
                <img src="{{ asset('images/globaldrop.jpg') }}" alt="GlobalDrop Logo" class="mx-auto w-24 h-24 mb-2">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Connectez-vous</h1>
                <p class="text-gray-600 dark:text-gray-300 mt-1">Bienvenue chez GlobalDrop !</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="font-semibold" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Mot de passe')" class="font-semibold" />
                    <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-700">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                        {{ __('Se souvenir de moi') }}
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-indigo-600 hover:text-indigo-800 font-medium" href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié ?') }}
                        </a>
                    @endif

                    <x-primary-button class="ml-4 px-6 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-md font-semibold">
                        {{ __('Se connecter') }}
                    </x-primary-button>
                </div>
            </form>

            <p class="mt-6 text-center text-gray-600 dark:text-gray-300">
                Pas encore de compte ? 
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-medium underline">Inscrivez-vous</a>
            </p>
        </div>
    </div>
</x-guest-layout>
