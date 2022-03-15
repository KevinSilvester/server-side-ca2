<x-layout title="Todo-Lists">
   <body class="bg-custom-navy-600 font-nunito relative">
      <div class="container mx-auto my-20 flex flex-col items-center">
         <h1 class="text-custom-blue-200 text-5xl font-extrabold">Todo Lists</h1>
         <div class="my-7 flex flex-col gap-3">
            @if ($todoLists)
               @foreach ($todoLists as $todoList)
                  <x-box>{{ $todoList->name }}</x-box>
               @endforeach
            @else
               <x-box>No Todos To Do</x-box>
            @endif
         </div>
      </div>
   </body>
</x-layout>
