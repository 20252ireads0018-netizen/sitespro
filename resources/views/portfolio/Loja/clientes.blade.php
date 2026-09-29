@extends('portfolio.Loja.layout')

@section('titulo', 'Contatos de clientes')
@section('subtitulo', 'Histórico de compras e relacionamento')

@section('conteudo')

    @php
        $lista = collect($clientes)->sortByDesc('gastoTotal');
        $vips = $lista->where('vip', true)->count();
        $moeda = fn ($v) => 'R$ ' . number_format($v, 2, ',', '.');
    @endphp

    {{-- Resumo --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Clientes cadastradas</p>
            <p class="font-display text-4xl text-studio-900" style="-webkit-text-fill-color: currentColor; background: none;">{{ $lista->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Clientes VIP</p>
            <p class="font-display text-4xl text-rosa-600" style="-webkit-text-fill-color: currentColor; background: none;">{{ $vips }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Pedidos totais</p>
            <p class="font-display text-4xl text-studio-900" style="-webkit-text-fill-color: currentColor; background: none;">{{ $lista->sum('totalPedidos') }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Faturamento por clientes</p>
            <p class="font-display text-3xl text-studio-900" style="-webkit-text-fill-color: currentColor; background: none;">{{ $moeda($lista->sum('gastoTotal')) }}</p>
        </div>
    </div>

    <div x-data="{ busca: '' }">
        <div class="flex items-center justify-between gap-3 mb-4">
            <input type="search" x-model="busca" placeholder="Buscar por nome"
                   class="text-sm border border-studio-200 rounded-md px-4 py-2 w-64 text-studio-800 placeholder-studio-400 focus:outline-none focus:ring-2 focus:ring-rosa-100 focus:border-rosa-400">
            <button @click="$dispatch('abrir-aviso')"
                    class="text-sm font-medium bg-rosa-600 hover:bg-rosa-700 text-white rounded-md px-4 py-2 transition">
                + Nova cliente
            </button>
        </div>

        <div class="bg-white rounded-lg border border-studio-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-studio-50 text-studio-500 text-xs">
                            <th class="text-left font-medium px-5 py-3">Nome</th>
                            <th class="text-left font-medium px-5 py-3">Contato</th>
                            <th class="text-right font-medium px-5 py-3">Pedidos</th>
                            <th class="text-right font-medium px-5 py-3">Total gasto</th>
                            <th class="text-left font-medium px-5 py-3">Última compra</th>
                            <th class="text-right font-medium px-5 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-studio-100">
                        @foreach ($lista as $c)
                            <tr class="hover:bg-studio-50 transition" x-show="@js(Str::lower($c['nome'])).includes(busca.toLowerCase())">
                                <td class="px-5 py-3 whitespace-nowrap font-medium text-studio-900">
                                    {{ $c['nome'] }}
                                    @if ($c['vip'])
                                        <span class="ml-1.5 text-xs font-medium px-2 py-0.5 rounded-full bg-rosa-50 text-rosa-700">VIP</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3">
                                    <p class="text-studio-700">{{ $c['telefone'] }}</p>
                                    <p class="text-xs text-studio-400">{{ $c['email'] }}</p>
                                </td>
                                <td class="px-5 py-3 text-right whitespace-nowrap text-studio-700">{{ $c['totalPedidos'] }}</td>
                                <td class="px-5 py-3 text-right whitespace-nowrap font-medium text-studio-900">{{ $moeda($c['gastoTotal']) }}</td>
                                <td class="px-5 py-3 whitespace-nowrap text-studio-500">{{ $c['ultimaCompra']->diffForHumans() }}</td>
                                <td class="px-5 py-3 text-right whitespace-nowrap">
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-rosa-600 hover:text-rosa-700 mr-3">Ligar</button>
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-studio-500 hover:text-studio-900">WhatsApp</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection