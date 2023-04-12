<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ActivityOnDocumentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LoginRecordsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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
Route::get('/password', [DashboardController::class, 'password'])->name('password')->middleware('auth:web');
Route::post('/password/change', [DashboardController::class, 'passwordChange'])->name('change-password')->middleware('auth:web');
Route::get('/category', [CategoryController::class, 'categories'])->name('categories')->middleware('auth:web');
Route::get('/users', [UserController::class, 'users'])->name('users')->middleware('auth:web');
Route::get('/archive', [DocumentController::class, 'documents'])->name('documents')->middleware('auth:web');

//Category
Route::get('/add-category', [CategoryController::class, 'addCategory'])->name('add-categories')->middleware('auth:web');
Route::post('/add-category', [CategoryController::class, 'store'])->name('add-category')->middleware('auth:web');
Route::get('/edit-category/{category}/edit', [CategoryController::class, 'edit'])->name('category-edit')->middleware('auth:web');
Route::patch('/update-category/{category}/edit', [CategoryController::class, 'update'])->name('category-update')->middleware('auth:web');
Route::delete('/delete-category/{category}', [CategoryController::class, 'delete'])->name('category-delete')->middleware('auth:web');

//User
Route::get('/add-user', [UserController::class, 'addUser'])->name('add-user')->middleware('auth:web');
Route::post('/add-user', [UserController::class, 'store'])->name('add-user')->middleware('auth:web');
Route::get('/edit-user/{user}/edit', [UserController::class, 'edit'])->name('user-edit')->middleware('auth:web');
Route::patch('/update-user/{user}/edit', [UserController::class, 'update'])->name('user-update')->middleware('auth:web');
Route::delete('/delete-user/{user}', [UserController::class, 'delete'])->name('user-delete')->middleware('auth:web');

//Document
Route::get('autocomplete', [DocumentController::class, 'search'])->name('autocomplete');
Route::post('/search/document', [DocumentController::class, 'searchDocument'])->name('search');
Route::get('/add-document', [DocumentController::class, 'addDocument'])->name('add-document')->middleware('auth:web');
Route::post('/add-document', [DocumentController::class, 'store'])->name('add-document')->middleware('auth:web');
Route::get('/edit-document/{document}/edit', [DocumentController::class, 'edit'])->name('document-edit')->middleware('auth:web');
Route::get('/document/{document}/view', [DocumentController::class, 'show'])->name('document-show')->middleware('auth:web');
Route::patch('/update-document/{document}/edit', [DocumentController::class, 'update'])->name('document-update')->middleware('auth:web');
Route::delete('/delete-document/{document}', [DocumentController::class, 'delete'])->name('document-delete')->middleware('auth:web');
