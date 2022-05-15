<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Needs\NeedsregisterControllers;


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
// 買い物リスト画面
Route::get('/home', [App\Http\Controllers\Needs\NeedController::class, 'index'])->name('/home');
/*買い物リスト登録画面*/

Route::get('/needs/needsregister', [App\Http\Controllers\Needs\NeedsregisterControllers::class, 'needsregister'])->middleware('auth');
//needsregister.blade.phpで'/needs/store'がpostされるとNeedsregisterControllersに行く、そして'needsregister'（登録画面）が表示される(登録される)
Route::post('/needs/store', [App\Http\Controllers\Needs\NeedsregisterControllers::class, 'store' ])->name('needs.store');

// 買い物リスト登録画面
Route::get('/needEdit', [App\Http\Controllers\Needs\NeedController::class, 'needEdit'])->name('needEdit');
Route::post('/needUpdate', [App\Http\Controllers\Needs\NeedController::class, 'needUpdate'])->name('needUpdate');
Route::delete('/needDelete', [App\Http\Controllers\Needs\NeedController::class, 'needDelete'])->name('needDelete');


// 在庫管理画面
Route::get('/stocks', [App\Http\Controllers\stocksControllers::class, 'stocks'])->name('stocks');

// 在庫登録画面
Route::get('/stocksRegister', [App\Http\Controllers\stocksControllers::class, 'stocksRegister'])->name('stocksRegister');
Route::post('/stockCreate',[App\Http\Controllers\stocksControllers::class,'stockCreate']);

// 在庫編集画面
Route::get('/stockEdit',[App\Http\Controllers\stocksControllers::class,'stockEdit'])->name('stocksEdit');
Route::post('/stockUpdate',[App\Http\Controllers\stocksControllers::class, 'stockUpdate'])->name('stockUpdate');
Route::delete('/stockDelete',[App\Http\Controllers\stocksControllers::class, 'stockDelete'])->name('stockDelete');
