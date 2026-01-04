<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// 一般ユーザー //
Route::get('/', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
Route::post('/store', [ContactController::class, 'store'])->name('contacts.store');

// Auth //
Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [LoginController::class, 'authenticate']) ->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', fn() => view('auth.logout'))->name('logout.view');

// Admin(ログイン必須) //
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])
        ->name('admin.index');
    Route::get('/search', [AdminController::class, 'search'])
        ->name('admin.search');
    Route::get('/admin/detail/{id}', [AdminController::class, 'detail'])
        ->name('admin.detail');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])
        ->name('admin.delete');
    Route::get('/admin/export', [AdminController::class, 'export'])
        ->name('admin.export');
    Route::get('admin/export/complete', function () {
        return view('admin.export');
    })->name('admin.export.complete');
    Route::get('/reset', [AdminController::class, 'reset'])
        ->name('admin.reset');
});