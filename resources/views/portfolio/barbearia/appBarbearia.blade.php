<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbearia Purple Elegance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    </a>
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0f5ff',
                            100: '#dbe7ff',
                            200: '#b8cdff',
                            300: '#8aabff',
                            400: '#5c85ff',
                            500: '#3763f4',
                            600: '#2749d1',
                            700: '#1f3aa8',
                            800: '#1c3184',
                            900: '#1b2c68',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">

    <main class="flex-1">
        @if (session('status'))
            <div class="max-w-5xl mx-auto px-6 pt-6">
                <div class="rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>