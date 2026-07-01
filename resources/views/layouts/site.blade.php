<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', '24 Frames | Motion Picture Production Services | Sri Lanka')</title>
    <meta name="description" content="@yield('description', '24 Frames is Sri Lanka’s premier motion pictures production company offering end-to-end production services for commercials, films, documentaries, and digital content.')">
    <link rel="icon" href="{{ \App\Support\Frames::brandingUrl('favicon') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ \App\Support\Frames::brandingUrl('favicon') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=Syne:wght@500;600;700&display=swap" rel="stylesheet">
    @if (request()->routeIs('home'))
        <script>
            document.documentElement.classList.add('site-loading');
        </script>
    @else
        <script>
            document.documentElement.classList.add('loader-done');
        </script>
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-full flex flex-col bg-black text-white" @yield('body-attrs')>
    @yield('content')
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</body>
</html>
