<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bela Rosa · @yield('titulo', 'Painel')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        display: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        studio: {
                            50: '#faf6f6', 100: '#f1e9e9', 200: '#e2d3d3', 300: '#c9b0b0',
                            400: '#a58080', 500: '#7d5c5c', 600: '#5e4444', 700: '#463232',
                            800: '#2c1f1f', 900: '#181111',
                        },
                        rosa: {
                            50:  '#fef1f5',
                            100: '#fce0ea',
                            400: '#f472a0',
                            500: '#ec4d84',
                            600: '#d62e6a',
                            700: '#b02155',
                        },
                    },
                },
            },
        };
    </script>

    <style>
        [x-cloak] { display: none !important; }
        html { -webkit-font-smoothing: antialiased; scroll-behavior: smooth; }
        body { background-color: #faf6f6; font-feature-settings: 'cv11', 'ss03'; }
        ::selection { background: #fce0ea; color: #b02155; }

        .font-display { font-weight: 600; letter-spacing: -0.025em; font-variant-numeric: tabular-nums; }
        h1.font-display {
            letter-spacing: -0.035em;
            display: inline-block;
            background-image: linear-gradient(100deg, #b02155, #ec4d84 55%, #f472a0);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            -webkit-text-fill-color: transparent;
        }

        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-thumb { background-color: #c9b0b0; border-radius: 999px; }
        ::-webkit-scrollbar-thumb:hover { background-color: #a58080; }

        main article,
        main > .grid.grid-cols-2 > div {
            box-shadow: 0 1px 2px rgba(24,17,17,.05);
            transition: transform .25s cubic-bezier(.2,.7,.2,1), box-shadow .25s ease, border-color .25s ease;
        }
        main article:hover,
        main > .grid.grid-cols-2 > div:hover {
            transform: translateY(-3px);
            border-color: #f472a0;
            box-shadow: 0 16px 32px -16px rgba(214,46,106,.3), 0 2px 6px -2px rgba(24,17,17,.06);
        }

        main table thead tr { background-image: linear-gradient(100deg, #b02155, #ec4d84 55%, #d62e6a) !important; }
        main table thead th { color: #fef1f5 !important; font-weight: 500 !important; }

        main tbody tr td:first-child { box-shadow: inset 3px 0 0 transparent; transition: box-shadow .2s ease; }
        main tbody tr:hover td:first-child { box-shadow: inset 3px 0 0 #ec4d84; }
        main tbody tr { transition: background-color .2s ease; }
        main tbody tr:hover { background-color: #fef7f9; }

        main button { transition: background-color .2s ease, color .2s ease, border-color .2s ease, box-shadow .2s ease, transform .15s ease; }
        main button:active { transform: scale(.97); }
        main button.bg-rosa-600 { background-image: linear-gradient(135deg, #ec4d84, #b02155); }
        main button.bg-rosa-600:hover { box-shadow: 0 8px 18px -8px rgba(214,46,106,.55); }

        :focus-visible { outline: 2px solid #f472a0; outline-offset: 2px; border-radius: 4px; }
        input:focus-visible { outline: none; }

        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; animation: none !important; }
            main article:hover, main > .grid.grid-cols-2 > div:hover { transform: none; }
        }
    </style>
</head>
<body class="font-sans text-studio-900 antialiased" x-data="{
        menuAberto: false,
        avisoAberto: false,
        mensagemAviso: 'Este é um site ilustrativo, criado apenas para demonstração visual. Nenhuma ação aqui é real.'
    }"
    @abrir-aviso.window="mensagemAviso = $event.detail?.mensagem || mensagemAviso; avisoAberto = true">

    @php
        $itensNav = [
            ['rota' => 'loja.produtos',       'label' => 'Produtos'],
            ['rota' => 'loja.encomendas',     'label' => 'Encomendas'],
            ['rota' => 'loja.clientes',       'label' => 'Clientes'],
            ['rota' => 'loja.profissionais',  'label' => 'Profissionais'],
        ];
    @endphp

    {{-- Cabeçalho --}}
    <header class="bg-white/85 backdrop-blur-md border-b border-studio-200 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 h-16 flex items-center justify-between gap-6">

            <a href="{{ route('loja.produtos') }}" class="flex items-center gap-3">
                <svg viewBox="0 0 24 24" class="w-7 h-7 text-rosa-600" fill="none" stroke="currentColor" stroke-width="1.6">
                    <path d="M9 6V5a3 3 0 016 0v1" />
                    <path d="M6 6h12l1 14H5z" />
                </svg>
                <span class="font-display text-2xl leading-none text-studio-900" style="-webkit-text-fill-color: currentColor; background: none;">Bela Rosa</span>
                <span class="hidden sm:inline text-sm text-studio-500 border-l border-studio-200 pl-3">Moda feminina</span>
            </a>

            <nav class="hidden lg:flex items-stretch h-16 gap-7 text-sm">
                @foreach ($itensNav as $item)
                    @php $ativo = request()->routeIs($item['rota']); @endphp
                    <a href="{{ route($item['rota']) }}"
                       class="flex items-center border-b-2 transition
                              {{ $ativo ? 'border-rosa-500 text-studio-900 font-medium' : 'border-transparent text-studio-500 hover:text-studio-900 hover:border-studio-300' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="flex items-center gap-2">
                <button @click="$dispatch('abrir-aviso')"
                        class="hidden sm:inline-flex items-center gap-2 text-xs font-medium text-rosa-600 border border-rosa-100 bg-rosa-50 rounded-md px-3 py-2 hover:bg-rosa-100 transition">
                    <span class="w-1.5 h-1.5 rounded-full bg-rosa-500"></span>
                    Site de demonstração
                </button>
                <button @click="menuAberto = !menuAberto" class="lg:hidden p-2 rounded-md hover:bg-studio-100" aria-label="Abrir menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-studio-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Menu mobile --}}
        <nav x-show="menuAberto" x-cloak class="lg:hidden border-t border-studio-200 bg-white px-4 py-3 space-y-1 text-sm">
            @foreach ($itensNav as $item)
                @php $ativo = request()->routeIs($item['rota']); @endphp
                <a href="{{ route($item['rota']) }}"
                   class="block px-3 py-2 rounded-md {{ $ativo ? 'bg-rosa-50 text-rosa-700 font-medium' : 'text-studio-600 hover:bg-studio-50' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>
    </header>

    {{-- Título da página --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-8 pt-10 pb-6">
        <h1 class="font-display text-3xl sm:text-4xl text-studio-900">@yield('titulo', 'Painel')</h1>
        <p class="text-sm text-studio-500 mt-1.5">@yield('subtitulo', ' ')</p>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-8 pb-16">
        @yield('conteudo')
    </main>

    <footer class="border-t border-studio-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-6 text-xs text-studio-500">
            Bela Rosa é um site ilustrativo, desenvolvido como exemplo de portfólio.
        </div>
    </footer>

    {{-- Popup global: site ilustrativo --}}
    <div x-show="avisoAberto" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center px-4"
         style="display: none;">
        <div class="absolute inset-0 bg-studio-900/50 backdrop-blur-sm" @click="avisoAberto = false"></div>

        <div x-show="avisoAberto"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="relative bg-white rounded-lg shadow-xl max-w-sm w-full p-6 text-center">
            <div class="w-12 h-12 mx-auto rounded-full bg-rosa-50 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-rosa-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </div>
            <h2 class="font-display text-2xl text-studio-900 mb-2" style="-webkit-text-fill-color: currentColor; background: none;">Site ilustrativo</h2>
            <p class="text-sm text-studio-600 leading-relaxed" x-text="mensagemAviso"></p>
            <button @click="avisoAberto = false"
                    class="mt-6 w-full bg-rosa-600 hover:bg-rosa-700 text-white text-sm font-medium rounded-md py-2.5 transition">
                Entendi
            </button>
        </div>
    </div>

</body>
</html>