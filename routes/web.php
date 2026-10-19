<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Controlux (JC URBAN)
|--------------------------------------------------------------------------
*/

// Inicio de la tienda
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas de invitados (No autenticados)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/registro', [AuthController::class, 'showRegisterForm'])->name('registro');
    Route::post('/registro', [AuthController::class, 'register']);
});

// Rutas de usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Perfil de usuario (RF-05)
    Route::get('/perfil', [ProfileController::class, 'show'])->name('perfil');
    Route::put('/perfil/envio', [ProfileController::class, 'updateShipping'])->name('perfil.shipping');
    Route::put('/perfil/password', [ProfileController::class, 'updatePassword'])->name('perfil.password');

    // Panel Administrativo (RF-18 protegido con middleware 'admin')
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });
});
