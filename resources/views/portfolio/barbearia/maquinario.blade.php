@extends('portfolio.barbearia.appBarbearia')

@section('title', 'Maquinário')

@section('content')

<style>[x-cloak]{display:none !important;}</style>

<div class="min-h-screen bg-white text-slate-800 flex">

    <aside class="w-64 min-h-screen bg-white border-r border-purple-100
                  flex flex-col fixed left-0 top-0 bottom-0 z-50 shadow-sm">

        <div class="px-6 py-8 border-b border-purple-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-purple-600 to-purple-800
                            flex items-center justify-center shadow-lg shadow-purple-200">
                    <span class="text-xl text-white">✂</span>
                </div>
                <div>
                    <h1 class="text-lg font-bold tracking-wide text-slate-900">BARBEARIA</h1>
                    <p class="text-[10px] text-purple-500 tracking-[0.25em]">ESTILO • DISCIPLINA</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6">
            <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 px-3 mb-3">Menu</p>

            @php
                $menuItems = [
                    ['label' => 'Agenda',       'icon' => '▣', 'route' => 'barbearia.agenda'],
                    ['label' => 'Financeiro',   'icon' => '◉', 'route' => 'barbearia.financeiro'],
                    ['label' => 'Maquinário',   'icon' => '⚙', 'route' => 'barbearia.maquinario'],
                    ['label' => 'Funcionário',  'icon' => '♙', 'route' => 'barbearia.funcionario'],
                ];
            @endphp

            @foreach ($menuItems as $item)
                @php
                    $isActive = Route::has($item['route']) && request()->routeIs($item['route']);
                    $href = Route::has($item['route']) ? route($item['route']) : '#';
                @endphp
                <a href="{{ $href }}"
                   class="menu-item group flex items-center gap-4 px-4 py-3.5 rounded-xl mb-2
                          transition-all duration-200
                          {{ $isActive
                                ? 'bg-purple-600 text-white shadow-md shadow-purple-200'
                                : 'text-slate-500 hover:bg-purple-50 hover:text-purple-700 hover:translate-x-1' }}">
                    <span class="text-xl">{{ $item['icon'] }}</span>
                    <span class="font-medium">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="p-5 border-t border-purple-100">
            <div class="rounded-xl bg-purple-50 border border-purple-100 p-4">
                <p class="text-xs text-slate-500">Sistema da</p>
                <p class="text-sm font-semibold text-purple-700 mt-1">Barbearia</p>
                <p class="text-[10px] text-slate-400 mt-2">Painel administrativo</p>
            </div>

            @if (Route::has('onboarding.index'))
                <a href="{{ route('onboarding.index') }}"
                   class="mt-3 flex items-center justify-center gap-2 w-full px-3 py-2 rounded-lg
                          text-xs font-medium text-purple-600 border border-purple-200
                          hover:bg-purple-50 transition-colors">
                    <span>←</span> Voltar ao onboarding
                </a>
            @endif
        </div>

    </aside>


    <main class="ml-64 flex-1 min-h-screen bg-slate-50">

        <header class="h-20 border-b border-purple-100 bg-white/80 backdrop-blur-xl
                       flex items-center justify-between px-8">
            <div>
                <p class="text-sm text-slate-400">Painel administrativo</p>
                <h2 class="text-xl font-semibold mt-1 text-slate-900">Maquinário</h2>
            </div>
        </header>

        @php
            // Equipamentos ilustrativos organizados por setor (10 equipamentos no total).
            $setores = $setores ?? [
                [
                    'nome' => 'Estação 1',
                    'equipamentos' => [
                        ['nome' => 'Máquina de corte',       'status' => 'Ativa', 'barbeiro' => 'Lucas Almeida'],
                        ['nome' => 'Secador',                'status' => 'Ativa', 'barbeiro' => 'Lucas Almeida'],
                    ],
                ],
                [
                    'nome' => 'Estação 2',
                    'equipamentos' => [
                        ['nome' => 'Máquina de acabamento',  'status' => 'Ativa',       'barbeiro' => 'Rafael Costa'],
                        ['nome' => 'Máquina de corte',       'status' => 'Manutenção',  'barbeiro' => 'Rafael Costa'],
                    ],
                ],
                [
                    'nome' => 'Estação 3',
                    'equipamentos' => [
                        ['nome' => 'Secador',                'status' => 'Ativa', 'barbeiro' => 'Gabriel Santos'],
                        ['nome' => 'Máquina de corte',       'status' => 'Ativa', 'barbeiro' => 'Gabriel Santos'],
                        ['nome' => 'Máquina de acabamento',  'status' => 'Ativa', 'barbeiro' => 'Gabriel Santos'],
                    ],
                ],
                [
                    'nome' => 'Estação 4',
                    'equipamentos' => [
                        ['nome' => 'Máquina de corte',       'status' => 'Ativa',   'barbeiro' => 'Thiago Lima'],
                        ['nome' => 'Secador',                'status' => 'Inativa', 'barbeiro' => 'Thiago Lima'],
                        ['nome' => 'Máquina de acabamento',  'status' => 'Ativa',   'barbeiro' => 'Thiago Lima'],
                    ],
                ],
            ];
        @endphp

        @php
    $totalEquipamentos = 0;
    $totalAtivos = 0;

    foreach ($setores as $setor) {
        $totalEquipamentos += count($setor['equipamentos']);

        foreach ($setor['equipamentos'] as $equipamento) {
            if ($equipamento['status'] === 'Ativa') {
                $totalAtivos++;
            }
        }
    }
