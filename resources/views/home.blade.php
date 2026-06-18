<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Ember & Spice') }} — Fine Street Food</title>
 
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
      @keyframes float {
    0%, 100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-12px);
    }
}

@keyframes fadeUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }
}

.animate-float {
    animation: float 4s ease-in-out infinite;
}

.animate-fade-up {
    animation: fadeUp .6s ease both;
}

.animate-fade-in {
    animation: fadeIn .4s ease both;
}
    </style>
</head>
<body class="bg-cream text-charcoal antialiased">

{{-- ═══════════════════════════════════════════════
     STICKY NAVBAR
═══════════════════════════════════════════════ --}}
<nav id="mainNav"
     class="sticky top-0 z-50 bg-cream/90 backdrop-blur-md border-b border-soft/20
            transition-shadow duration-300"
     x-data="{ open: false }" {{-- Alpine.js if available --}}>
  <x-navbar :cart="$cart"/>
</nav>

{{-- ═══════════════════════════════════════════════
     HERO SECTION
═══════════════════════════════════════════════ --}}
<section class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-2">
  <x-hero-section/>
</section>

{{-- ═══════════════════════════════════════════════
     CATEGORY QUICK-LINKS
═══════════════════════════════════════════════ --}}
<section class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="flex overflow-x-auto hide-scrollbar gap-3 pb-1">
    {{-- "All" pill --}}
    <a href="{{ route('menu') }}"
       class="shrink-0 flex items-center gap-2 px-5 py-2.5 rounded-full
              bg-gradient-to-r from-flame to-ember text-white font-body font-semibold text-sm
              shadow-btn hover:shadow-btn-hover transition-all duration-200">
      🍽️ All
    </a>
    {{-- Dynamic categories from controller --}}
    @foreach($categories as $category)
      <a href="{{ route('menu', ['category' => $category->slug]) }}"
         class="shrink-0 flex items-center gap-2 px-5 py-2.5 rounded-full
                bg-white border border-soft/40 text-muted font-body font-medium text-sm
                hover:border-flame hover:text-flame hover:bg-flame/5 shadow-card
                transition-all duration-200">
        <span>{{ $category->icon ?? '🍴' }}</span>
        {{ $category->name }}
        <span class="bg-black/8 rounded-full px-1.5 py-px text-[0.68rem] font-semibold">
          {{ $category->products_count ?? '' }}
        </span>
      </a>
    @endforeach
  </div>
</section>

