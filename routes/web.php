<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\ProductControllerApi;

// Authentication routes
Route::get('/', [AuthController::class, 'index'])->name('login');

//Fungsi Register dihapus
// Route::get('/register', [AuthController::class, 'index2'])->name('register');
// Route::post('/register', [AuthController::class, 'signup'])->name('post.register');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Role
Route::get('/role', [UserController::class, 'role'])->middleware(['auth','adminview']);

// User routes
Route::prefix('add-user')->middleware(['auth','role'])->group(function () {
    // Route::get('/', [UserController::class, 'index'])->name('add-user');

    Route::get('/', [UserController::class, 'index'])
    ->name('add-user')
    ->withoutMiddleware('adminview');

    Route::post('/store', [UserController::class, 'store'])->name('add-user.store');

    Route::get('/user-list', [UserController::class, 'show'])
    ->name('user-list.show')
    ->withoutMiddleware('role');
    // Route::get('/user-list', [UserController::class, 'show'])->name('user-list.show');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('add-user.edit');
    Route::put('/{id}/update', [UserController::class, 'update'])->name('add-user.update');
    Route::delete('/{id}', [UserController::class, 'delete'])->name('user-list.delete');  // Method DELETE
});

//Stok Route
Route::prefix('stok-input')->middleware(['auth', 'adminview'])->group(function () {
    Route::get('/', [StokController::class, 'index'])->name('stok-input');
    Route::post('/store', [StokController::class, 'store'])->name('stok-input.store');
    
    // Pengecualian middleware 'role' pada route 'stok-list'
    Route::get('/stok-list', [StokController::class, 'show'])
        ->name('stok-list.show')
        ->withoutMiddleware('adminview');
    
    Route::get('/{id}/edit', [StokController::class, 'edit'])->name('stok-input.edit');
    Route::put('/{id}/update', [StokController::class, 'update'])->name('stok-input.update');
    Route::delete('/{id}', [StokController::class, 'delete'])->name('stok-list.delete');
});


//Product Route


Route::prefix('add-product')->middleware(['auth', 'sales'])->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('add-product');
    Route::post('/store', [ProductController::class, 'store'])->name('add-product.store');
    // Route::get('/user-list', [UserController::class, 'show'])->name('user-list.show');
    Route::get('/{id}/edit', [ProductController::class, 'index'])->name('add-product.edit');
    Route::put('/{id}/update', [ProductController::class, 'update'])->name('add-product.update');
    Route::delete('/{id}', [ProductController::class, 'delete'])->name('add-product.delete'); 
});

// City routes
Route::prefix('add-city')->middleware(['auth','role'])->group(function () {

    Route::get('/', [CityController::class, 'index'])
    ->name('add-city')
    ->withoutMiddleware('role');
    // Route::get('/', [CityController::class, 'index'])->name('add-city');
    Route::post('/create', [CityController::class, 'create'])->name('add-city.create');
    Route::get('/{id}/edit', [CityController::class, 'index'])->name('add-city.edit');
    Route::put('/{id}/update', [CityController::class, 'update'])->name('add-city.update');
    Route::put('/{id}', [CityController::class, 'delete'])->name('add-city.delete');
});
// Route::resource('cities', [CityController::class]);

// Protected route
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProductControllerApi::class, 'dashboard'])->name('dashboard');
    
});
