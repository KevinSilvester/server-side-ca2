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
            class="bg-custom-white-200 ring-custom-blue-200 h-10 w-10 overflow-hidden rounded-full object-cover ring-1 z-0">
            <img class="h-full" src="{{ $iconPath }}" alt="{{ $todo->name }}">
         </div>
         <h1 class="text-custom-blue-200 text-4xl font-extrabold">{{ $todo->name }}</h1>
      </div>

      @if (count($tasks))
         <div class="my-7 grid grid-cols-3 gap-3">
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
         <div>No Tasks Found</div>
      @endif
   </div>
   <x-modal />
</x-layout>
