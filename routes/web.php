<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;

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

// 「/」にアクセスした場合indexアクションを呼び出す
Route::get('/', [PhotoController::class, 'index'])
    ->name('root');

Route::get('photos/table/', [PhotoController::class, 'table'])
    ->name('table');;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// 認証していなければアクセスできないように制御
Route::resource('photos', PhotoController::class)
    ->only(['store', 'create', 'update', 'destroy', 'edit'])
    ->middleware('auth');

//認証していなくてもアクセスできる
Route::resource('photos', PhotoController::class)
    ->only(['index', 'show']);

require __DIR__ . '/auth.php';
