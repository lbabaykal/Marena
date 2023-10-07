<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StudioController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

//========AUTH========
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
//========AUTH========



Route::get('/', \App\Http\Controllers\MainController::class)->name('main.show');
Route::get('/articles/{article}', \App\Http\Controllers\ArticleController::class)->name('article.show');
Route::get('/categories/{category}', \App\Http\Controllers\CategoryController::class)->name('category.show');

//ERROR
Route::get('/genres/{genre}', \App\Http\Controllers\CategoryController::class)->name('genre.show');



//========FULL_ARTICLE========
Route::post('/rating_assessments', \App\Http\Controllers\RatingAssessmentController::class);
Route::post('/favorites', \App\Http\Controllers\FavoriteController::class);
//========FULL_ARTICLE========COMMENTS========
Route::pattern('comment', '[0-9]+');
Route::namespace('App\Http\Controllers\Comments')->prefix('comments')->name('comments.')->group(function () {
    Route::post('/', \App\Http\Controllers\Comments\StoreController::class);
    Route::get('/{comment}/edit', \App\Http\Controllers\Comments\EditController::class)->name('edit');
    Route::patch('/{comment}', \App\Http\Controllers\Comments\UpdateController::class);
});

//==========ADMIN_PANEL==========
Route::namespace('App\Http\Controllers\Admin')
        ->prefix('admin_panel')
        ->name('admin.')
        ->middleware(['auth', 'isAdmin'])
        ->group(function () {
    //========ADMIN_PANEL========
    Route::get('/', 'IndexController')->name('index');
    //========ARTICLES========
    Route::pattern('article', '[0-9]+');
    Route::resource('articles', ArticleController::class);
    //========CATEGORIES========
    Route::pattern('category', '[0-9]+');
    Route::resource('categories', CategoryController::class);
    //========COUNTRIES========
    Route::pattern('country', '[0-9]+');
    Route::resource('countries', CountryController::class);
    //========GENRES========
    Route::pattern('genre', '[0-9]+');
    Route::resource('genres', GenreController::class);
    //========STUDIOS========
    Route::pattern('studio', '[0-9]+');
    Route::resource('studios', StudioController::class);
    //========TYPES========
    Route::pattern('type', '[0-9]+');
    Route::resource('types', TypeController::class);
    //========USERS========
    Route::pattern('user', '[0-9]+');
    Route::resource('users', UserController::class);
    //========ROLES========
    Route::pattern('role', '[0-9]+');
    Route::resource('roles', RoleController::class);
});





