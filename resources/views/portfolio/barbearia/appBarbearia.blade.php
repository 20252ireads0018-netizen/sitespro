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
        body { font-family: 'Inter', sans-serif; overflow-x: clip; }
        [x-cloak] { display: none !important; }

        /* =====================================================
           RESPONSIVIDADE GLOBAL
           Afeta todas as páginas que usam este layout, sem
           precisar alterar cada view individualmente.
           Breakpoint do menu: abaixo de 1024px (lg do Tailwind).
           ===================================================== */

        /* Evita que tabelas/grids estourem a largura do flex */
        main { min-width: 0; }

        @media (max-width: 1023px) {
            /* Sidebar vira drawer escondido à esquerda */
            aside.fixed {
                transform: translateX(-100%);
                transition: transform .2s ease;
                height: 100vh;
                height: 100dvh;
                min-height: 0 !important;
                overflow-y: auto;
                max-width: 85vw;
            }
            body.menu-open aside.fixed { transform: translateX(0); }

            /* Conteúdo ocupa a largura toda */
            main.ml-64 { margin-left: 0 !important; }

            /* Espaço para o botão ☰ flutuante no cabeçalho */
            main > header { padding-left: 4.5rem !important; }
        }

        @media (max-width: 639px) {
            /* Paddings menores no celular */
            main > header { padding-right: 1rem !important; }
            main .p-8 { padding: 1rem !important; }
            main .p-6 { padding: 1rem !important; }

            /* Linhas "título ... ação/valor" quebram em vez de espremer */
            main .flex.items-center.justify-between { flex-wrap: wrap; gap: .75rem; }
            main header.flex.items-center.justify-between { flex-wrap: nowrap; }

            /* Faixas de números + botão (estatísticas) */
            main .flex.items-center.gap-6 { flex-wrap: wrap; gap: 1rem; width: 100%; }
            main .flex.items-center.gap-6 > button { width: 100%; }

            /* Gráfico de barras mais compacto */
            main .flex.items-end.gap-6 { gap: .5rem; }

            /* Tabelas rolam na horizontal em vez de quebrar o layout */
            .overflow-x-auto > table { min-width: 640px; }
        }
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

    <!-- MENU MOBILE GLOBAL: botão ☰ + fundo escuro (só aparece se a página tiver sidebar) -->
    <div x-data="{ temSidebar: false }"
         x-init="temSidebar = !!document.querySelector('aside.fixed')"
         x-effect="document.body.classList.toggle('menu-open', $store.menu.open);
                   document.body.classList.toggle('overflow-hidden', $store.menu.open)"
         @click.window="if ($event.target.closest('aside.fixed a')) $store.menu.open = false"
         @keydown.escape.window="$store.menu.open = false"
         @resize.window="if (window.innerWidth >= 1024) $store.menu.open = false">

        <button type="button"
                x-show="temSidebar && !$store.menu.open" x-cloak
                @click="$store.menu.open = true"
                aria-label="Abrir menu"
                :aria-expanded="$store.menu.open.toString()"
                class="lg:hidden fixed top-5 left-4 z-30 w-10 h-10 rounded-lg bg-white border border-purple-100
                       text-purple-600 text-xl shadow-sm flex items-center justify-center hover:bg-purple-50">
            ☰
        </button>

        <div x-show="temSidebar && $store.menu.open" x-cloak
             x-transition.opacity
             @click="$store.menu.open = false"
             class="lg:hidden fixed inset-0 z-40 bg-slate-900/50"></div>
    </div>

    <main class="flex-1">
        @if (session('status'))
            <div class="max-w-5xl mx-auto px-4 sm:px-6 pt-6">
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
            Alpine.store('menu', { open: false });
        });
    </script>

</body>
</html>