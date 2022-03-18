<div @class([
      'bg-custom-navy-500 hover:text-custom-blue-200 group flex w-72 cursor-pointer flex-nowrap items-center break-words rounded-lg px-3 py-2 duration-150 border-l-4 font-bold',
      'border-red-500' => $task->progress == 'todo',
      'border-amber-400' => $task->progress == 'doing',
      'border-green-400 line-through' => $task->progress == 'done',
   ])
   data-task='@json($task)'
   @click="toggleTask($event)"
>
   {{ $task->name }}
</div>
