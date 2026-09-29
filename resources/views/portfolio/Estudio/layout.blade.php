<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traço Arquitetura · @yield('titulo', 'Painel')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

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
                            50:  '#f6f5f1',
                            100: '#ecebe5',
                            200: '#dcdad1',
                            300: '#c3c0b4',
                            400: '#9b988b',
                            500: '#727064',
                            600: '#54524a',
                            700: '#3a3934',
                            800: '#262622',
                            900: '#171715',
                        },
                        planta: {
                            50:  '#eef3fa',
                            100: '#d9e5f5',
                            400: '#5b86c4',
                            500: '#2f63ad',
                            600: '#234f8e',
                            700: '#1c3f73',
                        },
                    },
                },
            },
        };
    </script>

    <style>
        [x-cloak] { display: none !important; }

        html { -webkit-font-smoothing: antialiased; scroll-behavior: smooth; }
        body { background-color: #f6f5f1; font-feature-settings: 'cv11', 'ss03'; }
        ::selection { background: #d9e5f5; color: #1c3f73; }

        /* Títulos e números grandes */
        .font-display { font-weight: 600; letter-spacing: -0.025em; font-variant-numeric: tabular-nums; }
        h1.font-display { letter-spacing: -0.035em; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-thumb { background-color: #c3c0b4; border-radius: 999px; }
        ::-webkit-scrollbar-thumb:hover { background-color: #9b988b; }

        /* Cards: projetos, ideias, contatos e cartões de resumo do topo */
        main article,
        main > .grid.grid-cols-2 > div {
            transition: transform .25s cubic-bezier(.2,.7,.2,1), box-shadow .25s ease, border-color .25s ease;
        }
        main article:hover,
        main > .grid.grid-cols-2 > div:hover {
            transform: translateY(-3px);
            border-color: #c3c0b4;
            box-shadow: 0 14px 30px -14px rgba(23,23,21,.22), 0 2px 6px -2px rgba(23,23,21,.06);
        }

        /* Planta do projeto: zoom suave no hover do card */
        main article > div:first-child > img,
        main article > div:first-child > svg { transition: transform .7s cubic-bezier(.2,.7,.2,1); }
        main article:hover > div:first-child > img,
        main article:hover > div:first-child > svg { transform: scale(1.06); }

        /* Linhas de tabela: faixa azul discreta à esquerda */
        main tbody tr td:first-child { box-shadow: inset 2px 0 0 transparent; transition: box-shadow .2s ease; }
        main tbody tr:hover td:first-child { box-shadow: inset 2px 0 0 #2f63ad; }
        main tbody tr { transition: background-color .2s ease; }

        /* Botões */
        main button { transition: background-color .2s ease, color .2s ease, border-color .2s ease, box-shadow .2s ease, transform .15s ease; }
        main button:active { transform: scale(.97); }
        main button.bg-planta-600:hover { box-shadow: 0 8px 18px -8px rgba(47,99,173,.65); }

        /* Foco acessível */
        :focus-visible { outline: 2px solid #5b86c4; outline-offset: 2px; border-radius: 4px; }
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
            ['rota' => 'estudio.projetos',   'label' => 'Projetos'],
            ['rota' => 'estudio.ideias',     'label' => 'Ideias'],
            ['rota' => 'estudio.financeiro', 'label' => 'Financeiro'],
            ['rota' => 'estudio.contratos',  'label' => 'Contratos'],
            ['rota' => 'estudio.contatos',   'label' => 'Contatos'],
        ];
    @endphp

    {{-- Cabeçalho --}}
    <header class="bg-white/85 backdrop-blur-md border-b border-studio-200 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 h-16 flex items-center justify-between gap-6">

            <a href="{{ route('estudio.projetos') }}" class="flex items-center gap-3">
                <svg viewBox="0 0 24 24" class="w-7 h-7 text-planta-600" fill="none" stroke="currentColor" stroke-width="1.6">
                    <rect x="3" y="3" width="18" height="18" />
                    <path d="M3 15h9V3M12 15v6M12 9h9" />
                </svg>
                <span class="font-display text-2xl leading-none text-studio-900">Traço</span>
                <span class="hidden sm:inline text-sm text-studio-500 border-l border-studio-200 pl-3">Arquitetura</span>
            </a>

            <nav class="hidden lg:flex items-stretch h-16 gap-7 text-sm">
                @foreach ($itensNav as $item)
                    @php $ativo = request()->routeIs($item['rota']); @endphp
                    <a href="{{ route($item['rota']) }}"
                       class="flex items-center border-b-2 transition
                              {{ $ativo ? 'border-planta-500 text-studio-900 font-medium' : 'border-transparent text-studio-500 hover:text-studio-900 hover:border-studio-300' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="flex items-center gap-2">
                <button @click="$dispatch('abrir-aviso')"
                        class="hidden sm:inline-flex items-center gap-2 text-xs font-medium text-planta-600 border border-planta-100 bg-planta-50 rounded-md px-3 py-2 hover:bg-planta-100 transition">
                    <span class="w-1.5 h-1.5 rounded-full bg-planta-500"></span>
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
                   class="block px-3 py-2 rounded-md {{ $ativo ? 'bg-planta-50 text-planta-700 font-medium' : 'text-studio-600 hover:bg-studio-50' }}">
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
            Traço Arquitetura é um site ilustrativo, desenvolvido como exemplo de portfólio.
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
            <div class="w-12 h-12 mx-auto rounded-full bg-planta-50 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-planta-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </div>
            <h2 class="font-display text-2xl text-studio-900 mb-2">Site ilustrativo</h2>
            <p class="text-sm text-studio-600 leading-relaxed" x-text="mensagemAviso"></p>
            <button @click="avisoAberto = false"
                    class="mt-6 w-full bg-planta-600 hover:bg-planta-700 text-white text-sm font-medium rounded-md py-2.5 transition">
                Entendi
            </button>
        </div>
    </div>

</body>
</html>