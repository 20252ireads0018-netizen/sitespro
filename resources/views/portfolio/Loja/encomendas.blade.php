@extends('portfolio.Loja.layout')

@section('titulo', 'Encomendas')
@section('subtitulo', 'Pedidos feitos pelas clientes')

@section('conteudo')

    @php
        $lista = collect($encomendas)->sortByDesc('data');
        $emAndamento = $lista->whereIn('status', ['Em separação', 'Pronto para retirada', 'A caminho']);
        $faturamento = $lista->where('status', '!=', 'Cancelada')->sum('valor');

        $coresStatus = [
            'Em separação'         => 'bg-amber-50 text-amber-700',
            'Pronto para retirada' => 'bg-sky-50 text-sky-700',
            'A caminho'            => 'bg-rosa-50 text-rosa-700',
            'Entregue'              => 'bg-emerald-50 text-emerald-700',
            'Cancelada'             => 'bg-studio-100 text-studio-500',
        ];

        $moeda = fn ($v) => 'R$ ' . number_format($v, 2, ',', '.');
    @endphp

    {{-- Resumo --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Encomendas</p>
            <p class="font-display text-4xl text-studio-900" style="-webkit-text-fill-color: currentColor; background: none;">{{ $lista->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Em andamento</p>
            <p class="font-display text-4xl text-rosa-600" style="-webkit-text-fill-color: currentColor; background: none;">{{ $emAndamento->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Faturamento</p>
            <p class="font-display text-3xl text-studio-900" style="-webkit-text-fill-color: currentColor; background: none;">{{ $moeda($faturamento) }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Canceladas</p>
            <p class="font-display text-4xl text-studio-900" style="-webkit-text-fill-color: currentColor; background: none;">{{ $lista->where('status', 'Cancelada')->count() }}</p>
        </div>
    </div>

    <div x-data="{ filtro: 'Todos' }">

        <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
            <div class="flex gap-2 overflow-x-auto">
                @foreach (['Todos', 'Em separação', 'Pronto para retirada', 'A caminho', 'Entregue', 'Cancelada'] as $opcao)
                    <button @click="filtro = @js($opcao)"
                            :class="filtro === @js($opcao) ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                            class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                        {{ $opcao }}
                    </button>
                @endforeach
            </div>
            <button @click="$dispatch('abrir-aviso')"
                    class="text-sm font-medium bg-rosa-600 hover:bg-rosa-700 text-white rounded-md px-4 py-2 transition">
                + Nova encomenda
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($lista as $e)
                <article x-show="filtro === 'Todos' || filtro === @js($e['status'])"
                         class="bg-white rounded-lg border border-studio-200 p-5 flex flex-col">

                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-xs text-studio-400">Encomenda #{{ $e['numero'] }}</p>
                            <h2 class="font-display text-xl text-studio-900 leading-tight mt-0.5" style="-webkit-text-fill-color: currentColor; background: none;">{{ $e['cliente'] }}</h2>
                        </div>
                        <span class="text-xs font-medium px-2.5 py-1 rounded-full whitespace-nowrap {{ $coresStatus[$e['status']] }}">
                            {{ $e['status'] }}
                        </span>
                    </div>

                    <p class="text-xs text-studio-400 mt-2">{{ $e['contato'] }}</p>

                    <ul class="mt-4 pt-4 border-t border-studio-100 space-y-1 text-sm text-studio-700">
                        @foreach ($e['itens'] as $item)
                            <li>{{ $item['qtd'] }}x {{ $item['nome'] }} (tam. {{ $item['tamanho'] }})</li>
                        @endforeach
                    </ul>

                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-studio-100 text-sm">
                        <div>
                            <p class="text-studio-400 text-xs">{{ $e['pagamento'] }} · {{ $e['entrega'] }}</p>
                            <p class="text-studio-400 text-xs mt-0.5">{{ $e['data']->diffForHumans() }}</p>
                        </div>
                        <p class="font-display text-lg text-studio-900" style="-webkit-text-fill-color: currentColor; background: none;">{{ $moeda($e['valor']) }}</p>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <button @click="$dispatch('abrir-aviso')" class="text-sm font-medium text-rosa-600 hover:text-rosa-700">
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