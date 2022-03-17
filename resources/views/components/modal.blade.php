<div 
   class="fixed top-0 left-0 h-screen w-screen backdrop-blur-sm grid bg-black/50 z-50 place-items-center"
   x-show="open"
   x-transition.duration.200ms
   x-transition:enter.scale.100
   x-transition:leave.scale.100
   style="display: none"
>
   <div
      class='w-[95vw] max-w-[500px] bg-custom-navy-600 p-6 md:p-7 rounded-md drop-shadow-2xls shadow-2xl'
      @click.away="open = false"
      x-show="open"
      x-transition.duration.200ms
   >
      <h2 id="modal-title" class='text-center text-2xl font-bold'>title</h2>
      <br />
      <form action="" id="modal-form" class="px-16">
         @csrf
         <div class="flex gap-4">
            <label for="modal-input" class="w-20">Task:</label>
            <input
               name="name"
               id="modal-input"
               type="text"
               class="bg-custom-navy-300 border-none outline-none focus:ring-0 rounded-md"
               :value="data.name"
            >
         </div>
         <div class="flex gap-4 mt-5">
            <label for="modal-select" class="w-20">Progress:</label>
            <select 
               name="progress" 
               id="modal-select"
               class="bg-custom-navy-300 border-none outline-none focus:ring-0 rounded-md"
               :value="data.progress"
            >
               <option value="todo">To Do</option>
               <option value="doing">Doing</option>
               <option value="done">Done</option>
            </select>
         </div>
      </form>
      <div class='mt-5 flex items-center justify-evenly'>
         <button class='px-4 py-2 bg-red-500 text-white rounded-md shadow-md hover:shadow-xl duration-200'>
            Cancel
         </button>
         <button class='px-4 py-2 bg-custom-blue-200 text-white rounded-md shadow-md hover:shadow-xl duration-200'>
            Save
         </button>
      </div>
   </div>
</div>