<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NieuwsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentaarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/nieuws', [NieuwsController::class, 'index'])->name('nieuws.index');
Route::get('/nieuws/create', [NieuwsController::class, 'create'])->name('nieuws.create');
Route::post('/nieuws', [NieuwsController::class, 'store'])->name('nieuws.store');
Route::get('/nieuws/{id}/edit', [NieuwsController::class, 'edit'])->name('nieuws.edit');
Route::patch('/nieuws/{id}', [NieuwsController::class, 'update'])->middleware('auth')->name('nieuws.update');
Route::delete('/nieuws/{id}', [NieuwsController::class, 'destroy'])->name('nieuws.destroy');
Route::get('/nieuws/manage', [NieuwsController::class, 'manage'])->middleware('auth')->name('nieuws.manage');
Route::get('/nieuws/{id}', [NieuwsController::class, 'show'])->name('nieuws.show');

//create a tag
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
Route::get('/tags/{id}/edit', [TagController::class, 'edit'])->name('tags.edit');
Route::patch('/tags/{id}', [TagController::class, 'update'])->name('tags.update');
Route::delete('/tags/{id}', [TagController::class, 'destroy'])->name('tags.destroy');

//create a category
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
Route::patch('/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');

//create a comment
Route::post('/comments', [CommentaarController::class, 'store'])->name('comments.store');
Route::get('/comments/{id}/edit', [CommentaarController::class, 'edit'])->name('comments.edit');
Route::patch('/comments/{id}', [CommentaarController::class, 'update'])->name('comments.update');
Route::delete('/comments/{id}', [CommentaarController::class, 'destroy'])->name('comments.destroy');