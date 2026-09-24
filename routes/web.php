<?php

use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\BarbeariaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OnboardingController::class, 'index'])->name('onboarding.index');
Route::post('/solicitacoes', [OnboardingController::class, 'store'])->name('onboarding.store');
Route::get('/obrigado', [OnboardingController::class, 'thanks'])->name('onboarding.thanks');

Route::get('/falar-com-humano', [OnboardingController::class, 'humanContact'])->name('contact.human');
Route::post('/falar-com-humano', [OnboardingController::class, 'storeHumanContact'])->name('contact.human.store');

Route::view('/portfolio', 'portfolio.index')->name('portfolio.index');

Route::get('/siteBarbearia', function () {
    return view('portfolio.barbearia.siteBarbearia');
})->name('siteBarbearia');

Route::prefix('barbearia')->name('barbearia.')->group(function () {

    Route::get('/agenda', [BarbeariaController::class, 'agenda'])->name('agenda');
    Route::get('/agendamentos', [BarbeariaController::class, 'agendamentosIndex'])->name('agendamentos.index');

    Route::get('/financeiro', [BarbeariaController::class, 'financeiro'])->name('financeiro');
    Route::get('/maquinario', [BarbeariaController::class, 'maquinario'])->name('maquinario');
    Route::get('/funcionario', [BarbeariaController::class, 'funcionario'])->name('funcionario');

});