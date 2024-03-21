<?php

use App\Http\Controllers\UsersController;
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

Route::get('/', function () {
    return view('home');
})->name('users.home');

Route::post('/users/create', [UsersController::class, 'create'])->name('users.create');

Route::get('/admin/users/list', function () {
    return view('admin.users.list');
})->name('admin.users.list');

Route::get('/admin/users/get', [UsersController::class, 'adminGetUsers'])->name('admin.users.get');
