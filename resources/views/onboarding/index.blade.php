@extends('layouts.app')

@section('title', 'Vamos criar o site do seu negócio')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-14"
     x-data="onboardingWizard()">

    <!-- Fundo animado progressivo -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
        <!-- Maré azul que sobe pela base -->
        <div class="ws-grow absolute inset-x-0 bottom-0 bg-gradient-to-t from-brand-200/60 via-brand-100/40 to-transparent"
            :style="`height: ${8 + progress * 57}%`"></div>

        <!-- Mancha 1: canto inferior esquerdo (presente desde o início) -->
        <div class="ws-drift-a absolute -left-48 -bottom-48">
            <div class="ws-grow w-[38rem] h-[38rem] rounded-full bg-brand-400/30 blur-3xl"
                :style="`transform: scale(${0.45 + progress * 0.75}); opacity: ${0.55 + progress * 0.45}`"></div>
        </div>

        <!-- Mancha 2: lateral direita (surge na etapa 2) -->
        <div class="ws-drift-b absolute -right-40 top-1/3">
            <div class="ws-grow w-[32rem] h-[32rem] rounded-full bg-brand-500/25 blur-3xl"
                :style="`transform: scale(${0.2 + progress * 0.9}); opacity: ${Math.min(1, Math.max(0, (progress - 0.15) * 1.2))}`"></div>
        </div>

        <!-- Mancha 3: topo (surge a partir da etapa 3) -->
        <div class="ws-drift-c absolute left-1/3 -top-56">
            <div class="ws-grow w-[28rem] h-[28rem] rounded-full bg-brand-300/30 blur-3xl"
                :style="`transform: scale(${0.2 + progress * 1.0}); opacity: ${Math.min(1, Math.max(0, (progress - 0.4) * 1.7))}`"></div>
        </div>
    </div>

    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight bg-gradient-to-r from-brand-700 via-brand-500 to-brand-400 bg-clip-text text-transparent">
            Vamos conhecer o seu negócio
        </h1>
        <p class="mt-3 text-slate-500">
            Responda algumas perguntas rápidas para que possamos entender como criar o site ideal para você.
        </p>
        <a href="{{ route('portfolio.index') }}"
           class="inline-flex items-center gap-1 mt-4 text-sm font-medium text-brand-600 hover:text-brand-800 transition-colors duration-200">
            Ver nosso portfólio
            <span class="transition-transform duration-200 group-hover:translate-x-0.5">→</span>
        </a>
    </div>

    <!-- Barra de progresso com etapas numeradas -->
    <div class="mb-10">
        <div class="flex items-center justify-between mb-3">
            <template x-for="n in totalSteps" :key="n">
                <div class="flex items-center flex-1 last:flex-none">
                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-semibold shrink-0 transition-colors duration-300"
                         :class="n <= step ? 'bg-brand-600 text-white' : 'bg-slate-200 text-slate-400'"
                         x-text="n"></div>
                    <div class="flex-1 h-0.5 mx-1 transition-colors duration-300"
                         :class="n < step ? 'bg-brand-500' : 'bg-slate-200'"
                         x-show="n < totalSteps"></div>
                </div>
            </template>
        </div>
        <div class="h-1.5 w-full bg-slate-200 rounded-full overflow-hidden">
            <div class="h-full bg-gradient-to-r from-brand-500 to-brand-600 transition-all duration-300"
                 :style="`width: ${(step / totalSteps) * 100}%`"></div>
        </div>
        <p class="mt-2 text-xs text-slate-400 text-right" x-text="`Etapa ${step} de ${totalSteps}`"></p>
    </div>

    <form action="{{ route('onboarding.store') }}" method="POST" enctype="multipart/form-data"
          @submit="loading = true" class="bg-white border border-slate-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 p-8">
        @csrf

        <!-- Etapa 1: Negócio atual -->
        <div x-show="step === 1" x-cloak>
            <h2 class="text-lg font-semibold text-slate-900 mb-1">Qual é o seu negócio atual?</h2>
            <p class="text-sm text-slate-500 mb-4">Ex: loja de roupas, consultoria, restaurante, prestador de serviços...</p>
            <input type="text" name="business_type" x-model="data.business_type" required
                   class="w-full rounded-lg border border-slate-300 px-4 py-3 transition-colors duration-200 hover:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                   placeholder="Ex: Loja de roupas femininas">
        </div>

        <!-- Etapa 2: Tamanho do negócio -->
        <div x-show="step === 2" x-cloak>
            <h2 class="text-lg font-semibold text-slate-900 mb-1">Qual o tamanho do seu negócio?</h2>
            <p class="text-sm text-slate-500 mb-4">Considere número de funcionários ou porte da operação.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach (['Individual / autônomo', 'Pequena empresa (2–10 pessoas)', 'Média empresa (11–50 pessoas)', 'Grande empresa (50+ pessoas)'] as $opcao)
                    <label class="flex items-center gap-3 border rounded-lg px-4 py-3 cursor-pointer transition-all duration-200 hover:border-brand-400 hover:bg-brand-50/60 hover:shadow-sm"
                           :class="data.business_size === '{{ $opcao }}' ? 'border-brand-500 bg-brand-50 ring-1 ring-brand-500' : 'border-slate-300'">
                        <input type="radio" name="business_size" value="{{ $opcao }}" x-model="data.business_size" required class="text-brand-600 focus:ring-brand-500">
                        <span class="text-sm text-slate-700">{{ $opcao }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Etapa 3: Volume de vendas -->
        <div x-show="step === 3" x-cloak>
            <h2 class="text-lg font-semibold text-slate-900 mb-1">Qual o seu volume de vendas aproximado?</h2>
            <p class="text-sm text-slate-500 mb-4">Isso nos ajuda a dimensionar a estrutura do site.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach (['Ainda não vendo', 'Até R$ 5 mil/mês', 'R$ 5 mil – R$ 20 mil/mês', 'R$ 20 mil – R$ 100 mil/mês', 'Acima de R$ 100 mil/mês'] as $opcao)
                    <label class="flex items-center gap-3 border rounded-lg px-4 py-3 cursor-pointer transition-all duration-200 hover:border-brand-400 hover:bg-brand-50/60 hover:shadow-sm"
                           :class="data.sales_volume === '{{ $opcao }}' ? 'border-brand-500 bg-brand-50 ring-1 ring-brand-500' : 'border-slate-300'">
                        <input type="radio" name="sales_volume" value="{{ $opcao }}" x-model="data.sales_volume" required class="text-brand-600 focus:ring-brand-500">
                        <span class="text-sm text-slate-700">{{ $opcao }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Etapa 4: Método de organização -->
        <div x-show="step === 4" x-cloak>
            <h2 class="text-lg font-semibold text-slate-900 mb-1">Como você organiza seu negócio hoje?</h2>
            <p class="text-sm text-slate-500 mb-4">Ex: planilhas de Excel, caderno/avulso, sistema próprio, etc.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach (['Excel / Planilhas', 'Caderno / Anotações avulsas', 'Sistema de gestão (ERP/CRM)', 'Não tenho um método definido'] as $opcao)
                    <label class="flex items-center gap-3 border rounded-lg px-4 py-3 cursor-pointer transition-all duration-200 hover:border-brand-400 hover:bg-brand-50/60 hover:shadow-sm"
                           :class="data.organization_method === '{{ $opcao }}' ? 'border-brand-500 bg-brand-50 ring-1 ring-brand-500' : 'border-slate-300'">
                        <input type="radio" name="organization_method" value="{{ $opcao }}" x-model="data.organization_method" required class="text-brand-600 focus:ring-brand-500">
                        <span class="text-sm text-slate-700">{{ $opcao }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Etapa 5: Detalhes do pedido + contato + imagens -->
        <div x-show="step === 5" x-cloak>
            <h2 class="text-lg font-semibold text-slate-900 mb-1">Conte mais sobre o site que você imagina</h2>
            <p class="text-sm text-slate-500 mb-4">Descreva ideias, referências e envie imagens (logotipo, prints, inspirações).</p>

            <textarea name="message" rows="4"
                      class="w-full rounded-lg border border-slate-300 px-4 py-3 mb-5 transition-colors duration-200 hover:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                      placeholder="Ex: quero um site com catálogo de produtos e botão de WhatsApp..."></textarea>

            <label class="block text-sm font-medium text-slate-700 mb-2">Imagens (opcional)</label>
            <input type="file" name="images[]" multiple accept="image/*"
                   class="w-full text-sm text-slate-600 mb-6 rounded-lg border border-dashed border-slate-300 px-3 py-2 transition-colors duration-200 hover:border-brand-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-brand-50 file:text-brand-700 file:transition-colors file:duration-200 hover:file:bg-brand-100">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nome</label>
                    <input type="text" name="name" x-model="data.name" required
                           class="w-full rounded-lg border border-slate-300 px-4 py-3 transition-colors duration-200 hover:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">E-mail</label>
                    <input type="email" name="email" x-model="data.email" required
                           class="w-full rounded-lg border border-slate-300 px-4 py-3 transition-colors duration-200 hover:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Telefone / WhatsApp</label>
                    <input type="text" name="phone"
                           class="w-full rounded-lg border border-slate-300 px-4 py-3 transition-colors duration-200 hover:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nome da empresa</label>
                    <input type="text" name="company_name"
                           class="w-full rounded-lg border border-slate-300 px-4 py-3 transition-colors duration-200 hover:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                </div>
            </div>
        </div>

        <!-- Campos ocultos para carregar respostas das etapas anteriores mesmo se o usuário voltar -->
        <input type="hidden" name="_step_check" value="1">
        <input type="hidden" name="request_type" x-model="request_type">

        <!-- Navegação -->
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <button type="button" @click="prev()" x-show="step > 1" x-cloak
                    class="text-sm font-medium text-slate-500 hover:text-brand-600 transition-colors duration-200 order-2 sm:order-1">
                ← Voltar
            </button>
            <span x-show="step === 1" class="order-2 sm:order-1"></span>

            <button type="button" @click="next()" x-show="step < totalSteps" x-cloak
                    :disabled="!isStepValid"
                    :class="isStepValid
                        ? 'bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-700 hover:to-brand-600 text-white opacity-100 cursor-pointer hover:shadow-md hover:shadow-brand-500/30'
                        : 'bg-gradient-to-r from-brand-600 to-brand-500 text-white opacity-40 cursor-not-allowed'"
                    class="w-full sm:w-auto sm:ml-auto order-1 sm:order-2 font-medium px-6 py-3 rounded-lg transition-all duration-200">
                Próximo →
            </button>

            <div x-show="step === totalSteps" x-cloak
                 class="w-full sm:w-auto sm:ml-auto order-1 sm:order-2 flex flex-col sm:flex-row gap-3">
                <button type="submit" @click="request_type = 'teste'" :disabled="loading"
                        class="w-full sm:w-auto border-2 border-brand-600 text-brand-700 font-medium px-6 py-3 rounded-lg transition-all duration-200 hover:bg-brand-50 hover:shadow-sm disabled:opacity-60">
                    Solicitar site teste
                </button>
                <button type="submit" @click="request_type = 'completo'" :disabled="loading"
                        class="w-full sm:w-auto bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-700 hover:to-brand-600 text-white font-medium px-6 py-3 rounded-lg transition-all duration-200 hover:shadow-md hover:shadow-brand-500/30 disabled:opacity-60">
                    <span x-show="!loading">Solicitar site completo</span>
                    <span x-show="loading">Enviando...</span>
                </button>
            </div>
        </div>

        @if ($errors->any())
            <div class="mt-6 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>

    <!-- Card com gráfico dinâmico: muda conforme a etapa do formulário -->
    <div class="mt-8 bg-white border border-slate-200 rounded-2xl shadow-sm p-6 sm:p-8 text-center">
        <div class="max-w-lg mx-auto">
            <p class="text-xs sm:text-sm font-semibold uppercase tracking-[0.14em] text-slate-600">
                O impacto de ter um site
            </p>

            <!-- Gráfico 1 (Etapa 1): Faturamento -->
            <div x-show="chartIndex === 1" x-transition.opacity.duration.400ms x-cloak>
                <p class="mt-1 text-lg sm:text-xl font-bold text-slate-800">Faturamento</p>

                <div class="mt-4 flex items-center justify-center gap-4 sm:gap-6 text-sm font-medium text-slate-600">
                    <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-slate-300"></span>Sem site</span>
                    <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-brand-500"></span>Com site</span>
                </div>

                <svg viewBox="0 0 480 170" class="w-full h-auto mt-4" role="img"
                     aria-label="Faturamento: a diferença entre a empresa com site e a empresa sem site aumenta ao longo dos meses">
                    <defs>
                        <linearGradient id="wsBar1" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#5c85ff"/>
                            <stop offset="100%" stop-color="#2749d1"/>
                        </linearGradient>
                    </defs>

                    <line x1="30" y1="120" x2="450" y2="120" stroke="#e2e8f0" stroke-width="1"/>

                    <rect class="ws-rise" x="79" y="95" width="28" height="25" rx="4" fill="#dbe3ee"/>
                    <rect class="ws-rise" x="113" y="95" width="28" height="25" rx="4" fill="url(#wsBar1)" style="animation-delay:.15s"/>

                    <rect class="ws-rise" x="209" y="89" width="28" height="31" rx="4" fill="#dbe3ee" style="animation-delay:.3s"/>
                    <rect class="ws-rise" x="243" y="67" width="28" height="53" rx="4" fill="url(#wsBar1)" style="animation-delay:.45s"/>

                    <rect class="ws-rise" x="339" y="83" width="28" height="37" rx="4" fill="#dbe3ee" style="animation-delay:.6s"/>
                    <rect class="ws-rise" x="373" y="24" width="28" height="96" rx="4" fill="url(#wsBar1)" style="animation-delay:.75s"/>

                    <g font-size="15" font-weight="500" fill="#475569" text-anchor="middle">
                        <text x="110" y="140">Mês 1</text>
                        <text x="240" y="140">Mês 3</text>
                        <text x="370" y="140" fill="#2749d1" font-weight="700">Mês 6</text>
                    </g>
                </svg>

                <p class="mt-5 text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Gráfico ilustrativo. Os resultados variam conforme cada negócio.
                </p>
            </div>

            <!-- Gráfico 2 (Etapa 2): Clientes atendidos por dia -->
            <div x-show="chartIndex === 2" x-transition.opacity.duration.400ms x-cloak>
                <p class="mt-1 text-lg sm:text-xl font-bold text-slate-800">Clientes atendidos por dia</p>

                <div class="mt-4 flex items-center justify-center gap-4 sm:gap-6 text-sm font-medium text-slate-600">
                    <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-slate-300"></span>Sem site</span>
                    <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-brand-500"></span>Com site</span>
                </div>

                <svg viewBox="0 0 480 170" class="w-full h-auto mt-4" role="img"
                     aria-label="Clientes atendidos por dia: o número de clientes diários cresce mais para quem tem site">
                    <defs>
                        <linearGradient id="wsBar2" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#5c85ff"/>
                            <stop offset="100%" stop-color="#2749d1"/>
                        </linearGradient>
                    </defs>

                    <line x1="30" y1="120" x2="450" y2="120" stroke="#e2e8f0" stroke-width="1"/>

                    <rect class="ws-rise" x="79" y="100" width="28" height="20" rx="4" fill="#dbe3ee"/>
                    <rect class="ws-rise" x="113" y="98" width="28" height="22" rx="4" fill="url(#wsBar2)" style="animation-delay:.15s"/>

                    <rect class="ws-rise" x="209" y="95" width="28" height="25" rx="4" fill="#dbe3ee" style="animation-delay:.3s"/>
                    <rect class="ws-rise" x="243" y="75" width="28" height="45" rx="4" fill="url(#wsBar2)" style="animation-delay:.45s"/>

                    <rect class="ws-rise" x="339" y="90" width="28" height="30" rx="4" fill="#dbe3ee" style="animation-delay:.6s"/>
                    <rect class="ws-rise" x="373" y="30" width="28" height="90" rx="4" fill="url(#wsBar2)" style="animation-delay:.75s"/>

                    <g font-size="15" font-weight="500" fill="#475569" text-anchor="middle">
                        <text x="110" y="140">Mês 1</text>
                        <text x="240" y="140">Mês 3</text>
                        <text x="370" y="140" fill="#2749d1" font-weight="700">Mês 6</text>
                    </g>
                </svg>

                <p class="mt-5 text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Gráfico ilustrativo. Mais visibilidade tende a atrair mais clientes todos os dias.
                </p>
            </div>

            <!-- Gráfico 3 (Etapa 3): Horas de trabalho por dia -->
            <div x-show="chartIndex === 3" x-transition.opacity.duration.400ms x-cloak>
                <p class="mt-1 text-lg sm:text-xl font-bold text-slate-800">Horas de trabalho por dia</p>

                <div class="mt-4 flex items-center justify-center gap-4 sm:gap-6 text-sm font-medium text-slate-600">
                    <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-slate-300"></span>Sem site</span>
                    <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-brand-500"></span>Com site</span>
                </div>

                <svg viewBox="0 0 480 170" class="w-full h-auto mt-4" role="img"
                     aria-label="Horas de trabalho por dia: com site, o tempo necessário para operar o negócio diminui">
                    <defs>
                        <linearGradient id="wsBar3" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#5c85ff"/>
                            <stop offset="100%" stop-color="#2749d1"/>
                        </linearGradient>
                    </defs>

                    <line x1="30" y1="120" x2="450" y2="120" stroke="#e2e8f0" stroke-width="1"/>

                    <rect class="ws-rise" x="79" y="40" width="28" height="80" rx="4" fill="#dbe3ee"/>
                    <rect class="ws-rise" x="113" y="45" width="28" height="75" rx="4" fill="url(#wsBar3)" style="animation-delay:.15s"/>

                    <rect class="ws-rise" x="209" y="38" width="28" height="82" rx="4" fill="#dbe3ee" style="animation-delay:.3s"/>
                    <rect class="ws-rise" x="243" y="70" width="28" height="50" rx="4" fill="url(#wsBar3)" style="animation-delay:.45s"/>

                    <rect class="ws-rise" x="339" y="35" width="28" height="85" rx="4" fill="#dbe3ee" style="animation-delay:.6s"/>
                    <rect class="ws-rise" x="373" y="95" width="28" height="25" rx="4" fill="url(#wsBar3)" style="animation-delay:.75s"/>

                    <g font-size="15" font-weight="500" fill="#475569" text-anchor="middle">
                        <text x="110" y="140">Mês 1</text>
                        <text x="240" y="140">Mês 3</text>
                        <text x="370" y="140" fill="#2749d1" font-weight="700">Mês 6</text>
                    </g>
                </svg>

                <p class="mt-5 text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Gráfico ilustrativo. Automatizar tarefas com um site reduz o tempo operacional necessário.
                </p>
            </div>

            <!-- Gráfico 4 (Etapas 4 e 5): Investimento necessário -->
            <div x-show="chartIndex === 4" x-transition.opacity.duration.400ms x-cloak>
                <p class="mt-1 text-lg sm:text-xl font-bold text-slate-800">Investimento necessário</p>

                <div class="mt-4 flex items-center justify-center gap-4 sm:gap-6 text-sm font-medium text-slate-600">
                    <span class="inline-flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-slate-300"></span>Sem site</span>
                    <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-brand-500"></span>Com site</span>
                </div>

                <svg viewBox="0 0 480 170" class="w-full h-auto mt-4" role="img"
                     aria-label="Investimento necessário: manter um site exige um investimento cada vez menor com o tempo">
                    <defs>
                        <linearGradient id="wsBar4" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#5c85ff"/>
                            <stop offset="100%" stop-color="#2749d1"/>
                        </linearGradient>
                    </defs>

                    <line x1="30" y1="120" x2="450" y2="120" stroke="#e2e8f0" stroke-width="1"/>

                    <rect class="ws-rise" x="79" y="90" width="28" height="30" rx="4" fill="#dbe3ee"/>
                    <rect class="ws-rise" x="113" y="92" width="28" height="28" rx="4" fill="url(#wsBar4)" style="animation-delay:.15s"/>

                    <rect class="ws-rise" x="209" y="65" width="28" height="55" rx="4" fill="#dbe3ee" style="animation-delay:.3s"/>
                    <rect class="ws-rise" x="243" y="100" width="28" height="20" rx="4" fill="url(#wsBar4)" style="animation-delay:.45s"/>

                    <rect class="ws-rise" x="339" y="30" width="28" height="90" rx="4" fill="#dbe3ee" style="animation-delay:.6s"/>
                    <rect class="ws-rise" x="373" y="105" width="28" height="15" rx="4" fill="url(#wsBar4)" style="animation-delay:.75s"/>

                    <g font-size="15" font-weight="500" fill="#475569" text-anchor="middle">
                        <text x="110" y="140">Mês 1</text>
                        <text x="240" y="140">Mês 3</text>
                        <text x="370" y="140" fill="#2749d1" font-weight="700">Mês 6</text>
                    </g>
                </svg>

                <p class="mt-5 text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Gráfico ilustrativo. Um site bem estruturado reduz a dependência de investir cada vez mais em anúncios.
                </p>
            </div>
        </div>
    </div>

    <p class="text-center text-sm text-slate-400 mt-8" style="color:darkblue">
        Prefere conversar diretamente?
        <a href="{{ route('contact.human') }}" class="text-brand-700 font-medium hover:text-brand-800 hover:underline transition-colors duration-200">Fale com um atendente humano</a>.
    </p>
</div>

<style>
    .ws-grow { transition: transform 1600ms cubic-bezier(.22,.61,.36,1),
                           opacity 1600ms ease-out,
                           height 1400ms cubic-bezier(.22,.61,.36,1); }

    @keyframes ws-drift-a { 0%,100% { transform: translate(0,0); }   50% { transform: translate(30px,-20px); } }
    @keyframes ws-drift-b { 0%,100% { transform: translate(0,0); }   50% { transform: translate(-25px,25px); } }
    @keyframes ws-drift-c { 0%,100% { transform: translate(0,0); }   50% { transform: translate(20px,15px); } }

    .ws-drift-a { animation: ws-drift-a 22s ease-in-out infinite; }
    .ws-drift-b { animation: ws-drift-b 28s ease-in-out infinite; }
    .ws-drift-c { animation: ws-drift-c 25s ease-in-out infinite; }

    /* Gráfico de faturamento */
    .ws-fade { opacity: 0; animation: ws-fade 1.2s ease-out 1.4s forwards; }
    @keyframes ws-fade { to { opacity: 1; } }

    .ws-rise { transform-box: fill-box; transform-origin: center bottom; transform: scaleY(0);
               animation: ws-rise 1.2s cubic-bezier(.22,.61,.36,1) forwards; }
    @keyframes ws-rise { to { transform: scaleY(1); } }

    @media (prefers-reduced-motion: reduce) {
        .ws-drift-a, .ws-drift-b, .ws-drift-c { animation: none; }
        .ws-grow { transition-duration: 1ms; }
        .ws-fade { animation: none; opacity: 1; }
        .ws-rise { animation: none; transform: none; }
    }
</style>

<script>

    function onboardingWizard() {
        return {
            step: 1,
            totalSteps: 5,
            loading: false,
            request_type: '',
            data: {
                business_type: '',
                business_size: '',
                sales_volume: '',
                organization_method: '',
                name: '',
                email: '',
            },
            get progress() {
                return (this.step - 1) / (this.totalSteps - 1); // 0 → 0.25 → 0.5 → 0.75 → 1
            },
            get chartIndex() {
                // Etapa 1 → gráfico 1, Etapa 2 → gráfico 2, Etapa 3 → gráfico 3,
                // Etapas 4 e 5 → gráfico 4 (não há um 5º gráfico)
                return Math.min(this.step, 4);
            },
            get isStepValid() {
                switch (this.step) {
                    case 1: return this.data.business_type.trim() !== '';
                    case 2: return this.data.business_size !== '';
                    case 3: return this.data.sales_volume !== '';
                    case 4: return this.data.organization_method !== '';
                    default: return true;
                }
            },
            next() {
                if (this.step < this.totalSteps) this.step++;
            },
            prev() {
                if (this.step > 1) this.step--;
            },
        }
    }
</script>
@endsection