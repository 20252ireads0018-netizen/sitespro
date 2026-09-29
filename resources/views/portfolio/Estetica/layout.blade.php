<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Aura · @yield('titulo', 'Painel')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Cormorant+Garamond:wght@600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                        display: ['Cormorant Garamond', 'serif'],
                    },
                    colors: {
                        aura: {
                            50:  '#fdf5f6',
                            100: '#fbe8ea',
                            200: '#f5cdd3',
                            300: '#ecabb5',
                            400: '#dd7f8f',
                            500: '#c85b6e',
                            600: '#a8425a',
                            700: '#87334a',
                            800: '#5f2334',
                            900: '#3c1621',
                        },
                        gold: {
                            400: '#d4b483',
                            500: '#c19a5b',
                            600: '#a67f42',
                        },
                    },
                },
            },
        };
    </script>

    <style>
        [x-cloak] { display: none !important; }
        body { background-color: #faf7f5; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-thumb { background-color: #ecabb5; border-radius: 999px; }
    </style>
</head>
<body class="font-sans text-aura-900 antialiased" x-data="{
        sidebarAberta: false,
        avisoAberto: false,
        mensagemAviso: 'Este é um site ilustrativo, criado apenas como exemplo de portfólio. Nenhuma ação aqui é real.'
    }"
    @abrir-aviso.window="mensagemAviso = $event.detail?.mensagem || mensagemAviso; avisoAberto = true">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside
            class="fixed z-30 inset-y-0 left-0 w-64 bg-white border-r border-aura-100 transform transition-transform duration-200 lg:translate-x-0 lg:static lg:flex lg:flex-col"
            :class="sidebarAberta ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="h-20 flex items-center gap-3 px-6 border-b border-aura-100">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-aura-400 to-gold-500 flex items-center justify-center text-white font-display text-xl">A</div>
                <div>
                    <p class="font-display text-xl leading-none text-aura-800">Clínica Aura</p>
                    <p class="text-[11px] tracking-widest uppercase text-aura-400">Estética &amp; Bem-estar</p>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 text-sm">
                @php
                    $itensNav = [
                        ['rota' => 'clinica.agenda',      'label' => 'Agenda',      'icone' => 'calendar'],
                        ['rota' => 'clinica.financeiro',  'label' => 'Financeiro',  'icone' => 'wallet'],
                        ['rota' => 'clinica.maquinario',  'label' => 'Maquinário',  'icone' => 'device'],
                        ['rota' => 'clinica.estoque',     'label' => 'Estoque',     'icone' => 'box'],
                        ['rota' => 'clinica.funcionario', 'label' => 'Funcionários','icone' => 'users'],
                    ];
                @endphp

                @foreach ($itensNav as $item)
                    @php $ativo = request()->routeIs($item['rota']); @endphp
                    <a href="{{ route($item['rota']) }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition
                              {{ $ativo ? 'bg-aura-50 text-aura-700 font-medium' : 'text-aura-800/70 hover:bg-aura-50/70 hover:text-aura-700' }}">
                        <span class="w-2 h-2 rounded-full {{ $ativo ? 'bg-gold-500' : 'bg-aura-200' }}"></span>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="p-4 border-t border-aura-100">
                <div class="rounded-xl bg-aura-50 p-4 text-xs text-aura-700/80 leading-relaxed">
                    Este painel faz parte de um <span class="font-semibold text-aura-700">site ilustrativo</span>,
                    desenvolvido como exemplo de portfólio.
                </div>
            </div>
        </aside>

        {{-- Overlay mobile --}}
        <div x-show="sidebarAberta" x-cloak @click="sidebarAberta = false"
             class="fixed inset-0 bg-black/30 z-20 lg:hidden"></div>

        {{-- Conteúdo --}}
        <div class="flex-1 flex flex-col min-w-0">

            <header class="h-20 bg-white/80 backdrop-blur border-b border-aura-100 flex items-center justify-between px-4 sm:px-8 sticky top-0 z-10">
                <div class="flex items-center gap-3">
                    <button @click="sidebarAberta = !sidebarAberta" class="lg:hidden p-2 rounded-lg hover:bg-aura-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-aura-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div>
                        <h1 class="font-display text-2xl text-aura-800">@yield('titulo', 'Painel')</h1>
                        <p class="text-xs text-aura-500">@yield('subtitulo', ' ')</p>
                    </div>
                </div>

                <button
                    @click="$dispatch('abrir-aviso')"
                    class="hidden sm:inline-flex items-center gap-2 text-xs font-medium text-aura-600 border border-aura-200 rounded-full px-4 py-2 hover:bg-aura-50 transition">
                    <span class="w-1.5 h-1.5 rounded-full bg-gold-500"></span>
                    Site de demonstração
                </button>
            </header>

            <main class="flex-1 p-4 sm:p-8">
                @yield('conteudo')
            </main>
        </div>
    </div>

    {{-- Popup global: site ilustrativo --}}
    <div x-show="avisoAberto" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center px-4"
         style="display: none;">
        <div class="absolute inset-0 bg-aura-900/40 backdrop-blur-sm" @click="avisoAberto = false"></div>

        <div x-show="avisoAberto"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="relative bg-white rounded-2xl shadow-xl max-w-sm w-full p-6 text-center">
            <div class="w-12 h-12 mx-auto rounded-full bg-aura-50 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-aura-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </div>
            <h2 class="font-display text-xl text-aura-800 mb-2">Site ilustrativo</h2>
            <p class="text-sm text-aura-700/80 leading-relaxed" x-text="mensagemAviso"></p>
            <button @click="avisoAberto = false"
                    class="mt-6 w-full bg-aura-600 hover:bg-aura-700 text-white text-sm font-medium rounded-xl py-2.5 transition">
                Entendi
            </button>
        </div>
    </div>

</body>
</html>