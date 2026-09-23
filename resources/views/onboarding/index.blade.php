@extends('layouts.app')

@section('title', 'Vamos criar o site do seu negócio')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-14"
     x-data="onboardingWizard()">

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
                    class="w-full sm:w-auto sm:ml-auto order-1 sm:order-2 bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-700 hover:to-brand-600 text-white font-medium px-6 py-3 rounded-lg transition-all duration-200 hover:shadow-md hover:shadow-brand-500/30">
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

    <p class="text-center text-sm text-slate-400 mt-8">
        Prefere conversar diretamente?
        <a href="{{ route('contact.human') }}" class="text-brand-700 font-medium hover:text-brand-800 hover:underline transition-colors duration-200">Fale com um atendente humano</a>.
    </p>
</div>

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