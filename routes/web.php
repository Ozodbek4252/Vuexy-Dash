<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'doRegister'])->name('register.post');


Route::get('/', function () {
    return view('index');
})->name('home');

Route::group([
    'middleware' => [
        'auth:sanctum', 'revalidate', 'localize',
        /* 'isAdmin', 'language' */
    ],
    'as' => 'dash.'
], function () {
    // Change language
    Route::get('change-lang/{lang}', [LangController::class, 'changeLang'])->name('lang.change');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // For now
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
