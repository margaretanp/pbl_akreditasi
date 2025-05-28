<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Vue SPA</title>

    <!-- Load CSS yang sudah di-compile oleh Laravel Mix atau Vite -->
    <!-- Jika pakai Laravel Mix -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />

    <!-- Jika pakai Vite (Laravel 9+), ganti dengan: -->
    <!-- @vite('resources/js/app.js') -->
</head>
<body>
    <!-- Root div untuk mount Vue app -->
    <div id="app"></div>

    <!-- Load JS bundle Vue -->
    <!-- Jika pakai Laravel Mix -->
    <script src="{{ mix('js/app.js') }}"></script>

    <!-- Jika pakai Vite -->
    <!-- @vite('resources/js/app.js') -->
</body>
</html>
