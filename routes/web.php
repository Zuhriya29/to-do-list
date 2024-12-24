<?php

use App\Http\Controllers\Todo\TodoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/to-do-list', [TodoController::class, 'index'])->name('todo');
Route::post('/to-do-list', [TodoController::class, 'store'])->name('todo.post');
Route::put('/to-do-list/{id}', [TodoController::class, 'update'])->name('todo.update');
Route::delete('/to-do-list/{id}', [TodoController::class, 'destroy'])->name('todo.delete');
