@extends('portfolio.barbearia.appBarbearia')

@section('title', 'Funcionário')

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
                <h2 class="text-xl font-semibold mt-1 text-slate-900">Funcionário</h2>
            </div>
        </header>

        @php
            // Lista de funcionários ilustrativa (usada apenas quando a view não recebe $funcionarios).
            $funcionarios = $funcionarios ?? [
                ['nome' => 'Lucas Almeida',   'cargo' => 'Barbeiro',           'telefone' => '(11) 98765-4321', 'email' => 'lucas.almeida@email.com',   'status' => 'Ativo',   'atendimentosMes' => 42],
                ['nome' => 'Rafael Costa',    'cargo' => 'Barbeiro',           'telefone' => '(11) 91234-5678', 'email' => 'rafael.costa@email.com',    'status' => 'Ativo',   'atendimentosMes' => 38],
                ['nome' => 'Gabriel Santos',  'cargo' => 'Barbeiro',           'telefone' => '(11) 99988-7766', 'email' => 'gabriel.santos@email.com',  'status' => 'Ativo',   'atendimentosMes' => 35],
                ['nome' => 'Thiago Lima',     'cargo' => 'Barbeiro',           'telefone' => '(11) 94444-1111', 'email' => 'thiago.lima@email.com',     'status' => 'Ativo',   'atendimentosMes' => 30],
                ['nome' => 'Felipe Martins',  'cargo' => 'Barbeiro Júnior',    'telefone' => '(11) 97777-1122', 'email' => 'felipe.martins@email.com',  'status' => 'Ativo',   'atendimentosMes' => 27],
                ['nome' => 'Marcelo Souza',   'cargo' => 'Barbeiro',           'telefone' => '(11) 93333-2222', 'email' => 'marcelo.souza@email.com',   'status' => 'Ativo',   'atendimentosMes' => 33],
                ['nome' => 'Igor Batista',    'cargo' => 'Recepcionista',      'telefone' => '(11) 96666-3344', 'email' => 'igor.batista@email.com',    'status' => 'Ativo',   'atendimentosMes' => 0],
                ['nome' => 'Henrique Souza',  'cargo' => 'Barbeiro Júnior',    'telefone' => '(11) 95555-6677', 'email' => 'henrique.souza@email.com',  'status' => 'Inativo', 'atendimentosMes' => 12],
                ['nome' => 'Diego Ramos',     'cargo' => 'Barbeiro',           'telefone' => '(11) 92222-8899', 'email' => 'diego.ramos@email.com',     'status' => 'Ativo',   'atendimentosMes' => 29],
                ['nome' => 'Eduardo Nunes',   'cargo' => 'Auxiliar de limpeza','telefone' => '(11) 91111-4455', 'email' => 'eduardo.nunes@email.com',   'status' => 'Ativo',   'atendimentosMes' => 0],
            ];
        @endphp

        @php
    $totalAtivos = count(array_filter($funcionarios, function ($f) {
        return $f['status'] === 'Ativo';
    }));

    $totalAtendimentos = array_sum(array_column($funcionarios, 'atendimentosMes'));
@endphp

<div class="p-8">

    <div class="bg-white border border-purple-100 rounded-2xl p-6 shadow-sm mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Equipe</h2>
                <p class="text-sm text-slate-400 mt-1">
                    Funcionários cadastrados na barbearia
                </p>
            </div>

            <div class="flex items-center gap-6">
                <div class="text-center">
                    <p class="text-2xl font-bold text-slate-900">{{ count($funcionarios) }}</p>
                    <p class="text-xs text-slate-400 mt-1">Funcionários</p>
                </div>

                <div class="text-center">
                    <p class="text-2xl font-bold text-emerald-600">{{ $totalAtivos }}</p>
                    <p class="text-xs text-slate-400 mt-1">Ativos</p>
                </div>

                <div class="text-center">
                    <p class="text-2xl font-bold text-purple-600">{{ $totalAtendimentos }}</p>
                    <p class="text-xs text-slate-400 mt-1">Atendimentos no mês</p>
                </div>

                <button type="button"
                        @click="$store.aviso.open = true"
                        class="px-4 py-2.5 rounded-xl bg-purple-600 text-white text-sm font-medium shadow-md shadow-purple-200 hover:bg-purple-700 transition-colors">
                    + Novo funcionário
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

        @forelse ($funcionarios as $f)
            <div class="bg-white border border-purple-100 rounded-2xl p-5 shadow-sm">

                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-500 to-purple-800 flex items-center justify-center text-white font-semibold">
                        {{ strtoupper(substr($f['nome'] ?? '?', 0, 1)) }}
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-slate-900 truncate">
                            {{ $f['nome'] ?? 'Sem nome' }}
                        </p>
                        <p class="text-xs text-slate-400">
                            {{ $f['cargo'] ?? '—' }}
                        </p>
                    </div>

                    <span class="text-xs px-3 py-1.5 rounded-full whitespace-nowrap
                        {{ ($f['status'] ?? 'Inativo') === 'Ativo' ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                        {{ $f['status'] ?? 'Inativo' }}
                    </span>
                </div>

                <div class="space-y-1.5 text-xs text-slate-500 mb-4">
                    <p class="flex items-center gap-2">
                        <span class="text-purple-500">☏</span>
                        {{ $f['telefone'] ?? '—' }}
                    </p>

                    <p class="flex items-center gap-2 truncate">
                        <span class="text-purple-500">✉</span>
                        {{ $f['email'] ?? '—' }}
                    </p>
                </div>

                <div class="rounded-xl bg-purple-50/60 border border-purple-100 px-4 py-3 flex items-center justify-between mb-4">
                    <span class="text-xs text-slate-500">Atendimentos no mês</span>
                    <span class="text-sm font-semibold text-purple-700">
                        {{ $f['atendimentosMes'] ?? 0 }}
                    </span>
                </div>

                <div class="flex items-center gap-2">
                    <button type="button"
                            @click="$store.aviso.open = true"
                            class="flex-1 px-3 py-2 rounded-lg bg-purple-50 text-purple-700 text-xs font-medium border border-purple-100 hover:bg-purple-100">
                        Editar
                    </button>

                    <button type="button"
                            @click="$store.aviso.open = true"
                            class="flex-1 px-3 py-2 rounded-lg bg-red-50 text-red-600 text-xs font-medium border border-red-100 hover:bg-red-100">
                        Excluir
                    </button>
                </div>

            </div>
        @empty
            <p class="text-sm text-slate-400 italic col-span-full">
                Nenhum funcionário cadastrado.
            </p>
        @endforelse

    </div>
</div>

    </main>

</div>

@endsection