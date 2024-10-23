<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');

    Route::get('/user/{user:username}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{user:username}/about', [UserController::class, 'showAbout'])->name('user.about');
    Route::get('/user/{user:username}/friends', [UserController::class, 'showFriends'])->name('user.friends');
    Route::get('/user/{user:username}/videos', [UserController::class, 'showVideos'])->name('user.videos');
    Route::get('/user/{user:username}/photos', [UserController::class, 'showPhotos'])->name('user.photos');
    Route::get('/user/{user:username}/check-ins', [UserController::class, 'showCheckIns'])->name('user.checkins');
    Route::post('/user/update-image', [UserController::class, 'updateImage'])->name('user.updateImage');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route ::post('addBio',[ProfileController::class,'addBio'])->name('profile.addBio');
    Route ::post('editBio',[ProfileController::class,'editBio'])->name('profile.editBio');
});

require __DIR__.'/auth.php';
