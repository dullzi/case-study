<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Authors
    Route::get('authors', [\App\Http\Controllers\Web\AuthorController::class, 'index'])->name('authors.index');
    Route::middleware('admin')->group(function () {
        Route::get('authors/create', [\App\Http\Controllers\Web\AuthorController::class, 'create'])->name('authors.create');
        Route::post('authors', [\App\Http\Controllers\Web\AuthorController::class, 'store'])->name('authors.store');
        Route::get('authors/{author}/edit', [\App\Http\Controllers\Web\AuthorController::class, 'edit'])->name('authors.edit');
        Route::patch('authors/{author}', [\App\Http\Controllers\Web\AuthorController::class, 'update'])->name('authors.update');
        Route::delete('authors/{author}', [\App\Http\Controllers\Web\AuthorController::class, 'destroy'])->name('authors.destroy');
    });

    // Publishers
    Route::get('publishers', [\App\Http\Controllers\Web\PublisherController::class, 'index'])->name('publishers.index');
    Route::middleware('admin')->group(function () {
        Route::get('publishers/create', [\App\Http\Controllers\Web\PublisherController::class, 'create'])->name('publishers.create');
        Route::post('publishers', [\App\Http\Controllers\Web\PublisherController::class, 'store'])->name('publishers.store');
        Route::get('publishers/{publisher}/edit', [\App\Http\Controllers\Web\PublisherController::class, 'edit'])->name('publishers.edit');
        Route::patch('publishers/{publisher}', [\App\Http\Controllers\Web\PublisherController::class, 'update'])->name('publishers.update');
        Route::delete('publishers/{publisher}', [\App\Http\Controllers\Web\PublisherController::class, 'destroy'])->name('publishers.destroy');
    });

    // Books
    Route::get('books', [\App\Http\Controllers\Web\BookController::class, 'index'])->name('books.index');
    Route::middleware('admin')->group(function () {
        Route::get('books/create', [\App\Http\Controllers\Web\BookController::class, 'create'])->name('books.create');
        Route::post('books', [\App\Http\Controllers\Web\BookController::class, 'store'])->name('books.store');
        Route::get('books/{book}/edit', [\App\Http\Controllers\Web\BookController::class, 'edit'])->name('books.edit');
        Route::patch('books/{book}', [\App\Http\Controllers\Web\BookController::class, 'update'])->name('books.update');
        Route::delete('books/{book}', [\App\Http\Controllers\Web\BookController::class, 'destroy'])->name('books.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
