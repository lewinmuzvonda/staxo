<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Customer\ShopController;

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

//Customer Routes
Route::get('/', [ShopController::class, 'index'])->name('home');
Route::get('/product/{id}', [ShopController::class, 'product'])->name('product');

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
    //Admin Routes
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/add-product', [AdminController::class, 'productForm'])->name('productform');
    Route::post('/admin/save-product', [AdminController::class, 'saveProduct'])->name('saveproduct');

    Route::view('/admin/add-category', '/admin/add-category')->name('categoryform');
    Route::post('/admin/add-category', [AdminController::class, 'saveCategory'])->name('savecategory');
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('categories');
});

require __DIR__.'/auth.php';
