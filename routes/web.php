<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [\App\Http\Controllers\ChatMessageController::class, '__invoke']);
Route::get('/Dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/ChatMessage/refreshTable', [\App\Http\Controllers\ChatMessageController::class, 'refreshTable']);
Route::post('/ChatMessage/deleteMessage', [\App\Http\Controllers\ChatMessageController::class, 'deleteMessage']);
Route::post('/ChatMessage/addMessage', [\App\Http\Controllers\ChatMessageController::class, 'addMessage']);


// Route::post('/ChatMessage', [\App\Http\Controllers\ChatMessageController::class, 'store']);
Route::get('/ChatMessage', [\App\Http\Controllers\ChatMessageController::class, '__invoke']);
