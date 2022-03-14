<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Laravel</title>
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
   <link href="{{ mix('css/main.css') }}" rel="stylesheet">
</head>

<body class="bg-blue-100">
   <script defer src="{{ mix('js/main.bundle.js') }}"></script>
   <script defer src="{{ mix('js/runtime.bundle.js') }}"></script>
   <script defer src="{{ mix('js/vendors.bundle.js') }}"></script>
</body>

</html>
