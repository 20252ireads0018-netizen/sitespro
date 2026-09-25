<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbearia Purple Elegance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.9/dist/cdn.min.js"></script>
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

    <!-- MODAL GLOBAL: aviso de exemplo ilustrativo -->
    <!-- Qualquer botão de ação em qualquer página deve chamar "$store.aviso.open = true" -->
    <div x-data
         x-show="$store.aviso.open"
         x-cloak
         x-transition.opacity
         class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/40 px-4"
         @keydown.escape.window="$store.aviso.open = false">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm p-6 text-center"
             @click.outside="$store.aviso.open = false"
             x-show="$store.aviso.open"
             x-transition>
            <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center mx-auto mb-4 text-2xl">
                ℹ
            </div>
            <h3 class="text-base font-semibold text-slate-900 mb-2">Site de exemplo</h3>
            <p class="text-sm text-slate-500">
                Esta é apenas uma demonstração ilustrativa de como o site pode ficar.
                Nenhuma ação real é executada nesta página.
            </p>
            <button type="button" @click="$store.aviso.open = false"
                    class="mt-6 w-full px-4 py-2.5 rounded-xl bg-purple-600 text-white text-sm font-medium
                           hover:bg-purple-700 transition-colors">
                Entendi
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('aviso', { open: false });
        });
    </script>

</body>
</html>