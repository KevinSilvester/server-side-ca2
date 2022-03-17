<x-layout title="Todo-Lists">
   <div class="container mx-auto my-28 flex flex-col items-center">
      <h1 class="text-custom-blue-200 text-5xl font-extrabold">Todo Lists:</h1>
      <div class="my-7 flex flex-col gap-3">
         @if (count($todoLists))
            @foreach ($todoLists as $todoList)
               <x-box :icon="$todoList->icon" :name="$todoList->name" :id="$todoList->todo_id">
                  {{ $todoList->name }}
               </x-box>
            @endforeach
         @else
            <x-box>No Todos To Do</x-box>
         @endif
      </div>
   </div>
</x-layout>
