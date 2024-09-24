<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Filament\Resources\ProductoResource\Pages\ProductDetail;
use App\Models\Producto;
use App\Http\Controllers\PayPalController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard'); // Cambia 'dashboard' a la ruta deseada para usuarios autenticados
    }
    return redirect()->route('login');
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/about', fn() => Inertia::render('About'))->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // routes/web.php


    // Ruta para mostrar todos los productos
    Route::get('productos', [ProductController::class, 'index'])->name('productos.index');


    // Ruta para mostrar el formulario de creación de productos
    Route::get('/productos/create', [ProductController::class, 'create'])->name('productos.create');

    // Ruta para almacenar un nuevo producto
    Route::post('/productos', [ProductController::class, 'store'])->name('productos.store');

    // Ruta para mostrar un producto específico
    Route::get('/productos/{id}', [ProductController::class, 'show'])->name('productos.show');

    // Ruta para mostrar el formulario de edición de un producto
    Route::get('/productos/{id}/edit', [ProductController::class, 'edit'])->name('productos.edit');

    // Ruta para actualizar un producto
    Route::put('/productos/{id}', [ProductController::class, 'update'])->name('productos.update');

    // Ruta para eliminar un producto
    Route::delete('/productos/{id}', [ProductController::class, 'destroy'])->name('productos.destroy');

    // Ruta para ver el carrito de compras
    Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');

    // Ruta para agregar un producto al carrito
    Route::post('/carrito/agregar', [CartController::class, 'add'])->name('cart.add');

    // Ruta para eliminar un producto del carrito
    Route::delete('/carrito/eliminar/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('producto/{record}/detail', [ProductDetail::class, 'mount'])
    ->name('filament.resources.producto.detail');


    Route::get('/producto/{id}/detalle', [ProductController::class, 'detalle'])->name('producto.detalle');



    Route::get('/paypal/create-payment', [PayPalController::class, 'createPayment'])->name('paypal.create');
    Route::get('/paypal/success', [PayPalController::class, 'capturePayment'])->name('paypal.success');
    Route::get('/paypal/cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');



});

require __DIR__ . '/auth.php';
