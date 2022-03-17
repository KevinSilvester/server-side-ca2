@php
   $PATH = '';
   if (App::environment('production'))
      $PATH = '/public/dist';
   else 
      $PATH = '/dist';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>{{ $title }}</title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link
      href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet">
   <link rel="icon" type="image/x-icon" href="{{ $PATH }}/favicon.ico">
   <link href="{{ $PATH . mix('/main.css') }}" rel="stylesheet">
   {{-- <link href="{{ $PATH . mix('/modal.css') }}" rel="stylesheet"> --}}
   {{-- @livewireStyles --}}
   {{-- <link href="{{ $PATH . mix('/livewire.css') }}" rel="stylesheet"> --}}
</head>
<body class="bg-custom-navy-600 text-custom-slate-300 font-nunito" x-data="modal">
   {{ $slot }}
   {{-- @livewireScripts --}}
   {{-- @livewire('livewire-ui-modal') --}}
   {{-- <script src="{{ $PATH . mix('/livewire.js') }}"></script> --}}
   {{-- <script src="{{ $PATH . mix('/modal.js') }}"></script> --}}
   <script src="{{ $PATH . mix('/vendors.js') }}"></script>
   <script src="{{ $PATH . mix('/runtime.js') }}"></script>
   <script src="{{ $PATH . mix('/mix.js') }}"></script>
   <script src="{{ $PATH . mix('/main.js') }}"></script>
</body>
</html>
