<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Auth::routes();

Route::get('todos/index', [TodoController::class, 'index'])->name('todos.index');
Route::get('todos/create', [TodoController::class, 'create'])->name('todos.create');
Route::post('todos/store', [TodoController::class, 'store'])->name('todos.store');
Route::get('todos/show/{id}', [TodoController::class, 'show'])->name('todos.show');
Route::get('todos/{id}/edit', [TodoController::class, 'edit'])->name('todos.edit');
Route::put('todos/update', [TodoController::class, 'update'])->name('todos.update');
Route::delete('todos/destroy', [TodoController::class, 'destroy'])->name('todos.destroy');
Route::get('todos/{id}/confirm-delete', [TodoController::class, 'confirmDelete'])->name('todos.confirm-delete');
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('auth/register', [RegisterController::class, 'store']);

Route::get('/register', [App\Http\Controllers\RegisterController::class, 'create'])->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store']);

require __DIR__.'/auth.php';

