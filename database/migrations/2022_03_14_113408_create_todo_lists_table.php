<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoListsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('todo_lists', function (Blueprint $table) {
         $table->engine = 'InnoDB';
         $table->id('todo_id')->autoIncrement();
         $table->string('name', 150);
         $table->string('banner', 150);
         $table->string('icon', 150);
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
      Schema::dropIfExists('todo_lists');
   }
}
