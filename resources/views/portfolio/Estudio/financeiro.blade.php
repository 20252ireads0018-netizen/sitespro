@extends('portfolio.Estudio.layout')

@section('titulo', 'Financeiro')
@section('subtitulo', 'Entradas, saídas e o que ainda está por receber')

@section('conteudo')

    @php
        $lista    = collect($lancamentos)->sortByDesc('data');
        $receita  = $lista->where('tipo', 'Entrada')->where('status', 'Pago')->sum('valor');
        $despesa  = $lista->where('tipo', 'Saída')->where('status', 'Pago')->sum('valor');
        $aReceber = $lista->where('tipo', 'Entrada')->whereIn('status', ['Pendente', 'Atrasado'])->sum('valor');
        $saldo    = $receita - $despesa;

        $maxMes = max(collect($meses)->max('receita'), collect($meses)->max('despesa'), 1);

        $coresStatus = [
            'Pago'     => 'bg-emerald-50 text-emerald-700',
            'Pendente' => 'bg-amber-50 text-amber-700',
            'Atrasado' => 'bg-red-50 text-red-600',
        ];

        $moeda = fn ($v) => 'R$ ' . number_format($v, 2, ',', '.');
    @endphp

    {{-- Resumo --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Receita recebida</p>
            <p class="font-display text-3xl text-studio-900">{{ $moeda($receita) }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Despesas pagas</p>
            <p class="font-display text-3xl text-studio-900">{{ $moeda($despesa) }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Saldo</p>
            <p class="font-display text-3xl {{ $saldo >= 0 ? 'text-emerald-700' : 'text-red-600' }}">{{ $moeda($saldo) }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">A receber</p>
            <p class="font-display text-3xl text-planta-600">{{ $moeda($aReceber) }}</p>
        </div>
    </div>

    {{-- Gráfico --}}
    <div class="bg-white rounded-lg border border-studio-200 p-5 sm:p-6 mb-8">
        <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
            <h2 class="font-display text-2xl text-studio-900">Últimos seis meses</h2>
            <div class="flex items-center gap-4 text-xs text-studio-500">
                <span class="inline-flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-planta-500"></span>Receita</span>
                <span class="inline-flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-studio-300"></span>Despesa</span>
            </div>
        </div>

        <div class="grid grid-cols-6 gap-3 sm:gap-6">
            @foreach ($meses as $m)
                <div>
                    <div class="h-40 flex items-end justify-center gap-1.5 border-b border-studio-200">
                        <div class="w-full max-w-[28px] bg-planta-500 rounded-t-sm" style="height: {{ round($m['receita'] / $maxMes * 100) }}%"
                             title="Receita: {{ $moeda($m['receita']) }}"></div>
                        <div class="w-full max-w-[28px] bg-studio-300 rounded-t-sm" style="height: {{ round($m['despesa'] / $maxMes * 100) }}%"
                             title="Despesa: {{ $moeda($m['despesa']) }}"></div>
                    </div>
                    <p class="text-xs text-studio-500 text-center mt-2">{{ $m['mes'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Lançamentos --}}
    <div x-data="{ tipo: 'Todos' }">
        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
            <div class="flex gap-2">
                @foreach (['Todos', 'Entrada', 'Saída'] as $opcao)
                    <button @click="tipo = '{{ $opcao }}'"
                            :class="tipo === '{{ $opcao }}' ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                            class="text-xs font-medium border rounded-full px-4 py-1.5 transition">
                        {{ $opcao === 'Todos' ? 'Todos' : $opcao . 's' }}
                    </button>
                @endforeach
            </div>
            <div class="flex gap-2">
                <button @click="$dispatch('abrir-aviso')"
                        class="text-sm font-medium border border-studio-200 text-studio-700 rounded-md px-4 py-2 hover:bg-studio-100 transition">
                    Exportar
                </button>
                <button @click="$dispatch('abrir-aviso')"
                        class="text-sm font-medium bg-planta-600 hover:bg-planta-700 text-white rounded-md px-4 py-2 transition">
                    + Novo lançamento
                </button>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-studio-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-studio-50 text-studio-500 text-xs">
                            <th class="text-left font-medium px-5 py-3">Data</th>
                            <th class="text-left font-medium px-5 py-3">Descrição</th>
                            <th class="text-left font-medium px-5 py-3">Projeto</th>
                            <th class="text-right font-medium px-5 py-3">Valor</th>
                            <th class="text-left font-medium px-5 py-3">Situação</th>
                            <th class="text-right font-medium px-5 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-studio-100">
                        @foreach ($lista as $l)
                            <tr class="hover:bg-studio-50 transition" x-show="tipo === 'Todos' || tipo === @js($l['tipo'])">
                                <td class="px-5 py-3 whitespace-nowrap text-studio-700">{{ $l['data']->format('d/m/Y') }}</td>
                                <td class="px-5 py-3 text-studio-900 font-medium">{{ $l['descricao'] }}</td>
                                <td class="px-5 py-3 whitespace-nowrap text-studio-500">{{ $l['projeto'] }}</td>
                                <td class="px-5 py-3 whitespace-nowrap text-right font-medium {{ $l['tipo'] === 'Entrada' ? 'text-emerald-700' : 'text-studio-700' }}">
                                    {{ $l['tipo'] === 'Entrada' ? '+' : '-' }} {{ $moeda($l['valor']) }}
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap">
                                    <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $coresStatus[$l['status']] ?? 'bg-studio-100 text-studio-600' }}">
                                        {{ $l['status'] }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-right whitespace-nowrap">
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-planta-600 hover:text-planta-700 mr-3">Editar</button>
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-studio-400 hover:text-red-500">Excluir</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection