@extends('portfolio.barbearia.appBarbearia')

@section('title', 'Barbearia')

@section('content')

<div class="min-h-screen bg-white text-slate-800 flex">

    <!-- MENU LATERAL -->
    <aside class="w-64 min-h-screen bg-white border-r border-purple-100
                  flex flex-col fixed left-0 top-0 bottom-0 z-50 shadow-sm">

        <!-- LOGO -->
        <div class="px-6 py-8 border-b border-purple-100">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-purple-600 to-purple-800
                            flex items-center justify-center shadow-lg shadow-purple-200">
                    <span class="text-xl text-white">✂</span>
                </div>

                <div>
                    <h1 class="text-lg font-bold tracking-wide text-slate-900">
                        BARBEARIA
                    </h1>

                    <p class="text-[10px] text-purple-500 tracking-[0.25em]">
                        ESTILO • DISCIPLINA
                    </p>
                </div>
            </div>
        </div>


        <!-- NAVEGAÇÃO -->
        <nav class="flex-1 px-4 py-6">

            <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 px-3 mb-3">
                Menu
            </p>

            @php
                // Ajuste os nomes de rota abaixo para os nomes reais definidos em routes/web.php
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

                    <span class="font-medium">
                        {{ $item['label'] }}
                    </span>
                </a>
            @endforeach

        </nav>


        <!-- RODAPÉ DO MENU -->
        <div class="p-5 border-t border-purple-100">

            <div class="rounded-xl bg-purple-50 border border-purple-100 p-4">

                <p class="text-xs text-slate-500">
                    Sistema da
                </p>

                <p class="text-sm font-semibold text-purple-700 mt-1">
                    Barbearia
                </p>

                <p class="text-[10px] text-slate-400 mt-2">
                    Painel administrativo
                </p>

            </div>

        </div>

    </aside>


    <!-- ÁREA PRINCIPAL -->
    <main class="ml-64 flex-1 min-h-screen bg-slate-50">

        <!-- HEADER -->
        <header class="h-20 border-b border-purple-100 bg-white/80 backdrop-blur-xl
                       flex items-center justify-between px-8">

            <div>
                <p class="text-sm text-slate-400">
                    Painel administrativo
                </p>

                <h2 class="text-xl font-semibold mt-1 text-slate-900">
                    Visão geral
                </h2>
            </div>


            <!-- USUÁRIO -->
            <div class="flex items-center gap-4">

                <div class="text-right">
                    <p class="text-sm font-medium text-slate-900">
                        Administrador
                    </p>

                    <p class="text-xs text-slate-400">
                        Barbearia
                    </p>
                </div>

                <div class="w-10 h-10 rounded-full
                            bg-gradient-to-br from-purple-500 to-purple-800
                            flex items-center justify-center
                            font-bold text-white shadow-lg shadow-purple-200">
                    A
                </div>

            </div>

        </header>


        <!-- CONTEÚDO -->
        <div class="p-8">

            <!-- TÍTULO -->
            <div class="mb-8">

                <p class="text-purple-500 text-sm mb-2">
                    Bem-vindo de volta
                </p>

                <h1 class="text-3xl font-bold text-slate-900">
                    Resumo da barbearia
                </h1>

                <p class="text-slate-400 mt-2">
                    Acompanhe os principais dados do seu negócio.
                </p>

            </div>


            <!-- CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">


                <!-- CARD 1 -->
                <div class="dashboard-card bg-white border border-purple-100
                            rounded-2xl p-6 shadow-sm
                            hover:border-purple-300 hover:shadow-md
                            hover:-translate-y-1
                            transition-all duration-200">

                    <div class="flex justify-between items-start">

                        <div>
                            <p class="text-sm text-slate-400">
                                Agendamentos hoje
                            </p>

                            <p class="text-3xl font-bold mt-3 text-slate-900">
                                12
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-purple-50
                                    flex items-center justify-center
                                    text-purple-600 text-xl">
                            ▣
                        </div>

                    </div>

                    <p class="text-xs text-emerald-600 mt-4">
                        ↑ 20% em relação a ontem
                    </p>

                </div>


                <!-- CARD 2 -->
                <div class="dashboard-card bg-white border border-purple-100
                            rounded-2xl p-6 shadow-sm
                            hover:border-purple-300 hover:shadow-md
                            hover:-translate-y-1
                            transition-all duration-200">

                    <div class="flex justify-between items-start">

                        <div>
                            <p class="text-sm text-slate-400">
                                Faturamento
                            </p>

                            <p class="text-3xl font-bold mt-3 text-slate-900">
                                R$ 680
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-purple-50
                                    flex items-center justify-center
                                    text-purple-600 text-xl">
                            $
                        </div>

                    </div>

                    <p class="text-xs text-emerald-600 mt-4">
                        ↑ 12% esta semana
                    </p>

                </div>


                <!-- CARD 3 -->
                <div class="dashboard-card bg-white border border-purple-100
                            rounded-2xl p-6 shadow-sm
                            hover:border-purple-300 hover:shadow-md
                            hover:-translate-y-1
                            transition-all duration-200">

                    <div class="flex justify-between items-start">

                        <div>
                            <p class="text-sm text-slate-400">
                                Clientes atendidos
                            </p>

                            <p class="text-3xl font-bold mt-3 text-slate-900">
                                86
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-purple-50
                                    flex items-center justify-center
                                    text-purple-600 text-xl">
                            ♙
                        </div>

                    </div>

                    <p class="text-xs text-slate-400 mt-4">
                        Neste mês
                    </p>

                </div>


                <!-- CARD 4 -->
                <div class="dashboard-card bg-white border border-purple-100
                            rounded-2xl p-6 shadow-sm
                            hover:border-purple-300 hover:shadow-md
                            hover:-translate-y-1
                            transition-all duration-200">

                    <div class="flex justify-between items-start">

                        <div>
                            <p class="text-sm text-slate-400">
                                Funcionários
                            </p>

                            <p class="text-3xl font-bold mt-3 text-slate-900">
                                4
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-purple-50
                                    flex items-center justify-center
                                    text-purple-600 text-xl">
                            ♟
                        </div>

                    </div>

                    <p class="text-xs text-slate-400 mt-4">
                        Todos ativos
                    </p>

                </div>

            </div>


            <!-- GRID INFERIOR -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">


                <!-- AGENDA -->
                <div class="xl:col-span-2 bg-white border border-purple-100
                            rounded-2xl overflow-hidden shadow-sm">

                    <div class="flex items-center justify-between p-6
                                border-b border-purple-100">

                        <div>
                            <h2 class="text-lg font-semibold text-slate-900">
                                Agenda de hoje
                            </h2>

                            <p class="text-sm text-slate-400 mt-1">
                                Próximos atendimentos
                            </p>
                        </div>

                        <a href="{{ Route::has('barbearia.agendamentos.index') ? route('barbearia.agendamentos.index') : '#' }}"
                           class="text-sm text-purple-600 hover:text-purple-800
                                  transition-colors duration-200">
                            Ver todos →
                        </a>

                    </div>


                    <!-- AGENDAMENTOS -->
                    <div class="divide-y divide-purple-50">

                        @php
                            // Substitua por dados vindos do seu model/controller (ex.: $agendamentosHoje)
                            $agendamentosHoje = [
                                [
                                    'hora' => '09:00',
                                    'inicial' => 'L',
                                    'nome' => 'Lucas Almeida',
                                    'servico' => 'Corte masculino',
                                    'status' => 'Confirmado',
                                    'telefone' => '(11) 98765-4321',
                                    'email' => 'lucas.almeida@email.com',
                                ],
                                [
                                    'hora' => '10:30',
                                    'inicial' => 'R',
                                    'nome' => 'Rafael Costa',
                                    'servico' => 'Barba + Sobrancelha',
                                    'status' => 'Confirmado',
                                    'telefone' => '(11) 91234-5678',
                                    'email' => 'rafael.costa@email.com',
                                ],
                                [
                                    'hora' => '13:00',
                                    'inicial' => 'G',
                                    'nome' => 'Gabriel Santos',
                                    'servico' => 'Corte + Barba',
                                    'status' => 'Confirmado',
                                    'telefone' => '(11) 99988-7766',
                                    'email' => 'gabriel.santos@email.com',
                                ],
                                [
                                    'hora' => '15:30',
                                    'inicial' => 'F',
                                    'nome' => 'Felipe Martins',
                                    'servico' => 'Corte masculino',
                                    'status' => 'Pendente',
                                    'telefone' => '(11) 97777-1122',
                                    'email' => 'felipe.martins@email.com',
                                ],
                            ];
                        @endphp

                        @foreach ($agendamentosHoje as $ag)
                            <div class="appointment relative flex items-center gap-5 px-6 py-5
                                        hover:bg-purple-50/60
                                        transition-colors duration-150"
                                 x-data="{ open: false }"
                                 @mouseenter="open = true"
                                 @mouseleave="open = false">

                                <div class="text-sm font-semibold text-purple-600 w-14">
                                    {{ $ag['hora'] }}
                                </div>

                                <div class="w-10 h-10 rounded-full
                                            bg-gradient-to-br from-purple-500 to-purple-800
                                            flex items-center justify-center text-white font-medium">
                                    {{ $ag['inicial'] }}
                                </div>

                                <div class="flex-1 cursor-default">
                                    <p class="font-medium text-slate-900">
                                        {{ $ag['nome'] }}
                                    </p>

                                    <p class="text-xs text-slate-400 mt-1">
                                        {{ $ag['servico'] }}
                                    </p>
                                </div>

                                <span class="text-xs px-3 py-1.5 rounded-full
                                             {{ $ag['status'] === 'Confirmado'
                                                    ? 'bg-emerald-50 text-emerald-600'
                                                    : 'bg-amber-50 text-amber-600' }}">
                                    {{ $ag['status'] }}
                                </span>

                                <!-- TOOLTIP COM DADOS DO CLIENTE -->
                                <div x-show="open"
                                     x-cloak
                                     x-transition
                                     class="absolute left-24 top-full mt-1 z-50 w-64
                                            bg-white border border-purple-100 rounded-xl
                                            shadow-xl p-4">

                                    <p class="text-sm font-semibold text-slate-900">
                                        {{ $ag['nome'] }}
                                    </p>

                                    <p class="text-xs text-slate-500 mt-2 flex items-center gap-2">
                                        <span class="text-purple-500">☏</span>
                                        {{ $ag['telefone'] }}
                                    </p>

                                    <p class="text-xs text-slate-500 mt-1 flex items-center gap-2">
                                        <span class="text-purple-500">✉</span>
                                        {{ $ag['email'] }}
                                    </p>

                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>


                <!-- RESUMO FINANCEIRO -->
                <div class="bg-white border border-purple-100
                            rounded-2xl p-6 shadow-sm">

                    <div class="flex justify-between items-center">

                        <div>
                            <h2 class="font-semibold text-slate-900">
                                Financeiro
                            </h2>

                            <p class="text-xs text-slate-400 mt-1">
                                Resumo do mês
                            </p>
                        </div>

                        <span class="text-purple-600 text-xl">
                            $
                        </span>

                    </div>


                    <div class="mt-8">

                        <p class="text-sm text-slate-400">
                            Faturamento
                        </p>

                        <p class="text-3xl font-bold mt-2 text-slate-900">
                            R$ 8.420
                        </p>

                        <p class="text-xs text-emerald-600 mt-2">
                            ↑ 18% este mês
                        </p>

                    </div>


                    <!-- BARRAS DO GRÁFICO -->
                    <div class="flex items-end gap-2 h-32 mt-8">

                        <div class="flex-1 bg-purple-100 rounded-t h-[35%]"></div>

                        <div class="flex-1 bg-purple-200 rounded-t h-[50%]"></div>

                        <div class="flex-1 bg-purple-300 rounded-t h-[42%]"></div>

                        <div class="flex-1 bg-purple-400 rounded-t h-[65%]"></div>

                        <div class="flex-1 bg-purple-500 rounded-t h-[58%]"></div>

                        <div class="flex-1 bg-purple-600 rounded-t h-[82%]"></div>

                        <div class="flex-1 bg-purple-700 rounded-t h-full"></div>

                    </div>


                    <div class="flex justify-between text-[10px] text-slate-400 mt-3">
                        <span>Seg</span>
                        <span>Ter</span>
                        <span>Qua</span>
                        <span>Qui</span>
                        <span>Sex</span>
                        <span>Sáb</span>
                        <span>Dom</span>
                    </div>

                </div>

            </div>


            <!-- MAQUINÁRIO -->
            <div class="mt-6 bg-white border border-purple-100
                        rounded-2xl p-6 shadow-sm">

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">
                            Maquinário
                        </h2>

                        <p class="text-sm text-slate-400 mt-1">
                            Status dos equipamentos
                        </p>
                    </div>

                    <a href="{{ Route::has('barbearia.maquinario') ? route('barbearia.maquinario') : '#' }}"
                       class="text-sm text-purple-600 hover:text-purple-800">
                        Ver todos →
                    </a>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <div class="flex items-center gap-4 p-4 rounded-xl
                                bg-purple-50/60 border border-purple-100">

                        <div class="w-10 h-10 rounded-lg bg-purple-100
                                    flex items-center justify-center text-purple-600">
                            ⚡
                        </div>

                        <div class="flex-1">

                            <p class="text-sm font-medium text-slate-900">
                                Máquina de corte
                            </p>

                            <p class="text-xs text-emerald-600 mt-1">
                                ● Ativa
                            </p>

                        </div>

                    </div>


                    <div class="flex items-center gap-4 p-4 rounded-xl
                                bg-purple-50/60 border border-purple-100">

                        <div class="w-10 h-10 rounded-lg bg-purple-100
                                    flex items-center justify-center text-purple-600">
                            ⚡
                        </div>

                        <div class="flex-1">

                            <p class="text-sm font-medium text-slate-900">
                                Máquina de acabamento
                            </p>

                            <p class="text-xs text-emerald-600 mt-1">
                                ● Ativa
                            </p>

                        </div>

                    </div>


                    <div class="flex items-center gap-4 p-4 rounded-xl
                                bg-purple-50/60 border border-purple-100">

                        <div class="w-10 h-10 rounded-lg bg-purple-100
                                    flex items-center justify-center text-purple-600">
                            ⚡
                        </div>

                        <div class="flex-1">

                            <p class="text-sm font-medium text-slate-900">
                                Secador
                            </p>

                            <p class="text-xs text-emerald-600 mt-1">
                                ● Ativa
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>


<!-- ANIMAÇÕES -->
<style>

    .dashboard-card {
        animation: aparecer 0.35s ease-out;
    }

    .appointment {
        animation: aparecer 0.3s ease-out;
    }

    @keyframes aparecer {

        from {
            opacity: 0;
            transform: translateY(6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }

</style>

@endsection