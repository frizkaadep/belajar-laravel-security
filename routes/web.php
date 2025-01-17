<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Models\Todo;
use Illuminate\Support\Facades\Route;


Route::post("/api/todo", [TodoController::class, "create"]);

Route::get("/users/login", [UserController::class, "login"]);
Route::get("/users/current", [UserController::class, "current"])
    ->middleware("auth");
Route::get("/api/users/current", [UserController::class, "current"])
    ->middleware("auth:token");
Route::get("/simple-api/users/current", [UserController::class, "current"])
    ->middleware("auth:simple-token");


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

require __DIR__ . '/auth.php';
