@extends('portfolio.Delivery.layout')

@section('titulo', 'Veículos')
@section('subtitulo', 'Frota usada nas entregas')

@section('conteudo')

    @php
        $lista = collect($veiculos);
        $emUso = $lista->where('status', 'Em uso')->count();
        $manutencao = $lista->where('status', 'Em manutenção')->count();

        $coresStatus = [
            'Em uso'         => 'bg-emerald-50 text-emerald-700',
            'Disponível'     => 'bg-sky-50 text-sky-700',
            'Em manutenção'  => 'bg-red-50 text-red-600',
        ];
    @endphp

    {{-- Resumo --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Veículos na frota</p>
            <p class="font-display text-4xl text-studio-900">{{ $lista->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Em uso agora</p>
            <p class="font-display text-4xl text-emerald-600">{{ $emUso }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Em manutenção</p>
            <p class="font-display text-4xl {{ $manutencao > 0 ? 'text-red-500' : 'text-studio-900' }}">{{ $manutencao }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Km total rodado</p>
            <p class="font-display text-3xl text-studio-900">{{ number_format($lista->sum('km'), 0, ',', '.') }}</p>
        </div>
    </div>

    <div x-data="{ status: 'Todos' }">

        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
            <div class="flex gap-2 overflow-x-auto">
                @foreach (['Todos', 'Em uso', 'Disponível', 'Em manutenção'] as $opcao)
                    <button @click="status = @js($opcao)"
                            :class="status === @js($opcao) ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                            class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                        {{ $opcao }}
                    </button>
                @endforeach
            </div>
            <button @click="$dispatch('abrir-aviso')"
                    class="text-sm font-medium bg-brasa-600 hover:bg-brasa-700 text-white rounded-md px-4 py-2 transition">
                + Novo veículo
            </button>
        </div>

        <div class="bg-white rounded-lg border border-studio-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-studio-50 text-studio-500 text-xs">
                            <th class="text-left font-medium px-5 py-3">Placa</th>
                            <th class="text-left font-medium px-5 py-3">Tipo / Modelo</th>
                            <th class="text-left font-medium px-5 py-3">Entregador</th>
                            <th class="text-right font-medium px-5 py-3">Km rodado</th>
                            <th class="text-left font-medium px-5 py-3">Situação</th>
                            <th class="text-right font-medium px-5 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-studio-100">
                        @foreach ($lista as $v)
                            <tr class="hover:bg-studio-50 transition" x-show="status === 'Todos' || status === @js($v['status'])">
                                <td class="px-5 py-3 whitespace-nowrap font-medium text-studio-900">{{ $v['placa'] }}</td>
                                <td class="px-5 py-3">
                                    <p class="text-studio-900">{{ $v['tipo'] }}</p>
                                    <p class="text-xs text-studio-400">{{ $v['modelo'] }}</p>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap text-studio-500">{{ $v['entregador'] }}</td>
                                <td class="px-5 py-3 whitespace-nowrap text-right text-studio-700">{{ number_format($v['km'], 0, ',', '.') }} km</td>
                                <td class="px-5 py-3 whitespace-nowrap">
                                    <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $coresStatus[$v['status']] ?? 'bg-studio-100 text-studio-600' }}">
                                        {{ $v['status'] }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-right whitespace-nowrap">
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-brasa-600 hover:text-brasa-700 mr-3">Editar</button>
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-studio-400 hover:text-red-500">Remover</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection