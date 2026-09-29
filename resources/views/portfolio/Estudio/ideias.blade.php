@extends('portfolio.Estudio.layout')

@section('titulo', 'Ideias')
@section('subtitulo', 'Sugestões da equipe para projetos, processos e materiais')

@section('conteudo')

    @php
        $lista = collect($ideias);

        $colunas = [
            'Nova'       => 'Ainda não avaliadas',
            'Em análise' => 'Sendo discutidas pela equipe',
            'Aprovada'   => 'Prontas para entrar em prática',
        ];

        $coresCategoria = [
            'Sustentabilidade' => 'bg-emerald-50 text-emerald-700',
            'Materiais'        => 'bg-amber-50 text-amber-700',
            'Processo'         => 'bg-sky-50 text-sky-700',
            'Marca'            => 'bg-violet-50 text-violet-700',
        ];
    @endphp

    {{-- Campo rápido para nova ideia --}}
    <div class="bg-white rounded-lg border border-studio-200 p-4 mb-8 flex flex-col sm:flex-row gap-3">
        <input type="text" placeholder="Escreva uma ideia para o estúdio"
               class="flex-1 text-sm border border-studio-200 rounded-md px-4 py-2.5 text-studio-800 placeholder-studio-400 focus:outline-none focus:ring-2 focus:ring-planta-100 focus:border-planta-400">
        <button @click="$dispatch('abrir-aviso')"
                class="text-sm font-medium bg-planta-600 hover:bg-planta-700 text-white rounded-md px-5 py-2.5 transition">
            + Nova ideia
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        @foreach ($colunas as $nomeColuna => $descricao)
            @php $itens = $lista->where('coluna', $nomeColuna); @endphp

            <section class="bg-studio-100/70 rounded-lg p-4">
                <div class="flex items-baseline justify-between mb-4 px-1">
                    <div>
                        <h2 class="font-display text-2xl text-studio-900">{{ $nomeColuna }}</h2>
                        <p class="text-xs text-studio-500">{{ $descricao }}</p>
                    </div>
                    <span class="text-xs font-medium text-studio-600 bg-white border border-studio-200 rounded-full px-2.5 py-1">{{ $itens->count() }}</span>
                </div>

                <div class="space-y-3">
                    @foreach ($itens->sortByDesc('votos') as $ideia)
                        <article class="bg-white rounded-md border border-studio-200 p-4">
                            <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $coresCategoria[$ideia['categoria']] ?? 'bg-studio-100 text-studio-600' }}">
                                {{ $ideia['categoria'] }}
                            </span>
                            <h3 class="font-medium text-studio-900 mt-3">{{ $ideia['titulo'] }}</h3>
                            <p class="text-sm text-studio-600 leading-relaxed mt-1">{{ $ideia['descricao'] }}</p>

                            <div class="flex items-center justify-between mt-4 pt-3 border-t border-studio-100">
                                <p class="text-xs text-studio-400">
                                    {{ $ideia['autor'] }} · {{ $ideia['data']->format('d/m') }}
                                </p>
                                <button @click="$dispatch('abrir-aviso')"
                                        class="inline-flex items-center gap-1.5 text-xs font-medium text-studio-600 border border-studio-200 rounded-md px-2.5 py-1 hover:bg-planta-50 hover:text-planta-700 hover:border-planta-100 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12 5l8 12H4z" /></svg>
                                    {{ $ideia['votos'] }}
                                </button>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>

@endsection