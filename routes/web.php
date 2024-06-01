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

Route::post('/saveItem', [TodoListController::class, 'store'])->name('saveItem');

// routes/web.php

// route for getting user's name
Route::get('/dashboard', [ProfileController::class, 'greeting'])->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
