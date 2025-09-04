<?php

use App\Http\Controllers\Api\MenuController;
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

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->get('/api/menus', [MenuController::class, 'index']);
Route::middleware(['auth', 'verified'])->get('/api/recipes', [RecipesController::class, 'getRecipes']);
