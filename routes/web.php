<?php
use App\Http\Controllers\NewsController; 
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

   Route::get('/news/index', [NewsController::class, 'index'])
       ->name('news.index')
       ->middleware('news');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
Route::get('/autocomplete', [App\Http\Controllers\NewsController::class, 'autocomplete'])->name('autocomplete');
Route::get('/users', [UserController::class, 'index'])->name('users.index')->name('news');