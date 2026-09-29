@extends('portfolio.Loja.layout')

@section('titulo', 'Profissionais')
@section('subtitulo', 'Equipe da loja')

@section('conteudo')

    @php
        $lista = collect($profissionais);
        $areas = $lista->pluck('area')->unique()->values();

        $coresArea = [
            'Gestão'    => 'bg-violet-50 text-violet-700',
            'Vendas'    => 'bg-rosa-50 text-rosa-700',
            'Criação'   => 'bg-amber-50 text-amber-700',
            'Produção'  => 'bg-sky-50 text-sky-700',
            'Logística' => 'bg-emerald-50 text-emerald-700',
        ];
    @endphp

    <div x-data="{ area: 'Todos' }">

        <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
            <div class="flex gap-2 overflow-x-auto">
                <button @click="area = 'Todos'"
                        :class="area === 'Todos' ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                        class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                    Todos
                </button>
                @foreach ($areas as $a)
                    <button @click="area = @js($a)"
                            :class="area === @js($a) ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                            class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                        {{ $a }}
                    </button>
                @endforeach
            </div>
            <button @click="$dispatch('abrir-aviso')"
                    class="text-sm font-medium bg-rosa-600 hover:bg-rosa-700 text-white rounded-md px-4 py-2 transition">
                + Nova pessoa
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($lista as $p)
                <article x-show="area === 'Todos' || area === @js($p['area'])"
                         class="bg-white rounded-lg border border-studio-200 p-5">

                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 shrink-0 rounded-full bg-studio-100 text-studio-700 font-medium flex items-center justify-center">
                            {{ Str::substr($p['nome'], 0, 1) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-2">
                                <h2 class="font-medium text-studio-900 leading-tight">{{ $p['nome'] }}</h2>
                                <span class="text-xs font-medium px-2.5 py-1 rounded-full whitespace-nowrap {{ $coresArea[$p['area']] ?? 'bg-studio-100 text-studio-600' }}">
                                    {{ $p['area'] }}
                                </span>
                            </div>
                            <p class="text-sm text-studio-500 mt-0.5">{{ $p['cargo'] }}</p>
                        </div>
                    </div>

                    <dl class="mt-4 pt-4 border-t border-studio-100 space-y-2 text-sm">
                        <div class="flex justify-between gap-3">
                            <dt class="text-studio-400">Telefone</dt>
                            <dd class="text-studio-700">{{ $p['telefone'] }}</dd>
                        </div>
                        <div class="flex justify-between gap-3">
                            <dt class="text-studio-400">Na equipe desde</dt>
                            <dd class="text-studio-700">{{ $p['admissao']->format('m/Y') }}</dd>
                        </div>
                    </dl>

                    <div class="flex items-center gap-2 mt-4">
                        <button @click="$dispatch('abrir-aviso')"
                                class="flex-1 text-xs font-medium border border-studio-200 text-studio-700 rounded-md py-2 hover:bg-studio-100 transition">
                            Ligar
                        </button>
                        <button @click="$dispatch('abrir-aviso')"
                                class="text-xs font-medium text-rosa-600 hover:text-rosa-700 px-2">
                            Editar
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

@endsection