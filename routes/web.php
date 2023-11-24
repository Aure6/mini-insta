<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PostController;
//use App\Http\Controllers\DashboardController; //TODO A SUPPR
use App\Http\Controllers\Admin\ArticleController as AdminArticleController; //
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

//par défaut
/* Route::get('/', function () {
    return view('welcome');
}); */

/* =============================================== */
// Page d'accueil si connecté
/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])
    ->name('dashboard'); */

// Route::get('/dashboard', [DashboardController::class, 'index']);

//dashboard avec postcontroller pour afficher les articles avec fonction articles.index
Route::get('/dashboard', [PostController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
/* =============================================== */

// Page d'accueil si non connecté
Route::get('/', [HomepageController::class, 'index']);
// Liste des posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
// Détail d'un post
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('posts', AdminPostController::class);
});

// Gestion du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Détail d'un profil utilisateur
//TODO

// Authentification
require __DIR__ . '/auth.php';
