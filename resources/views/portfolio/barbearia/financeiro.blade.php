@extends('portfolio.barbearia.appBarbearia')

@section('title', 'Financeiro')

@section('content')

<style>[x-cloak]{display:none !important;}</style>

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

            @if (Route::has('onboarding.index'))
                <a href="{{ route('onboarding.index') }}"
                   class="mt-3 flex items-center justify-center gap-2 w-full px-3 py-2 rounded-lg
                          text-xs font-medium text-purple-600 border border-purple-200
                          hover:bg-purple-50 transition-colors">
                    <span>←</span> Voltar ao onboarding
                </a>
            @endif
        </div>

    </aside>


    <main class="ml-64 flex-1 min-h-screen bg-slate-50">

        <header class="h-20 border-b border-purple-100 bg-white/80 backdrop-blur-xl
                       flex items-center justify-between px-8">
            <div>
                <p class="text-sm text-slate-400">Painel administrativo</p>
                <h2 class="text-xl font-semibold mt-1 text-slate-900">Financeiro</h2>
            </div>
        </header>

        <div class="p-8">

            @php
                $nomesMeses = [
                    1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
                    5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
                    9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro',
                ];
                $agora = now();
                $nomeMesAtual = $nomesMeses[(int) $agora->format('n')];
                $anoAtual = $agora->format('Y');

                $resumoMes = [
                    'faturamento' => 8420.00,
                    'gastos' => 2150.00,
                    'agendamentosMes' => 132,
                    'variacaoFaturamento' => 18,
                    'variacaoGastos' => -6,
                    'variacaoAgendamentos' => 9,
                ];
                $lucro = $resumoMes['faturamento'] - $resumoMes['gastos'];

                $serieMes = [
                    ['label' => 'Semana 1', 'faturamento' => 1850, 'gastos' => 480],
                    ['label' => 'Semana 2', 'faturamento' => 2100, 'gastos' => 520],
                    ['label' => 'Semana 3', 'faturamento' => 1980, 'gastos' => 560],
                    ['label' => 'Semana 4', 'faturamento' => 2490, 'gastos' => 590],
                ];
                $maxSerie = max(array_map(fn ($d) => max($d['faturamento'], $d['gastos']), $serieMes));

                // Lista de pagamentos ilustrativa.
                $pagamentos = [
                    ['nome' => 'Lucas Almeida',     'cpf' => '123.456.789-01', 'dia' => '25/09/2026', 'servico' => 'Corte masculino',       'valor' => 45.00],
                    ['nome' => 'Marcelo Souza',      'cpf' => '234.567.891-02', 'dia' => '25/09/2026', 'servico' => 'Corte + Barba',         'valor' => 70.00],
                    ['nome' => 'Thiago Lima',        'cpf' => '345.678.912-03', 'dia' => '25/09/2026', 'servico' => 'Corte masculino',       'valor' => 45.00],
                    ['nome' => 'Felipe Martins',     'cpf' => '456.789.123-04', 'dia' => '24/09/2026', 'servico' => 'Corte masculino',       'valor' => 45.00],
                    ['nome' => 'Gabriel Santos',     'cpf' => '567.891.234-05', 'dia' => '24/09/2026', 'servico' => 'Corte + Barba',         'valor' => 70.00],
                    ['nome' => 'Rafael Costa',       'cpf' => '678.912.345-06', 'dia' => '24/09/2026', 'servico' => 'Barba + Sobrancelha',   'valor' => 60.00],
                    ['nome' => 'Igor Batista',       'cpf' => '789.123.456-07', 'dia' => '23/09/2026', 'servico' => 'Sobrancelha',           'valor' => 25.00],
                    ['nome' => 'Henrique Souza',     'cpf' => '891.234.567-08', 'dia' => '23/09/2026', 'servico' => 'Corte + Barba',         'valor' => 70.00],
                    ['nome' => 'Diego Ramos',        'cpf' => '912.345.678-09', 'dia' => '22/09/2026', 'servico' => 'Barba',                 'valor' => 30.00],
                    ['nome' => 'Gabriel Santos',     'cpf' => '567.891.234-05', 'dia' => '22/09/2026', 'servico' => 'Corte + Barba',         'valor' => 70.00],
                    ['nome' => 'Eduardo Nunes',      'cpf' => '123.987.654-10', 'dia' => '21/09/2026', 'servico' => 'Sobrancelha',           'valor' => 25.00],
                    ['nome' => 'Rafael Costa',       'cpf' => '678.912.345-06', 'dia' => '21/09/2026', 'servico' => 'Barba + Sobrancelha',   'valor' => 60.00],
                    ['nome' => 'Bruno Alves',        'cpf' => '111.222.333-11', 'dia' => '20/09/2026', 'servico' => 'Corte masculino',       'valor' => 45.00],
                    ['nome' => 'Caio Pereira',       'cpf' => '222.333.444-12', 'dia' => '20/09/2026', 'servico' => 'Corte + Barba',         'valor' => 70.00],
                    ['nome' => 'Vitor Hugo',         'cpf' => '333.444.555-13', 'dia' => '19/09/2026', 'servico' => 'Barba',                 'valor' => 30.00],
                    ['nome' => 'André Luiz',         'cpf' => '444.555.666-14', 'dia' => '19/09/2026', 'servico' => 'Corte masculino',       'valor' => 45.00],
                    ['nome' => 'Renato Silva',       'cpf' => '555.666.777-15', 'dia' => '18/09/2026', 'servico' => 'Sobrancelha',           'valor' => 25.00],
                    ['nome' => 'Fábio Nogueira',     'cpf' => '666.777.888-16', 'dia' => '18/09/2026', 'servico' => 'Corte + Barba',         'valor' => 70.00],
                    ['nome' => 'Leonardo Dias',      'cpf' => '777.888.999-17', 'dia' => '17/09/2026', 'servico' => 'Barba + Sobrancelha',   'valor' => 60.00],
                    ['nome' => 'Otávio Ferreira',    'cpf' => '888.999.111-18', 'dia' => '17/09/2026', 'servico' => 'Corte masculino',       'valor' => 45.00],
                    ['nome' => 'Pedro Henrique',     'cpf' => '999.111.222-19', 'dia' => '16/09/2026', 'servico' => 'Corte + Barba',         'valor' => 70.00],
                    ['nome' => 'Wesley Moraes',      'cpf' => '111.333.555-20', 'dia' => '16/09/2026', 'servico' => 'Sobrancelha',           'valor' => 25.00],
                    ['nome' => 'Anderson Reis',      'cpf' => '222.444.666-21', 'dia' => '15/09/2026', 'servico' => 'Barba',                 'valor' => 30.00],
                    ['nome' => 'Douglas Farias',     'cpf' => '333.555.777-22', 'dia' => '15/09/2026', 'servico' => 'Corte masculino',       'valor' => 45.00],
                    ['nome' => 'Emerson Vieira',     'cpf' => '444.666.888-23', 'dia' => '14/09/2026', 'servico' => 'Corte + Barba',         'valor' => 70.00],
                    ['nome' => 'Nicolas Barbosa',    'cpf' => '555.777.999-24', 'dia' => '13/09/2026', 'servico' => 'Barba + Sobrancelha',   'valor' => 60.00],
                    ['nome' => 'Matheus Correia',    'cpf' => '666.888.111-25', 'dia' => '12/09/2026', 'servico' => 'Corte masculino',       'valor' => 45.00],
                ];

                usort($pagamentos, function ($a, $b) {
                    $dataA = \DateTime::createFromFormat('d/m/Y', $a['dia']);
                    $dataB = \DateTime::createFromFormat('d/m/Y', $b['dia']);
                    return $dataB <=> $dataA;
                });
            @endphp

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

                <div class="flex items-center justify-between rounded-xl bg-purple-600/5 border border-purple-100 px-5 py-4 mb-8">
                    <span class="text-sm text-slate-500">Lucro estimado (faturamento − gastos)</span>
                    <span class="text-lg font-bold text-purple-700">
                        R$ {{ number_format($lucro, 2, ',', '.') }}
                    </span>
                </div>

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

            <!-- LISTA DE PAGAMENTOS (paginada, 10 por página) -->
            <div class="bg-white border border-purple-100 rounded-2xl p-6 shadow-sm"
                 x-data="paginacaoPagamentos(@json($pagamentos))">

                <div class="flex items-center justify-between mb-6 flex-wrap gap-2">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Pagamentos recebidos</h2>
                        <p class="text-sm text-slate-400 mt-1">Ordenado do pagamento mais recente para o mais antigo</p>
                    </div>
                    <p class="text-xs text-slate-400" x-show="todos.length > 0">
                        Mostrando <span class="font-medium text-slate-600" x-text="rangeInicio()"></span>–<span class="font-medium text-slate-600" x-text="rangeFim()"></span>
                        de <span class="font-medium text-slate-600" x-text="todos.length"></span> pagamentos
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-xs uppercase tracking-wide text-slate-400 border-b border-purple-50">
                                <th class="py-3 pr-4 font-medium">Nome</th>
                                <th class="py-3 pr-4 font-medium">CPF</th>
                                <th class="py-3 pr-4 font-medium">Serviço</th>
                                <th class="py-3 pr-4 font-medium">Dia do pagamento</th>
                                <th class="py-3 pr-0 font-medium text-right">Valor</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-purple-50">
                            @forelse ($pagamentos as $pg)
                                <tr class="hover:bg-purple-50/50 transition-colors duration-150">
                                    <td class="py-3 pr-4 font-medium text-slate-900">
                                        {{ $pg['nome'] }}
                                    </td>

                                    <td class="py-3 pr-4 text-slate-500">
                                        {{ $pg['cpf'] }}
                                    </td>

                                    <td class="py-3 pr-4 text-slate-500">
                                        {{ $pg['servico'] }}
                                    </td>

                                    <td class="py-3 pr-4 text-slate-500">
                                        {{ $pg['dia'] }}
                                    </td>

                                    <td class="py-3 pr-0 text-right font-medium text-purple-700">
                                        R$ {{ number_format($pg['valor'], 2, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-slate-400">
                                        Nenhum pagamento registrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Controles de paginação (apenas navegação visual, não é uma ação real) -->
                <div class="flex items-center justify-between mt-6 flex-wrap gap-3" x-show="totalPaginas > 1">
                    <button type="button"
                            @click="anterior()"
                            :disabled="paginaAtual === 1"
                            :class="paginaAtual === 1 ? 'opacity-40 cursor-not-allowed' : 'hover:bg-purple-50'"
                            class="px-3 py-2 rounded-lg border border-purple-100 text-sm text-slate-600 transition-colors">
                        ← Anterior
                    </button>

                    <div class="flex items-center gap-1.5 flex-wrap justify-center">
                        <template x-for="p in paginasVisiveis" :key="p">
                            <button type="button"
                                    @click="irPara(p)"
                                    :class="p === paginaAtual
                                        ? 'bg-purple-600 text-white shadow-sm shadow-purple-200'
                                        : 'text-slate-500 hover:bg-purple-50'"
                                    class="w-9 h-9 rounded-lg text-sm font-medium transition-colors"
                                    x-text="p">
                            </button>
                        </template>
                    </div>

                    <button type="button"
                            @click="proxima()"
                            :disabled="paginaAtual === totalPaginas"
                            :class="paginaAtual === totalPaginas ? 'opacity-40 cursor-not-allowed' : 'hover:bg-purple-50'"
                            class="px-3 py-2 rounded-lg border border-purple-100 text-sm text-slate-600 transition-colors">
                        Próxima →
                    </button>
                </div>

            </div>

        </div>

    </main>

</div>

<script>
    // Paginação puramente visual sobre a lista ilustrativa de pagamentos.
    function paginacaoPagamentos(dadosIniciais) {
        return {
            todos: dadosIniciais || [],
            porPagina: 10,
            paginaAtual: 1,

            get totalPaginas() {
                return Math.max(1, Math.ceil(this.todos.length / this.porPagina));
            },
            get pageItems() {
                const inicio = (this.paginaAtual - 1) * this.porPagina;
                return this.todos.slice(inicio, inicio + this.porPagina);
            },
            get paginasVisiveis() {
                const paginas = [];
                for (let i = 1; i <= this.totalPaginas; i++) {
                    paginas.push(i);
                }
                return paginas;
            },
            irPara(pagina) {
                if (pagina >= 1 && pagina <= this.totalPaginas) {
                    this.paginaAtual = pagina;
                }
            },
            anterior() {
                this.irPara(this.paginaAtual - 1);
            },
            proxima() {
                this.irPara(this.paginaAtual + 1);
            },
            rangeInicio() {
                return this.todos.length === 0 ? 0 : (this.paginaAtual - 1) * this.porPagina + 1;
            },
            rangeFim() {
                return Math.min(this.paginaAtual * this.porPagina, this.todos.length);
            },
            formatCurrency(valor) {
                return 'R$ ' + Number(valor).toLocaleString('pt-BR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });
            },
        };
    }
</script>

@endsection