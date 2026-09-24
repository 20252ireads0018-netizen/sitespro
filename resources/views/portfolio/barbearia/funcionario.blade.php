@extends('portfolio.barbearia.appBarbearia')

@section('title', 'Maquinário')

@section('content')

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

        <div class="p-8">

            @php
                $equipamentos = $equipamentos ?? [
                    ['nome' => 'Máquina de corte', 'status' => 'Ativa'],
                    ['nome' => 'Máquina de acabamento', 'status' => 'Ativa'],
                    ['nome' => 'Secador', 'status' => 'Ativa'],
                ];
            @endphp

            <div class="bg-white border border-purple-100 rounded-2xl p-6 shadow-sm">

                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Equipamentos</h2>
                        <p class="text-sm text-slate-400 mt-1">Status atual do maquinário</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($equipamentos as $eq)
                        <div class="flex items-center gap-4 p-4 rounded-xl bg-purple-50/60 border border-purple-100">
                            <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center text-purple-600">
                                ⚡
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-900">{{ $eq['nome'] }}</p>
                                <p class="text-xs {{ $eq['status'] === 'Ativa' ? 'text-emerald-600' : 'text-amber-600' }} mt-1">
                                    ● {{ $eq['status'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>

    </main>

</div>

@endsection