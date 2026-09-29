@extends('portfolio.Estudio.layout')

@section('titulo', 'Contatos')
@section('subtitulo', 'Clientes, fornecedores, consultores e construtoras')

@section('conteudo')

    @php
        $lista = collect($contatos);
        $tipos = $lista->pluck('tipo')->unique()->values();

        $coresTipo = [
            'Cliente'     => 'bg-planta-50 text-planta-700',
            'Fornecedor'  => 'bg-amber-50 text-amber-700',
            'Consultor'   => 'bg-violet-50 text-violet-700',
            'Construtora' => 'bg-emerald-50 text-emerald-700',
        ];
    @endphp

    <div x-data="{ tipo: 'Todos', busca: '' }">

        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
            <div class="flex gap-2 overflow-x-auto">
                <button @click="tipo = 'Todos'"
                        :class="tipo === 'Todos' ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                        class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                    Todos
                </button>
                @foreach ($tipos as $t)
                    <button @click="tipo = @js($t)"
                            :class="tipo === @js($t) ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                            class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                        {{ $t }}
                    </button>
                @endforeach
            </div>

            <div class="flex gap-2">
                <input type="search" x-model="busca" placeholder="Buscar por nome ou empresa"
                       class="text-sm border border-studio-200 rounded-md px-4 py-2 w-56 text-studio-800 placeholder-studio-400 focus:outline-none focus:ring-2 focus:ring-planta-100 focus:border-planta-400">
                <button @click="$dispatch('abrir-aviso')"
                        class="text-sm font-medium bg-planta-600 hover:bg-planta-700 text-white rounded-md px-4 py-2 transition">
                    + Novo contato
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach ($lista as $c)
                @php
                    $iniciais = Str::of($c['nome'])->explode(' ')->map(fn ($parte) => Str::substr($parte, 0, 1))->take(2)->implode('');
                @endphp

                <article class="bg-white rounded-lg border border-studio-200 p-5"
                         x-show="(tipo === 'Todos' || tipo === @js($c['tipo'])) && @js(Str::lower($c['nome'] . ' ' . $c['empresa'])).includes(busca.toLowerCase())">

                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 shrink-0 rounded-full bg-studio-100 text-studio-700 font-medium flex items-center justify-center">
                            {{ $iniciais }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-2">
                                <h2 class="font-medium text-studio-900 leading-tight">{{ $c['nome'] }}</h2>
                                <span class="text-xs font-medium px-2.5 py-1 rounded-full whitespace-nowrap {{ $coresTipo[$c['tipo']] ?? 'bg-studio-100 text-studio-600' }}">
                                    {{ $c['tipo'] }}
                                </span>
                            </div>
                            <p class="text-sm text-studio-500 mt-0.5">{{ $c['cargo'] }} · {{ $c['empresa'] }}</p>
                        </div>
                    </div>

                    <dl class="mt-4 pt-4 border-t border-studio-100 space-y-2 text-sm">
                        <div class="flex justify-between gap-3">
                            <dt class="text-studio-400">Telefone</dt>
                            <dd class="text-studio-700">{{ $c['telefone'] }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt class="text-studio-400">E-mail</dt>
                            <dd class="text-studio-700 truncate">{{ $c['email'] }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt class="text-studio-400">Projeto</dt>
                            <dd class="text-studio-700">{{ $c['projeto'] }}</dd>
                        </div>
                    </dl>

                    <div class="flex items-center gap-2 mt-4">
                        <button @click="$dispatch('abrir-aviso')"
                                class="flex-1 text-xs font-medium border border-studio-200 text-studio-700 rounded-md py-2 hover:bg-studio-100 transition">
                            Ligar
                        </button>
                        <button @click="$dispatch('abrir-aviso')"
                                class="flex-1 text-xs font-medium border border-studio-200 text-studio-700 rounded-md py-2 hover:bg-studio-100 transition">
                            Enviar e-mail
                        </button>
                        <button @click="$dispatch('abrir-aviso')"
                                class="text-xs font-medium text-planta-600 hover:text-planta-700 px-2">
                            Editar
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

@endsection