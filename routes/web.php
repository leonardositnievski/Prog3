<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MidiaController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;
use Stevebauman\Location\Facades\Location;
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

Route::view('/login','auth.login')->name('login');
Route::post('/login', [UsuariosController::class, 'login']);

Route::view('/criar-conta','auth.create-account')->name('criar-conta');
Route::post('/criar-conta', [UsuariosController::class, 'insert']);

Route::get('/logout', [UsuariosController::class, 'logout'])->name('logout');

Route::get('image/{url}', [MidiaController::class, 'get'])->name('image');

Route::get('/profile/{id}',[UsuariosController::class, 'show'])->name('profile');

Route::get('/post/{id}',[PostController::class, 'show'])->name('post');


Route::group(['middleware' => ['auth']], function(){
    Route::get('/', [PostController::class, 'home'])->name('home');
    
    Route::post('/publicar',[PostController::class, 'publicar'])->name('publicar');
    Route::view('/criar', 'createpost')->name('criar');

    Route::post('perfil', [ UsuariosController::class, 'editar'])->name('edit.profile');
    Route::view('perfil', 'profile-editar');
    
    Route::view('/configuracoes', 'settings')->name('settings');
    Route::post('/configuracoes', [UsuariosController::class, 'configuracoes']);
    
    Route::view('/conta', 'createpost')->name('conta');

});
Route::group(['middleware' => ['auth', 'is.admin'], 'prefix' => 'admin'], function(){

    Route::get('aprovacoes', [ AdminController::class, 'index'])->name('aprovacoes');
    Route::get('aprovacoes/{id}/{action}', [ AdminController::class, 'autorizacao'])->name('autorizacao');


});
