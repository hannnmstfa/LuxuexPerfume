<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ asset(\App\Models\TokoSetting::data()->path_logo ?? '') }}" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/sharp-light.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@n8n/chat/dist/style.css">
<link rel="stylesheet" href="{{ asset('assets/css/chat-custom.css') }}">
@auth
    <script type="module" src="{{ asset('assets/js/chat.js') }}"></script>
@endauth
<!-- Scripts -->
@vite(['resources/css/font.css', 'resources/css/app.css', 'resources/js/app.js'])