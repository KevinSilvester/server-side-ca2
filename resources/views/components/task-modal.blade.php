<div 
   class="fixed top-0 left-0 h-screen w-screen backdrop-blur-sm grid bg-black/50 z-50 place-items-center"
   x-show="openTaskModal"
   x-transition.duration.200ms
   x-transition:enter.scale.100
   x-transition:leave.scale.100
   style="display: none"
>
   <div
      class='w-[95vw] max-w-[500px] bg-custom-navy-600 relative p-6 md:p-7 rounded-lg drop-shadow-2xls shadow-2xl'
      @click.away="openTaskModal = false"
      x-show="openTaskModal"
      x-transition.duration.200ms
   >
   <button 
      class="absolute top-2 right-2 w-10 h-10 grid place-items-center bg-custom-navy-300 group rounded-md duration-150"
      @click="openTaskModal = false"
   >
      <svg 
         class="h-3/4 fill-custom-slate-300 group-hover:fill-custom-blue-200 group-focus:fill-custom-blue-200" xmlns="http://www.w3.org/2000/svg" 
         viewBox="0 0 320 512"
      >
         <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/>
      </svg>
   </button>
      <h2 id="modal-title" class='text-center text-2xl font-bold' x-text="title"></h2>
      <br />
      <form id="modal-form" class="px-12" @submit.prevent="actions(mode)($event)">
         @csrf
         <div class="flex gap-4">
            <label for="modal-input" class="w-20 grid items-center justify-end font-extrabold">Task:</label>
            <input
               name="name"
               id="modal-input"
               type="text"
               class="bg-custom-navy-300 hover:text-custom-slate-100 focus:text-custom-blue-200 border-none outline-none focus:ring-0 rounded-md font-bold"
               :value="task.name"
            >
         </div>
         <div class="mt-1 pl-24">
            <template x-for="error in errors">
               <div class="px-1 w-fit h-fit bg-red-100 text-red-500 rounded-md text-sm" x-text="error"></div>
            </template>
         </div>
         <div class="flex gap-4 mt-5">
            <label for="modal-select" class="w-20 grid items-center justify-end font-extrabold">Progress:</label>
            <select 
               name="progress" 
               id="modal-select"
               class="bg-custom-navy-300 hover:text-custom-slate-100 focus:text-custom-blue-200 border-none outline-none focus:ring-0 rounded-md font-bold cursor-pointer"
               :value="task.progress"
            >
               <option value="todo">To Do</option>
               <option value="doing">Doing</option>
               <option value="done">Done</option>
            </select>
         </div>
         <div class='mt-5 flex items-center justify-evenly'>
            <button 
               class='px-4 py-2 bg-red-500 text-white rounded-md shadow-md hover:shadow-xl duration-200 disabled:bg-red-500/50'
               :disabled="disabled"
               @click.prevent="actions('deleteTask')()"
            >
               Delete
            </button>
            <button class='px-4 py-2 bg-custom-blue-200 text-white rounded-md shadow-md hover:shadow-xl duration-200'>
               Save
            </button>
         </div>
      </form>
   </div>
</div>