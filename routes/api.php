<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/task/create', [TaskController::class, 'create']);

Route::delete('/task/{id}', [TaskController::class, 'destroy']);

Route::post('/task/{id}', [TaskController::class, 'update']);

Route::post('/todo/create', [TodoListController::class, 'create']);

Route::delete('/todo/{id}', [TodoListController::class, 'destroy']);

Route::post('/todo/{id}', [TodoListController::class, 'update']);