@extends('portfolio.Estetica.layout')

@section('titulo', 'Maquinário')
@section('subtitulo', 'Aparelhos por sala e status de manutenção')

@section('conteudo')

    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <p class="text-sm text-aura-600">
            {{ count($salas) }} salas cadastradas ·
            {{ collect($salas)->sum(fn($s) => count($s['aparelhos'])) }} aparelhos no total
        </p>
        <button @click="$dispatch('abrir-aviso')"
                class="text-sm font-medium bg-aura-600 hover:bg-aura-700 text-white rounded-xl px-4 py-2 transition">
            + Cadastrar aparelho
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @foreach ($salas as $sala)
            <div class="bg-white rounded-2xl border border-aura-100 overflow-hidden">
                <div class="px-5 py-4 border-b border-aura-100 flex items-center justify-between">
                    <h2 class="font-display text-lg text-aura-800">{{ $sala['nome'] }}</h2>
                    <span class="text-xs text-aura-400">{{ count($sala['aparelhos']) }} itens</span>
                </div>

                <div class="divide-y divide-aura-50">
                    @foreach ($sala['aparelhos'] as $aparelho)
                        @php
                            $cores = [
                                'Ativo'      => 'bg-emerald-50 text-emerald-600',
                                'Manutenção' => 'bg-amber-50 text-amber-600',
                                'Inativo'    => 'bg-gray-100 text-gray-500',
                            ];
                        @endphp
                        <div class="px-5 py-4">
                            <div class="flex items-start justify-between gap-2">
                                <p class="font-medium text-aura-800">{{ $aparelho['nome'] }}</p>
                                <span class="text-xs font-medium px-2.5 py-1 rounded-full whitespace-nowrap {{ $cores[$aparelho['status']] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ $aparelho['status'] }}
                                </span>
                            </div>
                            <p class="text-xs text-aura-500 mt-1">Responsável: {{ $aparelho['responsavel'] }}</p>
                            <div class="flex items-center justify-between mt-3">
                                <p class="text-xs text-aura-400">
                                    Próx. manutenção: <span class="text-aura-600">{{ $aparelho['manutencao'] }}</span>
                                </p>
                                <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-aura-600 hover:text-aura-800">
                                    Gerenciar
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

@endsection