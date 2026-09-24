@extends('portfolio.barbearia.appBarbearia')

@section('title', 'Todos os agendamentos')

@section('content')

<div class="min-h-screen bg-white text-slate-800 flex">

    <aside class="w-64 min-h-screen bg-white border-r border-purple-100
                  flex flex-col fixed left-0 top-0 bottom-0 z-50 shadow-sm">

        <div class="px-6 py-8 border-b border-purple-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-purple-600 to-purple-800
                            flex items-center justify-center shadow-lg shadow-purple-200">
                    <span class="text-xl text-white">✂</span>
                </div>
                <div>
                    <h1 class="text-lg font-bold tracking-wide text-slate-900">BARBEARIA</h1>
                    <p class="text-[10px] text-purple-500 tracking-[0.25em]">ESTILO • DISCIPLINA</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6">
            <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 px-3 mb-3">Menu</p>

            @php
                $menuItems = [
                    ['label' => 'Agenda',       'icon' => '▣', 'route' => 'barbearia.agenda'],
                    ['label' => 'Financeiro',   'icon' => '◉', 'route' => 'barbearia.financeiro'],
                    ['label' => 'Maquinário',   'icon' => '⚙', 'route' => 'barbearia.maquinario'],
                    ['label' => 'Funcionário',  'icon' => '♙', 'route' => 'barbearia.funcionario'],
                ];
            @endphp

            @foreach ($menuItems as $item)
                @php
                    $isActive = Route::has($item['route']) && request()->routeIs($item['route']);
                    $href = Route::has($item['route']) ? route($item['route']) : '#';
                @endphp
                <a href="{{ $href }}"
                   class="menu-item group flex items-center gap-4 px-4 py-3.5 rounded-xl mb-2
                          transition-all duration-200
                          {{ $isActive
                                ? 'bg-purple-600 text-white shadow-md shadow-purple-200'
                                : 'text-slate-500 hover:bg-purple-50 hover:text-purple-700 hover:translate-x-1' }}">
                    <span class="text-xl">{{ $item['icon'] }}</span>
                    <span class="font-medium">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="p-5 border-t border-purple-100">
            <div class="rounded-xl bg-purple-50 border border-purple-100 p-4">
                <p class="text-xs text-slate-500">Sistema da</p>
                <p class="text-sm font-semibold text-purple-700 mt-1">Barbearia</p>
                <p class="text-[10px] text-slate-400 mt-2">Painel administrativo</p>
            </div>
        </div>

    </aside>


    <!-- ÁREA PRINCIPAL -->
    <main class="ml-64 flex-1 min-h-screen bg-slate-50">

        <header class="h-20 border-b border-purple-100 bg-white/80 backdrop-blur-xl
                       flex items-center justify-between px-8">
            <div>
                <a href="{{ Route::has('barbearia.agenda') ? route('barbearia.agenda') : '#' }}"
                   class="text-sm text-purple-500 hover:text-purple-700">← Voltar para a agenda</a>
                <h2 class="text-xl font-semibold mt-1 text-slate-900">Todos os agendamentos</h2>
            </div>
        </header>

        <div class="p-8">

            @php
                // Nome do mês/ano atual em português, sem depender do locale configurado no Laravel
                $nomesMeses = [
                    1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
                    5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
                    9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro',
                ];
                $agora = now();
                $nomeMesAtual = $nomesMeses[(int) $agora->format('n')];
                $anoAtual = $agora->format('Y');

                // Substitua pelos valores reais vindos do controller (ex.: soma de faturamento e gastos do mês)
                $resumoMes = $resumoMes ?? [
                    'faturamento' => 8420.00,
                    'gastos'      => 2150.00,
                    'agendamentosMes' => 132,
                    'variacaoFaturamento' => 18,   // %
                    'variacaoGastos'      => -6,   // %
                    'variacaoAgendamentos'=> 9,    // %
                ];

                $lucro = $resumoMes['faturamento'] - $resumoMes['gastos'];

                // Série por semana DO MÊS atual (troque pelos totais reais de cada semana)
                $serieMes = $serieMes ?? [
                    ['label' => 'Semana 1', 'faturamento' => 1850, 'gastos' => 480],
                    ['label' => 'Semana 2', 'faturamento' => 2100, 'gastos' => 520],
                    ['label' => 'Semana 3', 'faturamento' => 1980, 'gastos' => 560],
                    ['label' => 'Semana 4', 'faturamento' => 2490, 'gastos' => 590],
                ];
                $maxSerie = max(array_map(fn ($d) => max($d['faturamento'], $d['gastos']), $serieMes));
            @endphp

            <!-- RESUMO FINANCEIRO DO MÊS -->
            <div class="bg-white border border-purple-100 rounded-2xl p-6 shadow-sm mb-6">

                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Financeiro do mês</h2>
                        <p class="text-sm text-slate-400 mt-1">
                            Faturamento, gastos e agendamentos de <strong class="text-purple-600">{{ $nomeMesAtual }} de {{ $anoAtual }}</strong>
                        </p>
                    </div>
                    <span class="text-purple-600 text-xl">$</span>
                </div>

                <!-- MÉTRICAS -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

                    <div class="rounded-xl border border-purple-100 bg-purple-50/40 p-5">
                        <p class="text-sm text-slate-500">Faturamento</p>
                        <p class="text-2xl font-bold mt-2 text-slate-900">
                            R$ {{ number_format($resumoMes['faturamento'], 2, ',', '.') }}
                        </p>
                        <p class="text-xs {{ $resumoMes['variacaoFaturamento'] >= 0 ? 'text-emerald-600' : 'text-red-500' }} mt-2">
                            {{ $resumoMes['variacaoFaturamento'] >= 0 ? '↑' : '↓' }} {{ abs($resumoMes['variacaoFaturamento']) }}% este mês
                        </p>
                    </div>

                    <div class="rounded-xl border border-purple-100 bg-purple-50/40 p-5">
                        <p class="text-sm text-slate-500">Gastos</p>
                        <p class="text-2xl font-bold mt-2 text-slate-900">
                            R$ {{ number_format($resumoMes['gastos'], 2, ',', '.') }}
                        </p>
                        <p class="text-xs {{ $resumoMes['variacaoGastos'] <= 0 ? 'text-emerald-600' : 'text-red-500' }} mt-2">
                            {{ $resumoMes['variacaoGastos'] >= 0 ? '↑' : '↓' }} {{ abs($resumoMes['variacaoGastos']) }}% este mês
                        </p>
                    </div>

                    <div class="rounded-xl border border-purple-100 bg-purple-50/40 p-5">
                        <p class="text-sm text-slate-500">Agendamentos no mês</p>
                        <p class="text-2xl font-bold mt-2 text-slate-900">
                            {{ $resumoMes['agendamentosMes'] }}
                        </p>
                        <p class="text-xs {{ $resumoMes['variacaoAgendamentos'] >= 0 ? 'text-emerald-600' : 'text-red-500' }} mt-2">
                            {{ $resumoMes['variacaoAgendamentos'] >= 0 ? '↑' : '↓' }} {{ abs($resumoMes['variacaoAgendamentos']) }}% este mês
                        </p>
                    </div>

                </div>

                <!-- LUCRO -->
                <div class="flex items-center justify-between rounded-xl bg-purple-600/5 border border-purple-100 px-5 py-4 mb-8">
                    <span class="text-sm text-slate-500">Lucro estimado (faturamento − gastos)</span>
                    <span class="text-lg font-bold text-purple-700">
                        R$ {{ number_format($lucro, 2, ',', '.') }}
                    </span>
                </div>

                <!-- GRÁFICO: FATURAMENTO x GASTOS, POR SEMANA DO MÊS -->
                <div class="flex items-center justify-between mb-3 flex-wrap gap-2">
                    <h3 class="text-sm font-semibold text-slate-700">
                        Comparativo semanal — {{ $nomeMesAtual }} de {{ $anoAtual }}
                    </h3>
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-2 text-xs text-slate-500">
                            <span class="w-3 h-3 rounded-sm bg-purple-500 inline-block"></span> Faturamento
                        </span>
                        <span class="flex items-center gap-2 text-xs text-slate-500">
                            <span class="w-3 h-3 rounded-sm bg-rose-300 inline-block"></span> Gastos
                        </span>
                    </div>
                </div>

                <div class="flex items-end gap-6 h-44 pt-8">
                    @foreach ($serieMes as $d)
                        <div class="relative flex-1 flex flex-col items-center gap-1"
                             x-data="{ open: false }"
                             @mouseenter="open = true"
                             @mouseleave="open = false">

                            <!-- TOOLTIP DO GRÁFICO -->
                            <div x-show="open" x-cloak x-transition
                                 class="absolute bottom-full mb-2 z-50 w-52
                                        bg-white border border-purple-100 rounded-xl shadow-xl p-4
                                        left-1/2 -translate-x-1/2">
                                <p class="text-sm font-semibold text-slate-900">{{ $d['label'] }}</p>
                                <p class="text-xs text-slate-500 mt-2 flex items-center justify-between gap-2">
                                    <span class="flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-sm bg-purple-500 inline-block"></span>
                                        Faturamento
                                    </span>
                                    <span class="font-medium text-slate-900">
                                        R$ {{ number_format($d['faturamento'], 2, ',', '.') }}
                                    </span>
                                </p>
                                <p class="text-xs text-slate-500 mt-1 flex items-center justify-between gap-2">
                                    <span class="flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-sm bg-rose-300 inline-block"></span>
                                        Gastos
                                    </span>
                                    <span class="font-medium text-slate-900">
                                        R$ {{ number_format($d['gastos'], 2, ',', '.') }}
                                    </span>
                                </p>
                                <p class="text-xs text-purple-600 mt-2 pt-2 border-t border-purple-50 flex items-center justify-between">
                                    <span>Saldo</span>
                                    <span class="font-semibold">
                                        R$ {{ number_format($d['faturamento'] - $d['gastos'], 2, ',', '.') }}
                                    </span>
                                </p>
                            </div>

                            <div class="w-full flex items-end justify-center gap-1.5 h-32 cursor-default">
                                <div class="w-1/2 bg-purple-500 rounded-t transition-all duration-150 hover:bg-purple-600"
                                     style="height: {{ round(($d['faturamento'] / $maxSerie) * 100) }}%"></div>
                                <div class="w-1/2 bg-rose-300 rounded-t transition-all duration-150 hover:bg-rose-400"
                                     style="height: {{ round(($d['gastos'] / $maxSerie) * 100) }}%"></div>
                            </div>
                            <span class="text-[11px] text-slate-500 mt-1">{{ $d['label'] }}</span>
                        </div>
                    @endforeach
                </div>

            </div>


            <!-- FILTROS -->
            <form method="GET" class="flex flex-wrap gap-3 mb-6">
                <input type="date" name="data" value="{{ request('data') }}"
                       class="rounded-xl border border-purple-100 px-4 py-2 text-sm text-slate-700
                              focus:outline-none focus:ring-2 focus:ring-purple-300">

                <select name="status"
                        class="rounded-xl border border-purple-100 px-4 py-2 text-sm text-slate-700
                               focus:outline-none focus:ring-2 focus:ring-purple-300">
                    <option value="">Todos os status</option>
                    <option value="confirmado" @selected(request('status') === 'confirmado')>Confirmado</option>
                    <option value="pendente" @selected(request('status') === 'pendente')>Pendente</option>
                </select>

                <button type="submit"
                        class="rounded-xl bg-purple-600 text-white px-5 py-2 text-sm font-medium
                               hover:bg-purple-700 transition-colors duration-200">
                    Filtrar
                </button>

                @if (request('data') || request('status'))
                    <a href="{{ url()->current() }}"
                       class="rounded-xl border border-purple-100 text-purple-600 px-5 py-2 text-sm font-medium
                              hover:bg-purple-50 transition-colors duration-200">
                        Limpar filtros
                    </a>
                @endif
            </form>

            <div class="bg-white border border-purple-100 rounded-2xl shadow-sm">

                <div class="divide-y divide-purple-50">

                    @php
                        // Troque por $agendamentos vindo do controller (idealmente já filtrado via query no banco).
                        // Aqui, para a lista de exemplo funcionar com os filtros da URL, filtramos em PHP mesmo.
                        $todosAgendamentos = $agendamentos ?? [
                            ['hora' => '09:00', 'data' => '24/09/2026', 'inicial' => 'L', 'nome' => 'Lucas Almeida', 'servico' => 'Corte masculino', 'status' => 'Confirmado', 'telefone' => '(11) 98765-4321', 'email' => 'lucas.almeida@email.com'],
                            ['hora' => '10:30', 'data' => '24/09/2026', 'inicial' => 'R', 'nome' => 'Rafael Costa', 'servico' => 'Barba + Sobrancelha', 'status' => 'Confirmado', 'telefone' => '(11) 91234-5678', 'email' => 'rafael.costa@email.com'],
                            ['hora' => '13:00', 'data' => '24/09/2026', 'inicial' => 'G', 'nome' => 'Gabriel Santos', 'servico' => 'Corte + Barba', 'status' => 'Confirmado', 'telefone' => '(11) 99988-7766', 'email' => 'gabriel.santos@email.com'],
                            ['hora' => '15:30', 'data' => '24/09/2026', 'inicial' => 'F', 'nome' => 'Felipe Martins', 'servico' => 'Corte masculino', 'status' => 'Pendente', 'telefone' => '(11) 97777-1122', 'email' => 'felipe.martins@email.com'],
                            ['hora' => '16:45', 'data' => '25/09/2026', 'inicial' => 'M', 'nome' => 'Marcelo Souza', 'servico' => 'Corte + Barba', 'status' => 'Confirmado', 'telefone' => '(11) 93333-2222', 'email' => 'marcelo.souza@email.com'],
                            ['hora' => '18:00', 'data' => '25/09/2026', 'inicial' => 'T', 'nome' => 'Thiago Lima', 'servico' => 'Corte masculino', 'status' => 'Pendente', 'telefone' => '(11) 94444-1111', 'email' => 'thiago.lima@email.com'],
                        ];

                        $dataFiltro = request('data');   // formato Y-m-d (padrão do <input type="date">)
                        $statusFiltro = request('status');

                        $agendamentosFiltrados = array_values(array_filter($todosAgendamentos, function ($ag) use ($dataFiltro, $statusFiltro) {

                            if ($dataFiltro) {
                                $dataAgendamento = \DateTime::createFromFormat('d/m/Y', $ag['data']);
                                if (!$dataAgendamento || $dataAgendamento->format('Y-m-d') !== $dataFiltro) {
                                    return false;
                                }
                            }

                            if ($statusFiltro && strtolower($ag['status']) !== strtolower($statusFiltro)) {
                                return false;
                            }

                            return true;
                        }));
                    @endphp

                    @forelse ($agendamentosFiltrados as $index => $ag)
                        <div class="appointment relative flex items-center gap-5 px-6 py-5
                                    hover:bg-purple-50/60 transition-colors duration-150
                                    {{ $index === 0 ? 'rounded-t-2xl' : '' }}
                                    {{ $index === count($agendamentosFiltrados) - 1 ? 'rounded-b-2xl' : '' }}"
                             x-data="{ open: false, flip: false }"
                             @mouseenter="
                                const rect = $el.getBoundingClientRect();
                                flip = (window.innerHeight - rect.bottom) < 170;
                                open = true;
                             "
                             @mouseleave="open = false">

                            <div class="text-sm font-semibold text-purple-600 w-24">
                                {{ $ag['data'] }} <br>
                                <span class="text-slate-400">{{ $ag['hora'] }}</span>
                            </div>

                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-purple-800
                                        flex items-center justify-center text-white font-medium">
                                {{ $ag['inicial'] }}
                            </div>

                            <div class="flex-1 cursor-default">
                                <p class="font-medium text-slate-900">{{ $ag['nome'] }}</p>
                                <p class="text-xs text-slate-400 mt-1">{{ $ag['servico'] }}</p>
                            </div>

                            <span class="text-xs px-3 py-1.5 rounded-full
                                         {{ $ag['status'] === 'Confirmado'
                                                ? 'bg-emerald-50 text-emerald-600'
                                                : 'bg-amber-50 text-amber-600' }}">
                                {{ $ag['status'] }}
                            </span>

                            <!-- TOOLTIP DO CLIENTE: abre pra cima (flip) quando não há espaço embaixo -->
                            <div x-show="open" x-cloak x-transition
                                 :class="flip ? 'bottom-full mb-1' : 'top-full mt-1'"
                                 class="absolute left-28 z-50 w-64
                                        bg-white border border-purple-100 rounded-xl shadow-xl p-4">
                                <p class="text-sm font-semibold text-slate-900">{{ $ag['nome'] }}</p>
                                <p class="text-xs text-slate-500 mt-2 flex items-center gap-2">
                                    <span class="text-purple-500">☏</span> {{ $ag['telefone'] }}
                                </p>
                                <p class="text-xs text-slate-500 mt-1 flex items-center gap-2">
                                    <span class="text-purple-500">✉</span> {{ $ag['email'] }}
                                </p>
                            </div>

                        </div>
                    @empty
                        <div class="px-6 py-10 text-center text-sm text-slate-400">
                            Nenhum agendamento encontrado para esse filtro.
                        </div>
                    @endforelse

                </div>

            </div>

            {{-- Se $agendamentos for um paginator do Laravel (ideal para dados reais), exiba os links: --}}
            {{-- <div class="mt-6">{{ $agendamentos->links() }}</div> --}}

        </div>

    </main>

</div>

@endsection