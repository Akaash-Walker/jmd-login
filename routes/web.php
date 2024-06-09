<?php

use App\Http\Controllers\JeffToDoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/jeff-todo', JeffToDoController::class);
});

// route for saving items to db
Route::post('/saveItem', [TodoListController::class, 'store'])->name('saveItem');

// route for showing items on dashboard with user greeting
Route::get('/dashboard', [TodoListController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// route for deleting items using id
Route::delete('/items/{id}', [TodoListController::class, 'delete'])->name('dashboard.delete');

require __DIR__ . '/auth.php';
