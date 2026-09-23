<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Criação de Sites para Empresas')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
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

    <header class="border-b border-slate-200 bg-white/80 backdrop-blur sticky top-0 z-10">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('onboarding.index') }}" class="flex items-center gap-2 group">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-brand-500 to-brand-700 flex items-center justify-center text-white font-bold shadow-sm shadow-brand-500/30 transition-transform duration-200 group-hover:scale-105">S</div>
                <span class="font-semibold text-lg text-slate-900">SitesPro</span>
            </a>
            <nav class="flex items-center gap-6">
                <a href="{{ route('portfolio.index') }}"
                   class="text-sm font-medium text-slate-500 hover:text-brand-700 transition-colors duration-200">
                    Veja nosso portfólio
                </a>
                <a href="{{ route('contact.human') }}"
                   class="text-sm font-medium text-brand-700 hover:text-brand-800 transition-colors duration-200 flex items-center gap-1">
                    Fale com um humano
                    <span class="transition-transform duration-200 group-hover:translate-x-0.5">→</span>
                </a>
            </nav>
        </div>
    </header>

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

    <footer class="border-t border-slate-200 bg-white">
        <div class="max-w-5xl mx-auto px-6 py-6 text-sm text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-2">
            <span>&copy; {{ date('Y') }} SitesPro. Todos os direitos reservados.</span>
            <span class="flex items-center gap-4">
                <a href="{{ route('portfolio.index') }}" class="hover:text-brand-600 transition-colors duration-200">Portfólio</a>
                <span>Feito para transformar seu negócio em um site profissional.</span>
            </span>
        </div>
    </footer>
</body>
</html>