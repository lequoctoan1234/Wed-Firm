<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\MovieController;
use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[IndexController::class, 'home'])->name('homepage');
Route::get('/danh-muc', [App\Http\Controllers\IndexConTroller::class, 'category'] )->name('category');
Route::get('/the-loai', [App\Http\Controllers\IndexConTroller::class, 'genre'] )->name('genre'); 
Route::get('/quoc-gia', [App\Http\Controllers\IndexConTroller::class, 'country'] )->name('country');
Route::get('/xem-phim', [App\Http\Controllers\IndexConTroller::class, 'watch'] )->name('watch');
Route::get('/tap-phim', [App\Http\Controllers\IndexConTroller::class, 'episode'] )->name('episode');
Route::get('/firm', [App\Http\Controllers\IndexConTroller::class, 'movie'] )->name('movie');



Auth::routes();

Route::get('/home',[HomeController::class, 'index'])->name('home');

Route::resource('category',CategoryController::class);
Route::resource('genre',GenreController::class);
Route::resource('movie',MovieController::class);
Route::resource('country',CountryController::class);
Route::resource('episode',EpisodeController::class);
