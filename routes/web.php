<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Customer\ShopController;
use App\Http\Controllers\Auth\AuthController;

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


//Admin Routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/add-product', [AdminController::class, 'productForm'])->name('productform');
Route::post('/admin/add-product', [AdminController::class, 'saveProduct'])->name('saveproduct');

Route::view('/admin/add-category', '/admin/add-category')->name('categoryform');
Route::post('/admin/add-category', [AdminController::class, 'saveCategory'])->name('savecategory');
Route::get('/admin/categories', [AdminController::class, 'categories'])->name('categories');
