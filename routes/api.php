<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PagesController;

// Ruta de autenticación para iniciar sesión
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Rutas de páginas de la página principal
Route::post('/menu', [PagesController::class, 'menu']);
Route::post('/order', [PagesController::class, 'order']);
Route::post('/booking', [PagesController::class, 'booking']);
Route::post('/aboutus', [PagesController::class, 'aboutus']);
Route::post('/contact', [PagesController::class, 'contact']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/admin', [AdminController::class, 'admin']);
});

Route::prefix('admin')->group(function () {
    // Rutas de recursos para el controlador de usuarios
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index']);
        Route::post('/', [UsersController::class, 'store']);
        Route::get('/{id}', [UsersController::class, 'show']);
        Route::put('/{id}', [UsersController::class, 'update']);
        Route::delete('/{id}', [UsersController::class, 'destroy']);
    });

    // Rutas de recursos para el controlador de productos
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductsController::class, 'index']);
        Route::post('/', [ProductsController::class, 'store']);
        Route::get('/{id}', [ProductsController::class, 'show']);
        Route::put('/{id}', [ProductsController::class, 'update']);
        Route::delete('/{id}', [ProductsController::class, 'destroy']);
    });

    // Rutas de recursos para el controlador de pedidos
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrdersController::class, 'index']);
        Route::post('/', [OrdersController::class, 'store']);
        Route::get('/{id}', [OrdersController::class, 'show']);
        Route::put('/{id}', [OrdersController::class, 'update']);
        Route::delete('/{id}', [OrdersController::class, 'destroy']);
    });

    // Rutas de recursos para el controlador de detalles de pedidos
    Route::prefix('order-details')->group(function () {
        Route::get('/', [OrderDetailsController::class, 'index']);
        Route::post('/', [OrderDetailsController::class, 'store']);
        Route::get('/{id}', [OrderDetailsController::class, 'show']);
        Route::put('/{id}', [OrderDetailsController::class, 'update']);
        Route::delete('/{id}', [OrderDetailsController::class, 'destroy']);
    });

    // Rutas de recursos para el controlador de reservas
    Route::prefix('bookings')->group(function () {
        Route::get('/', [BookingsController::class, 'index']);
        Route::post('/', [BookingsController::class, 'store']);
        Route::get('/{id}', [BookingsController::class, 'show']);
        Route::put('/{id}', [BookingsController::class, 'update']);
        Route::delete('/{id}', [BookingsController::class, 'destroy']);
    });
});