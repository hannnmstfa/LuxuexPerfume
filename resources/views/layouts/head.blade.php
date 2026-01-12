<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ asset('assets/logo.jpg') }}" type="image/x-icon">

<!-- Scripts -->
@vite(['resources/css/font.css', 'resources/css/app.css', 'resources/js/app.js'])
