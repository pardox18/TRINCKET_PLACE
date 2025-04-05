<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PaymentController; // Controlador de métodos de pago

// Página de inicio (Welcome)
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

    // Página principal después de iniciar sesión
    Route::get('/home', function () {
        return redirect()->route('index');
    })->name('home');

    // Página de inicio después de autenticación
    Route::get('/index', function () {
        return view('auth.index');
    })->name('index');

    // Perfil
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/perfil/update', [ProfileController::class, 'update'])->name('profile.update');

    // Productos (CRUD)
    Route::resource('products', ProductController::class)->except(['show']);
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('producto/{id}', [ProductController::class, 'show'])->name('producto.show');
    // Vistas individuales de productos
    Route::view('/producto-bolso', 'auth.producto_bolso')->name('producto.bolso');
    Route::view('/producto-arequipe', 'auth.producto_arequipe')->name('producto.arequipe');
    Route::view('/producto-llavero', 'auth.producto_llavero')->name('producto.llavero');
    Route::view('/producto-pintura', 'auth.producto_pintura')->name('producto.pintura');

    // Carrito
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregarAlCarrito'])->name('carrito.agregar');
    Route::post('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
    Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

    // Rutas de pago
    Route::post('procesar-pago', [PaymentController::class, 'procesarPago'])->name('pago.procesar');
    Route::get('/metodos-pago', [PaymentController::class, 'index'])->name('metodos.pago');
    
    // Agregar ruta para la lista de productos (product.index)
    Route::get('productos', [ProductController::class, 'index'])->name('product.index');
});

