@extends('portfolio.Estetica.layout')

@section('titulo', 'Funcionários')
@section('subtitulo', 'Equipe da clínica e atendimentos no mês')

@section('conteudo')

    @php
        $ativos = collect($funcionarios)->where('status', 'Ativo')->count();
        $totalAtendimentos = collect($funcionarios)->sum('atendimentosMes');
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-2xl p-5 border border-aura-100">
            <p class="text-xs text-aura-500 mb-1">Total de funcionários</p>
            <p class="font-display text-3xl text-aura-800">{{ count($funcionarios) }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-aura-100">
            <p class="text-xs text-aura-500 mb-1">Ativos</p>
            <p class="font-display text-3xl text-aura-800">{{ $ativos }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-aura-100">
            <p class="text-xs text-aura-500 mb-1">Atendimentos no mês</p>
            <p class="font-display text-3xl text-aura-800">{{ $totalAtendimentos }}</p>
        </div>
    </div>

    <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
        <h2 class="font-display text-xl text-aura-800">Equipe</h2>
        <button @click="$dispatch('abrir-aviso')"
                class="text-sm font-medium bg-aura-600 hover:bg-aura-700 text-white rounded-xl px-4 py-2 transition">
            + Novo funcionário
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @foreach ($funcionarios as $f)
            <div class="bg-white rounded-2xl border border-aura-100 p-5">
                <div class="flex items-start justify-between gap-2">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-full bg-aura-50 flex items-center justify-center font-display text-lg text-aura-700">
                            {{ collect(explode(' ', $f['nome']))->map(fn($p) => mb_substr($p, 0, 1))->take(2)->implode('') }}
                        </div>
                        <div>
                            <p class="font-medium text-aura-800 leading-tight">{{ $f['nome'] }}</p>
                            <p class="text-xs text-aura-500">{{ $f['cargo'] }}</p>
                        </div>
                    </div>
                    <span class="text-xs font-medium px-2.5 py-1 rounded-full whitespace-nowrap
                        {{ $f['status'] === 'Ativo' ? 'bg-emerald-50 text-emerald-600' : 'bg-gray-100 text-gray-500' }}">
                        {{ $f['status'] }}
                    </span>
                </div>

                <div class="mt-4 space-y-1 text-xs text-aura-500">
                    <p>{{ $f['telefone'] }}</p>
                    <p class="truncate">{{ $f['email'] }}</p>
                </div>

                <div class="flex items-center justify-between mt-4 pt-4 border-t border-aura-50">
                    <p class="text-xs text-aura-500">
                        Atendimentos: <span class="font-medium text-aura-700">{{ $f['atendimentosMes'] }}</span>
                    </p>
                    <div class="flex gap-3">
                        <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-aura-600 hover:text-aura-800">Editar</button>
                        <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-aura-400 hover:text-red-500">Remover</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection