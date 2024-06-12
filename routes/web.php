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
// Route::post('/saveItem', [TodoListController::class, 'store'])->name('saveItem');

// route for showing items on dashboard with user greeting
// Route::get('/dashboard', [TodoListController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// route for deleting items using id
// Route::delete('/items/{id}', [TodoListController::class, 'delete'])->name('dashboard.delete');
// Route::post('/edit/{id}', [TodoListController::class, 'edit'])->name('dashboard.edit');
// Route::post('/save/{id}', [TodoListController::class, 'save'])->name('dashboard.save');

// Laravel conventional routes:
// tip: use php artisan route:list to display list of routes
// You can group routes to minimize repeating code such as middleware
Route::middleware('auth', 'verified')->group(function () {
    // In your case the dashboard displays not only the index but perfoms all functionality as well
    // such as creating, showing, editing, and deleting so their corresponding routes have been commented out
    Route::get('/dashboard', [TodoListController::class, 'index'])->name('dashboard'); // typically a list of items
    // Route::get('/dashboard', [TodoListController::class, 'create']); // typically a form for creating an item
    Route::post('/dashboard', [TodoListController::class, 'store'])->name('dashboard.store'); // the action for the above form to persist to db
    // Route::get('/dashboard/{todo}', [TodoListController::class, 'show']); // typically a detail view only of a particular item
    Route::get('/dashboard/{id}/edit', [TodoListController::class, 'edit'])->name('dashboard.edit'); // typically a form similar to the create but for editing the item
    // Route::patch('/dashboard', [TodoListController::class, 'update']); // non-conventional but necessary in your case for single page functionality
    Route::patch('/dashboard/{id}', [TodoListController::class, 'update'])->name('dashboard.update'); // conventionally the action for the edit form to persist changes to the db
    // Route::delete('/dashboard', [TodoListController::class, 'destroy']); // non-conventional but necessary in your case for single page functionality
    Route::delete('/dashboard/{id}', [TodoListController::class, 'destroy'])->name('dashboard.destroy'); // conventionally the action for deleting an item, typically a form consisting of just a button found on the detail view
});

require __DIR__ . '/auth.php';
