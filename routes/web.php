<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\HistorialPagoController;
use App\Http\Controllers\ComentarioController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('roles', RolController::class);
});

Route::apiResource('comentarios', ComentarioController::class);
Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('historial_pagos', HistorialPagoController::class);
Route::apiResource('propiedades',PropiedadController::class);

Route::post('/login', [UsuarioController::class, 'login']);

Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/1propiedades', function () {
    return view('1propiedades');
})->name('1propiedades');

Route::get('/2arrendatarios', function () {
    return view('2arrendatarios');
})->name('2arrendatarios');

Route::get('/3comentarios', function () {
    return view('3comentarios');
})->name('3comentarios');

Route::get('/4acerca_de', function () {
    return view('4acerca_de');
})->name('4acerca_de');

Route::get('/5login', function () {
    return view('5login');
})->name('5login');

Route::get('/6registro', function () {
    return view('6registro');
})->name('6registro');



