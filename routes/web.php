<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\MicropostsController;
use App\Http\Controllers\UserFollowController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AdController;
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

Route::get('/', [MicropostsController::class, 'index']);

Route::get('/dashboard', [MicropostsController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('users/{id}')->group(function () {
        Route::post('follow', [UserFollowController::class, 'store'])->name('user.follow');
        Route::delete('unfollow', [UserFollowController::class, 'destroy'])->name('user.unfollow');
        Route::get('followings', [UsersController::class, 'followings'])->name('users.followings');
        Route::get('followers', [UsersController::class, 'followers'])->name('users.followers');
        Route::post('edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::get('ad', [AdController::class, 'ad'])->name('users.ad');
        Route::post('addad', [AdController::class, 'addad'])->name('users.addad');
        Route::put('update', [UsersController::class, 'update'])->name('users.update');
    });
    
    Route::prefix('users/{id}')->group(function () {
        Route::post('favorite', [FavoriteController::class, 'store'])->name('favor.favorite');
        Route::delete('unfavorite', [FavoriteController::class, 'destroy'])->name('favor.unfavorite');
        Route::get('favoritings', [UsersController::class, 'favoritings'])->name('users.favoritings');
        //Route::get('favoriters', [FavoriteController::class, 'followers'])->name('users.favoriters');
        
        //Route::post('addad', [AdController::class, 'addad'])->name('ad.addad');
    });
    
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    
    /*
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    */
    
    Route::resource('microposts', MicropostsController::class, ['only' => ['store', 'destroy']]);
     
    Route::resource('image', ImageController::class);
    Route::post('store', [ImageController::class, 'store'])->name('image.store');
    //Route::resource('ad', AdController::class);s
    
});

require __DIR__.'/auth.php';
