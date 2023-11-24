<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PostController;
//use App\Http\Controllers\ProfileController; //TODO pour le profil public


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
    // Affichage du formulaire de création d'un post
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    // Récupération des données du formulaire de création d'un post
    // posts/create doit être après /posts/{id}
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    // Détail d'un post
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    // TODO likes avec le PostController
    // TODO commentaires avec le PostController

    // Gestion du profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // TODO Détail d'un profil utilisateur "show"
    // TODO follow
});

// Authentification
require __DIR__ . '/auth.php';
