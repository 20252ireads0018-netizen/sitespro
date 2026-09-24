@extends('layouts.app')

@section('title', 'Nosso portfólio')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-14">

    <!-- Cabeçalho -->
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight bg-gradient-to-r from-brand-700 via-brand-500 to-brand-400 bg-clip-text text-transparent">
            Nosso portfólio
        </h1>
        <p class="mt-3 text-slate-500 max-w-xl mx-auto">
            Alguns exemplos de sites que já criamos. Clique em um card para ver os detalhes.
        </p>
        <a href="{{ route('onboarding.index') }}"
           class="inline-flex items-center gap-1 mt-4 text-sm font-medium text-brand-600 hover:text-brand-800 transition-colors duration-200">
            ← Voltar para o formulário
        </a>
    </div>

    <!-- Grade de cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $projetos = [
                [
                    'titulo' => 'Loja de roupas femininas',
                    'descricao' => 'Catálogo de produtos com filtros por categoria e botão de compra direto no WhatsApp.',
                    'tag' => 'E-commerce',
                    'cor' => 'from-pink-400 to-rose-500',
                    'url' => '#',
                ],
                [
                    'titulo' => 'Consultoria financeira',
                    'descricao' => 'Site institucional com formulário de contato e agendamento de reuniões online.',
                    'tag' => 'Institucional',
                    'cor' => 'from-brand-500 to-brand-700',
                    'url' => '#',
                ],
                [
                    'titulo' => 'Restaurante e delivery',
                    'descricao' => 'Cardápio digital, pedidos online e integração com apps de entrega.',
                    'tag' => 'Delivery',
                    'cor' => 'from-amber-400 to-orange-500',
                    'url' => '#',
                ],
                [
                    'titulo' => 'Estúdio de arquitetura',
                    'descricao' => 'Portfólio visual com galeria de projetos e página de contato para orçamentos.',
                    'tag' => 'Portfólio',
                    'cor' => 'from-slate-500 to-slate-700',
                    'url' => '#',
                ],
                [
                    'titulo' => 'Clínica de estética',
                    'descricao' => 'Página de serviços com agendamento online e depoimentos de clientes.',
                    'tag' => 'Serviços',
                    'cor' => 'from-emerald-400 to-teal-600',
                    'url' => '#',
                ],
                [
                    'titulo' => 'Barbearia',
                    'descricao' => 'Site simples e direto com agenda de horários e localização integrada ao mapa.',
                    'tag' => 'Agendamento',
                    'cor' => 'from-indigo-500 to-violet-600',
                    'url' => '/siteBarbearia',
                ],
            ];
        @endphp

        @foreach ($projetos as $projeto)
            <a href="{{ $projeto['url'] }}"
               class="card-projeto group block bg-white border border-slate-200 rounded-2xl shadow-sm p-5
                      transition-all duration-300 ease-out
                      hover:shadow-lg hover:-translate-y-1 hover:scale-[1.03] hover:border-brand-300">

                <!-- Sub-tela (mockup de navegador) -->
                <div class="rounded-xl overflow-hidden border border-slate-200 shadow-inner
                            transition-transform duration-300 ease-out group-hover:scale-[1.02]">

                    <!-- Barra do navegador -->
                    <div class="flex items-center gap-1.5 bg-slate-100 px-3 py-2 border-b border-slate-200">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-400"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                    </div>

                    <!-- "Conteúdo" da sub-tela -->
                    <div class="relative h-32 bg-gradient-to-br {{ $projeto['cor'] }} p-3 flex flex-col gap-2">
                        <div class="h-2 w-2/3 bg-white/70 rounded"></div>
                        <div class="h-2 w-1/2 bg-white/50 rounded"></div>
                        <div class="mt-auto flex gap-2">
                            <div class="h-6 w-16 bg-white/80 rounded-md"></div>
                            <div class="h-6 w-6 bg-white/40 rounded-md"></div>
                        </div>

                        <!-- Overlay "ver projeto" que aparece no hover -->
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/25
                                    transition-colors duration-300 flex items-center justify-center">
                            <span class="opacity-0 group-hover:opacity-100 translate-y-1 group-hover:translate-y-0
                                         transition-all duration-300 text-white text-sm font-semibold
                                         bg-black/40 backdrop-blur-sm px-3 py-1.5 rounded-full">
                                Ver projeto →
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tag -->
                <span class="inline-block mt-4 text-[11px] font-semibold uppercase tracking-wide text-brand-600 bg-brand-50 px-2.5 py-1 rounded-full">
                    {{ $projeto['tag'] }}
                </span>

                <!-- Título e descrição -->
                <h3 class="mt-2 text-base font-semibold text-slate-900 group-hover:text-brand-700 transition-colors duration-200">
                    {{ $projeto['titulo'] }}
                </h3>
                <p class="mt-1 text-sm text-slate-500 leading-relaxed">
                    {{ $projeto['descricao'] }}
                </p>
            </a>
        @endforeach
    </div>

    <!-- CTA final -->
    <div class="mt-14 text-center">
        <p class="text-slate-500 mb-4">Gostou do que viu? Vamos criar o site do seu negócio.</p>
        <a href="{{ route('onboarding.index') }}"
           class="inline-flex items-center gap-2 bg-gradient-to-r from-brand-600 to-brand-500
                  hover:from-brand-700 hover:to-brand-600 text-white font-medium px-6 py-3 rounded-lg
                  transition-all duration-200 hover:shadow-md hover:shadow-brand-500/30">
            Começar agora →
        </a>
    </div>
</div>
@endsection