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
   @php
      if (App::environment('production')) {
          $PATH = '/public/dist';
      } else {
          $PATH = 'dist';
      }
   @endphp
   <link rel="icon" type="image/x-icon" href="{{ $PATH }}/favicon.ico">
   <link href="{{ $PATH . mix('/main.css') }}" rel="stylesheet">
   <script defer src="{{ $PATH . mix('/main.js') }}"></script>
   <script defer src="{{ $PATH . mix('/runtime.js') }}"></script>
   <script defer src="{{ $PATH . mix('/vendors.js') }}"></script>
</head>

{{ $slot }}

</html>
