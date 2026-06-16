<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

// Rotas Públicas (Visitante / Qualquer perfil)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events/{event}', [HomeController::class, 'show'])->name('events.show');

// Rotas de Autenticação Manual
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Rotas Protegidas do Módulo do Organizador
Route::middleware(['auth', \App\Http\Middleware\OrganizerMiddleware::class])->group(function () {
    Route::get('/admin/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/admin/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/admin/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/admin/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/admin/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/admin/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});

// Rotas Protegidas do Módulo do Participante (Inscrições)
Route::middleware(['auth', \App\Http\Middleware\ParticipantMiddleware::class])->group(function () {
    Route::post('/events/{event}/subscribe', [SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::get('/my-tickets', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::delete('/subscriptions/{event}', [SubscriptionController::class, 'destroy'])->name('subscriptions.destroy');
});