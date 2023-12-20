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
use App\Http\Controllers\RatingController;
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

Route::pattern('team', '\d+');
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
    }
);

//========MAIN_PAGE========
Route::get('/', \App\Http\Controllers\MainController::class)->name('main.show');

//========TEAMS========
Route::resource('teams', \App\Http\Controllers\TeamController::class);
Route::get('/teams/{team}/description', [\App\Http\Controllers\TeamController::class, 'description']);

//========FULL_ARTICLE========
    Route::get('/articles/{article}', [\App\Http\Controllers\ArticleController::class, 'show'])
        ->name('article.show');

    Route::get('/articles/{article}/teams/{team}', [\App\Http\Controllers\ArticleController::class, 'team'])
        ->name('article.team');

    Route::get('/filter', [\App\Http\Controllers\ArticleController::class, 'filter'])
        ->name('article.filter_article');

    //========FAVORITES========
    Route::prefix('favorites')
        ->name('favorites.')
        ->group(function () {
            Route::post('/', [FavoriteController::class, 'store']);
            Route::delete('/', [FavoriteController::class, 'destroy']);
        }
    );

    //========RATING========
    Route::prefix('rating')
        ->name('rating.')
        ->group(function () {
            Route::post('/', [RatingController::class, 'store']);
            Route::delete('/', [RatingController::class, 'destroy']);
        }
    );
//========/FULL_ARTICLE/========

//========COMMENTS========
Route::pattern('comment', '[0-9]+');
Route::namespace('App\Http\Controllers\Comments')
    ->prefix('comments')
    ->name('comments.')
    ->group(function () {
        Route::post('/', \App\Http\Controllers\Comments\StoreController::class);
        Route::get('/{comment}/edit', \App\Http\Controllers\Comments\EditController::class)->name('edit');
        Route::patch('/{comment}', \App\Http\Controllers\Comments\UpdateController::class);
});

//==========ADMIN_PANEL==========
Route::namespace('App\Http\Controllers\Admin')
    ->prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'permission:Admin_Panel'])
    ->group(function () {
        Route::get('/', 'IndexController')->name('index');
        Route::prefix('articles')
            ->name('articles.')
            ->group(function () {
                Route::get('/drafts', [ArticleController::class, 'drafts'])->name('drafts');
                Route::get('/archive', [ArticleController::class, 'archive'])->name('archive');
        });

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


//TEST Resource
Route::get('/articleResource/{article}', [\App\Http\Controllers\ArticleController::class, 'articleResource']);
Route::get('/articlesResource', [\App\Http\Controllers\ArticleController::class, 'articlesResource']);