@endphp

<div class="p-8">

    <div class="bg-white border border-purple-100 rounded-2xl p-6 shadow-sm mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Visão geral</h2>
                <p class="text-sm text-slate-400 mt-1">
                    Equipamentos distribuídos por setor de trabalho
                </p>
            </div>

            <div class="flex items-center gap-6">
                <div class="text-center">
                    <p class="text-2xl font-bold text-slate-900">{{ count($setores) }}</p>
                    <p class="text-xs text-slate-400 mt-1">Setores</p>
                </div>

                <div class="text-center">
                    <p class="text-2xl font-bold text-slate-900">{{ $totalEquipamentos }}</p>
                    <p class="text-xs text-slate-400 mt-1">Equipamentos</p>
                </div>

                <div class="text-center">
                    <p class="text-2xl font-bold text-emerald-600">{{ $totalAtivos }}</p>
                    <p class="text-xs text-slate-400 mt-1">Ativos</p>
                </div>

                <button type="button"
                        @click="$store.aviso.open = true"
                        class="px-4 py-2.5 rounded-xl bg-purple-600 text-white text-sm font-medium shadow-md shadow-purple-200 hover:bg-purple-700 transition-colors">
                    + Novo setor
                </button>
            </div>
        </div>
    </div>

    <div class="space-y-6">

        @forelse ($setores as $setorIndex => $setor)
            <div class="bg-white border border-purple-100 rounded-2xl p-6 shadow-sm">

                <div class="flex items-center justify-between mb-5 flex-wrap gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600 text-sm font-semibold">
                            {{ $setorIndex + 1 }}
                        </div>

                        <div>
                            <h3 class="text-base font-semibold text-slate-900">
                                {{ $setor['nome'] }}
                            </h3>
                            <p class="text-xs text-slate-400">
                                {{ count($setor['equipamentos']) }} equipamento(s)
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" @click="$store.aviso.open = true"
                                class="px-3 py-1.5 rounded-lg bg-purple-50 text-purple-700 text-xs font-medium border border-purple-100 hover:bg-purple-100">
                            + Equipamento
                        </button>

                        <button type="button" @click="$store.aviso.open = true"
                                class="px-3 py-1.5 rounded-lg bg-slate-50 text-slate-600 text-xs font-medium border border-slate-100 hover:bg-slate-100">
                            Renomear
                        </button>

                        <button type="button" @click="$store.aviso.open = true"
                                class="px-3 py-1.5 rounded-lg bg-red-50 text-red-600 text-xs font-medium border border-red-100 hover:bg-red-100">
                            Excluir setor
                        </button>
                    </div>
                </div>

                @if (count($setor['equipamentos']) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        @foreach ($setor['equipamentos'] as $eq)
                            <div class="flex items-center gap-4 p-4 rounded-xl bg-purple-50/60 border border-purple-100">
                                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600">
                                    ⚡
                                </div>

                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-slate-900 truncate">
                                        {{ $eq['nome'] }}
                                    </p>

                                    <p class="text-xs mt-1
                                        {{ $eq['status'] === 'Ativa' ? 'text-emerald-600' : ($eq['status'] === 'Manutenção' ? 'text-amber-600' : 'text-red-500') }}">
                                        ● {{ $eq['status'] }}
                                    </p>

                                    <p class="text-[11px] text-slate-400 mt-1 truncate">
                                        Uso: {{ $eq['barbeiro'] }}
                                    </p>
                                </div>

                                <div class="flex flex-col gap-1.5">
                                    <button type="button" @click="$store.aviso.open = true"
                                            class="text-[11px] px-2 py-1 rounded-md bg-white text-purple-600 border border-purple-100 hover:bg-purple-50">
                                        Editar
                                    </button>

                                    <button type="button" @click="$store.aviso.open = true"
                                            class="text-[11px] px-2 py-1 rounded-md bg-white text-red-500 border border-red-100 hover:bg-red-50">
                                        Excluir
                                    </button>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @else
                    <p class="text-sm text-slate-400 italic">
                        Nenhum equipamento cadastrado neste setor.
                    </p>
                @endif

            </div>
        @empty
            <p class="text-sm text-slate-400 italic">
                Nenhum setor cadastrado.
            </p>
        @endforelse

    </div>
</div>

    </main>

</div>

<script>
    // Este painel é apenas ilustrativo: exibe os setores/equipamentos recebidos pela view,
    // sem criar, editar ou excluir nada de verdade (veja o modal global de aviso no layout).
    function maquinarioApp(dadosIniciais) {
        return {
            setores: dadosIniciais || [],

            get totalEquipamentos() {
                return this.setores.reduce((acc, s) => acc + s.equipamentos.length, 0);
            },
            get totalAtivos() {
                return this.setores.reduce(
                    (acc, s) => acc + s.equipamentos.filter(eq => eq.status === 'Ativa').length,
                    0
                );
            },
        };
    }
</script>

@endsection