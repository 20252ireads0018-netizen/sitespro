@extends('portfolio.Consultoria.layout')

@section('titulo', 'Proposta de valor')
@section('subtitulo', 'O que nos diferencia de uma consultoria tradicional')

@section('conteudo')

    {{-- Pilares --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
        @foreach ($pilares as $pilar)
            <article class="bg-white rounded-lg border border-studio-200 p-6">
                <div class="w-11 h-11 rounded-lg bg-selo-50 flex items-center justify-center mb-4">
                    <svg viewBox="0 0 24 24" class="w-5 h-5 text-selo-600" fill="none" stroke="currentColor" stroke-width="1.6">
                        @switch($pilar['icone'])
                            @case('olho')
                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z" /><circle cx="12" cy="12" r="3" />
                                @break
                            @case('escudo')
                                <path d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7z" />
                                @break
                            @case('usuario')
                                <circle cx="12" cy="8" r="3.5" /><path d="M5 20c1-4 4-6 7-6s6 2 7 6" />
                                @break
                            @default
                                <path d="M4 19V9m6 10V5m6 14v-7" />
                        @endswitch
                    </svg>
                </div>
                <h2 class="font-display text-xl text-studio-900">{{ $pilar['titulo'] }}</h2>
                <p class="text-sm text-studio-600 leading-relaxed mt-2">{{ $pilar['descricao'] }}</p>
            </article>
        @endforeach
    </div>

    {{-- Comparativo --}}
    <div>
        <h2 class="font-display text-2xl text-studio-900 mb-5">Consultoria independente x modelo tradicional</h2>

        <div class="bg-white rounded-lg border border-studio-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-studio-50 text-studio-500 text-xs">
                            <th class="text-left font-medium px-5 py-3">Critério</th>
                            <th class="text-left font-medium px-5 py-3">Na Âncora</th>
                            <th class="text-left font-medium px-5 py-3">No modelo tradicional</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-studio-100">
                        @foreach ($comparativo as $linha)
                            <tr class="hover:bg-studio-50 transition">
                                <td class="px-5 py-3 font-medium text-studio-900 whitespace-nowrap">{{ $linha['criterio'] }}</td>
                                <td class="px-5 py-3 text-selo-700">{{ $linha['nos'] }}</td>
                                <td class="px-5 py-3 text-studio-500">{{ $linha['mercado'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection