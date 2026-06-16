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
    /* {{-- Prevent Alpine cloak flash --}} */

        [x-cloak] { display: none !important; }
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
     <!-- Quick test to verify Alpine is working -->
    <div x-data="{ open: false }" class="p-5">
        <button @click="open = !open" class="btn">Toggle Content</button>
        <p x-show="open" class="mt-2">Alpine.js is bundled and running successfully!</p>
    </div>
    <div class="flex flex-col md:flex-row min-h-screen">

    {{-- Desktop sidebar (hidden on mobile) --}}
        {{-- SIDEBAR --}}
        <x-nav.admin-nav/>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 overflow-y-auto">

        {{-- Header contains the hamburger button --}}
            {{-- TOPBAR --}}
            <x-admin-header/>

            {{-- CONTENT --}}
            <div class="p-4 md:p-8 overflow-y-auto h-[calc(100vh-101px)] pb-20 md:pb-8">
                {{$slot}}
            </div>

        </main>
        {{-- Mobile drawer (hidden on desktop) --}}
            <x-nav.mobile-nav />
    </div>

    <script>
    document.addEventListener('alpine:init', () => {

        Alpine.store('mobileNav', {
            isOpen: false,

            open() {
                this.isOpen = true;
                // Prevent background scroll while drawer is open
                document.documentElement.classList.add('overflow-hidden');
            },

            close() {
                this.isOpen = false;
                document.documentElement.classList.remove('overflow-hidden');
            },

            toggle() {
                this.isOpen ? this.close() : this.open();
            },
        });

    });
</script>
</body>
</html>
