@extends('portfolio.appBarbearia')

@section('title', 'Barbearia')

@section('content')

<div class="min-h-screen bg-[#0d0b12] text-white flex">

    <!-- MENU LATERAL -->
    <aside class="w-64 min-h-screen bg-[#13101a] border-r border-purple-900/30
                  flex flex-col fixed left-0 top-0 bottom-0 z-50">

        <!-- LOGO -->
        <div class="px-6 py-8 border-b border-purple-900/20">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-purple-600 to-violet-900
                            flex items-center justify-center shadow-lg shadow-purple-900/30">
                    <span class="text-xl">✂</span>
                </div>

                <div>
                    <h1 class="text-lg font-bold tracking-wide">
                        BARBEARIA
                    </h1>

                    <p class="text-[10px] text-purple-400 tracking-[0.25em]">
                        ESTILO • DISCIPLINA
                    </p>
                </div>
            </div>
        </div>


        <!-- NAVEGAÇÃO -->
        <nav class="flex-1 px-4 py-6">

            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 px-3 mb-3">
                Menu
            </p>

            <!-- AGENDA -->
            <a href="#"
               class="menu-item group flex items-center gap-4 px-4 py-3.5 rounded-xl
                      bg-purple-600/20 border border-purple-500/20
                      text-purple-300 mb-2
                      transition-all duration-200
                      hover:bg-purple-600/30 hover:border-purple-500/40">

                <span class="text-xl">▣</span>

                <span class="font-medium">
                    Agenda
                </span>
            </a>


            <!-- FINANCEIRO -->
            <a href="#"
               class="menu-item group flex items-center gap-4 px-4 py-3.5 rounded-xl
                      text-gray-400 mb-2
                      transition-all duration-200
                      hover:bg-purple-600/10 hover:text-purple-300
                      hover:translate-x-1">

                <span class="text-xl">◉</span>

                <span class="font-medium">
                    Financeiro
                </span>
            </a>


            <!-- MAQUINÁRIO -->
            <a href="#"
               class="menu-item group flex items-center gap-4 px-4 py-3.5 rounded-xl
                      text-gray-400 mb-2
                      transition-all duration-200
                      hover:bg-purple-600/10 hover:text-purple-300
                      hover:translate-x-1">

                <span class="text-xl">⚙</span>

                <span class="font-medium">
                    Maquinário
                </span>
            </a>


            <!-- FUNCIONÁRIO -->
            <a href="#"
               class="menu-item group flex items-center gap-4 px-4 py-3.5 rounded-xl
                      text-gray-400 mb-2
                      transition-all duration-200
                      hover:bg-purple-600/10 hover:text-purple-300
                      hover:translate-x-1">

                <span class="text-xl">♙</span>

                <span class="font-medium">
                    Funcionário
                </span>
            </a>

        </nav>


        <!-- RODAPÉ DO MENU -->
        <div class="p-5 border-t border-purple-900/20">

            <div class="rounded-xl bg-purple-950/30 border border-purple-900/30 p-4">

                <p class="text-xs text-gray-400">
                    Sistema da
                </p>

                <p class="text-sm font-semibold text-purple-300 mt-1">
                    Barbearia
                </p>

                <p class="text-[10px] text-gray-600 mt-2">
                    Painel administrativo
                </p>

            </div>

        </div>

    </aside>


    <!-- ÁREA PRINCIPAL -->
    <main class="ml-64 flex-1 min-h-screen">

        <!-- HEADER -->
        <header class="h-20 border-b border-purple-900/20 bg-[#100d16]/80 backdrop-blur-xl
                       flex items-center justify-between px-8">

            <div>
                <p class="text-sm text-gray-500">
                    Painel administrativo
                </p>

                <h2 class="text-xl font-semibold mt-1">
                    Visão geral
                </h2>
            </div>


            <!-- USUÁRIO -->
            <div class="flex items-center gap-4">

                <div class="text-right">
                    <p class="text-sm font-medium">
                        Administrador
                    </p>

                    <p class="text-xs text-gray-500">
                        Barbearia
                    </p>
                </div>

                <div class="w-10 h-10 rounded-full
                            bg-gradient-to-br from-purple-500 to-violet-900
                            flex items-center justify-center
                            font-bold shadow-lg shadow-purple-900/30">
                    A
                </div>

            </div>

        </header>


        <!-- CONTEÚDO -->
        <div class="p-8">

            <!-- TÍTULO -->
            <div class="mb-8">

                <p class="text-purple-400 text-sm mb-2">
                    Bem-vindo de volta
                </p>

                <h1 class="text-3xl font-bold">
                    Resumo da barbearia
                </h1>

                <p class="text-gray-500 mt-2">
                    Acompanhe os principais dados do seu negócio.
                </p>

            </div>


            <!-- CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">


                <!-- CARD 1 -->
                <div class="dashboard-card bg-[#15121c] border border-purple-900/20
                            rounded-2xl p-6
                            hover:border-purple-500/30
                            hover:-translate-y-1
                            transition-all duration-200">

                    <div class="flex justify-between items-start">

                        <div>
                            <p class="text-sm text-gray-500">
                                Agendamentos hoje
                            </p>

                            <p class="text-3xl font-bold mt-3">
                                12
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-purple-600/10
                                    flex items-center justify-center
                                    text-purple-400 text-xl">
                            ▣
                        </div>

                    </div>

                    <p class="text-xs text-emerald-400 mt-4">
                        ↑ 20% em relação a ontem
                    </p>

                </div>


                <!-- CARD 2 -->
                <div class="dashboard-card bg-[#15121c] border border-purple-900/20
                            rounded-2xl p-6
                            hover:border-purple-500/30
                            hover:-translate-y-1
                            transition-all duration-200">

                    <div class="flex justify-between items-start">

                        <div>
                            <p class="text-sm text-gray-500">
                                Faturamento
                            </p>

                            <p class="text-3xl font-bold mt-3">
                                R$ 680
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-purple-600/10
                                    flex items-center justify-center
                                    text-purple-400 text-xl">
                            $
                        </div>

                    </div>

                    <p class="text-xs text-emerald-400 mt-4">
                        ↑ 12% esta semana
                    </p>

                </div>


                <!-- CARD 3 -->
                <div class="dashboard-card bg-[#15121c] border border-purple-900/20
                            rounded-2xl p-6
                            hover:border-purple-500/30
                            hover:-translate-y-1
                            transition-all duration-200">

                    <div class="flex justify-between items-start">

                        <div>
                            <p class="text-sm text-gray-500">
                                Clientes atendidos
                            </p>

                            <p class="text-3xl font-bold mt-3">
                                86
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-purple-600/10
                                    flex items-center justify-center
                                    text-purple-400 text-xl">
                            ♙
                        </div>

                    </div>

                    <p class="text-xs text-gray-500 mt-4">
                        Neste mês
                    </p>

                </div>


                <!-- CARD 4 -->
                <div class="dashboard-card bg-[#15121c] border border-purple-900/20
                            rounded-2xl p-6
                            hover:border-purple-500/30
                            hover:-translate-y-1
                            transition-all duration-200">

                    <div class="flex justify-between items-start">

                        <div>
                            <p class="text-sm text-gray-500">
                                Funcionários
                            </p>

                            <p class="text-3xl font-bold mt-3">
                                4
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-xl bg-purple-600/10
                                    flex items-center justify-center
                                    text-purple-400 text-xl">
                            ♟
                        </div>

                    </div>

                    <p class="text-xs text-gray-500 mt-4">
                        Todos ativos
                    </p>

                </div>

            </div>


            <!-- GRID INFERIOR -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">


                <!-- AGENDA -->
                <div class="xl:col-span-2 bg-[#15121c] border border-purple-900/20
                            rounded-2xl overflow-hidden">

                    <div class="flex items-center justify-between p-6
                                border-b border-purple-900/20">

                        <div>
                            <h2 class="text-lg font-semibold">
                                Agenda de hoje
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Próximos atendimentos
                            </p>
                        </div>

                        <button
                            class="text-sm text-purple-400 hover:text-purple-300
                                   transition-colors duration-200">
                            Ver todos →
                        </button>

                    </div>


                    <!-- AGENDAMENTO -->
                    <div class="divide-y divide-purple-900/10">


                        <div class="appointment flex items-center gap-5 px-6 py-5
                                    hover:bg-purple-600/5
                                    transition-colors duration-150">

                            <div class="text-sm font-semibold text-purple-400 w-14">
                                09:00
                            </div>

                            <div class="w-10 h-10 rounded-full
                                        bg-gradient-to-br from-purple-500 to-purple-900
                                        flex items-center justify-center">
                                L
                            </div>

                            <div class="flex-1">
                                <p class="font-medium">
                                    Lucas Almeida
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Corte masculino
                                </p>
                            </div>

                            <span class="text-xs px-3 py-1.5 rounded-full
                                         bg-emerald-500/10 text-emerald-400">
                                Confirmado
                            </span>

                        </div>


                        <div class="appointment flex items-center gap-5 px-6 py-5
                                    hover:bg-purple-600/5
                                    transition-colors duration-150">

                            <div class="text-sm font-semibold text-purple-400 w-14">
                                10:30
                            </div>

                            <div class="w-10 h-10 rounded-full
                                        bg-gradient-to-br from-purple-500 to-purple-900
                                        flex items-center justify-center">
                                R
                            </div>

                            <div class="flex-1">
                                <p class="font-medium">
                                    Rafael Costa
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Barba + Sobrancelha
                                </p>
                            </div>

                            <span class="text-xs px-3 py-1.5 rounded-full
                                         bg-emerald-500/10 text-emerald-400">
                                Confirmado
                            </span>

                        </div>


                        <div class="appointment flex items-center gap-5 px-6 py-5
                                    hover:bg-purple-600/5
                                    transition-colors duration-150">

                            <div class="text-sm font-semibold text-purple-400 w-14">
                                13:00
                            </div>

                            <div class="w-10 h-10 rounded-full
                                        bg-gradient-to-br from-purple-500 to-purple-900
                                        flex items-center justify-center">
                                G
                            </div>

                            <div class="flex-1">
                                <p class="font-medium">
                                    Gabriel Santos
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Corte + Barba
                                </p>
                            </div>

                            <span class="text-xs px-3 py-1.5 rounded-full
                                         bg-emerald-500/10 text-emerald-400">
                                Confirmado
                            </span>

                        </div>


                        <div class="appointment flex items-center gap-5 px-6 py-5
                                    hover:bg-purple-600/5
                                    transition-colors duration-150">

                            <div class="text-sm font-semibold text-purple-400 w-14">
                                15:30
                            </div>

                            <div class="w-10 h-10 rounded-full
                                        bg-gradient-to-br from-purple-500 to-purple-900
                                        flex items-center justify-center">
                                F
                            </div>

                            <div class="flex-1">
                                <p class="font-medium">
                                    Felipe Martins
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Corte masculino
                                </p>
                            </div>

                            <span class="text-xs px-3 py-1.5 rounded-full
                                         bg-yellow-500/10 text-yellow-400">
                                Pendente
                            </span>

                        </div>

                    </div>

                </div>


                <!-- RESUMO FINANCEIRO -->
                <div class="bg-[#15121c] border border-purple-900/20
                            rounded-2xl p-6">

                    <div class="flex justify-between items-center">

                        <div>
                            <h2 class="font-semibold">
                                Financeiro
                            </h2>

                            <p class="text-xs text-gray-500 mt-1">
                                Resumo do mês
                            </p>
                        </div>

                        <span class="text-purple-400 text-xl">
                            $
                        </span>

                    </div>


                    <div class="mt-8">

                        <p class="text-sm text-gray-500">
                            Faturamento
                        </p>

                        <p class="text-3xl font-bold mt-2">
                            R$ 8.420
                        </p>

                        <p class="text-xs text-emerald-400 mt-2">
                            ↑ 18% este mês
                        </p>

                    </div>


                    <!-- BARRAS DO GRÁFICO -->
                    <div class="flex items-end gap-2 h-32 mt-8">

                        <div class="flex-1 bg-purple-900/40 rounded-t h-[35%]"></div>

                        <div class="flex-1 bg-purple-900/50 rounded-t h-[50%]"></div>

                        <div class="flex-1 bg-purple-800/60 rounded-t h-[42%]"></div>

                        <div class="flex-1 bg-purple-700/70 rounded-t h-[65%]"></div>

                        <div class="flex-1 bg-purple-600/80 rounded-t h-[58%]"></div>

                        <div class="flex-1 bg-purple-500 rounded-t h-[82%]"></div>

                        <div class="flex-1 bg-purple-400 rounded-t h-full"></div>

                    </div>


                    <div class="flex justify-between text-[10px] text-gray-600 mt-3">
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
            <div class="mt-6 bg-[#15121c] border border-purple-900/20
                        rounded-2xl p-6">

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <h2 class="text-lg font-semibold">
                            Maquinário
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Status dos equipamentos
                        </p>
                    </div>

                    <button class="text-sm text-purple-400 hover:text-purple-300">
                        Ver todos →
                    </button>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <div class="flex items-center gap-4 p-4 rounded-xl
                                bg-purple-600/5 border border-purple-900/20">

                        <div class="w-10 h-10 rounded-lg bg-purple-600/10
                                    flex items-center justify-center text-purple-400">
                            ⚡
                        </div>

                        <div class="flex-1">

                            <p class="text-sm font-medium">
                                Máquina de corte
                            </p>

                            <p class="text-xs text-emerald-400 mt-1">
                                ● Ativa
                            </p>

                        </div>

                    </div>


                    <div class="flex items-center gap-4 p-4 rounded-xl
                                bg-purple-600/5 border border-purple-900/20">

                        <div class="w-10 h-10 rounded-lg bg-purple-600/10
                                    flex items-center justify-center text-purple-400">
                            ⚡
                        </div>

                        <div class="flex-1">

                            <p class="text-sm font-medium">
                                Máquina de acabamento
                            </p>

                            <p class="text-xs text-emerald-400 mt-1">
                                ● Ativa
                            </p>

                        </div>

                    </div>


                    <div class="flex items-center gap-4 p-4 rounded-xl
                                bg-purple-600/5 border border-purple-900/20">

                        <div class="w-10 h-10 rounded-lg bg-purple-600/10
                                    flex items-center justify-center text-purple-400">
                            ⚡
                        </div>

                        <div class="flex-1">

                            <p class="text-sm font-medium">
                                Secador
                            </p>

                            <p class="text-xs text-emerald-400 mt-1">
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