<?php

use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RecipesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', []);
})->name('home');
Route::get('dashboard', function () {
    return Inertia::render('Dashboard', []);
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('menu', function () {
    return Inertia::render('Menu', []);
})->middleware(['auth', 'verified'])->name('menu');
Route::get('recipes', function () {
    return Inertia::render('Recipes', []);
})->middleware(['auth', 'verified'])->name('recipes');
Route::get('news', function () {
    return Inertia::render('News', []);
})->middleware(['auth', 'verified'])->name('news');
Route::get('post-menu', function () {
    return Inertia::render('PostMenu', []);
})->middleware(['auth', 'verified'])->name('post-menu');
Route::get('post-create', function () {
    return Inertia::render('PostCreate', []);
})->middleware(['auth', 'verified'])->name('post-create');
Route::get('create-recipe', function () {
    return Inertia::render('CreateRecipe', []);
})->middleware(['auth', 'verified'])->name('create-recipe');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->get('/api/menus', [MenuController::class, 'index']);

Route::middleware(['auth', 'verified'])->get('/api/recipes', [RecipesController::class, 'getRecipes']);
Route::middleware(['auth', 'verified'])->post('/api/recipes', [RecipesController::class, 'store'])->name('recipes.store');

Route::middleware(['auth', 'verified'])
    ->post('/api/recipes/favorite/{id}', [RecipesController::class, 'addFavorite'])
    ->name('recipes.favorite');
Route::middleware(['auth', 'verified'])
    ->delete('/api/recipes/favorite/{id}', [RecipesController::class, 'removeFavorite'])
    ->name('recipes.unfavorite');
Route::middleware(['auth', 'verified'])
    ->get('/api/recipes/favorites', [RecipesController::class, 'getFavorites'])
    ->name('recipes.favorites');

//Post
Route::middleware(['auth', 'verified'])
    ->get('/api/posts', [PostController::class, 'getPosts'])
    ->name('recipes.favorites');
Route::middleware(['auth', 'verified'])
    ->post('api/post', [PostController::class, 'store'])
    ->name('api.posts.store');




