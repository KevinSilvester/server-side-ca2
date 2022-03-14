<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('index');
});

Route::post('/add-task', [TaskController::class, 'addTask'])->name('add-task');

