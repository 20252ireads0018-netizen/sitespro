@extends('portfolio.Consultoria.layout')

@section('titulo', 'Contato')
@section('subtitulo', 'Fale com a gente e veja as mensagens recebidas')

@section('conteudo')

    {{-- Canais --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-10">
        @foreach ($canais as $canal)
            <div class="bg-white rounded-lg p-5 border border-studio-200">
                <p class="text-xs text-studio-500 mb-1">{{ $canal['tipo'] }}</p>
                <p class="font-medium text-studio-900">{{ $canal['valor'] }}</p>
                <p class="text-xs text-studio-400 mt-2">{{ $canal['horario'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Formulário --}}
    <div class="bg-white rounded-lg border border-studio-200 p-6 sm:p-8 mb-10">
        <h2 class="font-display text-2xl text-studio-900 mb-5">Envie uma mensagem</h2>

        <form @submit.prevent="$dispatch('abrir-aviso')" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="text-xs text-studio-500 mb-1 block">Nome</label>
                <input type="text" placeholder="Seu nome completo"
                       class="w-full text-sm border border-studio-200 rounded-md px-4 py-2.5 text-studio-800 placeholder-studio-400 focus:outline-none focus:ring-2 focus:ring-selo-100 focus:border-selo-400">
            </div>
            <div>
                <label class="text-xs text-studio-500 mb-1 block">E-mail</label>
                <input type="email" placeholder="voce@exemplo.com"
                       class="w-full text-sm border border-studio-200 rounded-md px-4 py-2.5 text-studio-800 placeholder-studio-400 focus:outline-none focus:ring-2 focus:ring-selo-100 focus:border-selo-400">
            </div>
            <div class="sm:col-span-2">
                <label class="text-xs text-studio-500 mb-1 block">Assunto</label>
                <input type="text" placeholder="Sobre o que você quer falar"
                       class="w-full text-sm border border-studio-200 rounded-md px-4 py-2.5 text-studio-800 placeholder-studio-400 focus:outline-none focus:ring-2 focus:ring-selo-100 focus:border-selo-400">
            </div>
            <div class="sm:col-span-2">
                <label class="text-xs text-studio-500 mb-1 block">Mensagem</label>
                <textarea rows="4" placeholder="Conte um pouco sobre o seu momento financeiro"
                          class="w-full text-sm border border-studio-200 rounded-md px-4 py-2.5 text-studio-800 placeholder-studio-400 focus:outline-none focus:ring-2 focus:ring-selo-100 focus:border-selo-400"></textarea>
            </div>
            <div class="sm:col-span-2">
                <button type="submit"
                        class="text-sm font-medium bg-selo-600 hover:bg-selo-700 text-white rounded-md px-5 py-2.5 transition">
                    Enviar mensagem
                </button>
            </div>
        </form>
    </div>

    {{-- Mensagens recebidas --}}
    <div>
        <h2 class="font-display text-2xl text-studio-900 mb-5">Mensagens recebidas</h2>

        <div class="bg-white rounded-lg border border-studio-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-studio-50 text-studio-500 text-xs">
                            <th class="text-left font-medium px-5 py-3">Nome</th>
                            <th class="text-left font-medium px-5 py-3">E-mail</th>
                            <th class="text-left font-medium px-5 py-3">Assunto</th>
                            <th class="text-left font-medium px-5 py-3">Recebida</th>
                            <th class="text-left font-medium px-5 py-3">Situação</th>
                            <th class="text-right font-medium px-5 py-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-studio-100">
                        @foreach ($mensagens as $m)
                            <tr class="hover:bg-studio-50 transition">
                                <td class="px-5 py-3 whitespace-nowrap font-medium text-studio-900">{{ $m['nome'] }}</td>
                                <td class="px-5 py-3 whitespace-nowrap text-studio-500">{{ $m['email'] }}</td>
                                <td class="px-5 py-3 text-studio-700">{{ $m['assunto'] }}</td>
                                <td class="px-5 py-3 whitespace-nowrap text-studio-500">{{ $m['data']->diffForHumans() }}</td>
                                <td class="px-5 py-3 whitespace-nowrap">
                                    <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $m['respondida'] ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                                        {{ $m['respondida'] ? 'Respondida' : 'Pendente' }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-right whitespace-nowrap">
                                    <button @click="$dispatch('abrir-aviso')" class="text-xs font-medium text-selo-600 hover:text-selo-700">Responder</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection