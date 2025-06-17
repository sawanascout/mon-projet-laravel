<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
        {{ $slot }}
    </div>
</body>
</html>
