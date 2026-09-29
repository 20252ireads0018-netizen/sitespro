<?php

use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\BarbeariaController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ConsultoriaController;
use App\Http\Controllers\LojaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OnboardingController::class, 'index'])->name('onboarding.index');
Route::post('/solicitacoes', [OnboardingController::class, 'store'])->name('onboarding.store');
Route::get('/obrigado', [OnboardingController::class, 'thanks'])->name('onboarding.thanks');

Route::get('/falar-com-humano', [OnboardingController::class, 'humanContact'])->name('contact.human');
Route::post('/falar-com-humano', [OnboardingController::class, 'storeHumanContact'])->name('contact.human.store');

Route::view('/portfolio', 'portfolio.index')->name('portfolio.index');

/* Barbearia */
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

/* Clínica de estética */
Route::get('/siteClinica', [ClinicaController::class, 'agenda'])->name('siteClinica');

Route::prefix('clinica')->name('clinica.')->group(function () {
    Route::get('/agenda', [ClinicaController::class, 'agenda'])->name('agenda');
    Route::get('/financeiro', [ClinicaController::class, 'financeiro'])->name('financeiro');
    Route::get('/maquinario', [ClinicaController::class, 'maquinario'])->name('maquinario');
    Route::get('/estoque', [ClinicaController::class, 'estoque'])->name('estoque');
    Route::get('/funcionario', [ClinicaController::class, 'funcionario'])->name('funcionario');
});

/* Estúdio de arquitetura */
Route::get('/siteEstudio', [EstudioController::class, 'projetos'])->name('siteEstudio');

Route::prefix('estudio')->name('estudio.')->group(function () {
    Route::get('/projetos', [EstudioController::class, 'projetos'])->name('projetos');
    Route::get('/ideias', [EstudioController::class, 'ideias'])->name('ideias');
    Route::get('/financeiro', [EstudioController::class, 'financeiro'])->name('financeiro');
    Route::get('/contratos', [EstudioController::class, 'contratos'])->name('contratos');
    Route::get('/contatos', [EstudioController::class, 'contatos'])->name('contatos');
});

/* Restaurante delivery */
Route::get('/siteDelivery', [DeliveryController::class, 'pedidos'])->name('siteDelivery');

Route::prefix('delivery')->name('delivery.')->group(function () {
    Route::get('/pedidos', [DeliveryController::class, 'pedidos'])->name('pedidos');
    Route::get('/pratos', [DeliveryController::class, 'pratos'])->name('pratos');
    Route::get('/entregadores', [DeliveryController::class, 'entregadores'])->name('entregadores');
    Route::get('/veiculos', [DeliveryController::class, 'veiculos'])->name('veiculos');
    Route::get('/atendimento', [DeliveryController::class, 'atendimento'])->name('atendimento');
});

Route::get('/siteConsultoria', [ConsultoriaController::class, 'sobre'])->name('siteConsultoria');

Route::prefix('consultoria')->name('consultoria.')->group(function () {
    Route::get('/sobre', [ConsultoriaController::class, 'sobre'])->name('sobre');
    Route::get('/valores', [ConsultoriaController::class, 'valores'])->name('valores');
    Route::get('/servicos', [ConsultoriaController::class, 'servicos'])->name('servicos');
    Route::get('/contatos', [ConsultoriaController::class, 'contatos'])->name('contatos');
    Route::get('/agendamento', [ConsultoriaController::class, 'agendamento'])->name('agendamento');
});

/* Loja de roupas femininas */
Route::get('/siteLoja', [LojaController::class, 'produtos'])->name('siteLoja');

Route::prefix('loja')->name('loja.')->group(function () {
    Route::get('/produtos', [LojaController::class, 'produtos'])->name('produtos');
    Route::get('/encomendas', [LojaController::class, 'encomendas'])->name('encomendas');
    Route::get('/clientes', [LojaController::class, 'clientes'])->name('clientes');
    Route::get('/profissionais', [LojaController::class, 'profissionais'])->name('profissionais');
});