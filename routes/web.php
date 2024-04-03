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
Route::get('/danh-muc/{slug}', [App\Http\Controllers\IndexConTroller::class, 'category'] )->name('category');
Route::get('/the-loai/{slug}', [App\Http\Controllers\IndexConTroller::class, 'genre'] )->name('genre'); 
Route::get('/quoc-gia/{slug}', [App\Http\Controllers\IndexConTroller::class, 'country'] )->name('country');
Route::get('/xem-phim/{slug}', [App\Http\Controllers\IndexConTroller::class, 'watch'] )->name('watch');
Route::get('/tap-phim', [App\Http\Controllers\IndexConTroller::class, 'episode'] )->name('episode');
Route::get('/firm/{slug}', [App\Http\Controllers\IndexConTroller::class, 'movie'] )->name('movie');

Route::get('/update-year-phim',[MovieController::class, 'year'])->name('year');
Route::get('/update-season-phim',[MovieController::class, 'season'])->name('season');
Route::get('/update-topview',[MovieController::class, 'topview'])->name('topview');

Route::get('/nam/{year}',[IndexController::class, 'year']);
Route::get('/tag/{tag}',[IndexController::class, 'tag']);

Route::post('/filter-topview',[MovieController::class, 'filter_topview']);
Route::get('/filter-topview-default',[MovieController::class, 'filter_topview_default']);



Auth::routes();

Route::get('/home',[HomeController::class, 'index'])->name('home');
Route::post('resorting',[CategoryController::class, 'resorting'])->name('resorting');
Route::post('resorting',[GenreController::class, 'resorting'])->name('resorting');
Route::post('resorting',[CountryController::class, 'resorting'])->name('resorting');



Route::resource('category',CategoryController::class);
Route::resource('genre',GenreController::class);
Route::resource('movie',MovieController::class);
Route::resource('country',CountryController::class);
Route::resource('episode',EpisodeController::class);
