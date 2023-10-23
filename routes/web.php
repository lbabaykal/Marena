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

//========AUTH========
require __DIR__.'/auth.php';

//==============================================================================================
Route::prefix('account')
    ->name('account.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        //========ACCOUNT========
        Route::get('/', [AccountController::class, 'index'])->name('index');

        Route::prefix('favorites')
            ->name('favorites.')
            ->group(function () {
                //========ACCOUNT_FAVORITES========
                Route::pattern('folder', '[0-9]+');
                Route::get('/', [FavoriteController::class, 'index'])->name('index');

                Route::prefix('folders')
                    ->name('folders.')
                    ->group(function () {
                        //========ACCOUNT_FAVORITES_FOLDERS========
                        Route::get('/{folder}', [FolderController::class, 'show'])->name('show');
                });
            }
        );
    }
);
//ДОБАВЬ МИДЛВАРЕ ДЛЯ ПРОВЕРКИ РАЗРЕШЕНИЯ ДЛЯ ПРОСМОТРА ПУБЛИЧНОЙ ПАПКИ ДРУГОГО ЧЕЛОВЕКА

//MAIN_PAGE
Route::get('/', \App\Http\Controllers\MainController::class)->name('main.show');
//========FULL_ARTICLE========
Route::get('/articles/{article}', [\App\Http\Controllers\ArticleController::class, 'show'])
    ->name('article.show');
Route::post('/rating_assessments', \App\Http\Controllers\RatingAssessmentController::class);
Route::post('/favorites', [\App\Http\Controllers\FavoriteController::class, 'store']);
Route::delete('/favorites', [\App\Http\Controllers\FavoriteController::class, 'destroy']);
//========FILTER_ARTICLE========
Route::get('/filter_article', [\App\Http\Controllers\ArticleController::class, 'filter_article'])
    ->name('article.filter_article');
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
    ->prefix('admin_panel')
    ->name('admin.')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
        //========ADMIN_PANEL========
        Route::get('/', 'IndexController')->name('index');
        Route::pattern('article', '[0-9]+');
        Route::pattern('category', '[0-9]+');
        Route::pattern('country', '[0-9]+');
        Route::pattern('genre', '[0-9]+');
        Route::pattern('studio', '[0-9]+');
        Route::pattern('type', '[0-9]+');
        Route::pattern('user', '[0-9]+');
        Route::pattern('role', '[0-9]+');
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
