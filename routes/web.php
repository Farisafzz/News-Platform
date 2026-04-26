<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', [NewsController::class, 'index'])->name('home');
Route::resource('news', NewsController::class);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.post');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/news', [AdminController::class, 'news'])->name('news');
    Route::get('/news/{news}/edit', [AdminController::class, 'editNews'])->name('news.edit');
    Route::put('/news/{news}', [AdminController::class, 'updateNews'])->name('news.update');
    Route::delete('/news/{news}', [AdminController::class, 'deleteNews'])->name('news.delete');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/tags', [AdminController::class, 'tags'])->name('tags');
    Route::post('/tags', [AdminController::class, 'storeTag'])->name('tags.store');
    Route::get('/tags/{tag}/edit', [AdminController::class, 'editTag'])->name('tags.edit');
    Route::put('/tags/{tag}', [AdminController::class, 'updateTag'])->name('tags.update');
    Route::delete('/tags/{tag}', [AdminController::class, 'deleteTag'])->name('tags.delete');
});
