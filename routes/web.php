<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\User;
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

Route::get('/', [homeController::class, 'homepage' ]  );

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [homeController::class, "index"])->middleware(['auth', 'verified'])->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Admin

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
Route::get('/postPage', [adminController::class, 'postPage']); //->middleware(['auth', 'verified', 'admin']);
Route::post('/add_post',[adminController::class, 'add_post']) ;//->middleware(['auth', 'verified', 'admin']);
Route::get('/show_post', [adminController::class, 'show_post']); //->middleware(['auth', 'verified', 'admin']);
Route::get('/delete_post/{id}', [adminController::class, 'delete_post']); //->middleware(['auth', 'verified', 'admin']);
Route::get('/edit_post/{id}', [adminController::class, 'edit_post']); //->middleware(['auth', 'verified', 'admin']);
Route::post('/updated_post/{id}', [adminController::class, 'updated_post']); //->middleware(['auth', 'verified', 'admin']);
Route::get('/accept_post/{id}', [adminController::class, 'accept_post']); //->middleware(['auth', 'verified', 'admin']);
Route::get('/decline_post/{id}', [adminController::class, 'decline_post']); //->middleware(['auth', 'verified', 'admin']);
Route::get('/get-new-post-count', [AdminController::class, 'getNewPostCount']);
Route::get('/get-pending-tasks', [AdminController::class, 'getPendingTasks']);
Route::get('/pending_post', [adminController::class, 'pending_post']); //->middleware(['auth', 'verified', 'admin']);
Route::get('/getChartData', [adminController::class, 'getChartData']);
// Route::get('/getUserData', [adminController::class, 'getUserData']);




});

///public routes
Route::get('/read_more/{id}', [homeController::class, 'read_more']);
Route::get('/about_read_more', [homeController::class, 'about_read_more']);
Route::get('/blogs', [homeController::class, 'blogs']);
// Route::get('/search', [adminController::class, 'search']);


///user
Route::middleware(['auth', 'verified', 'user'])->group(function () {
Route::get('/create_post',[homeController::class, 'create_post']); //->middleware(['auth', 'verified']);
Route::post('/user_post', [homeController::class, 'user_post']); //->middleware(['auth', 'verified']);
Route::get('/my_posts',[homeController::class, 'my_posts']); //->middleware(['auth', 'verified']);
Route::get('/user_delete_post/{id}', [homeController::class, 'user_delete_post']);
Route::get('/user_edit_post/{id}', [homeController::class, 'user_edit_post']); //->middleware(['auth', 'verified', 'admin']);
Route::post('/user_updated_post/{id}', [homeController::class, 'user_updated_post']); //->middleware(['auth', 'verified', 'admin']);

});


