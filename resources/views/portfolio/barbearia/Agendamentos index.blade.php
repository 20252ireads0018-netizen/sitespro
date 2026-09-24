@extends('portfolio.barbearia.appBarbearia')

@section('title', 'Todos os agendamentos')

@section('content')

<div class="min-h-screen bg-white text-slate-800 flex">

    <!-- MENU LATERAL (mesmo do dashboard, reaproveite um @include se preferir) -->
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


    <!-- ÁREA PRINCIPAL -->
    <main class="ml-64 flex-1 min-h-screen bg-slate-50">

        <header class="h-20 border-b border-purple-100 bg-white/80 backdrop-blur-xl
                       flex items-center justify-between px-8">
            <div>
                <a href="{{ Route::has('barbearia.agenda') ? route('barbearia.agenda') : '#' }}"
                   class="text-sm text-purple-500 hover:text-purple-700">← Voltar para a agenda</a>
                <h2 class="text-xl font-semibold mt-1 text-slate-900">Todos os agendamentos</h2>
            </div>
        </header>

        <div class="p-8">

            <!-- FILTROS (opcional, ajuste conforme sua lógica de backend) -->
            <form method="GET" class="flex flex-wrap gap-3 mb-6">
                <input type="date" name="data" value="{{ request('data') }}"
                       class="rounded-xl border border-purple-100 px-4 py-2 text-sm text-slate-700
                              focus:outline-none focus:ring-2 focus:ring-purple-300">

                <select name="status"
                        class="rounded-xl border border-purple-100 px-4 py-2 text-sm text-slate-700
                               focus:outline-none focus:ring-2 focus:ring-purple-300">
                    <option value="">Todos os status</option>
                    <option value="confirmado" @selected(request('status') === 'confirmado')>Confirmado</option>
                    <option value="pendente" @selected(request('status') === 'pendente')>Pendente</option>
                </select>

                <button type="submit"
                        class="rounded-xl bg-purple-600 text-white px-5 py-2 text-sm font-medium
                               hover:bg-purple-700 transition-colors duration-200">
                    Filtrar
                </button>
            </form>

            <div class="bg-white border border-purple-100 rounded-2xl overflow-hidden shadow-sm">

                <div class="divide-y divide-purple-50">

                    @php
                        // Troque por $agendamentos (paginado, vindo do controller)
                        $agendamentos = $agendamentos ?? [
                            ['hora' => '09:00', 'data' => '24/09/2026', 'inicial' => 'L', 'nome' => 'Lucas Almeida', 'servico' => 'Corte masculino', 'status' => 'Confirmado', 'telefone' => '(11) 98765-4321', 'email' => 'lucas.almeida@email.com'],
                            ['hora' => '10:30', 'data' => '24/09/2026', 'inicial' => 'R', 'nome' => 'Rafael Costa', 'servico' => 'Barba + Sobrancelha', 'status' => 'Confirmado', 'telefone' => '(11) 91234-5678', 'email' => 'rafael.costa@email.com'],
                            ['hora' => '13:00', 'data' => '24/09/2026', 'inicial' => 'G', 'nome' => 'Gabriel Santos', 'servico' => 'Corte + Barba', 'status' => 'Confirmado', 'telefone' => '(11) 99988-7766', 'email' => 'gabriel.santos@email.com'],
                            ['hora' => '15:30', 'data' => '24/09/2026', 'inicial' => 'F', 'nome' => 'Felipe Martins', 'servico' => 'Corte masculino', 'status' => 'Pendente', 'telefone' => '(11) 97777-1122', 'email' => 'felipe.martins@email.com'],
                        ];
                    @endphp

                    @foreach ($agendamentos as $ag)
                        <div class="appointment relative flex items-center gap-5 px-6 py-5
                                    hover:bg-purple-50/60 transition-colors duration-150"
                             x-data="{ open: false }"
                             @mouseenter="open = true"
                             @mouseleave="open = false">

                            <div class="text-sm font-semibold text-purple-600 w-24">
                                {{ $ag['data'] }} <br>
                                <span class="text-slate-400">{{ $ag['hora'] }}</span>
                            </div>

                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-purple-800
                                        flex items-center justify-center text-white font-medium">
                                {{ $ag['inicial'] }}
                            </div>

                            <div class="flex-1 cursor-default">
                                <p class="font-medium text-slate-900">{{ $ag['nome'] }}</p>
                                <p class="text-xs text-slate-400 mt-1">{{ $ag['servico'] }}</p>
                            </div>

                            <span class="text-xs px-3 py-1.5 rounded-full
                                         {{ $ag['status'] === 'Confirmado'
                                                ? 'bg-emerald-50 text-emerald-600'
                                                : 'bg-amber-50 text-amber-600' }}">
                                {{ $ag['status'] }}
                            </span>

                            <div x-show="open" x-cloak x-transition
                                 class="absolute left-28 top-full mt-1 z-50 w-64
                                        bg-white border border-purple-100 rounded-xl shadow-xl p-4">
                                <p class="text-sm font-semibold text-slate-900">{{ $ag['nome'] }}</p>
                                <p class="text-xs text-slate-500 mt-2 flex items-center gap-2">
                                    <span class="text-purple-500">☏</span> {{ $ag['telefone'] }}
                                </p>
                                <p class="text-xs text-slate-500 mt-1 flex items-center gap-2">
                                    <span class="text-purple-500">✉</span> {{ $ag['email'] }}
                                </p>
                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

            {{-- Se $agendamentos for um paginator do Laravel, exiba os links: --}}
            {{-- <div class="mt-6">{{ $agendamentos->links() }}</div> --}}

        </div>

    </main>

</div>

@endsection