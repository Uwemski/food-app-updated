<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu — {{ config('app.name', 'Ember & Spice') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
      body { font-family: 'DM Sans', sans-serif; }
      .hide-scrollbar::-webkit-scrollbar { display: none; }
      .hide-scrollbar { -ms-overflow-style:none; scrollbar-width:none; }
      /* Image zoom on card hover */
      .card-img-zoom { transition: transform .45s cubic-bezier(.34,1.2,.64,1); }
      .product-card:hover .card-img-zoom { transform: scale(1.08); }
      /* Wishlist / fav button reveal */
      .fav-btn { opacity:0; transform:scale(.85); transition: opacity .2s, transform .2s; }
      .product-card:hover .fav-btn { opacity:1; transform:scale(1); }
      .fav-btn.active { opacity:1; }
      /* Add-to-cart button */
      .btn-add { transition: all .22s ease; }
      .btn-add:hover:not(:disabled) { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(232,68,10,0.5); }
      .btn-add:active { transform: scale(.97); }
      /* Nav underline animation */
      .nav-link::after { content:''; display:block; height:2px; background:#E8440A; transform:scaleX(0); transition:transform .25s ease; border-radius:2px; }
      .nav-link:hover::after { transform:scaleX(1); }
      /* Category tab indicator */
      .cat-tab { position:relative; transition: color .2s, background .2s, border-color .2s; }
      /* Section reveal stagger */
      .cat-section { animation: fadeUp .5s ease both; }
      .fade-up{
        animation: fadeUp .55s ease both;
      } 
      .fade-in{
        animation: fadeIn .35s ease both;
      }
     @keyframes fadeUp{
          0% {
            opacity: 0,
            transform: translateY(18px)
          } 
          100% {
            opacity:1,
            transform: translateY(0) 
          },
      }
     @keyframes  fadeIn { 
        0% {
          opacity: 0
        } 
        100% {
          opacity:1
        },
      },
    </style>
</head>
<body class="bg-cream text-charcoal antialiased">

{{-- ═══════════════════════════════════════════════
     STICKY NAVBAR
═══════════════════════════════════════════════ --}}
<nav id="mainNav"
     class="sticky top-0 z-50 bg-cream/90 backdrop-blur-md border-b border-soft/20 transition-shadow duration-300">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16 gap-4">

      {{-- Logo --}}
      <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-flame to-amber flex items-center justify-center text-lg shadow-btn">
          🔥
        </div>
        <span class="font-display font-bold text-xl text-charcoal leading-none hidden sm:block">
          Ember<span class="text-flame">&amp;</span>Spice
        </span>
      </a>

      {{-- Desktop search (menu page prominently shows search) --}}
      <div class="hidden md:flex flex-1 max-w-sm relative mx-4">
        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-soft pointer-events-none text-sm">🔍</span>
        <input type="search"
               id="productSearch"
               placeholder="Search dishes, ingredients…"
               value="{{ request('search') }}"
               class="w-full pl-9 pr-4 py-2.5 rounded-full border-[1.5px] border-soft/40 bg-warmwhite
                      font-body text-sm text-charcoal placeholder-soft
                      focus:outline-none focus:border-flame focus:ring-2 focus:ring-flame/10
                      transition-all duration-200">
      </div>

      {{-- Desktop nav links --}}
      <div class="hidden md:flex items-center gap-5">
        <a href="{{ route('home') }}"
           class="nav-link font-body font-medium text-sm text-brown hover:text-flame transition-colors pb-0.5">
          Home
        </a>
        <a href="{{ route('menu') }}"
           class="nav-link font-body font-medium text-sm text-flame pb-0.5">
          Menu
        </a>
        <a href="#" class="nav-link font-body font-medium text-sm text-brown hover:text-flame transition-colors pb-0.5">About</a>
        <a href="#" class="nav-link font-body font-medium text-sm text-brown hover:text-flame transition-colors pb-0.5">Contact</a>
      </div>

      {{-- Actions --}}
      <div class="flex items-center gap-2.5 shrink-0">
        @guest
          <a href="{{ route('login') }}"
             class="hidden sm:block font-body font-medium text-sm text-brown border border-soft/50
                    rounded-full px-4 py-2 hover:border-flame hover:text-flame transition-all duration-200">
            Sign In
          </a>
        @else
          <span class="hidden sm:block font-body text-sm text-muted">{{ Auth::user()->name }}</span>
        @endguest
        <a href="{{ route('cart.index') ?? '#' }}"
           class="relative w-10 h-10 rounded-full bg-warmwhite border border-soft/40 flex items-center
                  justify-center text-base hover:border-flame hover:bg-flame/5 transition-all duration-200">
          🛒
          @if(session('cart_count', 0) > 0)
            <span class="absolute -top-1 -right-1 w-5 h-5 bg-flame text-white text-xs font-bold
                         rounded-full flex items-center justify-center border-2 border-cream">
              {{ session('cart_count', 0) }}
            </span>
          @endif
        </a>
        <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')"
                class="md:hidden w-9 h-9 rounded-lg flex flex-col items-center justify-center gap-1.5
                       border border-soft/40 bg-warmwhite hover:border-flame transition-all">
          <span class="block w-5 h-0.5 bg-charcoal rounded"></span>
          <span class="block w-5 h-0.5 bg-charcoal rounded"></span>
          <span class="block w-5 h-0.5 bg-charcoal rounded"></span>
        </button>
      </div>
    </div>

    {{-- Mobile menu + mobile search --}}
    <div id="mobileMenu" class="hidden md:hidden border-t border-soft/20 py-4 space-y-1">
      <div class="relative mb-3">
        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-soft pointer-events-none text-sm">🔍</span>
        <input type="search" placeholder="Search dishes…"
               class="w-full pl-9 pr-4 py-2.5 rounded-full border border-soft/40 bg-warmwhite
                      font-body text-sm text-charcoal placeholder-soft
                      focus:outline-none focus:border-flame transition-all duration-200">
      </div>
      <a href="{{ route('home') }}"
         class="block px-4 py-2.5 rounded-xl font-body font-medium text-sm text-brown hover:bg-flame/8 hover:text-flame transition-colors">
        🏠 &nbsp;Home
      </a>
      <a href="{{ route('menu') }}"
         class="block px-4 py-2.5 rounded-xl font-body font-medium text-sm bg-flame/10 text-flame">
        🍽️ &nbsp;Menu
      </a>
      <a href="#" class="block px-4 py-2.5 rounded-xl font-body font-medium text-sm text-brown hover:bg-flame/8 hover:text-flame transition-colors">📖 &nbsp;About</a>
      <a href="#" class="block px-4 py-2.5 rounded-xl font-body font-medium text-sm text-brown hover:bg-flame/8 hover:text-flame transition-colors">📞 &nbsp;Contact</a>
    </div>
  </div>
</nav>

{{-- ═══════════════════════════════════════════════
     MENU HERO / HEADER
═══════════════════════════════════════════════ --}}
<div class="bg-gradient-to-br from-[#2A1508] via-[#4A1F0D] to-[#6B2E14] py-12 sm:py-16">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto text-center">
      <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full
                  bg-gold/15 border border-gold/30 text-gold text-xs font-semibold
                  uppercase tracking-widest mb-4">
        🍽️ &nbsp;Full Menu
      </div>
      <h1 class="font-display font-black text-white leading-tight mb-3
                 text-[clamp(2rem,5vw,3rem)]">
        Every Bite, <em class="text-gold not-italic">Perfected</em>
      </h1>
      <p class="text-white/60 text-sm sm:text-base leading-relaxed max-w-lg mx-auto mb-7">
        Explore our full range of handcrafted dishes — from fiery street burgers to silky pastas and smoky jollof. Made fresh, every order.
      </p>
      {{-- Mobile search in hero --}}
      <div class="md:hidden relative max-w-sm mx-auto">
        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-soft pointer-events-none">🔍</span>
        <input type="search" placeholder="Search dishes…"
               class="w-full pl-10 pr-4 py-3 rounded-full border-2 border-white/20 bg-white/10
                      text-white placeholder-white/40 font-body text-sm
                      focus:outline-none focus:border-amber transition-all duration-200">
      </div>
      {{-- Stats bar --}}
      <div class="hidden sm:flex items-center justify-center gap-8 mt-8">
        @foreach([
          ['🍽️', $stats['totalProducts'] ?? '50+', 'Dishes'],
          ['📂', $stats['totalCategories'] ?? '8', 'Categories'],
          ['⭐', '4.9', 'Avg Rating'],
          ['🚀', '15 min', 'Avg Delivery'],
        ] as $s)
          <div class="text-center">
            <div class="text-xl mb-0.5"></div>
            <div class="font-display font-bold text-gold text-lg leading-none">{{ $s[1] }}</div>
            <div class="text-white/40 text-[0.65rem] uppercase tracking-wider mt-0.5">{{ $s[2] }}</div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

{{-- ═══════════════════════════════════════════════
     STICKY CATEGORY NAVIGATION
     Horizontally scrollable on mobile
═══════════════════════════════════════════════ --}}
<div id="categoryNav"
     class="sticky top-16 z-40 bg-cream/95 backdrop-blur-sm border-b border-soft/20
            shadow-card transition-shadow duration-300">
  <x-nav.category-nav :categories="$categories"/>
</div>

{{-- ═══════════════════════════════════════════════
     FILTER / SORT ROW
═══════════════════════════════════════════════ --}}
<div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 pt-7 pb-4">
  <div class="flex flex-wrap items-center justify-between gap-3">

    {{-- Filter chips --}}
    <div class="flex flex-wrap gap-2">
      @foreach(['all' => 'All Items', 'popular' => '🔥 Popular', 'new' => '✨ New', 'deals' => '💰 Deals', 'veg' => '🥦 Veg'] as $key => $label)
        <a href="{{ route('menu', array_merge(request()->except('filter'), ['filter' => $key])) }}"
           class="px-4 py-1.5 rounded-full border font-body text-xs font-medium
                  transition-all duration-200 whitespace-nowrap
                  {{ request('filter', 'all') == $key
                       ? 'border-amber bg-amber/10 text-brown'
                       : 'border-soft/40 bg-white text-muted hover:border-amber hover:text-brown' }}">
          {{ $label }}
        </a>
      @endforeach
    </div>

    {{-- Sort + result count --}}
    <div class="flex items-center gap-3">
      <span class="text-sm text-muted hidden sm:block">

      </span>
      <form method="GET" action="{{ route('menu') }}" class="flex items-center">
        @foreach(request()->except('sort') as $key => $val)
          <input type="hidden" name="{{ $key }}" value="{{ $val }}">
        @endforeach
        <select name="sort" onchange="this.form.submit()"
                class="pl-3 pr-8 py-2 rounded-full border border-soft/40 bg-white
                       font-body text-sm text-brown cursor-pointer
                       focus:outline-none focus:border-flame transition-all duration-200
                       appearance-none"
                style="background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%236B5147'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right .85rem center">
          <option value="featured"  {{ request('sort','featured')=='featured'  ? 'selected' : '' }}>Featured</option>
          <option value="price_asc" {{ request('sort')=='price_asc'  ? 'selected' : '' }}>Price: Low–High</option>
          <option value="price_desc"{{ request('sort')=='price_desc' ? 'selected' : '' }}>Price: High–Low</option>
          <option value="rating"    {{ request('sort')=='rating'     ? 'selected' : '' }}>Highest Rated</option>
          <option value="newest"    {{ request('sort')=='newest'     ? 'selected' : '' }}>Newest</option>
        </select>
      </form>
    </div>
  </div>
</div>

{{-- ═══════════════════════════════════════════════
     PRODUCTS — GROUPED BY CATEGORY
     $groupedProducts = products grouped by category (from controller)
     Each group: category object + products collection
═══════════════════════════════════════════════ --}}
<main class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">

  @if(isset($groupedProducts) && $groupedProducts->isNotEmpty())

    @foreach($groupedProducts as $categoryGroup)
      {{-- ── CATEGORY SECTION ──────────────────────────────────────────── --}}
      <section id="cat-{{ $categoryGroup->slug }}"
               class="cat-section mb-14 scroll-mt-36">

        {{-- Category Header --}}
        <div class="flex items-end justify-between gap-4 mb-5 pb-4 border-b border-soft/20">
          <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-flame/10 flex items-center justify-center text-xl shrink-0">
              {{ $categoryGroup->category->icon ?? '🍴' }}
            </div>
            <div>
              <h2 class="font-display font-bold text-charcoal text-xl sm:text-2xl leading-tight">
                {{ $categoryGroup->name }}
              </h2>
              @if($categoryGroup->description)
                <p class="text-muted text-xs mt-0.5">{{ $categoryGroup->category->description }}</p>
              @endif
            </div>
            <span class="ml-1 px-2.5 py-0.5 rounded-full bg-soft/25 text-muted text-xs font-semibold">
              items
            </span>
          </div>
          <a href="{{ route('menu', ['category' => $categoryGroup->slug]) }}"
             class="shrink-0 text-flame text-sm font-medium flex items-center gap-1
                    hover:gap-2.5 transition-all duration-200">
            See all <span>→</span>
          </a>
        </div>

        {{-- ── PRODUCT GRID ──────────────────────────────────────────────
             equal card heights via flex-col; footer always sticks bottom.
             Auto-fill with minmax ensures grid adapts to any product count.
        ──────────────────────────────────────────────────────────────── --}}
        @if($categoryGroup->product->isNotEmpty())
          <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-5">
            @foreach($categoryGroup->product as $product)

              {{-- ── PRODUCT CARD ──────────────────────────────────────── --}}
              <article class="product-card group bg-white rounded-2xl overflow-hidden
                              border border-soft/15 shadow-card hover:shadow-card-hover
                              flex flex-col transition-shadow duration-300
                              {{ $product->is_sold_out ? 'opacity-75' : '' }}"
                       data-product-id="{{ $product->id }}"
                       data-name="{{ strtolower($product->name) }}"
                       data-category="{{ $product->category->slug ?? '' }}">

                {{-- Image area --}}
                <div class="relative overflow-hidden bg-gradient-to-br from-[#FDE8DC] to-[#F9C6AE]"
                     style="padding-top:65%">
                  <div class="absolute inset-0 flex items-center justify-center">
                    @if($product->image)
                      <img src="{{ ($product->image) }}"
                           alt="{{ $product->name }}"
                           loading="lazy"
                           class="card-img-zoom w-full h-full object-cover">
                    @else
                      <span class="card-img-zoom text-[3.5rem] sm:text-[4.5rem] select-none">
                        {{ $product->emoji ?? '🍽️' }}
                      </span>
                    @endif
                  </div>

                  {{-- Sold-out overlay --}}
                  @if($product->is_sold_out)
                    <div class="absolute inset-0 bg-charcoal/55 flex items-center justify-center z-10">
                      <span class="bg-charcoal/80 text-white/85 text-xs font-bold uppercase
                                   tracking-widest px-3 py-1.5 rounded-full border border-white/10">
                        Sold Out
                      </span>
                    </div>
                  @endif

                  {{-- Product badge --}}
                  @if($product->badge && !$product->is_sold_out)
                    <span class="absolute top-2.5 left-2.5 z-10 text-[0.65rem] font-bold uppercase
                                 tracking-wide px-2.5 py-1 rounded-full
                                 @switch($product->badge)
                                   @case('hot')  bg-flame text-white           @break
                                   @case('new')  bg-amber text-brown           @break
                                   @case('deal') bg-emerald-500 text-white     @break
                                   @case('best') bg-charcoal text-gold         @break
                                   @default      bg-charcoal/70 text-white/80
                                 @endswitch">
                      @switch($product->badge)
                        @case('hot')  🔥 Hot      @break
                        @case('new')  ✨ New      @break
                        @case('deal') 💰 Deal     @break
                        @case('best') 🏆 Best     @break
                        @default      {{ ucfirst($product->badge) }}
                      @endswitch
                    </span>
                  @endif

                  {{-- Discount badge (top-right) --}}
                  @if($product->original_price && $product->original_price > $product->price && !$product->is_sold_out)
                    <span class="absolute top-2.5 right-2.5 z-10 bg-emerald-500 text-white
                                 text-[0.62rem] font-bold px-2 py-0.5 rounded-full">
                      -{{ round((1 - $product->price / $product->original_price) * 100) }}%
                    </span>
                  @endif

                  {{-- Wishlist button (shown on hover, always shown if active) --}}
                  <button data-product-id="{{ $product->id }}"
                          onclick="toggleWishlist(this)"
                          class="fav-btn {{ in_array($product->id, $wishlistIds ?? []) ? 'active' : '' }}
                                 absolute z-10 w-8 h-8 rounded-full bg-white/90 shadow-sm
                                 flex items-center justify-center text-sm
                                 hover:bg-white hover:scale-110 transition-all duration-200
                                 {{ ($product->original_price && !$product->is_sold_out) ? 'top-2.5 right-11' : 'top-2.5 right-2.5' }}"
                          aria-label="Add to wishlist">
                    {{ in_array($product->id, $wishlistIds ?? []) ? '❤️' : '🤍' }}
                  </button>
                </div>

                {{-- Card body --}}
                <div class="flex flex-col flex-1 p-3.5 sm:p-4">

                  {{-- Category + Rating row --}}
                  <div class="flex items-center justify-between mb-2">
                    <span class="text-flame text-[0.67rem] font-bold uppercase tracking-wider truncate max-w-[55%]">
                      {{ $product->category->name ?? 'Uncategorized' }}
                    </span>
                    <div class="flex items-center gap-1 shrink-0 text-[0.72rem] text-muted font-medium">
                      <span class="text-amber">★</span>
                      {{ number_format($product->rating ?? 4.5, 1) }}
                      <span class="text-soft hidden sm:inline">({{ $product->reviews_count ?? 0 }})</span>
                    </div>
                  </div>

                  {{-- Product name --}}
                  <h3 class="font-display font-bold text-charcoal leading-snug mb-1.5
                             text-[0.9rem] sm:text-[1rem] line-clamp-2">
                    {{ $product->name }}
                  </h3>

                  {{-- Description --}}
                  <p class="text-muted text-[0.75rem] sm:text-xs leading-relaxed mb-3.5 flex-1 line-clamp-2">
                    {{ $product->description }}
                  </p>

                  {{-- Footer: price + add btn --}}
                  <div class="flex items-center justify-between gap-1.5 mt-auto">
                    <div class="min-w-0">
                      @if($product->original_price && $product->original_price > $product->price)
                        <div class="text-soft line-through text-[0.68rem] leading-none mb-0.5">
                          ₦{{ number_format($product->original_price) }}
                        </div>
                      @endif
                      <div class="font-display font-bold leading-none
                                  text-[1rem] sm:text-[1.15rem]
                                  {{ ($product->original_price && $product->original_price > $product->price) ? 'text-ember' : 'text-charcoal' }}">
                        ₦{{ number_format($product->price) }}
                      </div>
                    </div>

                    @if($product->is_sold_out)
                      <button disabled
                              class="shrink-0 px-2.5 py-1.5 rounded-full bg-soft/25 text-muted
                                     font-semibold text-[0.72rem] cursor-not-allowed">
                        ✕ Sold Out
                      </button>
                    @else
                      <form action="{{ route('cart.add', $product->id) }}" method="POST" class="shrink-0">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit"
                                class="btn-add flex items-center gap-1 px-2.5 sm:px-3.5 py-1.5 sm:py-2
                                       rounded-full bg-gradient-to-r from-flame to-ember text-white
                                       font-body font-semibold text-[0.75rem] sm:text-xs shadow-btn">
                          <span class="text-base leading-none">＋</span>
                          <span class="hidden sm:inline">Add</span>
                        </button>
                      </form>
                    @endif
                  </div>
                </div>
              </article>
              {{-- ── / PRODUCT CARD ────────────────────────────────────── --}}

            @endforeach
          </div>
        @else
          {{-- No products in this category --}}
          <div class="py-10 text-center rounded-2xl bg-warmwhite border border-soft/20">
            <span class="text-4xl block mb-2">😴</span>
            <p class="text-muted text-sm">No dishes available in this category right now.</p>
          </div>
        @endif

      </section>
      {{-- ── / CATEGORY SECTION ──────────────────────────────────────────── --}}

    @endforeach

  @elseif(isset($products) && $products->isNotEmpty())
    {{-- ══ FLAT GRID (when filtering by single category or search) ════════ --}}
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-5 mb-10">
      @foreach($products as $product)
        {{-- Same card structure as above — extracted here for flat view --}}
        <article class="product-card group bg-white rounded-2xl overflow-hidden
                        border border-soft/15 shadow-card hover:shadow-card-hover
                        flex flex-col transition-shadow duration-300
                        {{ $product->is_sold_out ? 'opacity-75' : '' }}">
          <div class="relative overflow-hidden bg-gradient-to-br from-[#FDE8DC] to-[#F9C6AE]"
               style="padding-top:65%">
            <div class="absolute inset-0 flex items-center justify-center">
              @if($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                     loading="lazy" class="card-img-zoom w-full h-full object-cover">
              @else
                <span class="card-img-zoom text-[3.5rem] sm:text-[4.5rem] select-none">
                  {{ $product->emoji ?? '🍽️' }}
                </span>
              @endif
            </div>
            @if($product->is_sold_out)
              <div class="absolute inset-0 bg-charcoal/55 flex items-center justify-center z-10">
                <span class="bg-charcoal/80 text-white/85 text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full">Sold Out</span>
              </div>
            @endif
            @if($product->badge && !$product->is_sold_out)
              <span class="absolute top-2.5 left-2.5 z-10 text-[0.65rem] font-bold uppercase tracking-wide px-2.5 py-1 rounded-full
                @switch($product->badge) @case('hot') bg-flame text-white @break @case('new') bg-amber text-brown @break @case('deal') bg-emerald-500 text-white @break @default bg-charcoal/70 text-white/80 @endswitch">
                @switch($product->badge) @case('hot') 🔥 Hot @break @case('new') ✨ New @break @case('deal') 💰 Deal @break @default {{ ucfirst($product->badge) }} @endswitch
              </span>
            @endif
            @if($product->original_price && $product->original_price > $product->price && !$product->is_sold_out)
              <span class="absolute top-2.5 right-2.5 z-10 bg-emerald-500 text-white text-[0.62rem] font-bold px-2 py-0.5 rounded-full">
                -{{ round((1 - $product->price / $product->original_price) * 100) }}%
              </span>
            @endif
            <button onclick="toggleWishlist(this)" data-product-id="{{ $product->id }}"
                    class="fav-btn absolute z-10 top-2.5 right-2.5 w-8 h-8 rounded-full bg-white/90 shadow-sm flex items-center justify-center text-sm hover:bg-white hover:scale-110 transition-all duration-200">
              🤍
            </button>
          </div>
          <div class="flex flex-col flex-1 p-3.5 sm:p-4">
            <div class="flex items-center justify-between mb-2">
              <span class="text-flame text-[0.67rem] font-bold uppercase tracking-wider">{{ $product->category->name ?? '' }}</span>
              <div class="flex items-center gap-1 text-[0.72rem] text-muted font-medium">
                <span class="text-amber">★</span> {{ number_format($product->rating ?? 4.5, 1) }}
              </div>
            </div>
            <h3 class="font-display font-bold text-charcoal leading-snug mb-1.5 text-[0.9rem] sm:text-[1rem] line-clamp-2">{{ $product->name }}</h3>
            <p class="text-muted text-[0.75rem] leading-relaxed mb-3.5 flex-1 line-clamp-2">{{ $product->description }}</p>
            <div class="flex items-center justify-between gap-1.5 mt-auto">
              <div>
                @if($product->original_price && $product->original_price > $product->price)
                  <div class="text-soft line-through text-[0.68rem] leading-none mb-0.5">₦{{ number_format($product->original_price) }}</div>
                @endif
                <div class="font-display font-bold text-[1rem] sm:text-[1.15rem] leading-none {{ ($product->original_price && $product->original_price > $product->price) ? 'text-ember' : 'text-charcoal' }}">
                  ₦{{ number_format($product->price) }}
                </div>
                <div>
                  <p class="text-muted text-xs sm:text-[0.8rem] leading-relaxed mb-4">
                  {{$product->quantity}} left
                </p>
                </div>
                
              </div>
              @if($product->is_sold_out)
                <button disabled class="shrink-0 px-2.5 py-1.5 rounded-full bg-soft/25 text-muted font-semibold text-[0.72rem] cursor-not-allowed">✕ Sold Out</button>
              @else
                <form action="{{ route('cart.add') }}" method="POST" class="shrink-0">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit" class="btn-add flex items-center gap-1 px-3 py-1.5 sm:py-2 rounded-full bg-gradient-to-r from-flame to-ember text-white font-body font-semibold text-[0.75rem] shadow-btn">
                    <span class="text-base leading-none">＋</span> Add
                  </button>
                </form>
              @endif
            </div>
          </div>
        </article>
      @endforeach
    </div>

    {{-- Pagination for flat view --}}
    @if($products->hasPages())
      <div class="flex items-center justify-center gap-2 flex-wrap pb-4">
        @if($products->onFirstPage())
          <span class="px-4 h-10 flex items-center rounded-xl border border-soft/30 bg-white text-soft font-medium text-sm cursor-not-allowed">← Prev</span>
        @else
          <a href="{{ $products->previousPageUrl() }}" class="px-4 h-10 flex items-center rounded-xl border border-soft/30 bg-white text-brown font-medium text-sm shadow-card hover:border-flame hover:text-flame transition-all duration-200">← Prev</a>
        @endif
        @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
          @if($page == $products->currentPage())
            <span class="w-10 h-10 flex items-center justify-center rounded-xl font-semibold text-sm text-white bg-gradient-to-br from-flame to-ember shadow-btn">{{ $page }}</span>
          @else
            <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-xl border border-soft/30 bg-white text-brown font-medium text-sm shadow-card hover:border-flame hover:text-flame transition-all duration-200">{{ $page }}</a>
          @endif
        @endforeach
        @if($products->hasMorePages())
          <a href="{{ $products->nextPageUrl() }}" class="px-4 h-10 flex items-center rounded-xl border border-soft/30 bg-white text-brown font-medium text-sm shadow-card hover:border-flame hover:text-flame transition-all duration-200">Next →</a>
        @else
          <span class="px-4 h-10 flex items-center rounded-xl border border-soft/30 bg-white text-soft font-medium text-sm cursor-not-allowed">Next →</span>
        @endif
      </div>
    @endif

  @else
    {{-- ══ EMPTY STATE ════════════════════════════════════════════════════ --}}
    <div class="flex flex-col items-center justify-center py-24 text-center">
      <span class="text-7xl mb-5">🍽️</span>
      <h3 class="font-display font-bold text-2xl text-charcoal mb-2">No dishes found</h3>
      <p class="text-muted text-sm mb-6 max-w-xs">
        Try a different category, remove filters, or search for something else.
      </p>
      <a href="{{ route('menu') }}"
         class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-gradient-to-r from-flame to-ember
                text-white font-body font-semibold text-sm shadow-btn hover:shadow-btn-hover hover:-translate-y-0.5 transition-all duration-200">
        Clear filters
      </a>
    </div>
  @endif

</main>

{{-- ═══════════════════════════════════════════════
     PROMOTIONAL SECTION
═══════════════════════════════════════════════ --}}
<section class="bg-gradient-to-r from-[#2A1508] to-[#5A2510] py-14">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
      @forelse($promotions ?? [] as $promo)
        <div class="relative overflow-hidden rounded-2xl p-6 text-white cursor-pointer
                    transition-all duration-280 hover:-translate-y-1 hover:shadow-[0_20px_40px_rgba(0,0,0,0.35)]"
             style="background: {{ $promo->bg_gradient ?? 'linear-gradient(135deg,#FF6B35,#E8440A)' }}">
          <div class="text-4xl mb-3">{{ $promo->icon ?? '🍽️' }}</div>
          <div class="text-xs font-semibold uppercase tracking-widest opacity-80 mb-1">{{ $promo->label ?? 'Special' }}</div>
          <div class="font-display font-bold text-xl leading-snug">{{ $promo->title }}</div>
          <span class="absolute right-4 bottom-4 text-sm opacity-60">→</span>
        </div>
      @empty
        {{-- Fallback static promos --}}
        <div class="relative overflow-hidden rounded-2xl p-6 text-white cursor-pointer transition-all duration-280 hover:-translate-y-1 bg-gradient-to-br from-[#FF6B35] to-flame">
          <div class="text-4xl mb-3">🍕</div>
          <div class="text-xs font-semibold uppercase tracking-widest opacity-80 mb-1">Limited Time</div>
          <div class="font-display font-bold text-xl leading-snug">Buy 2 Pizzas,<br>Get 1 Free</div>
          <span class="absolute right-4 bottom-4 text-sm opacity-60">→</span>
        </div>
        <div class="relative overflow-hidden rounded-2xl p-6 text-white cursor-pointer transition-all duration-280 hover:-translate-y-1 bg-gradient-to-br from-amber to-[#D97706]">
          <div class="text-4xl mb-3">🥤</div>
          <div class="text-xs font-semibold uppercase tracking-widest opacity-80 mb-1">Today Only</div>
          <div class="font-display font-bold text-xl leading-snug">Free Drink<br>with any Meal</div>
          <span class="absolute right-4 bottom-4 text-sm opacity-60">→</span>
        </div>
        <div class="relative overflow-hidden rounded-2xl p-6 text-white cursor-pointer transition-all duration-280 hover:-translate-y-1 bg-gradient-to-br from-[#6B2E14] to-[#3D1A08] sm:col-span-2 lg:col-span-1">
          <div class="text-4xl mb-3">🚀</div>
          <div class="text-xs font-semibold uppercase tracking-widest opacity-80 mb-1">Always</div>
          <div class="font-display font-bold text-xl leading-snug">Free Delivery<br>Over ₦9,000</div>
          <span class="absolute right-4 bottom-4 text-sm opacity-60">→</span>
        </div>
      @endforelse
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════════════
     FOOTER
═══════════════════════════════════════════════ --}}
<footer class="bg-charcoal text-white/60">
  <x-footer />
</footer>

{{-- Flash message --}}
@if(session('success'))
  <div id="toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 bg-charcoal text-white px-6 py-3 rounded-full shadow-card-hover font-body text-sm flex items-center gap-2 animate-fade-up">
    ✅ {{ session('success') }}
  </div>
  <script>setTimeout(()=>document.getElementById('toast')?.remove(), 3000)</script>
@endif

<script>
  // ── Sticky nav shadow ─────────────────────────────
  window.addEventListener('scroll', () => {
    const nav = document.getElementById('mainNav');
    nav.style.boxShadow = window.scrollY > 20 ? '0 8px 32px rgba(28,22,17,0.12)' : '';
  });

  // ── Wishlist toggle ───────────────────────────────
  function toggleWishlist(btn) {
    const isActive = btn.textContent.trim() === '❤️';
    btn.textContent = isActive ? '🤍' : '❤️';
    btn.classList.toggle('active', !isActive);
    // Swap with fetch('/wishlist/toggle', { method:'POST', body: ... }) for real implementation
  }

  // ── Client-side search filter ────────────────────
  // Works alongside server-side search for instant UX
  const searchInput = document.getElementById('productSearch');
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      const q = this.value.toLowerCase().trim();
      document.querySelectorAll('.product-card').forEach(card => {
        const name = card.dataset.name || '';
        card.closest('article').parentElement
          .style.display = (!q || name.includes(q)) ? '' : 'none';
      });
    });
  }

  // ── Smooth category anchor scroll ────────────────
  document.querySelectorAll('a[href^="#cat-"]').forEach(a => {
    a.addEventListener('click', e => {
      e.preventDefault();
      const target = document.querySelector(a.getAttribute('href'));
      if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });
</script>
</body>
</html>