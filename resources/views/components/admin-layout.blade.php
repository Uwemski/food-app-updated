<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard — Ember & Spice</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        .glass-card {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.15);
            border-radius: 999px;
        }
    </style>
</head>

<body class="bg-cream text-charcoal antialiased min-h-screen">

<div class="flex flex-col md:flex-row min-h-screen">

    {{-- SIDEBAR --}}
    <x-nav.admin-nav/>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 overflow-y-auto">

        {{-- TOPBAR --}}
        <x-admin-header/>

        {{-- CONTENT --}}
        <div class="p-8 overflow-y-auto h-[calc(100vh-101px)]">
            {{$slot}}
        </div>

    </main>

</div>

</body>
</html>
