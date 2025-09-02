<?php

use App\Http\Controllers\Api\MenuController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');
Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('menu', function () {
    return Inertia::render('Menu');
})->middleware(['auth', 'verified'])->name('menu');
Route::get('recipe', function () {
    return Inertia::render('Recipe');
})->middleware(['auth', 'verified'])->name('recipe');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->get('/api/menus', [MenuController::class, 'index']);
