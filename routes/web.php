<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Redirect;

Route::get('/', [TodoListController::class, 'index']);


Route::get('/todo/{id}', [TodoListController::class, 'show']);


// Route::post('/add-task', [TaskController::class, 'addTask'])->name('add-task');

