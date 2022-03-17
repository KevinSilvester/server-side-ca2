<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
   use HasFactory;

   protected $primaryKey = 'todo_id';

   protected $fillable = ['name', 'banner', 'icon'];

   public function tasks()
   {
      return $this->hasMany(Task::class);
   }
}
