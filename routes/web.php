<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

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

// Logged in
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Page d'accueil si non connecté
Route::get('/', [HomepageController::class, 'index']);

// Authentifié
Route::middleware('auth')->group(function () {
    // Liste des posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    // Récupération des données du formulaire de création d'un post
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    // Affichage du formulaire de création d'un post
    // posts/create doit être avant /posts/{id}
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    // Détail d'un post
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    // Stockage d'un commentaire
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    // Liker un post
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');

    // Gestion du profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // modification de l'avatar
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    // Détail d'un profil utilisateur
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    // modifier la bio
    Route::patch('/profile/bio', [ProfileController::class, 'updateBio'])->name('profile.bio.update');
    // follow/unfollow a user
    Route::post('/profile/{user}/follow', [ProfileController::class, 'follow'])->name('profile.follow');
});



// Authentification
require __DIR__ . '/auth.php';
