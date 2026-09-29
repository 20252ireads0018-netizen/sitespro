@extends('portfolio.Consultoria.layout')

@section('titulo', 'Serviços')
@section('subtitulo', 'Consultoria para pessoas físicas e empresas')

@section('conteudo')

    @php
        $lista = collect($servicos);
        $publicos = $lista->pluck('publico')->unique()->values();
    @endphp

    <div x-data="{ publico: 'Todos' }">

        <div class="flex flex-wrap items-center gap-2 mb-6">
            <button @click="publico = 'Todos'"
                    :class="publico === 'Todos' ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                    class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                Todos
            </button>
            @foreach ($publicos as $p)
                <button @click="publico = @js($p)"
                        :class="publico === @js($p) ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                        class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                    {{ $p }}
                </button>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($lista as $s)
                <article x-show="publico === 'Todos' || publico === @js($s['publico'])"
                         class="bg-white rounded-lg border border-studio-200 p-6 flex flex-col">

                    <span class="text-xs font-medium text-selo-600 bg-selo-50 rounded-full px-2.5 py-1 self-start">
                        {{ $s['publico'] }}
                    </span>
                    <h2 class="font-display text-xl text-studio-900 mt-3">{{ $s['nome'] }}</h2>
                    <p class="text-sm text-studio-600 leading-relaxed mt-2 flex-1">{{ $s['descricao'] }}</p>

                    <div class="mt-5 pt-4 border-t border-studio-100 flex items-center justify-between">
                        <p class="text-xs text-studio-400">{{ $s['duracao'] }}</p>
                        <div class="text-right">
                            <p class="text-xs text-studio-400">a partir de</p>
                            <p class="font-display text-lg text-studio-900">R$ {{ number_format($s['precoDesde'], 2, ',', '.') }}</p>
                        </div>
                    </div>

                    <button @click="$dispatch('abrir-aviso')"
                            class="mt-4 text-sm font-medium bg-selo-600 hover:bg-selo-700 text-white rounded-md py-2.5 transition">
                        Solicitar proposta
                    </button>
                </article>
            @endforeach
        </div>
    </div>

@endsection