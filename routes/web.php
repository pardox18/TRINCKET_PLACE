<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\auth\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;

// Página pública
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/home', fn () => redirect()->route('index'))->name('home');

// Autenticación
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Recuperación de contraseña
Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Categorías
Route::get('/categoria/{categoria}', [CategoryController::class, 'show'])
    ->whereIn('categoria', ['accesorios', 'moda', 'a_mano', 'artesano'])
    ->name('categoria.show');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    Route::get('/index', [IndexController::class, 'index'])->name('index');

    // Perfil
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/perfil/update', [ProfileController::class, 'update'])->name('profile.update');

    // Productos
    Route::resource('products', ProductController::class)->except(['show']);
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/productos', [ProductController::class, 'index'])->name('product.index');

    // Productos estáticos
    Route::view('/producto-bolso', 'auth.producto_bolso')->name('producto.bolso');
    Route::view('/producto-arequipe', 'auth.producto_arequipe')->name('producto.arequipe');
    Route::view('/producto-llavero', 'auth.producto_llavero')->name('producto.llavero');
    Route::view('/producto-pintura', 'auth.producto_pintura')->name('producto.pintura');

    // Carrito
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
// web.php

Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    // Agregar al carrito
    Route::post('/carrito/agregar', [CarritoController::class, 'agregarProductoManual'])->name('carrito.agregar');
    Route::post('/carrito/agregar/{id}', [CarritoController::class, 'agregarAlCarrito'])->name('carrito.agregar.producto');

    // Actualizar carrito
    Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');

    // Pagos
    Route::get('/metodos-pago', [PaymentController::class, 'index'])->name('metodos.pago');
    Route::post('/procesar-pago', [PaymentController::class, 'procesarPago'])->name('pago.procesar');

    // Admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
});
