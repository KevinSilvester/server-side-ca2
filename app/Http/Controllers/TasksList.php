<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TodoList;

class TasksList extends Controller
{
   public function getTasks($id)
   {
      $todo = TodoList::where('todo_id', $id)->get();
      $otherTodos = TodoList::where('todo_id', '!=', $id)->get();
      $tasks = Task::where('todo_id', $id)->orderBy('progress')->orderBy('created_at')->get();
      return compact('todo', 'otherTodos', 'tasks');
   }
}
