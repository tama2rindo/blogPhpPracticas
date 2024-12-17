<?php

use App\Livewire\PaginaPrincipal;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DependencyInjection\RegisterControllerArgumentLocatorsPass;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use GuzzleHttp\Middleware;
use App\Livewire\Actions\Logout;

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

//Route::view('/', 'welcome');

Route::view('/', 'livewire.paginaprincipal')
->name('paginaprincipal');

Route::view('dashboard', 'dashboard')
  //  ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('/register','register')
    ->name('register');



/******************************************************************************** */
//Auth route:
//Route::group(['middleware' => 'role:super-admin|admin'], function() {
Route::group(['middleware' => 'isAdmin'], function() {

    //Permission routes:
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);   //removed [] because we'll target more than 1 funcion from this controller, as we're using a resource
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);   //here i'm targeting 1 function (destroy), so have to add it at the end

    Route::resource('roles', App\Http\Controllers\RoleController::class);  
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);   

    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);   
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);   

    Route::resource('users', App\Http\Controllers\UserController::class);  
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);
  
});




/******************************************************************************** */
Route::group(['middleware' => 'role:super-admin|admin|loggedin-user'], function() {
    Route::get('/posts/{post}/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/posts/{post}/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

});



 //Public Post routes accessible to everyone
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

// Comment routes
Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');

//routes for Update
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
//Route::get('/posts/{post}/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
//Route::put('/posts/{post}/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');


//Delete route
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
//Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


//Searchbar route
Route::get('/search', [App\Http\Controllers\PostController::class, 'search'])->name('posts.search');

//Logout route
Route::get('/logout', Logout::class)->name('logout');



require __DIR__.'/auth.php';
