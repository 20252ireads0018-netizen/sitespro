@extends('portfolio.Consultoria.layout')

@section('titulo', 'Agendamento')
@section('subtitulo', 'Marque uma reunião com um dos nossos consultores')

@section('conteudo')

    @php
        $lista = collect($horarios)->sortBy('data');
        $disponiveis = $lista->where('disponivel', true)->count();
    @endphp

    {{-- Resumo --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Horários na semana</p>
            <p class="font-display text-4xl text-studio-900">{{ $lista->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Disponíveis</p>
            <p class="font-display text-4xl text-emerald-600">{{ $disponiveis }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Consultores</p>
            <p class="font-display text-4xl text-studio-900">{{ count($consultores) }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Reuniões confirmadas</p>
            <p class="font-display text-4xl text-studio-900">{{ count($proximasReunioes) }}</p>
        </div>
    </div>

    <div x-data="{ consultor: 'Todos' }">

        {{-- Filtro por consultor --}}
        <div class="flex flex-wrap items-center gap-2 mb-6">
            <button @click="consultor = 'Todos'"
                    :class="consultor === 'Todos' ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                    class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                Todos
            </button>
            @foreach ($consultores as $c)
                <button @click="consultor = @js($c)"
                        :class="consultor === @js($c) ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                        class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                    {{ $c }}
                </button>
            @endforeach
        </div>

        {{-- Horários disponíveis --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-10">
            @foreach ($lista as $h)
                <button @click="$dispatch('abrir-aviso')"
                        x-show="consultor === 'Todos' || consultor === @js($h['consultor'])"
                        :disabled="{{ $h['disponivel'] ? 'false' : 'true' }}"
                        class="text-left bg-white rounded-lg border p-4 transition
                               {{ $h['disponivel']
                                    ? 'border-studio-200 hover:border-selo-300'
                                    : 'border-studio-100 opacity-50 cursor-not-allowed' }}">
                    <p class="text-xs text-studio-400">{{ $h['data']->translatedFormat('D, d/m') }}</p>
                    <p class="font-display text-2xl text-studio-900 mt-0.5">{{ $h['hora'] }}</p>
                    <p class="text-xs text-studio-500 mt-2">{{ $h['consultor'] }}</p>
                    <span class="inline-block mt-3 text-xs font-medium px-2.5 py-1 rounded-full {{ $h['disponivel'] ? 'bg-emerald-50 text-emerald-700' : 'bg-studio-100 text-studio-500' }}">
                        {{ $h['disponivel'] ? 'Disponível' : 'Ocupado' }}
                    </span>
                </button>
            @endforeach
        </div>
    </div>

    {{-- Próximas reuniões --}}
    <div>
        <h2 class="font-display text-2xl text-studio-900 mb-5">Próximas reuniões confirmadas</h2>

        <div class="bg-white rounded-lg border border-studio-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-studio-50 text-studio-500 text-xs">
                            <th class="text-left font-medium px-5 py-3">Cliente</th>
                            <th class="text-left font-medium px-5 py-3">Consultor</th>
                            <th class="text-left font-medium px-5 py-3">Assunto</th>
                            <th class="text-left font-medium px-5 py-3">Quando</th>
                            <th class="text-right font-medium px-5 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-studio-100">
                        @foreach ($proximasReunioes as $r)
                            <tr class="hover:bg-studio-50 transition">
                                <td class="px-5 py-3 whitespace-nowrap font-medium text-studio-900">{{ $r['cliente'] }}</td>
                                <td class="px-5 py-3 whitespace-nowrap text-studio-500">{{ $r['consultor'] }}</td>
                                <td class="px-5 py-3 text-studio-700">{{ $r['assunto'] }}</td>
                                <td class="px-5 py-3 whitespace-nowrap text-studio-500">{{ $r['data']->format('d/m/Y \à\s H:i') }}</td>
                                <td class="px-5 py-3 text-right whitespace-nowrap">
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-selo-600 hover:text-selo-700 mr-3">Reagendar</button>
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-studio-400 hover:text-red-500">Cancelar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection