<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/',[EventController::class, 'index'])->name('events.index');

Route::get('/events', [EventController::class, 'index'])->name('events.index');

Route::get('/admin/dashboard', [EventController::class, 'adminIndex'])->name('admin.dashboard');
Route::resource('users', UserController::class);
Route::get('/events/create', [EventController::class, 'create'])->middleware(['auth', 'verified'])->name('events.create');
// Editar evento (GET)
Route::get('/events/{event}/edit', [EventController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('events.edit');

// Atualizar evento (PATCH)
Route::patch('/events/{event}', [EventController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('events.update');

// Excluir evento (DELETE)
Route::delete('/events/{event}', [EventController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('events.destroy');


// Rotas para usuários autenticados (participantes)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas públicas para visualização de eventos (para participantes)
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

    // Rotas para inscrições
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::post('/events/{event}/register', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
});



require __DIR__.'/auth.php';
