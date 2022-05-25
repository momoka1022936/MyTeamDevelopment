<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Needs\NeedsregisterControllers;


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
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('/logout');

// 買い物リスト画面（ホーム）
Route::get('/home', [App\Http\Controllers\NeedController::class, 'index'])->name('/home');
// 買い物リスト系
Route::group(['prefix' => '/needs', 'as' => 'needs.'], function() {
    // 買い物リスト登録画面
    Route::get('register', [App\Http\Controllers\NeedController::class, 'register'])->name('register');
    Route::post('store', [App\Http\Controllers\NeedController::class, 'store' ])->name('store');
    // 買い物リスト編集画面
    Route::get('edit', [App\Http\Controllers\NeedController::class, 'edit'])->name('edit');
    Route::post('update', [App\Http\Controllers\NeedController::class, 'update'])->name('update');
    Route::delete('delete', [App\Http\Controllers\NeedController::class, 'delete'])->name('delete');
});

// 在庫一覧画面
Route::get('/stocks', [App\Http\Controllers\StockController::class, 'stocks'])->name('stocks');
// 在庫系
Route::group(['prefix' => '/stocks', 'as' => 'stocks.'], function() {
    // 在庫登録画面
    Route::get('Register', [App\Http\Controllers\StockController::class, 'register'])->name('register');
    Route::post('store',[App\Http\Controllers\StockController::class,'store'])->name('store');
    // 在庫編集画面
    Route::get('edit',[App\Http\Controllers\StockController::class,'edit'])->name('edit');
    Route::post('update',[App\Http\Controllers\StockController::class, 'update'])->name('update');
    Route::delete('delete',[App\Http\Controllers\StockController::class, 'delete'])->name('delete');
});
