@extends('portfolio.Estudio.layout')

@section('titulo', 'Projetos')
@section('subtitulo', 'Do estudo preliminar à entrega da obra')

@section('conteudo')

    @php
        $lista = collect($projetos);
        $fases = ['Estudo preliminar', 'Anteprojeto', 'Projeto executivo', 'Obra', 'Entrega'];

        $ativos    = $lista->filter(fn ($p) => $p['fase'] < 4);
        $emObra    = $lista->where('fase', 3)->count();
        $areaTotal = $ativos->sum('area');
        $proximo   = $ativos->sortBy('prazo')->first();
    @endphp

    {{-- Resumo --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Projetos ativos</p>
            <p class="font-display text-4xl text-studio-900">{{ $ativos->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Em obra</p>
            <p class="font-display text-4xl text-studio-900">{{ $emObra }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Área em projeto</p>
            <p class="font-display text-4xl text-studio-900">{{ number_format($areaTotal, 0, ',', '.') }} <span class="text-lg text-studio-500">m²</span></p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Próxima entrega</p>
            <p class="font-display text-4xl text-studio-900">{{ $proximo ? $proximo['prazo']->format('d/m') : '-' }}</p>
            @if ($proximo)
                <p class="text-xs text-studio-400 mt-1">{{ $proximo['nome'] }}</p>
            @endif
        </div>
    </div>

    <div x-data="{ filtro: 'Todos' }">

        <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
            <div class="flex gap-2 overflow-x-auto">
                @foreach (['Todos', 'Em projeto', 'Em obra', 'Concluído'] as $opcao)
                    <button @click="filtro = '{{ $opcao }}'"
                            :class="filtro === '{{ $opcao }}' ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                            class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                        {{ $opcao }}
                    </button>
                @endforeach
            </div>
            <button @click="$dispatch('abrir-aviso')"
                    class="text-sm font-medium bg-planta-600 hover:bg-planta-700 text-white rounded-md px-4 py-2 transition">
                + Novo projeto
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($lista as $p)
                @php
                    $status = $p['fase'] <= 2 ? 'Em projeto' : ($p['fase'] === 3 ? 'Em obra' : 'Concluído');
                    $corStatus = [
                        'Em projeto' => 'bg-sky-50 text-sky-700',
                        'Em obra'    => 'bg-amber-50 text-amber-700',
                        'Concluído'  => 'bg-emerald-50 text-emerald-700',
                    ][$status];

                    // Usa a foto só se o arquivo realmente existir em /public
                    $temFoto = !empty($p['imagem']) && file_exists(public_path($p['imagem']));
                @endphp

                <article x-show="filtro === 'Todos' || filtro === @js($status)"
                         class="bg-white rounded-lg border border-studio-200 overflow-hidden flex flex-col">

                    {{-- Imagem do projeto --}}
                    <div class="h-48 bg-planta-600 relative overflow-hidden">
                        @if ($temFoto)
                            <img src="{{ asset($p['imagem']) }}"
                                 alt="{{ $p['nome'] }}"
                                 loading="lazy"
                                 class="absolute inset-0 w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-studio-900/25 to-transparent"></div>
                        @else
                            <div class="absolute inset-0"
                                 style="background-image: linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px); background-size: 16px 16px;"></div>
                            <svg viewBox="0 0 200 100" class="absolute inset-0 w-full h-full p-5" fill="none" stroke="white" stroke-opacity=".85" stroke-width="1.5">
                                @switch($loop->index % 3)
                                    @case(0) <path d="M20 80V30h60V10h100v70z M80 30v50 M120 10v70" /> @break
                                    @case(1) <path d="M25 85V20h70v25h80v40z M95 45v40 M135 45v40" /> @break
                                    @default <path d="M15 80V40h50V15h60v25h60v40z M65 40v40 M125 40v40" />
                                @endswitch
                            </svg>
                        @endif
                        <span class="absolute top-3 right-3 text-xs font-medium px-2.5 py-1 rounded-full {{ $corStatus }}">{{ $status }}</span>
                    </div>

                    <div class="p-5 flex-1 flex flex-col">
                        <h2 class="font-display text-2xl text-studio-900 leading-tight">{{ $p['nome'] }}</h2>
                        <p class="text-sm text-studio-500 mt-1">{{ $p['cliente'] }} · {{ $p['tipo'] }}</p>

                        {{-- Fases --}}
                        <div class="flex gap-1 mt-5">
                            @foreach ($fases as $i => $fase)
                                <div class="h-1 flex-1 rounded-full {{ $i <= $p['fase'] ? 'bg-planta-500' : 'bg-studio-200' }}"></div>
                            @endforeach
                        </div>
                        <p class="text-xs text-studio-500 mt-2">Fase atual: {{ $fases[$p['fase']] }}</p>

                        <dl class="grid grid-cols-2 gap-y-3 gap-x-4 text-sm mt-5 pt-5 border-t border-studio-100">
                            <div>
                                <dt class="text-xs text-studio-400">Local</dt>
                                <dd class="text-studio-700">{{ $p['local'] }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-studio-400">Área</dt>
                                <dd class="text-studio-700">{{ number_format($p['area'], 0, ',', '.') }} m²</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-studio-400">Responsável</dt>
                                <dd class="text-studio-700">{{ $p['responsavel'] }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-studio-400">{{ $p['fase'] === 4 ? 'Entregue em' : 'Prazo' }}</dt>
                                <dd class="text-studio-700">{{ $p['prazo']->format('d/m/Y') }}</dd>
                            </div>
                        </dl>

                        <div class="flex items-center justify-between mt-5">
                            <button @click="$dispatch('abrir-aviso')" class="text-sm font-medium text-planta-600 hover:text-planta-700">
                                Abrir projeto
                            </button>
                            <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-studio-500 hover:text-studio-900">
                                Documentos
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

@endsection