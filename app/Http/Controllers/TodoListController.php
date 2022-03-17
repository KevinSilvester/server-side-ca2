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

   private $tasksList;

   public function __construct(TasksList $tasksList)
   {
      $this->tasksList = $tasksList;
   }

   public function index() {
      return view('index')->with('todoLists', TodoList::orderBy('name')->get());
   }

   public function show($id)
   {
      $data = $this->tasksList->getTasks($id);

      if (count($data['todo']) < 1){
         return redirect('/');
      }
      else{
         return view('todo.index')->with('data', $this->tasksList->getTasks($id));
      }
   }
}