{{-- ═══════════════════════════════════════════════
     PROMO BANNERS
═══════════════════════════════════════════════ --}}
<section class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 pb-10">
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    {{-- Promo 1 --}}
    <div class="promo-card relative overflow-hidden rounded-2xl cursor-pointer
                bg-gradient-to-br from-[#FF6B35] to-flame text-white p-5 flex items-center gap-4
                hover:shadow-[0_20px_40px_rgba(232,68,10,0.35)]">
      <span class="text-4xl shrink-0">🍕</span>
      <div>
        <div class="text-xs font-semibold uppercase tracking-widest opacity-80 mb-1">Limited Time</div>
        <div class="font-display font-bold text-lg leading-tight">Buy 2 Pizzas,<br>Get 1 Free</div>
      </div>
      <span class="absolute right-4 bottom-4 text-sm opacity-60">→</span>
    </div>
    {{-- Promo 2 --}}
    <div class="promo-card relative overflow-hidden rounded-2xl cursor-pointer
                bg-gradient-to-br from-amber to-[#D97706] text-white p-5 flex items-center gap-4
                hover:shadow-[0_20px_40px_rgba(245,158,11,0.35)]">
      <span class="text-4xl shrink-0">🥤</span>
      <div>
        <div class="text-xs font-semibold uppercase tracking-widest opacity-80 mb-1">Today Only</div>
        <div class="font-display font-bold text-lg leading-tight">Free Drink<br>with any Meal</div>
      </div>
      <span class="absolute right-4 bottom-4 text-sm opacity-60">→</span>
    </div>
    {{-- Promo 3 --}}
    <div class="promo-card relative overflow-hidden rounded-2xl cursor-pointer
                bg-gradient-to-br from-[#6B2E14] to-[#3D1A08] text-white p-5 flex items-center gap-4
                hover:shadow-[0_20px_40px_rgba(61,26,8,0.4)] sm:col-span-2 lg:col-span-1">
      <span class="text-4xl shrink-0">🚀</span>
      <div>
        <div class="text-xs font-semibold uppercase tracking-widest opacity-80 mb-1">Always</div>
        <div class="font-display font-bold text-lg leading-tight">Free Delivery<br>Over ₦5,000</div>
      </div>
      <span class="absolute right-4 bottom-4 text-sm opacity-60">→</span>
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════════════
     FEATURED PRODUCTS SECTION
     $featuredProducts — paginated collection from controller
═══════════════════════════════════════════════ --}}
<section class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">

  {{-- Section Header --}}
  <div class="flex items-end justify-between gap-4 mb-6">
    <div>
      <h2 class="font-display font-bold text-charcoal text-[clamp(1.5rem,3vw,2rem)] leading-tight">
        Featured <span class="text-flame">Dishes</span>
      </h2>
      <p class="text-muted text-sm mt-1">Handpicked favourites &amp; seasonal specials</p>
    </div>
    <a href="{{ route('menu') }}"
       class="shrink-0 flex items-center gap-1.5 text-flame font-body font-medium text-sm
              hover:gap-3 transition-all duration-200">
      View all <span>→</span>
    </a>
  </div>

  {{-- ── PRODUCT GRID ──────────────────────────────────────────────────────
       grid-cols responsive breakpoints ensure alignment with any product count.
       Each card uses flex-col + flex-grow so footer always pins to bottom.
  ──────────────────────────────────────────────────────────────────────── --}}
  @if($featuredProducts->isNotEmpty())
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-5">
      @foreach($featuredProducts as $product)
        {{-- ── PRODUCT CARD ─────────────────────────────────────────────── --}}
        <div class="product-card group bg-white rounded-2xl overflow-hidden
                    shadow-card hover:shadow-card-hover
                    border border-soft/15 flex flex-col
                    transition-shadow duration-300
                    {{ $product->is_sold_out ? 'opacity-80' : '' }}">

          <x-product.product-card :product="$product"/>
        </div>
        {{-- ── / PRODUCT CARD ─────────────────────────────────────────────── --}}

      @endforeach
    </div>

    {{-- Pagination --}}
    @if($featuredProducts->hasPages())
      <div class="flex items-center justify-center gap-2 mt-10 flex-wrap">
        {{-- Previous --}}
        @if($featuredProducts->onFirstPage())
          <span class="px-4 h-10 flex items-center rounded-xl border border-soft/30 bg-white
                       text-soft font-medium text-sm cursor-not-allowed">← Prev</span>
        @else
          <a href="{{ $featuredProducts->previousPageUrl() }}"
             class="px-4 h-10 flex items-center rounded-xl border border-soft/30 bg-white
                    text-brown font-medium text-sm shadow-card
                    hover:border-flame hover:text-flame transition-all duration-200">← Prev</a>
        @endif

        {{-- Page numbers --}}
        @foreach($featuredProducts->getUrlRange(1, $featuredProducts->lastPage()) as $page => $url)
          @if($page == $featuredProducts->currentPage())
            <span class="w-10 h-10 flex items-center justify-center rounded-xl font-semibold text-sm
                         text-white bg-gradient-to-br from-flame to-ember shadow-btn">
              {{ $page }}
            </span>
          @else
            <a href="{{ $url }}"
               class="w-10 h-10 flex items-center justify-center rounded-xl border border-soft/30
                      bg-white text-brown font-medium text-sm shadow-card
                      hover:border-flame hover:text-flame transition-all duration-200">
              {{ $page }}
            </a>
          @endif
        @endforeach

        {{-- Next --}}
        @if($featuredProducts->hasMorePages())
          <a href="{{ $featuredProducts->nextPageUrl() }}"
             class="px-4 h-10 flex items-center rounded-xl border border-soft/30 bg-white
                    text-brown font-medium text-sm shadow-card
                    hover:border-flame hover:text-flame transition-all duration-200">Next →</a>
        @else
          <span class="px-4 h-10 flex items-center rounded-xl border border-soft/30 bg-white
                       text-soft font-medium text-sm cursor-not-allowed">Next →</span>
        @endif
      </div>
    @endif

  @else
    {{-- Empty state --}}
    <div class="flex flex-col items-center justify-center py-20 text-center">
      <span class="text-6xl mb-4">🍽️</span>
      <h3 class="font-display font-bold text-xl text-charcoal mb-2">No dishes yet</h3>
      <p class="text-muted text-sm">Check back soon — our kitchen is warming up!</p>
    </div>
  @endif
</section>

{{-- ═══════════════════════════════════════════════
     TESTIMONIALS / SOCIAL PROOF
═══════════════════════════════════════════════ --}}
<section class="bg-gradient-to-br from-[#2A1508] via-[#3D1A08] to-[#5A2510] py-16">
  <x-testimonials/>
</section>

{{-- ═══════════════════════════════════════════════
     FOOTER
═══════════════════════════════════════════════ --}}
<footer class="bg-charcoal text-white/60">
  <x-footer />
</footer>

{{-- Flash / session message --}}
@if(session('success'))
  <div id="toast"
       class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50
              bg-charcoal text-white px-6 py-3 rounded-full shadow-card-hover
              font-body text-sm flex items-center gap-2 animate-fade-up">
    ✅ {{ session('success') }}
  </div>
  <script>setTimeout(()=>document.getElementById('toast')?.remove(), 3000)</script>
@endif

<script>
  // Sticky nav shadow
  window.addEventListener('scroll', () => {
    document.getElementById('mainNav').style.boxShadow =
      window.scrollY > 20 ? '0 8px 32px rgba(28,22,17,0.12)' : '';
  });

  // Wishlist toggle (replace with Axios/fetch for real implementation)
  function toggleWishlist(btn) {
    const isActive = btn.textContent.trim() === '❤️';
    btn.textContent = isActive ? '🤍' : '❤️';
    // POST to wishlist route if authenticated
  }

  async function addToCart(productId){
    const quantity = document.getElementById('quantity').value;
    try{
      const response = await fetch('route("cart.add")', {
        method: 'POST',
        headers: {
          'Content-type': 'application/json',
          'X-CSRF-TOKEN': document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content')
        },
        body: JSON.stingify({
          product_id: productId,
          quantity: quantity
        })
      });

      const data = await response.json();

      if(data.success){
        // Show success message, update cart count, etc.
        alert('Productadded to cart!');
      }
    }catch(error){
      console.error('Error adding to cart:', error);
    }
  }
</script>
</body>
</html>