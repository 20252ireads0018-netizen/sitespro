@extends('portfolio.Estetica.layout')

@section('titulo', 'Estoque')
@section('subtitulo', 'Produtos de maquiagem, cabelo, pele e mais')

@section('conteudo')

    @php
        $lista = collect($produtos);
        $limiteValidade = now()->addDays(60);

        $totalItens   = $lista->sum('quantidade');
        $estoqueBaixo = $lista->filter(fn ($p) => $p['quantidade'] <= $p['minimo'])->count();
        $vencendo     = $lista->filter(fn ($p) => $p['validade']->isBefore($limiteValidade))->count();
        $valorTotal   = $lista->sum(fn ($p) => $p['quantidade'] * $p['preco']);

        $categorias = $lista->pluck('categoria')->unique()->values();
    @endphp

    {{-- Cards de resumo --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-2xl p-5 border border-aura-100">
            <p class="text-xs text-aura-500 mb-1">Produtos cadastrados</p>
            <p class="font-display text-3xl text-aura-800">{{ $lista->count() }}</p>
            <p class="text-xs text-aura-400 mt-1">{{ $totalItens }} unidades em estoque</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-aura-100">
            <p class="text-xs text-aura-500 mb-1">Estoque baixo</p>
            <p class="font-display text-3xl {{ $estoqueBaixo > 0 ? 'text-amber-600' : 'text-aura-800' }}">{{ $estoqueBaixo }}</p>
            <p class="text-xs text-aura-400 mt-1">Abaixo do mínimo definido</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-aura-100">
            <p class="text-xs text-aura-500 mb-1">Vencendo em 60 dias</p>
            <p class="font-display text-3xl {{ $vencendo > 0 ? 'text-red-500' : 'text-aura-800' }}">{{ $vencendo }}</p>
            <p class="text-xs text-aura-400 mt-1">Inclui produtos já vencidos</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-aura-100">
            <p class="text-xs text-aura-500 mb-1">Valor em estoque</p>
            <p class="font-display text-3xl text-aura-800">R$ {{ number_format($valorTotal, 2, ',', '.') }}</p>
            <p class="text-xs text-aura-400 mt-1">Preço de custo</p>
        </div>
    </div>

    <div x-data="{ categoria: 'Todos', busca: '' }">

        {{-- Ações e filtros --}}
        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
            <h2 class="font-display text-xl text-aura-800">Produtos em estoque</h2>
            <div class="flex flex-wrap gap-2">
                <input type="search" x-model="busca" placeholder="Buscar produto ou marca"
                       class="text-sm border border-aura-200 rounded-xl px-4 py-2 w-56 text-aura-800 placeholder-aura-300 focus:outline-none focus:ring-2 focus:ring-aura-200">
                <button @click="$dispatch('abrir-aviso')"
                        class="text-sm font-medium border border-aura-200 text-aura-700 rounded-xl px-4 py-2 hover:bg-aura-50 transition">
                    Registrar saída
                </button>
                <button @click="$dispatch('abrir-aviso')"
                        class="text-sm font-medium bg-aura-600 hover:bg-aura-700 text-white rounded-xl px-4 py-2 transition">
                    + Novo produto
                </button>
            </div>
        </div>

        {{-- Abas de categoria --}}
        <div class="flex gap-2 overflow-x-auto pb-2 mb-4">
            <button @click="categoria = 'Todos'"
                    :class="categoria === 'Todos' ? 'bg-aura-600 text-white border-aura-600' : 'bg-white text-aura-700 border-aura-200 hover:bg-aura-50'"
                    class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                Todos
            </button>
            @foreach ($categorias as $cat)
                <button @click="categoria = '{{ $cat }}'"
                        :class="categoria === '{{ $cat }}' ? 'bg-aura-600 text-white border-aura-600' : 'bg-white text-aura-700 border-aura-200 hover:bg-aura-50'"
                        class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                    {{ $cat }}
                </button>
            @endforeach
        </div>

        {{-- Tabela --}}
        <div class="bg-white rounded-2xl border border-aura-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-aura-50/60 text-aura-500 text-xs uppercase tracking-wide">
                            <th class="text-left font-medium px-5 py-3">Produto</th>
                            <th class="text-left font-medium px-5 py-3">Categoria</th>
                            <th class="text-left font-medium px-5 py-3">Estoque</th>
                            <th class="text-left font-medium px-5 py-3">Validade</th>
                            <th class="text-right font-medium px-5 py-3">Custo unit.</th>
                            <th class="text-left font-medium px-5 py-3">Situação</th>
                            <th class="text-right font-medium px-5 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-aura-50">
                        @foreach ($lista as $p)
                            @php
                                $esgotado = $p['quantidade'] === 0;
                                $baixo    = ! $esgotado && $p['quantidade'] <= $p['minimo'];
                                $vencido  = $p['validade']->isPast();
                                $proximo  = ! $vencido && $p['validade']->isBefore($limiteValidade);

                                if ($esgotado) {
                                    $situacao = 'Esgotado';
                                    $corSituacao = 'bg-red-50 text-red-600';
                                    $corBarra = 'bg-red-400';
                                } elseif ($baixo) {
                                    $situacao = 'Estoque baixo';
                                    $corSituacao = 'bg-amber-50 text-amber-600';
                                    $corBarra = 'bg-amber-400';
                                } else {
                                    $situacao = 'Em estoque';
                                    $corSituacao = 'bg-emerald-50 text-emerald-600';
                                    $corBarra = 'bg-emerald-400';
                                }

                                $percentual = $p['minimo'] > 0
                                    ? min(100, round($p['quantidade'] / ($p['minimo'] * 3) * 100))
                                    : 100;
                            @endphp
                            <tr class="hover:bg-aura-50/40 transition"
                                x-show="(categoria === 'Todos' || categoria === '{{ $p['categoria'] }}')
                                        && ('{{ Str::lower($p['nome'] . ' ' . $p['marca']) }}').includes(busca.toLowerCase())">
                                <td class="px-5 py-3">
                                    <p class="font-medium text-aura-800">{{ $p['nome'] }}</p>
                                    <p class="text-xs text-aura-400">{{ $p['marca'] }} · {{ $p['codigo'] }}</p>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap text-aura-700">{{ $p['categoria'] }}</td>
                                <td class="px-5 py-3 whitespace-nowrap">
                                    <p class="text-aura-800 font-medium">
                                        {{ $p['quantidade'] }}
                                        <span class="text-xs font-normal text-aura-400">/ mín. {{ $p['minimo'] }}</span>
                                    </p>
                                    <div class="w-28 h-1.5 rounded-full bg-aura-50 mt-1.5 overflow-hidden">
                                        <div class="h-full rounded-full {{ $corBarra }}" style="width: {{ $percentual }}%"></div>
                                    </div>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap">
                                    <p class="{{ $vencido ? 'text-red-500 font-medium' : ($proximo ? 'text-amber-600 font-medium' : 'text-aura-700') }}">
                                        {{ $p['validade']->format('d/m/Y') }}
                                    </p>
                                    @if ($vencido)
                                        <p class="text-xs text-red-400">Vencido</p>
                                    @elseif ($proximo)
                                        <p class="text-xs text-amber-500">Vence em breve</p>
                                    @endif
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap text-right text-aura-700">
                                    R$ {{ number_format($p['preco'], 2, ',', '.') }}
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap">
                                    <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $corSituacao }}">
                                        {{ $situacao }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-right whitespace-nowrap">
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-aura-600 hover:text-aura-800 mr-3">Repor</button>
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-aura-400 hover:text-aura-700">Detalhes</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection