@extends('portfolio.Delivery.layout')

@section('titulo', 'Pratos disponíveis')
@section('subtitulo', 'Cardápio digital do restaurante')

@section('conteudo')

    @php
        $lista = collect($pratos);
        $categorias = $lista->pluck('categoria')->unique()->values();
        $disponiveis = $lista->where('disponivel', true)->count();
    @endphp

    {{-- Resumo --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Itens no cardápio</p>
            <p class="font-display text-4xl text-studio-900">{{ $lista->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Disponíveis agora</p>
            <p class="font-display text-4xl text-emerald-600">{{ $disponiveis }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Categorias</p>
            <p class="font-display text-4xl text-studio-900">{{ $categorias->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Fora do cardápio hoje</p>
            <p class="font-display text-4xl text-studio-900">{{ $lista->where('disponivel', false)->count() }}</p>
        </div>
    </div>

    <div x-data="{ categoria: 'Todos' }">

        <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
            <div class="flex gap-2 overflow-x-auto">
                <button @click="categoria = 'Todos'"
                        :class="categoria === 'Todos' ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                        class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                    Todos
                </button>
                @foreach ($categorias as $cat)
                    <button @click="categoria = @js($cat)"
                            :class="categoria === @js($cat) ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                            class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>
            <button @click="$dispatch('abrir-aviso')"
                    class="text-sm font-medium bg-brasa-600 hover:bg-brasa-700 text-white rounded-md px-4 py-2 transition">
                + Novo prato
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($lista as $p)
                <article x-show="categoria === 'Todos' || categoria === @js($p['categoria'])"
                         class="bg-white rounded-lg border border-studio-200 overflow-hidden flex flex-col {{ ! $p['disponivel'] ? 'opacity-60' : '' }}">

            @php
                $slug = \Illuminate\Support\Str::slug($p['nome']);
                $arquivo = null;
                foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
                    if (file_exists(public_path("images/{$slug}.{$ext}"))) {
                        $arquivo = "images/{$slug}.{$ext}";
                        break;
                    }
                }
                $temImagem = $arquivo !== null;
            @endphp

        <div class="h-40 bg-gradient-to-br from-brasa-400 to-orange-500 relative flex items-center justify-center overflow-hidden">
            @if ($temImagem)
                <img src="{{ asset($arquivo) }}" alt="{{ $p['nome'] }}" loading="lazy"
                    class="absolute inset-0 w-full h-full object-cover">
            @else
                <svg viewBox="0 0 24 24" class="w-10 h-10 text-white/85" fill="none" stroke="currentColor" stroke-width="1.6">
                    <circle cx="12" cy="12" r="9" />
                    <path d="M7 12h10M12 7v10" />
                </svg>
            @endif

            <span class="absolute top-3 right-3 z-10 text-xs font-medium px-2.5 py-1 rounded-full shadow-sm {{ $p['disponivel'] ? 'bg-emerald-50 text-emerald-700' : 'bg-studio-100 text-studio-600' }}">
                {{ $p['disponivel'] ? 'Disponível' : 'Indisponível' }}
            </span>
        </div>

                    <div class="p-5 flex-1 flex flex-col">
                        <span class="text-xs font-medium text-brasa-600 bg-brasa-50 rounded-full px-2.5 py-1 self-start">{{ $p['categoria'] }}</span>
                        <h2 class="font-display text-xl text-studio-900 mt-3">{{ $p['nome'] }}</h2>
                        <p class="text-sm text-studio-500 mt-1 leading-relaxed flex-1">{{ $p['descricao'] }}</p>

                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-studio-100">
                            <p class="text-xs text-studio-400">{{ $p['tempoPreparo'] }} min de preparo</p>
                            <p class="font-display text-lg text-studio-900">R$ {{ number_format($p['preco'], 2, ',', '.') }}</p>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <button @click="$dispatch('abrir-aviso')" class="text-sm font-medium text-brasa-600 hover:text-brasa-700">
                                Editar
                            </button>
                            <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-studio-500 hover:text-studio-900">
                                {{ $p['disponivel'] ? 'Marcar indisponível' : 'Marcar disponível' }}
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

@endsection