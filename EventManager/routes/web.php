<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('events', EventController::class);

// Rotas para inscrições (rotas protegidas para usuários autenticados)
Route::middleware('auth')->group(function () {
    Route::get('registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::post('events/{eventId}/register', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::delete('registrations/{registrationId}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
});
 
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
});


?>