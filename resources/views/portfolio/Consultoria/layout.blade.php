<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Âncora Consultoria · @yield('titulo', 'Painel')</title>

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
                            50: '#f5f7fa', 100: '#e9edf3', 200: '#d6dde7', 300: '#b7c3d4',
                            400: '#8a9ab1', 500: '#647389', 600: '#4b5768', 700: '#37404c',
                            800: '#242a32', 900: '#14171b',
                        },
                        selo: {
                            50:  '#eef5ff',
                            100: '#dbe9fe',
                            400: '#4c8fe0',
                            500: '#2f6fc7',
                            600: '#1f57a8',
                            700: '#1a4585',
                        },
                    },
                },
            },
        };
    </script>

    <style>
        [x-cloak] { display: none !important; }
        html { -webkit-font-smoothing: antialiased; scroll-behavior: smooth; }
        body {
            background-color: #f5f7fa;
            font-feature-settings: 'cv11', 'ss03';
            position: relative;
            overflow-x: hidden;
        }
        ::selection { background: #dbe9fe; color: #1a4585; }

        /* ---------- Background fluido ---------- */
        .blob-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
        }
        .blob-bg span {
            position: absolute;
            border-radius: 9999px;
            filter: blur(70px);
            opacity: .22;
            will-change: transform;
        }
        .blob-bg span:nth-child(1) {
            width: 480px; height: 480px;
            top: -160px; left: -120px;
            background: radial-gradient(circle at 30% 30%, #93c5fd, transparent 70%);
            animation: flutuar1 22s ease-in-out infinite;
        }
        .blob-bg span:nth-child(2) {
            width: 420px; height: 420px;
            top: 20%; right: -140px;
            background: radial-gradient(circle at 70% 30%, #60a5fa, transparent 70%);
            animation: flutuar2 26s ease-in-out infinite;
        }
        .blob-bg span:nth-child(3) {
            width: 380px; height: 380px;
            bottom: -140px; left: 20%;
            background: radial-gradient(circle at 50% 50%, #bfdbfe, transparent 70%);
            animation: flutuar3 30s ease-in-out infinite;
        }
        @keyframes flutuar1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%      { transform: translate(60px, 50px) scale(1.1); }
        }
        @keyframes flutuar2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%      { transform: translate(-50px, 40px) scale(1.08); }
        }
        @keyframes flutuar3 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%      { transform: translate(40px, -40px) scale(1.05); }
        }

        /* ---------- Tipografia ---------- */
        .font-display { font-weight: 600; letter-spacing: -0.025em; font-variant-numeric: tabular-nums; }

        /* Título da página em gradiente */
        h1.font-display {
            letter-spacing: -0.035em;
            display: inline-block;
            background-image: linear-gradient(100deg, #1a4585, #2f6fc7 55%, #4c8fe0);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            -webkit-text-fill-color: transparent;
        }

        /* ---------- Scrollbar ---------- */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-thumb { background-color: #b7c3d4; border-radius: 999px; }
        ::-webkit-scrollbar-thumb:hover { background-color: #2f6fc7; }

        /* ---------- Entrada suave do conteúdo ---------- */
        @keyframes entrar {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        main { animation: entrar .5s ease-out; }

        /* ---------- Cards ---------- */
        main article,
        main > .grid.grid-cols-2 > div {
            position: relative;
            box-shadow: 0 1px 2px rgba(20,23,27,.05);
            transition: transform .3s cubic-bezier(.2,.8,.2,1), box-shadow .3s ease, border-color .3s ease, background-color .3s ease;
        }
        main article:hover,
        main > .grid.grid-cols-2 > div:hover {
            transform: translateY(-4px);
            border-color: #4c8fe0;
            box-shadow: 0 20px 40px -18px rgba(31,87,168,.35), 0 4px 10px -4px rgba(31,87,168,.12);
        }

        /* Linha de destaque no topo do card, ao passar o mouse */
        main article::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            border-radius: 0.5rem 0.5rem 0 0;
            background-image: linear-gradient(90deg, #1a4585, #4c8fe0);
            opacity: 0;
            transition: opacity .3s ease;
        }
        main article:hover::before { opacity: 1; }

        /* ---------- Ícones em círculo dentro dos cards (sem rotação) ---------- */
        main article .rounded-lg.bg-selo-50,
        main article .rounded-full.bg-selo-50 {
            transition: transform .3s ease, background-color .3s ease;
        }
        main article:hover .rounded-lg.bg-selo-50,
        main article:hover .rounded-full.bg-selo-50 {
            transform: scale(1.08);
            background-color: #dbe9fe;
        }

        /* ---------- Tabelas ---------- */
        main table thead tr {
            background-image: linear-gradient(100deg, #1a4585 0%, #2f6fc7 55%, #1f57a8 100%) !important;
        }
        main table thead th {
            color: #eef5ff !important;
            font-weight: 500 !important;
        }
        main tbody tr td:first-child { box-shadow: inset 3px 0 0 transparent; transition: box-shadow .2s ease; }
        main tbody tr:hover td:first-child { box-shadow: inset 3px 0 0 #2f6fc7; }
        main tbody tr { transition: background-color .2s ease; }
        main tbody tr:hover { background-color: #f5f9ff; }

        /* ---------- Botões ---------- */
        main button {
            position: relative;
            overflow: hidden;
            transition: background-color .2s ease, color .2s ease, border-color .2s ease, box-shadow .25s ease, transform .15s ease;
        }
        main button:active { transform: scale(.96); }
        main button.bg-selo-600 {
            background-image: linear-gradient(135deg, #2f6fc7, #1a4585);
        }
        main button.bg-selo-600:hover {
            box-shadow: 0 10px 24px -10px rgba(31,87,168,.55);
            transform: translateY(-1px);
        }
        main button.bg-selo-600::after {
            content: '';
            position: absolute;
            top: 0; left: -60%;
            width: 40%; height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,.35), transparent);
            transform: skewX(-20deg);
            transition: left .6s ease;
        }
        main button.bg-selo-600:hover::after { left: 130%; }

        /* Botões de filtro (pills) */
        main button.rounded-full { transition: all .2s ease; }
        main button.rounded-full:hover:not(.bg-studio-900) {
            border-color: #4c8fe0;
            color: #1a4585;
        }

        /* ---------- Links de texto (Editar, Ver detalhes etc.) ---------- */
        main button.text-selo-600 { position: relative; }
        main button.text-selo-600::after {
            content: '';
            position: absolute;
            left: 0; bottom: -2px;
            width: 0; height: 1.5px;
            background: currentColor;
            transition: width .25s ease;
        }
        main button.text-selo-600:hover::after { width: 100%; }

        /* ---------- Cabeçalho / navegação (sem rotação) ---------- */
        header a.flex.items-center.gap-3 svg { transition: transform .3s ease; }
        header a.flex.items-center.gap-3:hover svg { transform: scale(1.08); }

        nav a.flex.items-center { position: relative; }
        nav a.flex.items-center::after {
            content: '';
            position: absolute;
            left: 0; right: 0; bottom: -1px;
            height: 2px;
            background: #2f6fc7;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform .25s ease;
        }
        nav a.flex.items-center:hover::after { transform: scaleX(1); }

        /* ---------- Campos de formulário ---------- */
        input, textarea { transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease; }
        input:hover, textarea:hover { border-color: #8a9ab1; }

        /* ---------- Foco acessível ---------- */
        :focus-visible { outline: 2px solid #4c8fe0; outline-offset: 2px; border-radius: 4px; }
        input:focus-visible, textarea:focus-visible { outline: none; }

        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; animation: none !important; }
            main article:hover, main > .grid.grid-cols-2 > div:hover { transform: none; }
            .blob-bg span { animation: none !important; }
        }

                /* ---------- Responsivo: cards ---------- */
        main article { min-width: 0; overflow-wrap: anywhere; }

        @media (max-width: 640px) {
            main article { padding: 1rem; }
            main > .grid.grid-cols-2 { gap: .75rem; }
            main > .grid.grid-cols-2 > div { padding: .875rem; min-width: 0; }
            main > .grid.grid-cols-2 .font-display { font-size: 1.25rem; }
        }

        /* telas muito estreitas: cards de resumo em uma coluna */
        @media (max-width: 380px) {
            main > .grid.grid-cols-2 { grid-template-columns: 1fr; }
        }

        /* dispositivos touch: sem "pulo" no hover */
        @media (hover: none) {
            main article:hover,
            main > .grid.grid-cols-2 > div:hover { transform: none; }
        }

        /* ---------- Responsivo: tabelas ---------- */
        /* Tablet: rolagem horizontal como segurança */
        @media (max-width: 1023px) and (min-width: 768px) {
            main table { display: block; overflow-x: auto; white-space: nowrap; }
        }

        /* Mobile: cada linha vira um cartão */
        @media (max-width: 767px) {
            main table:not(.tabela-scroll),
            main table:not(.tabela-scroll) tbody,
            main table:not(.tabela-scroll) tr,
            main table:not(.tabela-scroll) td { display: block; width: 100%; }

            main table:not(.tabela-scroll) thead {
                position: absolute; width: 1px; height: 1px;
                overflow: hidden; clip: rect(0 0 0 0);
            }
            main table:not(.tabela-scroll) tbody tr {
                background: #fff;
                border: 1px solid #d6dde7;
                border-radius: .5rem;
                margin-bottom: .75rem;
                padding: .25rem 0;
                box-shadow: 0 1px 2px rgba(20,23,27,.05);
            }
            main table:not(.tabela-scroll) td {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                gap: 1rem;
                text-align: right;
                padding: .5rem 1rem !important;
                border: 0 !important;
            }
            main table:not(.tabela-scroll) td::before {
                content: attr(data-label);
                flex-shrink: 0;
                text-align: left;
                font-size: .7rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: .04em;
                color: #647389;
            }
            main table:not(.tabela-scroll) td:not([data-label])::before { display: none; }
            main tbody tr:hover td:first-child { box-shadow: none; }
        }

        /* tabela larga que prefira rolagem no mobile: use class="tabela-scroll" */
        main .tabela-scroll { display: block; overflow-x: auto; white-space: nowrap; }
    </style>
</head>
<body class="font-sans text-studio-900 antialiased" x-data="{
        menuAberto: false,
        avisoAberto: false,
        mensagemAviso: 'Este é um site ilustrativo, criado apenas para demonstração visual. Nenhuma ação aqui é real.'
    }"
    @abrir-aviso.window="mensagemAviso = $event.detail?.mensagem || mensagemAviso; avisoAberto = true">

    {{-- Background fluido --}}
    <div class="blob-bg" aria-hidden="true">
        <span></span>
        <span></span>
        <span></span>
    </div>

    @php
        $itensNav = [
            ['rota' => 'consultoria.sobre',       'label' => 'Sobre'],
            ['rota' => 'consultoria.valores',     'label' => 'Proposta de valor'],
            ['rota' => 'consultoria.servicos',    'label' => 'Serviços'],
            ['rota' => 'consultoria.contatos',    'label' => 'Contato'],
            ['rota' => 'consultoria.agendamento', 'label' => 'Agendamento'],
        ];
    @endphp

    {{-- Cabeçalho --}}
    <header class="bg-white/80 backdrop-blur-md border-b border-studio-200 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 h-16 flex items-center justify-between gap-6">

            <a href="{{ route('consultoria.sobre') }}" class="flex items-center gap-3">
                <svg viewBox="0 0 24 24" class="w-7 h-7 text-selo-600" fill="none" stroke="currentColor" stroke-width="1.6">
                    <path d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7z" />
                    <path d="M9 12l2 2 4-4" />
                </svg>
                <span class="font-display text-2xl leading-none text-studio-900">Âncora</span>
                <span class="hidden sm:inline text-sm text-studio-500 border-l border-studio-200 pl-3">Consultoria financeira</span>
            </a>

            <nav class="hidden lg:flex items-stretch h-16 gap-7 text-sm">
                @foreach ($itensNav as $item)
                    @php $ativo = request()->routeIs($item['rota']); @endphp
                    <a href="{{ route($item['rota']) }}"
                       class="flex items-center border-b-2 transition
                              {{ $ativo ? 'border-selo-500 text-studio-900 font-medium' : 'border-transparent text-studio-500 hover:text-studio-900' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="flex items-center gap-2">
                <button @click="$dispatch('abrir-aviso')"
                        class="hidden sm:inline-flex items-center gap-2 text-xs font-medium text-selo-600 border border-selo-100 bg-selo-50 rounded-md px-3 py-2 hover:bg-selo-100 transition">
                    <span class="w-1.5 h-1.5 rounded-full bg-selo-500"></span>
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
                   class="block px-3 py-2 rounded-md {{ $ativo ? 'bg-selo-50 text-selo-700 font-medium' : 'text-studio-600 hover:bg-studio-50' }}">
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
            Âncora Consultoria é um site ilustrativo, desenvolvido como exemplo de portfólio.
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
            <div class="w-12 h-12 mx-auto rounded-full bg-selo-50 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-selo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </div>
            <h2 class="font-display text-2xl text-studio-900 mb-2">Site ilustrativo</h2>
            <p class="text-sm text-studio-600 leading-relaxed" x-text="mensagemAviso"></p>
            <button @click="avisoAberto = false"
                    class="mt-6 w-full bg-selo-600 hover:bg-selo-700 text-white text-sm font-medium rounded-md py-2.5 transition">
                Entendi
            </button>
        </div>
    </div>

</body>

<script>
    (function () {
        function rotular() {
            document.querySelectorAll('main table').forEach(function (t) {
                var cab = Array.from(t.querySelectorAll('thead th')).map(function (th) {
                    return th.textContent.trim();
                });
                t.querySelectorAll('tbody tr').forEach(function (tr) {
                    Array.from(tr.children).forEach(function (td, i) {
                        if (cab[i] && !td.dataset.label) td.dataset.label = cab[i];
                    });
                });
            });
        }
        document.addEventListener('DOMContentLoaded', function () {
            rotular();
            new MutationObserver(rotular).observe(document.querySelector('main'), { childList: true, subtree: true });
        });
    })();
</script>

</html>