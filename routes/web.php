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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/stocks', [App\Http\Controllers\stocksControllers::class, 'stocks'])->name('stocks');

Route::get('/stocksRegister', [App\Http\Controllers\stocksControllers::class, 'stocksRegister'])->name('stocksRegister');
Route::post('/stockCreate',[App\Http\Controllers\stocksControllers::class,'stockCreate']);

/*買い物リスト登録画面*/

Route::get('/needs/needsregister', [App\Http\Controllers\Needs\NeedsregisterControllers::class, 'needsregister']);
//needsregister.blade.phpでneeds/needsregisterがpostされるとNeedsregisterControllersに行く、そして'needsregister'（登録画面）が表示される(登録される)
Route::post('/needs/needsregister', [App\Http\Controllers\Needs\NeedsregisterControllers::class, 'needsregister']);