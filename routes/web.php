<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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


Auth::routes();

Route::middleware(['auth', 'admin'])->group(function() {

    // Routes for users
    Route::get('/users/make-admin/{user_id}', [UserController:: class, 'addAdmin'])->name('make.admin');
    Route::get('/users/remove-admin/{user_id}', [UserController::class, 'removeAdmin'])->name('remove.admin');
    Route::resource('users', UserController::class);


    // Route For Posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/edit/{post_id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/update/{post_id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/delete/{post_id}', [PostController::class, 'destroy'])->name('posts.delete');
    Route::get('/posts/trashed', [PostController:: class, 'trashedPosts'])->name('trashed.posts');
    Route::get('/posts/trashed/restore/{post_id}', [PostController::class, 'restoreTrashed'])->name('restore.trashed.post');
    Route::delete('/posts/trashed/delete/{post_id}', [PostController::class, 'deleteTrashed'])->name('delete.trashed.post');

    // Routes For Tags
    // Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    // Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    // Route::post('/tags/store', [TagController::class, 'store'])->name('tags.store');
    // Route::delete('/tags/delete/{tag_id}', [TagController::class, 'destroy'])->name('tags.delete');
    Route::resource('tags', TagController::class);


    // Routes For Comments
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::get('/comments/approve/{comment_id}', [CommentController::class, 'approveComment'])->name('approve.comment');
    Route::get('/comments/disapprove/{comment_id}', [CommentController::class, 'disapproveComment'])->name('disapprove.comment');
    Route::delete('/comments/delete/{comment_id}', [CommentController::class, 'destroy'])->name('delete.comment');

    // Routes For Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{category_id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/update/{category_id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/delete/{category_id}', [CategoryController::class, 'destroy'])->name('categories.delete');

    // Route For Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

});


Route::middleware('auth')->group(function() {

    // Route For Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    // Routes For Posts
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');


    // Route For Profile
    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('edit.profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('update.profile');


});

// Route For Website Homepage
Route::get('/', [HomepageController::class, 'homepage'])->name('homepage');


// Route For Every Single Post
Route::get('/post/{post_id}/{post_slug}', [HomepageController::class, 'singlePost'])->name('single.post');


// Send Comment For Visitors
Route::post('/comments/{post_id}/store/', [CommentController::class, 'store'])->name('comments.store');


// Route For Search
Route::get('/search', [HomepageController::class, 'searchEngine'])->name('search.engine');


// Route For About Page
Route::get('/about', [HomepageController::class, 'about'])->name('about');


// Route For Category Page
Route::get('/category/{category_name}', [HomepageController::class, 'categoryPage'])->name('category.page');


//Route For Author Page
Route::get('/author/{user_name}', [HomepageController::class, 'authorPage'])->name('author.page');

//Route For Tag Page
Route::get('/tag/{tag_name}', [HomepageController::class, 'tagPage'])->name('tag.page');


// Route For Contact Page
Route::get('/contact', [EmailController::class, 'index'])->name('contact.page');
Route::post('/contact/send', [EmailController::class, 'sendEmail'])->name('contact.send');





