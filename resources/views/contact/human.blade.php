@extends('layouts.app')

@section('title', 'Falar com um atendente humano')

@section('content')
<div class="max-w-xl mx-auto px-6 py-16">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Fale com um de nós</h1>
        <p class="mt-3 text-slate-500">
            Prefere conversar diretamente? Deixe seus dados e um atendente vai te chamar.
        </p>
    </div>

    <form action="{{ route('contact.human.store') }}" method="POST"
          class="bg-white border border-slate-200 rounded-2xl shadow-sm p-8 space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nome</label>
            <input type="text" name="name" required value="{{ old('name') }}"
                   class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">E-mail</label>
            <input type="email" name="email" required value="{{ old('email') }}"
                   class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Telefone / WhatsApp</label>
            <input type="text" name="phone" required value="{{ old('phone') }}"
                   class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Mensagem (opcional)</label>
            <textarea name="message" rows="4"
                      class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-brand-500 focus:border-brand-500"
                      placeholder="Conte rapidamente o que você precisa...">{{ old('message') }}</textarea>
        </div>

        @if ($errors->any())
            <div class="rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit"
                class="w-full bg-brand-600 hover:bg-brand-700 text-white font-medium px-6 py-3 rounded-lg transition">
            Quero ser contactado
        </button>
    </form>

    <p class="text-center text-sm text-slate-400 mt-6">
        <a href="{{ route('onboarding.index') }}" class="text-brand-700 font-medium hover:underline">← Voltar ao questionário</a>
    </p>
</div>
@endsection
