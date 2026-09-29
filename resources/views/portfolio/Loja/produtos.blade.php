@extends('portfolio.Loja.layout')

@section('titulo', 'Produtos')
@section('subtitulo', 'Catálogo da loja, com estoque e destaques')

@section('conteudo')

    @php
        $temFoto = function ($nome) {
            $slug = \Illuminate\Support\Str::slug($nome);
            foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
                if (file_exists(public_path("images/{$slug}.{$ext}"))) {
                    return true;
                }
            }
            return false;
        };

        $lista = collect($produtos)->filter(fn ($p) => $temFoto($p['nome']))->values();
        $categorias = $lista->pluck('categoria')->unique()->values();
        $semEstoque = $lista->where('estoque', 0)->count();
    @endphp

    {{-- Resumo --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Produtos cadastrados</p>
            <p class="font-display text-4xl text-studio-900" style="-webkit-text-fill-color: currentColor; background: none;">{{ $lista->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Em destaque</p>
            <p class="font-display text-4xl text-rosa-600" style="-webkit-text-fill-color: currentColor; background: none;">{{ $lista->where('destaque', true)->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Categorias</p>
            <p class="font-display text-4xl text-studio-900" style="-webkit-text-fill-color: currentColor; background: none;">{{ $categorias->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Sem estoque</p>
            <p class="font-display text-4xl {{ $semEstoque > 0 ? 'text-red-500' : 'text-studio-900' }}" style="-webkit-text-fill-color: currentColor; background: none;">{{ $semEstoque }}</p>
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
                    class="text-sm font-medium bg-rosa-600 hover:bg-rosa-700 text-white rounded-md px-4 py-2 transition">
                + Novo produto
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach ($lista as $p)
                <article x-show="categoria === 'Todos' || categoria === @js($p['categoria'])"
                         class="bg-white rounded-lg border border-studio-200 overflow-hidden flex flex-col {{ $p['estoque'] === 0 ? 'opacity-60' : '' }}">

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

        <div class="h-52 bg-gradient-to-br from-rosa-400 to-rosa-600 relative flex items-center justify-center overflow-hidden">
            @if ($temImagem)
                <img src="{{ asset($arquivo) }}" alt="{{ $p['nome'] }}" loading="lazy"
                    class="absolute inset-0 w-full h-full object-cover object-top">
            @else
                <svg viewBox="0 0 24 24" class="w-10 h-10 text-white/85" fill="none" stroke="currentColor" stroke-width="1.6">
                    <path d="M9 6V5a3 3 0 016 0v1" />
                    <path d="M6 6h12l1 14H5z" />
                </svg>
            @endif

            @if ($p['destaque'])
                <span class="absolute top-3 left-3 z-10 text-xs font-medium px-2.5 py-1 rounded-full bg-white/90 text-rosa-700 shadow-sm">Destaque</span>
            @endif
            <span class="absolute top-3 right-3 z-10 text-xs font-medium px-2.5 py-1 rounded-full shadow-sm {{ $p['estoque'] > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-studio-100 text-studio-600' }}">
                {{ $p['estoque'] > 0 ? 'Em estoque' : 'Esgotado' }}
            </span>
        </div>

                    <div class="p-5 flex-1 flex flex-col">
                        <span class="text-xs font-medium text-rosa-600 bg-rosa-50 rounded-full px-2.5 py-1 self-start">{{ $p['categoria'] }}</span>
                        <h2 class="font-display text-xl text-studio-900 mt-3" style="-webkit-text-fill-color: currentColor; background: none;">{{ $p['nome'] }}</h2>
                        <p class="text-sm text-studio-500 mt-1">Cor: {{ $p['cor'] }} · Tamanhos: {{ implode(', ', $p['tamanhos']) }}</p>

                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-studio-100">
                            <p class="text-xs text-studio-400">{{ $p['estoque'] }} un. disponíveis</p>
                            <p class="font-display text-lg text-studio-900" style="-webkit-text-fill-color: currentColor; background: none;">R$ {{ number_format($p['preco'], 2, ',', '.') }}</p>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <button @click="$dispatch('abrir-aviso')" class="text-sm font-medium text-rosa-600 hover:text-rosa-700">
                                Editar
                            </button>
                            <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-studio-500 hover:text-studio-900">
                                Comprar via WhatsApp
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

@endsection