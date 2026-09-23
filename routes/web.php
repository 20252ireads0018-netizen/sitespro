<?php

use App\Http\Controllers\OnboardingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OnboardingController::class, 'index'])->name('onboarding.index');
Route::post('/solicitacoes', [OnboardingController::class, 'store'])->name('onboarding.store');
Route::get('/obrigado', [OnboardingController::class, 'thanks'])->name('onboarding.thanks');

Route::get('/falar-com-humano', [OnboardingController::class, 'humanContact'])->name('contact.human');
Route::post('/falar-com-humano', [OnboardingController::class, 'storeHumanContact'])->name('contact.human.store');

Route::view('/portfolio', 'portfolio.index')->name('portfolio.index');