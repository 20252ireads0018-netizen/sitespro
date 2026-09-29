@extends('portfolio.Estudio.layout')

@section('titulo', 'Contratos')
@section('subtitulo', 'Vigência, valores e assinaturas pendentes')

@section('conteudo')

    @php
        $lista = collect($contratos);
        $limite = now()->addDays(30);

        $ativos      = $lista->where('status', 'Ativo');
        $aguardando  = $lista->where('status', 'Aguardando assinatura')->count();
        $valorAtivos = $ativos->sum('valor');
        $vencendo    = $ativos->filter(fn ($c) => $c['fim']->isBefore($limite))->count();

        $coresStatus = [
            'Ativo'                 => 'bg-emerald-50 text-emerald-700',
            'Aguardando assinatura' => 'bg-amber-50 text-amber-700',
            'Em revisão'            => 'bg-sky-50 text-sky-700',
            'Encerrado'             => 'bg-studio-100 text-studio-500',
        ];

        $moeda = fn ($v) => 'R$ ' . number_format($v, 2, ',', '.');
    @endphp

    {{-- Resumo --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Contratos ativos</p>
            <p class="font-display text-4xl text-studio-900">{{ $ativos->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Aguardando assinatura</p>
            <p class="font-display text-4xl {{ $aguardando > 0 ? 'text-amber-600' : 'text-studio-900' }}">{{ $aguardando }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Valor em contratos ativos</p>
            <p class="font-display text-3xl text-studio-900">{{ $moeda($valorAtivos) }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Terminam em 30 dias</p>
            <p class="font-display text-4xl {{ $vencendo > 0 ? 'text-red-500' : 'text-studio-900' }}">{{ $vencendo }}</p>
        </div>
    </div>

    <div x-data="{ status: 'Todos' }">

        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
            <div class="flex gap-2 overflow-x-auto">
                @foreach (['Todos', 'Ativo', 'Aguardando assinatura', 'Em revisão', 'Encerrado'] as $opcao)
                    <button @click="status = @js($opcao)"
                            :class="status === @js($opcao) ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                            class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                        {{ $opcao }}
                    </button>
                @endforeach
            </div>
            <button @click="$dispatch('abrir-aviso')"
                    class="text-sm font-medium bg-planta-600 hover:bg-planta-700 text-white rounded-md px-4 py-2 transition">
                + Novo contrato
            </button>
        </div>

        <div class="bg-white rounded-lg border border-studio-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-studio-50 text-studio-500 text-xs">
                            <th class="text-left font-medium px-5 py-3">Contrato</th>
                            <th class="text-left font-medium px-5 py-3">Cliente e projeto</th>
                            <th class="text-right font-medium px-5 py-3">Valor</th>
                            <th class="text-left font-medium px-5 py-3">Vigência</th>
                            <th class="text-left font-medium px-5 py-3">Situação</th>
                            <th class="text-right font-medium px-5 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-studio-100">
                        @foreach ($lista as $c)
                            @php
                                $terminaLogo = $c['status'] === 'Ativo' && $c['fim']->isBefore($limite);
                            @endphp
                            <tr class="hover:bg-studio-50 transition" x-show="status === 'Todos' || status === @js($c['status'])">
                                <td class="px-5 py-3 whitespace-nowrap font-medium text-studio-900">{{ $c['numero'] }}</td>
                                <td class="px-5 py-3">
                                    <p class="text-studio-900">{{ $c['cliente'] }}</p>
                                    <p class="text-xs text-studio-400">{{ $c['projeto'] }}</p>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap text-right text-studio-700">{{ $moeda($c['valor']) }}</td>
                                <td class="px-5 py-3 whitespace-nowrap">
                                    <p class="text-studio-700">{{ $c['inicio']->format('d/m/Y') }} a {{ $c['fim']->format('d/m/Y') }}</p>
                                    @if ($terminaLogo)
                                        <p class="text-xs text-red-500">Termina em breve</p>
                                    @endif
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap">
                                    <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $coresStatus[$c['status']] ?? 'bg-studio-100 text-studio-600' }}">
                                        {{ $c['status'] }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-right whitespace-nowrap">
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-planta-600 hover:text-planta-700 mr-3">Ver contrato</button>
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-studio-500 hover:text-studio-900">Baixar PDF</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection