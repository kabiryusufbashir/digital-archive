<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ActivityOnDocumentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LoginRecordsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [LoginController::class, 'front'])->name('front');

// Login 
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard 
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth:web');
Route::get('/category', [CategoryController::class, 'categories'])->name('categories')->middleware('auth:web');

//Category
Route::get('/add-category', [CategoryController::class, 'addCategory'])->name('add-categories')->middleware('auth:web');
Route::post('/add-category', [CategoryController::class, 'store'])->name('add-category')->middleware('auth:web');
Route::get('/edit-category', [CategoryController::class, 'edit'])->name('category-edit')->middleware('auth:web');
Route::get('/delete-category', [CategoryController::class, 'delete'])->name('category-delete')->middleware('auth:web');