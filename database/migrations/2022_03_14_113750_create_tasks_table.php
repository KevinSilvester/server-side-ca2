<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('tasks', function (Blueprint $table) {
         $table->engine = 'InnoDB';
         $table->id('task_id')->autoIncrement();
         $table->unsignedBigInteger('todo_id');
         $table->string('name', 150);
         $table->enum('progress', ['todo', 'doing', 'done']);
         $table->foreign('todo_id')->references('todo_id')->on('todo_lists')->onDelete('cascade');
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('tasks');
   }
}
