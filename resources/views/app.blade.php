<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Aplikasi RS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        @inertiaHead
    </head>
    <body class="font-sans antialiased" style="margin: 0; padding: 0; background-color: #0b0f19; color: #f3f4f6;">
        @inertia

        <!-- Scripts -->
        @viteReactRefresh
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </body>
</html>
