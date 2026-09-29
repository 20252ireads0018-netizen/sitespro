@extends('portfolio.Delivery.layout')

@section('titulo', 'Entregadores')
@section('subtitulo', 'Equipe de entrega e status em tempo real')

@section('conteudo')

    @php
        $lista = collect($entregadores);
        $online = $lista->where('status', 'Online')->count();
        $totalEntregas = $lista->sum('entregasHoje');

        $coresStatus = [
            'Online'   => 'bg-emerald-50 text-emerald-700',
            'Em pausa' => 'bg-amber-50 text-amber-700',
            'Offline'  => 'bg-studio-100 text-studio-500',
        ];
    @endphp

    {{-- Resumo --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Entregadores</p>
            <p class="font-display text-4xl text-studio-900">{{ $lista->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Online agora</p>
            <p class="font-display text-4xl text-emerald-600">{{ $online }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Entregas hoje</p>
            <p class="font-display text-4xl text-studio-900">{{ $totalEntregas }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Avaliação média</p>
            <p class="font-display text-4xl text-studio-900">{{ number_format($lista->avg('avaliacao'), 1, ',', '.') }}</p>
        </div>
    </div>

    <div class="flex items-center justify-end mb-5">
        <button @click="$dispatch('abrir-aviso')"
                class="text-sm font-medium bg-brasa-600 hover:bg-brasa-700 text-white rounded-md px-4 py-2 transition">
            + Novo entregador
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach ($lista as $e)
            <article class="bg-white rounded-lg border border-studio-200 p-5">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 shrink-0 rounded-full bg-studio-100 text-studio-700 font-medium flex items-center justify-center">
                            {{ Str::substr($e['nome'], 0, 1) }}
                        </div>
                        <div>
                            <h2 class="font-medium text-studio-900 leading-tight">{{ $e['nome'] }}</h2>
                            <p class="text-xs text-studio-500 mt-0.5">{{ $e['veiculo'] }} · {{ $e['placa'] }}</p>
                        </div>
                    </div>
                    <span class="text-xs font-medium px-2.5 py-1 rounded-full whitespace-nowrap {{ $coresStatus[$e['status']] }}">
                        {{ $e['status'] }}
                    </span>
                </div>

                <dl class="grid grid-cols-3 gap-3 mt-5 pt-4 border-t border-studio-100 text-sm">
                    <div>
                        <dt class="text-xs text-studio-400">Entregas hoje</dt>
                        <dd class="text-studio-700 font-medium">{{ $e['entregasHoje'] }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-studio-400">Avaliação</dt>
                        <dd class="text-studio-700 font-medium">{{ number_format($e['avaliacao'], 1, ',', '.') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-studio-400">Telefone</dt>
                        <dd class="text-studio-700 font-medium truncate">{{ $e['telefone'] }}</dd>
                    </div>
                </dl>

                <div class="flex items-center gap-2 mt-4">
                    <button @click="$dispatch('abrir-aviso')" class="flex-1 text-xs font-medium border border-studio-200 text-studio-700 rounded-md py-2 hover:bg-studio-100 transition">
                        Ligar
                    </button>
                    <button @click="$dispatch('abrir-aviso')" class="flex-1 text-xs font-medium border border-studio-200 text-studio-700 rounded-md py-2 hover:bg-studio-100 transition">
                        Enviar rota
                    </button>
                </div>
            </article>
        @endforeach
    </div>

@endsection