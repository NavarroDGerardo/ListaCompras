<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('auth.login');
});

Route::get('register', 'AuthController@viewRegister')->name('auth.view-register');
Route::post('register', 'AuthController@register')->name('auth.register');

Route::get('login', 'AuthController@viewLogin')->name('auth.view-login');
Route::post('login', 'AuthController@login')->name('auth.login');

Route::any('logout', 'AuthController@logout')-> name('auth.logout');

Route::resource('lista', 'ListasController');
Route::resource('producto', 'ProductosController');
Route::resource('share', 'SharedAccountsController');

Route::get('producto/{lista}/edit', 'ProductosController@edit')->name('producto.edit');
