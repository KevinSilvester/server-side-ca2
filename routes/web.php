<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoListController;

Route::get('/', [TodoListController::class, 'getAllTodoLists']);


Route::post('/todo', [TaskController::class, 'addTask'])->name('add-task');


// Route::post('/add-task', [TaskController::class, 'addTask'])->name('add-task');

