<div 
   class="fixed top-0 left-0 h-screen w-screen backdrop-blur-sm grid bg-black/50 z-50 place-items-center"
   x-show="openTodoModal"
   x-transition.duration.200ms
   x-transition:enter.scale.100
   x-transition:leave.scale.100
   x-cloak
>
   <div
      class='w-[95vw] max-w-[500px] bg-custom-navy-600 relative p-6 md:p-7 rounded-lg drop-shadow-2xls shadow-2xl'
      @click.away="toggleTodo()"
      x-show="openTodoModal"
      x-transition.duration.200ms
   >
   <button 
      class="absolute top-2 right-2 w-10 h-10 grid place-items-center bg-custom-navy-300 group rounded-md duration-150"
      @click="toggleTodo()"
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
      <form id="modal-form" class="px-10" @submit.prevent="actions(mode)($event)">
         <div class="flex gap-4">
            <label for="modal-input" class="w-28 grid items-center justify-end font-extrabold">List Name:</label>
            <input
               name="name"
               id="modal-input"
               type="text"
               class="bg-custom-navy-300 hover:text-custom-slate-100 focus:text-custom-blue-200 border-none outline-none focus:ring-0 rounded-md font-bold"
               :value="todo.name"
            >
         </div>

         <div class="flex gap-4 mt-5">
            <span class="w-28 grid items-center justify-end font-extrabold">List Icon:</span>
            <div class="flex gap-3">
               <div>
                  <div class="bg-custom-navy-200 ring-custom-blue-200 h-10 w-10 overflow-hidden rounded-full ring-1 z-0 grid place-items-center">
                     <img class="h-full object-cover" :src="iconPreview" alt="Icon Preview" x-cloak x-show="() => iconPreview.length > 1">
                     <svg class="h-1/2 fill-custom-slate-400 opacity-70" x-show="() => iconPreview.length < 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M447.1 32h-384C28.64 32-.0091 60.65-.0091 96v320c0 35.35 28.65 64 63.1 64h384c35.35 0 64-28.65 64-64V96C511.1 60.65 483.3 32 447.1 32zM111.1 96c26.51 0 48 21.49 48 48S138.5 192 111.1 192s-48-21.49-48-48S85.48 96 111.1 96zM446.1 407.6C443.3 412.8 437.9 416 432 416H82.01c-6.021 0-11.53-3.379-14.26-8.75c-2.73-5.367-2.215-11.81 1.334-16.68l70-96C142.1 290.4 146.9 288 152 288s9.916 2.441 12.93 6.574l32.46 44.51l93.3-139.1C293.7 194.7 298.7 192 304 192s10.35 2.672 13.31 7.125l128 192C448.6 396 448.9 402.3 446.1 407.6z"/>
                     </svg>
                  </div>
               </div>
               <label 
                  for="icon" 
                  class="px-4 py-2 bg-custom-blue-200/70 hover:bg-custom-blue-200/100 text-white rounded-md shadow-md hover:shadow-xl duration-200 cursor-pointer"
               >
                  Choose Image
               </label>
               <input 
                  type="file" 
                  id="icon" 
                  name="icon" 
                  hidden 
                  aria-hidden="true"
                  accept="image/*"
                  @change="imageToBase64($event, 'icon')"
               >
            </div>
         </div>

         <div class="flex gap-4 mt-5">
            <span class="w-28 grid items-center justify-end font-extrabold">List Banner:</span>
            <div>
               <label 
                  for="banner" 
                  class="px-4 py-2 bg-custom-blue-200/70 hover:bg-custom-blue-200/100 text-white rounded-md shadow-md hover:shadow-xl duration-200 cursor-pointer"
               >
                  Choose Image
               </label>
               <input 
                  type="file" 
                  id="banner" 
                  name="banner" 
                  hidden 
                  aria-hidden="true"
                  accept="image/*"
                  @change="imageToBase64($event, 'banner')"
               >
            </div>
         </div>

         <div class=" mt-4">
            <div class="bg-custom-navy-200 ring-custom-blue-200 h-44 w-full overflow-hidden rounded-lg z-0 grid place-items-center">
               {{-- <div class="h-full w-fill img" x-cloak x-show="() => bannerPreview.length > 1"></div> --}}
               <img class="h-full object-cover" :src="bannerPreview" alt="Banner Preview" x-cloak x-show="() => bannerPreview.length > 1">
               <svg class="h-1/2 fill-custom-slate-400 opacity-70" x-show="() => bannerPreview.length < 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path d="M447.1 32h-384C28.64 32-.0091 60.65-.0091 96v320c0 35.35 28.65 64 63.1 64h384c35.35 0 64-28.65 64-64V96C511.1 60.65 483.3 32 447.1 32zM111.1 96c26.51 0 48 21.49 48 48S138.5 192 111.1 192s-48-21.49-48-48S85.48 96 111.1 96zM446.1 407.6C443.3 412.8 437.9 416 432 416H82.01c-6.021 0-11.53-3.379-14.26-8.75c-2.73-5.367-2.215-11.81 1.334-16.68l70-96C142.1 290.4 146.9 288 152 288s9.916 2.441 12.93 6.574l32.46 44.51l93.3-139.1C293.7 194.7 298.7 192 304 192s10.35 2.672 13.31 7.125l128 192C448.6 396 448.9 402.3 446.1 407.6z"/>
               </svg>
            </div>
         </div>

         <div class="mt-1 pl-24">
            <template x-for="error in errors">
               <div class="px-1 w-fit h-fit bg-red-100 text-red-500 rounded-md text-sm" x-text="error"></div>
            </template>
         </div>
        
         <div class='mt-5 flex items-center justify-evenly'>
            <button 
               class='px-4 py-2 bg-red-500 text-white rounded-md shadow-md hover:shadow-xl duration-200 disabled:bg-red-500/50'
               @click.prevent="toggleTodo()"
            >
               Cancel
            </button>
            <button class='px-4 py-2 bg-custom-blue-200 text-white rounded-md shadow-md hover:shadow-xl duration-200'>
               Save
            </button>
         </div>
      </form>
   </div>
</div>