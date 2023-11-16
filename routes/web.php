<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StudioController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FolderController;
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
//TEST
Route::get('/articleResource/{article}', [\App\Http\Controllers\ArticleController::class, 'articleResource']);
Route::get('/articlesResource', [\App\Http\Controllers\ArticleController::class, 'articlesResource']);

//========AUTH========
require __DIR__.'/auth.php';

Route::pattern('folder', '\d+');
Route::pattern('article', '\d+');
Route::pattern('category', '\d+');
Route::pattern('country', '\d+');
Route::pattern('genre', '\d+');
Route::pattern('studio', '\d+');
Route::pattern('type', '\d+');
Route::pattern('user', '\d+');
Route::pattern('role', '\d+');
//==============================================================================================
Route::prefix('account')
    ->name('account.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        //========ACCOUNT========
        Route::get('/', [AccountController::class, 'index'])->name('index');

        //========ACCOUNT_FOLDERS========
        Route::resource('folders', FolderController::class);

        //========ACCOUNT_FAVORITES========
        Route::prefix('favorites')
            ->name('favorites.')
            ->group(function () {
                Route::post('/', [FavoriteController::class, 'store']);
                Route::delete('/', [FavoriteController::class, 'destroy']);
            }
        );
    }
);

//========MAIN_PAGE========
Route::get('/', \App\Http\Controllers\MainController::class)->name('main.show');
//========FULL_ARTICLE========
Route::get('/articles/{article}', [\App\Http\Controllers\ArticleController::class, 'show'])
    ->name('article.show');

Route::get('/filter', [\App\Http\Controllers\ArticleController::class, 'filter'])
    ->name('article.filter_article');
//========FULL_ARTICLE_RATING========
Route::post('/rating_assessments', \App\Http\Controllers\RatingAssessmentController::class);


//========COMMENTS========
Route::pattern('comment', '[0-9]+');
Route::namespace('App\Http\Controllers\Comments')
    ->prefix('comments')
    ->name('comments.')
    ->group(function () {
        Route::post('/', \App\Http\Controllers\Comments\StoreController::class);
        Route::get('/{comment}/edit', \App\Http\Controllers\Comments\EditController::class)
            ->name('edit');
        Route::patch('/{comment}', \App\Http\Controllers\Comments\UpdateController::class);
});

//==========ADMIN_PANEL==========
Route::namespace('App\Http\Controllers\Admin')
    ->prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
        Route::get('/', 'IndexController')->name('index');
        Route::resources([
            'articles' => ArticleController::class,
            'categories' => CategoryController::class,
            'countries' => CountryController::class,
            'genres' => GenreController::class,
            'studios' => StudioController::class,
            'types' => TypeController::class,
            'users' => UserController::class,
            'roles' => RoleController::class,
        ]);
});
