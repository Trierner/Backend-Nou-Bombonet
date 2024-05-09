<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\DetallesPedidosController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\AuthController;

Route::prefix("login")->group(function () {
    Route::post('/', [AuthController::class, 'login']);
});

Route::prefix("register")->group(function () {
    Route::post('/', [AuthController::class, 'register']);
});

Route::middleware('auth:api')->post('logout', [AuthController::class, 'logout']);

Route::prefix('users')->group(function () {
    Route::get('/', [UsersController::class, 'index']);
    Route::post('/', [UsersController::class, 'store']);
    Route::get('/{id}', [UsersController::class, 'show']);
    Route::put('/{id}', [UsersController::class, 'update']);
    Route::delete('/{id}', [UsersController::class, 'destroy']);
});

Route::prefix('productos')->group(function () {
    Route::get('/', [ProductosController::class, 'index']);
    Route::post('/', [ProductosController::class, 'store']);
    Route::get('/{id}', [ProductosController::class, 'show']);
    Route::put('/{id}', [ProductosController::class, 'update']);
    Route::delete('/{id}', [ProductosController::class, 'destroy']);
});

Route::prefix('pedidos')->group(function () {
    Route::get('/', [PedidosController::class, 'index']);
    Route::post('/', [PedidosController::class, 'store']);
    Route::get('/{id}', [PedidosController::class, 'show']);
    Route::put('/{id}', [PedidosController::class, 'update']);
    Route::delete('/{id}', [PedidosController::class, 'destroy']);
});

Route::prefix('detalles-pedidos')->group(function () {
    Route::get('/', [DetallesPedidosController::class, 'index']);
    Route::post('/', [DetallesPedidosController::class, 'store']);
    Route::get('/{id}', [DetallesPedidosController::class, 'show']);
    Route::put('/{id}', [DetallesPedidosController::class, 'update']);
    Route::delete('/{id}', [DetallesPedidosController::class, 'destroy']);
});

Route::prefix('reservas')->group(function () {
    Route::get('/', [ReservasController::class, 'index']);
    Route::post('/', [ReservasController::class, 'store']);
    Route::get('/{id}', [ReservasController::class, 'show']);
    Route::put('/{id}', [ReservasController::class, 'update']);
    Route::delete('/{id}', [ReservasController::class, 'destroy']);
});
