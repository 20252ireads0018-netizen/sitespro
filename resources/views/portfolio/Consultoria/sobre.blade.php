@extends('portfolio.Consultoria.layout')

@section('titulo', 'Sobre a empresa')
@section('subtitulo', 'Quem somos e como chegamos até aqui')

@section('conteudo')

    {{-- Números --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        @foreach ($numeros as $n)
            <div class="bg-white rounded-lg p-5 border border-studio-200">
                <p class="font-display text-4xl text-studio-900">{{ $n['valor'] }}</p>
                <p class="text-xs text-studio-500 mt-1">{{ $n['rotulo'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Apresentação --}}
    <div class="bg-white rounded-lg border border-studio-200 p-6 sm:p-8 mb-10">
        <h2 class="font-display text-2xl text-studio-900 mb-3">Quem somos</h2>
        <p class="text-sm text-studio-600 leading-relaxed max-w-3xl">
            A Âncora é uma consultoria financeira independente, sem vínculo com bancos ou corretoras. Ajudamos pessoas
            e pequenas empresas a organizar suas finanças, planejar investimentos e tomar decisões com mais segurança,
            sempre com um plano construído sob medida para cada realidade.
        </p>
    </div>

    {{-- Linha do tempo --}}
    <div class="mb-10">
        <h2 class="font-display text-2xl text-studio-900 mb-5">Nossa trajetória</h2>
        <div class="space-y-0">
            @foreach ($linhaDoTempo as $i => $marco)
                <div class="flex gap-5">
                    <div class="flex flex-col items-center">
                        <span class="w-3 h-3 rounded-full bg-selo-500 shrink-0 mt-1.5"></span>
                        @if (! $loop->last)
                            <span class="w-px flex-1 bg-studio-200 my-1"></span>
                        @endif
                    </div>
                    <div class="pb-8">
                        <p class="font-display text-lg text-studio-900">{{ $marco['ano'] }}</p>
                        <p class="text-sm text-studio-600 leading-relaxed mt-1 max-w-2xl">{{ $marco['texto'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Equipe --}}
    <div>
        <h2 class="font-display text-2xl text-studio-900 mb-5">Equipe</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            @foreach ($equipe as $pessoa)
                <article class="bg-white rounded-lg border border-studio-200 p-5 text-center">
                    <div class="w-14 h-14 mx-auto rounded-full bg-studio-100 text-studio-700 font-medium flex items-center justify-center text-lg">
                        {{ Str::substr($pessoa['nome'], 0, 1) }}
                    </div>
                    <h3 class="font-medium text-studio-900 mt-3">{{ $pessoa['nome'] }}</h3>
                    <p class="text-xs text-selo-600 mt-0.5">{{ $pessoa['cargo'] }}</p>
                    <p class="text-xs text-studio-500 mt-2">{{ $pessoa['especialidade'] }}</p>
                </article>
            @endforeach
        </div>
    </div>

@endsection