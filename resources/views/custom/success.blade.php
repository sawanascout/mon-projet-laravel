@extends('layouts.client')

@section('content')
<div class="container mx-auto px-4 py-10 max-w-lg text-center">
    <h1 class="text-2xl font-bold mb-6 text-green-700">Votre image a bien été uploadée !</h1>

    <img src="{{ $imageUrl }}" alt="Image uploadée" class="mx-auto mb-6 rounded-lg shadow-md max-h-64 object-contain">

    <p class="mb-4 text-gray-700">
        Cliquez sur le bouton ci-dessous pour ouvrir WhatsApp.<br>
        N’oubliez pas d’attacher manuellement l’image dans WhatsApp avant d’envoyer le message.
    </p>

    <a href="{{ $whatsappUrl }}" target="_blank" class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
        Ouvrir WhatsApp
    </a>
</div>
@endsection
