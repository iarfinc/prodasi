<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

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


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/auth', [LoginController::class, 'auth'])->name('auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('auth_register');



Route::group(['middleware' => ['auth', 'prevent-back']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [DashboardController::class, 'updateProfile'])->name('updateProfile');

    Route::group(['middleware' => ['role:Admin']], function () {
        Route::get('/users/{filter?}', [UsersController::class, 'index'])
        ->where('filter', '^(User|Admin)?$')
        ->name('users');
        Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
        Route::resource('users',UsersController::class);
    });
    Route::group(['middleware' => ['role:User']], function () {

    }); 
    
    
});