<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'GlobalDrop') }}</title>
    <!-- Bootstrap CSS (ou autre) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optionnel : ton CSS personnalisé -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Nunito', sans-serif;
        }

        /* Centrer le contenu verticalement et horizontalement */
        .full-height-center {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(90deg, #4f46e5 0%, #8b5cf6 50%, #ec4899 100%);
            padding: 1rem;
        }

        /* Carte blanche */
        .card-custom {
            max-width: 400px;
            width: 100%;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>

    <div class="full-height-center">
        <!-- Contenu spécifique (login/register) -->
        {{ $slot }}
    </div>

    <!-- Bootstrap JS (optionnel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
