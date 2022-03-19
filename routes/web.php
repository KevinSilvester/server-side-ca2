<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;

Route::get('/', [TodoListController::class, 'index']);

Route::get('/todo/{id}', [TodoListController::class, 'show']);
