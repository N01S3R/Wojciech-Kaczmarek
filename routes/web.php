<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('users', [UsersController::class, 'index']);
Route::get('add-users', [UsersController::class, 'create']);
Route::post('add-users', [UsersController::class, 'store']);
Route::get('edit-users/{id}', [UsersController::class, 'edit']);
Route::put('update-users/{id}', [UsersController::class, 'update']);
Route::delete('delete-users/{id}', [UsersController::class, 'destroy']);