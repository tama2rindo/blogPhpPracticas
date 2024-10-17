<?php

use App\Livewire\PaginaPrincipal;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DependencyInjection\RegisterControllerArgumentLocatorsPass;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;

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
Route::view('/', 'welcome');

Route::view('livewire/paginaprincipal', 'livewire.paginaprincipal')
->name('paginaprincipal');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('/register','register')
    ->name('register');

//this routes are duplicated, here and in the admin only, however only admins can create posts
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // Create a post
Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // Store a post
    
// Routes accessible to everyone (including non-logged-in users)
Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); // View all posts
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show'); // View single post
Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store'); // Non-logged-in users can add comments
    
// Routes accessible to logged-in users only (cannot create posts, can edit and delete their own comments)
Route::middleware('auth')->group(function () {
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy'); // Delete own comments
    Route::get('/posts/{post}/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit'); //edit comments
    Route::put('/posts/{post}/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');  //update comments
});
    
// Routes accessible only to admins (create, edit, and delete any post and delete any comment)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // Create a post
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // Store a post
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); // Delete any post
    Route::delete('/comments/{comment}/admin', [CommentController::class, 'adminDestroy'])->name('comments.adminDestroy'); // Admins can delete any comment
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
});
    


/* Public Post routes accessible to everyone
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
//Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
//Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

// Comment routes
Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');

// Routes accessible only to admins
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // Admin can create posts
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // Admin can store posts
});*/

/*
//routes for Update
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::get('/posts/{post}/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/posts/{post}/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');


//Delete route
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
*/

//Searchbar route
Route::get('/search', [App\Http\Controllers\PostController::class, 'search'])->name('posts.search');



require __DIR__.'/auth.php';
