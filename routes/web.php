<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;
Route::middleware(['auth'])->name('boook.')->prefix('/book')->group(function () {
    Route::get('/',[BookController::class,'index'])->name('book.index');
    Route::get('/new-book', [BookController::class, 'create'])->name('create-book');
    Route::post('/new-book', [BookController::class, 'store'])->name('store-book');
    Route::get('/{slug}', [BookController::class,'show'])->name('show');
    Route::get('/edit/{slug}', [BookController::class, 'edit'])->name('edit-book');
    Route::post('/edit/{slug}', [BookController::class, 'update'])->name('update-book');
    Route::delete('/delete/{id}', [BookController::class, 'destroy'])->name('delete-book');
});



// auth routes
Route::get('/sign-up', [UserController::class, 'signupForm'])->name('sign-up-form');
Route::post('/sign-up', [UserController::class, 'register'])->name('register');
Route::get('/sign-in', [UserController::class, 'signinForm'])->name('sign-in-form');
Route::post('/sign-in', [UserController::class, 'login'])->name('login');
Route::post('/sign-out', [UserController::class, 'logout'])->name('logout');