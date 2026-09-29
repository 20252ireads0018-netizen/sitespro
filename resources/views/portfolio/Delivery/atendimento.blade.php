@extends('portfolio.Delivery.layout')

@section('titulo', 'Atendimento pessoal')
@section('subtitulo', 'Conversas e solicitações dos clientes')

@section('conteudo')

    @php
        $lista = collect($atendimentos)->sortByDesc('data');
        $emAndamento = $lista->where('status', 'Em andamento')->count();
        $pendentes = $lista->where('status', 'Pendente')->count();

        $coresStatus = [
            'Pendente'     => 'bg-amber-50 text-amber-700',
            'Em andamento' => 'bg-sky-50 text-sky-700',
            'Resolvido'    => 'bg-emerald-50 text-emerald-700',
        ];

        $coresCanal = [
            'WhatsApp' => 'bg-emerald-50 text-emerald-700',
            'Telefone' => 'bg-violet-50 text-violet-700',
            'Chat'     => 'bg-sky-50 text-sky-700',
            'App'      => 'bg-brasa-50 text-brasa-700',
        ];
    @endphp

    {{-- Resumo --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Atendimentos hoje</p>
            <p class="font-display text-4xl text-studio-900">{{ $lista->count() }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Pendentes</p>
            <p class="font-display text-4xl {{ $pendentes > 0 ? 'text-amber-600' : 'text-studio-900' }}">{{ $pendentes }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Em andamento</p>
            <p class="font-display text-4xl text-sky-600">{{ $emAndamento }}</p>
        </div>
        <div class="bg-white rounded-lg p-5 border border-studio-200">
            <p class="text-xs text-studio-500 mb-1">Resolvidos hoje</p>
            <p class="font-display text-4xl text-emerald-600">{{ $lista->where('status', 'Resolvido')->count() }}</p>
        </div>
    </div>

    <div x-data="{ status: 'Todos' }">

        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
            <div class="flex gap-2 overflow-x-auto">
                @foreach (['Todos', 'Pendente', 'Em andamento', 'Resolvido'] as $opcao)
                    <button @click="status = @js($opcao)"
                            :class="status === @js($opcao) ? 'bg-studio-900 text-white border-studio-900' : 'bg-white text-studio-600 border-studio-200 hover:bg-studio-100'"
                            class="text-xs font-medium border rounded-full px-4 py-1.5 whitespace-nowrap transition">
                        {{ $opcao }}
                    </button>
                @endforeach
            </div>
            <button @click="$dispatch('abrir-aviso')"
                    class="text-sm font-medium bg-brasa-600 hover:bg-brasa-700 text-white rounded-md px-4 py-2 transition">
                + Novo atendimento
            </button>
        </div>

        <div class="bg-white rounded-lg border border-studio-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-studio-50 text-studio-500 text-xs">
                            <th class="text-left font-medium px-5 py-3">Cliente</th>
                            <th class="text-left font-medium px-5 py-3">Pedido</th>
                            <th class="text-left font-medium px-5 py-3">Assunto</th>
                            <th class="text-left font-medium px-5 py-3">Canal</th>
                            <th class="text-left font-medium px-5 py-3">Situação</th>
                            <th class="text-right font-medium px-5 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-studio-100">
                        @foreach ($lista as $a)
                            <tr class="hover:bg-studio-50 transition" x-show="status === 'Todos' || status === @js($a['status'])">
                                <td class="px-5 py-3 whitespace-nowrap font-medium text-studio-900">{{ $a['cliente'] }}</td>
                                <td class="px-5 py-3 whitespace-nowrap text-studio-500">{{ $a['pedido'] }}</td>
                                <td class="px-5 py-3 text-studio-700">{{ $a['assunto'] }}</td>
                                <td class="px-5 py-3 whitespace-nowrap">
                                    <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $coresCanal[$a['canal']] ?? 'bg-studio-100 text-studio-600' }}">
                                        {{ $a['canal'] }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 whitespace-nowrap">
                                    <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $coresStatus[$a['status']] ?? 'bg-studio-100 text-studio-600' }}">
                                        {{ $a['status'] }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-right whitespace-nowrap">
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-brasa-600 hover:text-brasa-700 mr-3">Responder</button>
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-studio-500 hover:text-studio-900">Fechar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection