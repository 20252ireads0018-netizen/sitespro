@extends('portfolio.Delivery.layout')

@section('titulo', 'Pedidos')
@section('subtitulo', 'Acompanhe o que está sendo preparado e entregue agora')

@section('conteudo')

    @php
        $lista = collect($pedidos)->sortByDesc('hora');
        $emAndamento = $lista->whereIn('status', ['Recebido', 'Em preparo', 'Em entrega']);
        $faturamentoHoje = $lista->where('status', '!=', 'Cancelado')->sum('valor');

        $coresStatus = [
            'Recebido'    => 'bg-sky-50 text-sky-700',
            'Em preparo'  => 'bg-amber-50 text-amber-700',
            'Em entrega'  => 'bg-brasa-50 text-brasa-700',
            'Entregue'    => 'bg-emerald-50 text-emerald-700',
            'Cancelado'   => 'bg-studio-100 text-studio-500',
        ];

        $moeda = fn ($v) => 'R$ ' . number_format($v, 2, ',', '.');
    @endphp

    {{-- Resumo --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Pedidos hoje</p>
            <p class="font-display text-4xl text-studio-900">{{ $lista->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Em andamento</p>
            <p class="font-display text-4xl text-brasa-600">{{ $emAndamento->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Faturamento do dia</p>
            <p class="font-display text-3xl text-studio-900">{{ $moeda($faturamentoHoje) }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Cancelados</p>
            <p class="font-display text-4xl text-studio-900">{{ $lista->where('status', 'Cancelado')->count() }}</p>
        </div>
    </div>

    <div x-data="{ filtro: 'Todos' }">

        <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
            <div class="flex gap-2 overflow-x-auto">
                @foreach (['Todos', 'Recebido', 'Em preparo', 'Em entrega', 'Entregue', 'Cancelado'] as $opcao)
                    <button @click="filtro = @js($opcao)"
                            :class="filtro === @js($opcao) ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                            class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                        {{ $opcao }}
                    </button>
                @endforeach
            </div>
            <button @click="$dispatch('abrir-aviso')"
                    class="text-sm font-medium bg-brasa-600 hover:bg-brasa-700 text-white rounded-md px-4 py-2 transition">
                + Novo pedido
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($lista as $p)
                <article x-show="filtro === 'Todos' || filtro === @js($p['status'])"
                         class="bg-white rounded-lg border border-studio-200 p-5 flex flex-col">

                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-xs text-studio-400">Pedido #{{ $p['numero'] }}</p>
                            <h2 class="font-display text-xl text-studio-900 leading-tight mt-0.5">{{ $p['cliente'] }}</h2>
                        </div>
                        <span class="text-xs font-medium px-2.5 py-1 rounded-full whitespace-nowrap {{ $coresStatus[$p['status']] }}">
                            {{ $p['status'] }}
                        </span>
                    </div>

                    <div class="mt-3 text-sm text-studio-600">
                        <p>{{ $p['endereco'] }}</p>
                        <p class="text-studio-400 text-xs mt-0.5">{{ $p['telefone'] }}</p>
                    </div>

                    <ul class="mt-4 pt-4 border-t border-studio-100 space-y-1 text-sm text-studio-700">
                        @foreach ($p['itens'] as $item)
                            <li class="flex justify-between">
                                <span>{{ $item['qtd'] }}x {{ $item['nome'] }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-studio-100 text-sm">
                        <div>
                            <p class="text-studio-400 text-xs">{{ $p['pagamento'] }} · {{ $p['hora']->diffForHumans() }}</p>
                            @if ($p['entregador'])
                                <p class="text-studio-500 text-xs mt-0.5">Entregador: {{ $p['entregador'] }}</p>
                            @endif
                        </div>
                        <p class="font-display text-lg text-studio-900">{{ $moeda($p['valor']) }}</p>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <button @click="$dispatch('abrir-aviso')" class="text-sm font-medium text-brasa-600 hover:text-brasa-700">
                            Ver detalhes
                        </button>
                        <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-studio-500 hover:text-studio-900">
                            Atualizar status
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

@endsection