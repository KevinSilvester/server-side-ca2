<x-layout title="Todo-Lists">
   <div class="container mx-auto my-28 flex flex-col items-center">
      <div class="flex gap-5">
         <h1 class="text-custom-blue-200 text-5xl font-extrabold">Todo Lists:</h1>
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
                     Add New List
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="my-7 flex flex-col gap-3">
         @if (count($todoLists))
            @foreach ($todoLists as $todoList)
               <x-box :icon="$todoList->icon" :name="$todoList->name" :id="$todoList->todo_id">
                  {{ $todoList->name }}
               </x-box>
            @endforeach
         @else
            <div class="text-lg font-bold">No Todos To Do</div>
         @endif
      </div>
   </div>
   <x-todo-modal />
</x-layout>