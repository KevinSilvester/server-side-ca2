<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Laravel</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
   @production
   <link href="{{ '/public' . mix('dist/main.css') }}" rel="stylesheet">
   <script defer src="{{  '/public' . mix('dist/main.js') }}"></script>
   <script defer src="{{'/public' . mix('dist/runtime.js') }}"></script>
   <script defer src="{{ '/public' . mix('dist/vendors.js') }}"></script>
   @else
   <link href="{{ 'dist' . mix('/main.css') }}" rel="stylesheet">
   <script defer src="{{ 'dist' . mix('/main.js') }}"></script>
   <script defer src="{{ 'dist' . mix('/runtime.js') }}"></script>
   <script defer src="{{ 'dist' . mix('/vendors.js') }}"></script>
   @endproduction

</head>

<body class="bg-blue-100">

   <form method="post" action="{{ route('add-task') }}" accept-charset="UTF-8" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
      {{ csrf_field() }}
      <input type="text" name="task" placeholder="task" />
      <br>
      <button class="grid place-items-center rounded-md w-fit h-fit p-2 bg-blue-300">
         Save Task
      </button>
   </form>
</body>

</html>
