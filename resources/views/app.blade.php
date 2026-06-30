<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Sistem ERP') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <script>
            (function() {
                try {
                    var theme = localStorage.getItem('medilink-theme');
                    if (!theme) {
                        theme = window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
                    }
                    document.documentElement.setAttribute('data-theme', theme);
                    if (theme === 'dark') {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                } catch (e) {}
            })();
        </script>
        @routes
        @inertiaHead
    </head>
    <body class="font-sans antialiased text-slate-900 bg-slate-50 dark:bg-slate-900 dark:text-slate-100" style="margin: 0; padding: 0;">
        @inertia

        <!-- Scripts -->
        @viteReactRefresh
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </body>
</html>
