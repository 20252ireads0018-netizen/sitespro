@extends('portfolio.Estetica.layout')

@section('titulo', 'Financeiro')
@section('subtitulo', $mesAtual)

@section('conteudo')

    {{-- Cards de resumo --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-2xl p-5 border border-aura-100">
            <p class="text-xs text-aura-500 mb-1">Faturamento no mês</p>
            <p class="font-display text-3xl text-aura-800">R$ {{ number_format($resumoMes['faturamento'], 2, ',', '.') }}</p>
            <p class="text-xs mt-1 {{ $resumoMes['variacaoFaturamento'] >= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                {{ $resumoMes['variacaoFaturamento'] >= 0 ? '+' : '' }}{{ $resumoMes['variacaoFaturamento'] }}% vs. mês anterior
            </p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-aura-100">
            <p class="text-xs text-aura-500 mb-1">Gastos no mês</p>
            <p class="font-display text-3xl text-aura-800">R$ {{ number_format($resumoMes['gastos'], 2, ',', '.') }}</p>
            <p class="text-xs mt-1 {{ $resumoMes['variacaoGastos'] <= 0 ? 'text-emerald-600' : 'text-red-500' }}">
                {{ $resumoMes['variacaoGastos'] >= 0 ? '+' : '' }}{{ $resumoMes['variacaoGastos'] }}% vs. mês anterior
            </p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-aura-100">
            <p class="text-xs text-aura-500 mb-1">Agendamentos no mês</p>
            <p class="font-display text-3xl text-aura-800">{{ $resumoMes['agendamentosMes'] }}</p>
            <p class="text-xs mt-1 text-emerald-600">+{{ $resumoMes['variacaoAgendamentos'] }}% vs. mês anterior</p>
        </div>
    </div>

    {{-- Gráfico simples (barras em CSS, sem libs externas) --}}
    <div class="bg-white rounded-2xl border border-aura-100 p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-display text-xl text-aura-800">Faturamento x Gastos por semana</h2>
            <button @click="$dispatch('abrir-aviso')"
                    class="text-sm font-medium border border-aura-200 text-aura-700 rounded-xl px-4 py-2 hover:bg-aura-50 transition">
                Exportar relatório
            </button>
        </div>

        @php $maxValor = max(array_map(fn($s) => max($s['faturamento'], $s['gastos']), $serieMes)); @endphp

        <div class="flex items-end justify-between gap-6 h-48 px-2">
            @foreach ($serieMes as $semana)
                <div class="flex-1 flex flex-col items-center gap-2">
                    <div class="w-full flex items-end justify-center gap-1.5 h-40">
                        <div class="w-4 sm:w-6 rounded-t-md bg-aura-500"
                             style="height: {{ max(6, round($semana['faturamento'] / $maxValor * 100)) }}%"
                             title="Faturamento: R$ {{ number_format($semana['faturamento'], 2, ',', '.') }}"></div>
                        <div class="w-4 sm:w-6 rounded-t-md bg-gold-500"
                             style="height: {{ max(6, round($semana['gastos'] / $maxValor * 100)) }}%"
                             title="Gastos: R$ {{ number_format($semana['gastos'], 2, ',', '.') }}"></div>
                    </div>
                    <p class="text-xs text-aura-500">{{ $semana['label'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="flex items-center gap-6 justify-center mt-6 text-xs text-aura-600">
            <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-aura-500"></span> Faturamento</span>
            <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-gold-500"></span> Gastos</span>
        </div>
    </div>

    {{-- Pagamentos recentes --}}
    <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
        <h2 class="font-display text-xl text-aura-800">Pagamentos recentes</h2>
        <button @click="$dispatch('abrir-aviso')"
                class="text-sm font-medium bg-aura-600 hover:bg-aura-700 text-white rounded-xl px-4 py-2 transition">
            + Lançar pagamento
        </button>
    </div>

    <div class="bg-white rounded-2xl border border-aura-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-aura-50/60 text-aura-500 text-xs uppercase tracking-wide">
                        <th class="text-left font-medium px-5 py-3">Cliente</th>
                        <th class="text-left font-medium px-5 py-3">Procedimento</th>
                        <th class="text-left font-medium px-5 py-3">Data</th>
                        <th class="text-left font-medium px-5 py-3">Forma</th>
                        <th class="text-right font-medium px-5 py-3">Valor</th>
                        <th class="text-right font-medium px-5 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-aura-50">
                    @foreach ($pagamentos as $pgto)
                        <tr class="hover:bg-aura-50/40 transition">
                            <td class="px-5 py-3 whitespace-nowrap font-medium text-aura-800">{{ $pgto['nome'] }}</td>
                            <td class="px-5 py-3 text-aura-700">{{ $pgto['procedimento'] }}</td>
                            <td class="px-5 py-3 whitespace-nowrap text-aura-700">{{ $pgto['dia'] }}</td>
                            <td class="px-5 py-3 whitespace-nowrap">
                                <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-aura-50 text-aura-600">{{ $pgto['forma'] }}</span>
                            </td>
                            <td class="px-5 py-3 text-right whitespace-nowrap font-medium text-aura-800">
                                R$ {{ number_format($pgto['valor'], 2, ',', '.') }}
                            </td>
                            <td class="px-5 py-3 text-right whitespace-nowrap">
                                <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-aura-600 hover:text-aura-800">Detalhes</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection