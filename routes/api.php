<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\CommandController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('devices')->group(function () {
    Route::get('/', [DeviceController::class, 'index']); // Lista todos os dispositivos
    Route::post('/', [DeviceController::class, 'store']); // Cria um novo dispositivo
    Route::get('/{id}', [DeviceController::class, 'show']); // Exibe um dispositivo específico
    Route::put('/{id}', [DeviceController::class, 'update']); // Atualiza um dispositivo
    Route::delete('/{id}', [DeviceController::class, 'destroy']); // Exclui um dispositivo
});

Route::prefix('commands')->group(function () {
    Route::get('/', [CommandController::class, 'index']); // Lista todos os dispositivos
    Route::post('/', [CommandController::class, 'store']); // Cria um novo dispositivo
    Route::get('/{id}', [CommandController::class, 'show']); // Exibe um dispositivo específico
    Route::put('/{id}', [CommandController::class, 'update']); // Atualiza um dispositivo
    Route::delete('/{id}', [CommandController::class, 'destroy']); // Exclui um dispositivo
});
