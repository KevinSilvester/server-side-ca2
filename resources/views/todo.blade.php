@php
   $PATH = App::environment('production') ? 'public/uploads' : asset('uploads');
   $todo = $data['todo'][0];
   $otherTodos = $data['otherTodos'];
   $tasks = $data['tasks'];
   $iconPath = $PATH . '/' . $todo->icon;
   $bannerPath = $PATH . '/' . $todo->banner;

   $tasksTodo = $tasks->filter(fn($task) => $task->progress == 'todo');
   $tasksDoing = $tasks->filter(fn($task) => $task->progress == 'doing');
   $tasksDone = $tasks->filter(fn($task) => $task->progress == 'done');
@endphp

<x-layout title="Todo-List - {{ $todo->name }}">
   <div class="absolute top-0 left-0 h-60 overflow-hidden opacity-30 z-[-1]">
      <img class="object-cover" src="{{ $bannerPath }}" alt="{{ $todo->name }}">
   </div>
   <div class="container mx-auto my-48 flex flex-col items-center">
      <div class="flex items-center gap-3">
         <div
            class="bg-custom-white-200 ring-custom-blue-200 h-10 w-10 overflow-hidden rounded-full ring-1 z-0"
         >
            <img class="h-full object-cover" src="{{ $iconPath }}" alt="{{ $todo->name }}">
         </div>
         <h1 
            class="text-custom-blue-200 text-4xl font-extrabold"
            data-todo='@json($todo)'
            x-init="populateTodo($el)"
         >
            {{ $todo->name }}
         </h1>
         <div 
            class="relative"
            x-on:keydown.escape.prevent.stop="closeDropDown($refs.button)"
            x-on:focusin.window="! $refs.panel.contains($event.target) && closeDropDown()"
            x-id="['dropdown-button']"
         >
            <button
               class="bg-custom-blue-200/80 hover:bg-custom-blue-200 text-custom-white-200 duration-150 w-10 h-10 rounded-lg grid place-items-center"
               x-ref="button"
               x-on:click="toggleDropDown()"
               :aria-expanded="openDropDown"
               :aria-controls="$id('dropdown-button')"
            >
            <svg class="h-[1.35rem] fill-custom-white-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
               <path d="M192 384c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L192 306.8l137.4-137.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-160 160C208.4 380.9 200.2 384 192 384z"/>
            </svg>
            </button>

            <div
               x-ref="panel"
               x-show="openDropDown"
               x-transition.origin.top.left
               x-on:click.outside="closeDropDown($refs.button)"
               :id="$id('dropdown-button')"
               style="display: none;"
               class="absolute z-50 left-0 mt-2 w-40 bg-custom-navy-300 font-bold rounded-lg shadow-md overflow-hidden"
            >
               <div>
                  <div 
                     tabindex="0" 
                     class="hover:text-custom-blue-200 cursor-pointer duration-150 block w-full px-4 py-3 text-center" 
                     @click="toggleTodo()"
                  >
                     Edit List Details
                  </div>
   
                  <div 
                     tabindex="0" 
                     class="hover:text-red-500 cursor-pointer duration-150 block w-full px-4 py-3 text-center"
                     @click="actions('deleteTodoList')()"
                  >
                     Delete List
                  </div>
               </div>
            </div>
         </div>
      </div>

      @if (count($tasks))
         <div class="relative my-7 grid grid-cols-3 gap-3 pt-20">
            <div class="absolute top-0 left-0 h-fit w-full">
               <button
                  class="bg-custom-blue-200/80 hover:bg-custom-blue-200 text-custom-white-200 absolute w-max right-0 duration-150 px-3 py-1 rounded-full flex gap-x-2 items-center text-center font-bold"
                  @click="toggleTask($event)"
               >
                  <svg class="h-5 fill-custom-white-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                     <path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z" />
                  </svg>
                  <span class="mr-2">Add Task</span>
               </button>
          </div>

            <div class="flex flex-col gap-y-2">
               <h3
                  class="text-custom-white-200 h-fit w-fit rounded-md bg-red-500 px-2 py-1 font-bold">
                  To Do
               </h3>
               @if (count($tasksTodo))
                  @foreach ($tasksTodo as $task)
                     <x-task-container :task="$task" />
                  @endforeach
               @else
                  <div
                     class="bg-custom-navy-500 ring-custom-blue-200 text-custom-blue-200 rounded-lg px-3 py-2 font-bold ring-1">
                     No Tasks To Do
                  </div>
               @endif
            </div>
            <div class="flex flex-col gap-y-2">
               <h3
                  class="text-custom-white-200 h-fit w-fit rounded-md bg-amber-400 px-2 py-1 font-bold">
                  Doing
               </h3>
               @if (count($tasksDoing))
                  @foreach ($tasksDoing as $task)
                     <x-task-container :task="$task" />
                  @endforeach
               @else
                  <div
                     class="bg-custom-navy-500 ring-custom-blue-200 text-custom-blue-200 rounded-lg px-3 py-2 font-bold ring-1">
                     No Tasks Are Being Done
                  </div>
               @endif
            </div>
            <div class="flex flex-col gap-y-2">
               <h3
                  class="text-custom-white-200 h-fit w-fit rounded-md bg-green-400 px-2 py-1 font-bold">
                  Done
               </h3>
               @if (count($tasksDone))
                  @foreach ($tasksDone as $task)
                     <x-task-container :task="$task" />
                  @endforeach
               @else
                  <div
                     class="bg-custom-navy-500 ring-custom-blue-200 text-custom-blue-200 rounded-lg px-3 py-2 font-bold ring-1">
                     No Tasks Completed
                  </div>
               @endif
            </div>
         </div>
      @else
         <div class="relative my-7 pt-20 w-[888px]  text-center">
            <div class="absolute top-0 left-0 h-fit w-full">
               <button
                  class="bg-custom-blue-200/80 hover:bg-custom-blue-200 text-custom-white-200 absolute w-max right-0 duration-150 px-3 py-1 rounded-full flex gap-x-2 items-center text-center font-bold"
                  @click="toggleTask($event)"
               >
                  <svg class="h-5 fill-custom-white-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                     <path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z" />
                  </svg>
                  <span class="mr-2r">Add Task</span>
               </button>
          </div>
          <span class="text-2xl font-bold text-custom-blue-200">No Tasks Found</span>
         </div>
      @endif
   </div>
   <x-task-modal />
   <x-todo-modal />
</x-layout>
