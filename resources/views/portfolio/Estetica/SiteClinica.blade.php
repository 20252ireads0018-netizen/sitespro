@extends('portfolio.Estetica.layout')

@section('titulo', 'Agenda')
@section('subtitulo', 'Acompanhe os atendimentos do dia e da semana')

@section('conteudo')

    {{-- Cards de resumo --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-2xl p-5 border border-aura-100">
            <p class="text-xs text-aura-500 mb-1">Agendamentos hoje</p>
            <p class="font-display text-3xl text-aura-800">{{ $resumoHoje['agendamentosHoje'] }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-aura-100">
            <p class="text-xs text-aura-500 mb-1">Faturamento hoje</p>
            <p class="font-display text-3xl text-aura-800">R$ {{ number_format($resumoHoje['faturamento'], 2, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-aura-100">
            <p class="text-xs text-aura-500 mb-1">Clientes no mês</p>
            <p class="font-display text-3xl text-aura-800">{{ $resumoHoje['clientesMes'] }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-aura-100">
            <p class="text-xs text-aura-500 mb-1">Profissionais ativos</p>
            <p class="font-display text-3xl text-aura-800">{{ $resumoHoje['profissionaisAtivos'] }}</p>
        </div>
    </div>

    {{-- Ações --}}
    <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
        <h2 class="font-display text-xl text-aura-800">Próximos agendamentos</h2>
        <div class="flex gap-2">
            <button @click="$dispatch('abrir-aviso')"
                    class="text-sm font-medium border border-aura-200 text-aura-700 rounded-xl px-4 py-2 hover:bg-aura-50 transition">
                Filtrar
            </button>
            <button @click="$dispatch('abrir-aviso')"
                    class="text-sm font-medium bg-aura-600 hover:bg-aura-700 text-white rounded-xl px-4 py-2 transition">
                + Novo agendamento
            </button>
        </div>
    </div>

    @php
        // Procura a foto pelo NOME do arquivo em qualquer subpasta de /public
        $acharImagem = function (array $candidatos) {
            $base = public_path();
            $it = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($base, \FilesystemIterator::SKIP_DOTS)
            );
            foreach ($it as $f) {
                if (!$f->isFile()) continue;
                foreach ($candidatos as $nome) {
                    if (strcasecmp($f->getFilename(), $nome) === 0) {
                        return asset(str_replace('\\', '/', substr($f->getPathname(), strlen($base) + 1)));
                    }
                }
            }
            return null;
        };

        // Procedimento => arquivos possíveis
        $arquivosProcedimento = [
            'Limpeza de pele'       => ['limpeza-pele.jpg'],
            'Drenagem'              => ['drenagem.jpg'],
            'Peeling'               => ['peeling.jpg'],
            'Depilação'             => ['depilacao-laser.jpg'],
            'Microagulhamento'      => ['microagulhamento.jpg'],
            'Massagem'              => ['massagem.jpg'],
            'Radiofrequência'       => ['radiofrequencia.jpg'],
            'Criolipólise'          => ['criolipolise.jpg'],
            'Maquiagem'             => ['maquiagem.jpg'],
            'Design de sobrancelha' => ['sobrancelha.jpg'],
        ];

        $imagemPadrao = $acharImagem(['padrao.jpg']);

        $imagensProcedimento = [];
        foreach ($arquivosProcedimento as $chave => $candidatos) {
            $imagensProcedimento[$chave] = $acharImagem($candidatos) ?? $imagemPadrao;
        }

        $buscarImagemProcedimento = function ($procedimento) use ($imagensProcedimento, $imagemPadrao) {
            foreach ($imagensProcedimento as $chave => $url) {
                if (str_contains($procedimento, $chave)) {
                    return $url;
                }
            }
            return $imagemPadrao;
        };
    @endphp

    {{-- Tabela --}}
    <div class="bg-white rounded-2xl border border-aura-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-aura-50/60 text-aura-500 text-xs uppercase tracking-wide">
                        <th class="text-left font-medium px-5 py-3">Data</th>
                        <th class="text-left font-medium px-5 py-3">Hora</th>
                        <th class="text-left font-medium px-5 py-3">Cliente</th>
                        <th class="text-left font-medium px-5 py-3">Procedimento</th>
                        <th class="text-left font-medium px-5 py-3">Profissional</th>
                        <th class="text-left font-medium px-5 py-3">Status</th>
                        <th class="text-right font-medium px-5 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-aura-50">
                    @foreach ($agendamentos as $ag)
                        <tr class="relative hover:bg-aura-50/40 transition"
                            x-data="{ open: false, flip: false }"
                            @mouseenter="
                                const rect = $el.getBoundingClientRect();
                                flip = (window.innerHeight - rect.bottom) < 220;
                                open = true;
                            "
                            @mouseleave="open = false">
                            <td class="px-5 py-3 whitespace-nowrap text-aura-700">
                                {{ $ag['data'] }}

                                {{-- TOOLTIP: imagem do procedimento --}}
                                <div x-show="open" x-cloak x-transition
                                     :class="flip ? 'bottom-full mb-2' : 'top-full mt-2'"
                                     class="absolute left-5 z-50 w-56
                                            bg-white border border-aura-100 rounded-2xl shadow-xl overflow-hidden">
                                    <img src="{{ $buscarImagemProcedimento($ag['procedimento']) }}"
                                         alt="{{ $ag['procedimento'] }}"
                                         class="w-full h-32 object-cover">
                                    <div class="p-3">
                                        <p class="text-sm font-medium text-aura-800">{{ $ag['procedimento'] }}</p>
                                        <p class="text-xs text-aura-400 mt-0.5">{{ $ag['nome'] }} · {{ $ag['hora'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3 whitespace-nowrap text-aura-700">{{ $ag['hora'] }}</td>
                            <td class="px-5 py-3 whitespace-nowrap">
                                <p class="font-medium text-aura-800">{{ $ag['nome'] }}</p>
                                <p class="text-xs text-aura-400">{{ $ag['telefone'] }}</p>
                            </td>
                            <td class="px-5 py-3 text-aura-700">{{ $ag['procedimento'] }}</td>
                            <td class="px-5 py-3 whitespace-nowrap text-aura-700">{{ $ag['profissional'] }}</td>
                            <td class="px-5 py-3 whitespace-nowrap">
                                @php
                                    $cores = [
                                        'Confirmado' => 'bg-emerald-50 text-emerald-600',
                                        'Pendente'   => 'bg-amber-50 text-amber-600',
                                        'Concluído'  => 'bg-aura-50 text-aura-600',
                                    ];
                                @endphp
                                <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $cores[$ag['status']] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ $ag['status'] }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-right whitespace-nowrap">
                                <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-aura-600 hover:text-aura-800 mr-3">Editar</button>
                                <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-aura-400 hover:text-red-500">Cancelar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection