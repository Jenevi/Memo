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

Route::get('/home', [\App\Http\Controllers\MemoController::class, '__invoke']);
Route::get('/Dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/Memo/refreshTable', [\App\Http\Controllers\MemoController::class, 'refreshTable']);
Route::post('/Memo/deleteNote', [\App\Http\Controllers\MemoController::class, 'deleteNote']);
Route::post('/Memo/addNote', [\App\Http\Controllers\MemoController::class, 'addNote']);
Route::post('/Memo/addTitle', [\App\Http\Controllers\MemoController::class, 'addTitle']);
