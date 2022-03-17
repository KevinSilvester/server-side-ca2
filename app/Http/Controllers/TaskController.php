<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Task;

class TaskController extends Controller
{
   public function show(Request $request)
   {
      $tasks = Task::orderBy('created_at')->get();
   }
}
