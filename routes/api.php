<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropiedadController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\HistorialPagoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/api/propiedades', [PropiedadController::class, 'index']);
Route::get('/api/propiedades/{id}', [PropiedadController::class, 'show'])->name('api.propiedades.show');
Route::post('/api/propiedades', [PropiedadController::class, 'store'])->name('api.propiedades.store');
Route::put('/api/propiedades/{id}', [PropiedadController::class, 'update'])->name('api.propiedades.update');
Route::delete('/api/propiedades/{id}', [PropiedadController::class, 'destroy'])->name('api.propiedades.destroy');

Route::get('/comentarios', [ComentarioController::class, 'index']);
Route::post('/comentarios', [ComentarioController::class, 'store']);
Route::put('/comentarios/{id}', [ComentarioController::class, 'update']);
Route::delete('/comentarios/{id}', [ComentarioController::class, 'destroy']);
Route::get('/comentarios/{id}', [ComentarioController::class, 'show']);

Route::get('/api/historial_pagos', [HistorialPagoController::class, 'index']);
Route::post('/api/historial_pagos', [HistorialPagoController::class, 'store']);
Route::put('/api/historial_pagos/{id}', [HistorialPagoController::class, 'update']);
Route::delete('/historial_pagos/{id}', [HistorialPagoController::class, 'destroy']);
Route::get('/historial_pagos/{id}', [HistorialPagoController::class, 'show']);

