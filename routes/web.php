<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// Página de inicio
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Autenticación
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Olvidaste tu contraseña
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// 🔹 Rutas de categorías
Route::get('/categoria/{categoria}', [CategoryController::class, 'show'])
    ->whereIn('categoria', ['accesorios', 'moda', 'a_mano', 'artesano'])
    ->name('categoria.show');

// 🔒 Rutas protegidas (requieren autenticación)
Route::middleware(['auth'])->group(function () {
    Route::get('/index', function () {
        return view('auth.index');
    })->name('index');

    Route::get('/home', function () {
        return redirect()->route('index');
    })->name('home');

    // Perfil
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/perfil/update', [ProfileController::class, 'update'])->name('profile.update');

    // Productos
    Route::resource('products', ProductController::class)->except(['show']);
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    // Vistas individuales de productos
    Route::view('/producto-bolso', 'auth.producto_bolso')->name('producto.bolso');
    Route::view('/producto-arequipe', 'auth.producto_arequipe')->name('producto.arequipe');
    Route::view('/producto-llavero', 'auth.producto_llavero')->name('producto.llavero');
    Route::view('/producto-pintura', 'auth.producto_pintura')->name('producto.pintura');
});
