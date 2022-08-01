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

// Route::get('/{locale?}', function ($locale = null) {

//     if (isset($locale) && in_array($locale, config('app.app_locales'))) {
//         app()->setLocale($locale);
//     }

//     return view('welcome');
// });


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('language/{locale}', [App\Http\Controllers\LocalizationController::class, 'index'])->name('set.locale');


Route::get('/hooks/test', [App\Http\Controllers\WebHookController::class, 'index'])->name('hooks.test');
