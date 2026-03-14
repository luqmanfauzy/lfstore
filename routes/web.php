<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/',[ClientController::class, 'home'])->name('home');
Route::get('/catalog', [ClientController::class, 'catalog'])->name('catalog');
Route::get('/detail-product/{slug}', [ClientController::class, 'detailProduct'])->name('detail');
Route::get('/category-product/{slug}', [ClientController::class, 'categoryProduct'])->name('category-product');
