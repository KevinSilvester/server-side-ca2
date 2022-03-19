@php
   $PATH = App::environment('production') ? 'public/uploads' : asset('uploads');
   $iconPath = $PATH . '/' . $icon;
@endphp

<a
   href="{{ url('/todo/'.$id) }}"
   class="bg-custom-blue-200/5 ring-custom-blue-200 hover:bg-custom-blue-200/25 group flex h-14 w-72 cursor-pointer flex-nowrap items-center rounded-lg px-3 ring-2 duration-150">
   <div
      class="bg-custom-white-200 ring-custom-blue-200 h-7 w-7 overflow-hidden rounded-full ring-1">
      <img class="h-full object-cover" src="{{ $iconPath }}" alt="{{ $name }}">
   </div>
   <div
      class="text-custom-slate-400 group-hover:text-custom-blue-200 my-auto overflow-hidden p-4 font-semibold">
      {{ $slot }}
   </div>
</a>
