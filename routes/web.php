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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Route::get('/', function () {
//     return view('welcome');
// });
Route::post('/ChatMessage/refreshTable', [\App\Http\Controllers\ChatMessageController::class, 'refreshTable']);
// Route::get('/ChatMessage/refreshTable', [\App\Http\Controllers\ChatMessageController::class, 'refreshTable']);


Route::post('/ChatMessage', [\App\Http\Controllers\ChatMessageController::class, 'store']);
Route::get('/ChatMessage', [\App\Http\Controllers\ChatMessageController::class, '__invoke']);
//
//
//
// //Route::post('/testUser2', [\App\Http\Controllers\TestUser2Controller::class, 'store']);
// //Route::get('/testUser2', [\App\Http\Controllers\TestUser2Controller::class, '__invoke']);
// //
// //Route::post('/testUser2/refreshTable', [\App\Http\Controllers\TestUser2Controller::class, 'refreshTable']);
//
//
//
//
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
//
// Route::post('/', function () {
//     return view('welcome');
// });
//
// require __DIR__.'/auth.php';
