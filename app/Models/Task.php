<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
   use HasFactory;

   protected $primaryKey = 'task_id';

   protected $fillable = ['name', 'progress', 'todo_id'];

   public function todoList()
   {
      return $this->belongsTo(TodoList::class);
   }
}
