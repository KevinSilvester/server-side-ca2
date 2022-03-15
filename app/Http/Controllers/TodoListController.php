<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\TodoList;

class TodoListController extends Controller
{
   //  public function addTask(Request $request) {
   //    $task = new Task;
   //    // $task->name
   //    Log::info(json_encode($request->all()));
   // return view('index');
   // }

   // public function getAllTask(Request $request) {
   //    $tasks = Task::orderBy('created_at')->get();
   //    // TODO: make route
   //    // return view('todo', ['tasks' => $tasks]);
   // }

   public function getAllTodoLists() {
      $todoLists = TodoList::orderBy('name')->get();
      return view('index', ['todoLists' => $todoLists]);
   }
}
