@extends('layouts.app')

@section('title', 'Recebemos sua solicitação')

@section('content')
<div class="max-w-lg mx-auto px-6 py-24 text-center">
    <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 flex items-center justify-center mb-6">
        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
    </div>
    <h1 class="text-2xl font-bold text-slate-900 mb-3">Recebemos suas informações!</h1>
    <p class="text-slate-500 mb-8">
        {{ session('status', 'Nossa equipe vai analisar os detalhes do seu negócio e entrará em contato em breve.') }}
    </p>
    <a href="{{ route('onboarding.index') }}"
       class="inline-block bg-brand-600 hover:bg-brand-700 text-white font-medium px-6 py-3 rounded-lg transition">
        Voltar ao início
    </a>
</div>
@endsection
