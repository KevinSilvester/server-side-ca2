<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\TodoList;

class TodoListController extends Controller
{
   private $tasksList;

   public function __construct(TasksList $tasksList)
   {
      $this->tasksList = $tasksList;
   }

   public function index() {
      return view('home')->with('todoLists', TodoList::orderBy('name')->get());
   }

   public function show($id)
   {
      $data = $this->tasksList->getTasks($id);

      if (count($data['todo']) < 1){
         return redirect('/');
      }
      else{
         return view('todo')->with('data', $this->tasksList->getTasks($id));
      }
   }

   public function create(Request $request)
   {
      $todoList = new TodoList;
      $todoList->name = $request->name;
      $todoList->icon = $request->file('icon')->store('icons', 'public');
      $todoList->banner = $request->file('banner')->store('banners', 'public');
      $todoList->save();
   }

   public function update(Request $request, $id)
   {
      $todoList = TodoList::findOrFail($id);
      $todoList->name = $request->name;
      if ($request->file('icon')) {
         Storage::disk('public')->delete($todoList->icon);
         $todoList->icon = $request->file('icon')->store('icons', 'public');
      }
      if ($request->file('banner')) {
         Storage::disk('public')->delete($todoList->banner);
         $todoList->banner = $request->file('banner')->store('banners', 'public');
      }
      $todoList->save();
   }

   public function destroy($id)
   {
      $todoList = TodoList::findOrFail($id);
      Storage::disk('public')->delete($todoList->icon);
      Storage::disk('public')->delete($todoList->banner);
      $todoList->delete();
   }
}
