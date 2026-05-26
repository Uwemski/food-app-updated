<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Ember & Spice') }} — Fine Street Food</title>

    {{-- Tailwind CDN (swap for compiled asset in production) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              flame:   '#E8440A',
              ember:   '#C73209',
              tomato:  '#D94F2B',
              amber:   '#F59E0B',
              gold:    '#F2C94C',
              cream:   '#FDF8F3',
              warmwhite: '#FFFAF5',
              charcoal: '#1C1611',
              brown:   '#3D2B1F',
              muted:   '#6B5147',
              soft:    '#C8A99A',
            },
            fontFamily: {
              display: ['"Playfair Display"', 'serif'],
              body:    ['"DM Sans"', 'sans-serif'],
            },
            boxShadow: {
              'card':  '0 2px 12px rgba(28,22,17,0.07)',
              'card-hover': '0 20px 60px rgba(28,22,17,0.18)',
              'btn':   '0 4px 14px rgba(232,68,10,0.35)',
              'btn-hover': '0 6px 24px rgba(232,68,10,0.5)',
            },
            animation: {
              'float': 'float 4s ease-in-out infinite',
              'fade-up': 'fadeUp .6s ease both',
              'fade-in': 'fadeIn .4s ease both',
            },
            keyframes: {
              float:  { '0%,100%': {transform:'translateY(0)'}, '50%': {transform:'translateY(-12px)'} },
              fadeUp: { '0%': {opacity:'0',transform:'translateY(20px)'}, '100%': {opacity:'1',transform:'translateY(0)'} },
              fadeIn: { '0%': {opacity:'0'}, '100%': {opacity:'1'} },
            },
          }
        }
      }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
      body { font-family: 'DM Sans', sans-serif; }
      .hide-scrollbar::-webkit-scrollbar { display: none; }
      .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
      .card-img-zoom { transition: transform .45s cubic-bezier(.34,1.2,.64,1); }
      .product-card:hover .card-img-zoom { transform: scale(1.08); }
      .btn-add { transition: all .22s ease; }
      .btn-add:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(232,68,10,0.5); }
      .btn-add:active { transform: scale(.97); }
      .nav-link::after { content:''; display:block; height:2px; background:var(--tw-color-flame,#E8440A); transform:scaleX(0); transition:transform .25s ease; border-radius:2px; }
      .nav-link:hover::after { transform:scaleX(1); }
      @keyframes shimmer { 0%{background-position:-400px 0} 100%{background-position:400px 0} }
      .skeleton { background:linear-gradient(90deg,#f0e8e1 25%,#fdf0e8 50%,#f0e8e1 75%); background-size:400px 100%; animation:shimmer 1.4s infinite; }
      .promo-card { transition: transform .28s ease, box-shadow .28s ease; }
      .promo-card:hover { transform: translateY(-4px); }
    </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
