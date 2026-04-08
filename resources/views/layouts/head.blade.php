<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ asset(\App\Models\TokoSetting::data()->path_logo ?? '') }}" type="image/x-icon">
<link rel="stylesheet" href="{{ asset('assets/css/chat-custom.css') }}">

<!-- Scripts -->
@vite(['resources/css/font.css', 'resources/css/app.css', 'resources/js/app.js'])
@livewireScriptConfig
@auth
    <script>
        window.user = {
            name: @json(Auth::user()->name),
            email: @json(Auth::user()->email),
            login: true,
        };
    </script>
@endauth