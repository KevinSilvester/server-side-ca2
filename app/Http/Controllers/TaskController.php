<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Task;

class TaskController extends Controller
{
   public function index()
   {
      $tasks = Task::orderBy('created_at')->get();
   }

   public function create(Request $request)
   {
      $task = new Task;
      $task->todo_id = $request->query('todo');
      $task->name = $request->name;
      $task->progress = $request->progress;
      $task->save();
   }

   public function destroy($id)
   {
      $task = Task::findOrFail($id);
      $task->delete();
   }

   public function update(Request $request, $id)
   {
      $task = Task::findOrFail($id);
      $task->name = $request->name;
      $task->progress = $request->progress;
      $task->save();
   }
}
