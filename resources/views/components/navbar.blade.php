<div>
    <!-- We must ship. - Taylor Otwell -->
     <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16 gap-4">

      {{-- Logo --}}
      <a href="{{ route('home') }}"
         class="flex items-center gap-2 shrink-0 group">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center text-lg
                    bg-gradient-to-br from-flame to-amber shadow-btn shrink-0">🔥</div>
        <span class="font-display font-bold text-xl text-charcoal leading-none">
          Ember<span class="text-flame">&amp;</span>Spice
        </span>
      </a>

      {{-- Desktop Nav --}}
      <div class="hidden md:flex items-center gap-6 flex-1 justify-center">
        <a href="{{ route('home') }}"
           class="nav-link font-body font-medium text-sm text-brown hover:text-flame transition-colors pb-0.5
                  {{ request()->routeIs('home') ? 'text-flame' : '' }}">Home</a>
        <a href="{{ route('menu') }}"
           class="nav-link font-body font-medium text-sm text-brown hover:text-flame transition-colors pb-0.5
                  {{ request()->routeIs('menu*') ? 'text-flame' : '' }}">Menu</a>
        <a href="{{ route('about') ?? '#' }}"
           class="nav-link font-body font-medium text-sm text-brown hover:text-flame transition-colors pb-0.5">About</a>
        <a href="{{ route('contact') ?? '#' }}"
           class="nav-link font-body font-medium text-sm text-brown hover:text-flame transition-colors pb-0.5">Contact</a>
      </div>

      {{-- Desktop Actions --}}
      <div class="hidden md:flex items-center gap-3 shrink-0">
        @guest
          <!-- <a href="{{ route('login') }}"
             class="font-body font-medium text-sm text-brown border border-soft/50 rounded-full
                    px-4 py-2 hover:border-flame hover:text-flame transition-all duration-200">
            Sign In
          </a> -->
          <!-- <a href="{{ route('register') }}"
             class="font-body font-semibold text-sm text-white rounded-full px-5 py-2
                    bg-gradient-to-r from-flame to-ember shadow-btn
                    hover:shadow-btn-hover hover:-translate-y-0.5 transition-all duration-200">
            Join Us
          </a> -->
        @else
          <span class="font-body text-sm text-muted">Hi, {{ Auth::user()->name }}</span>
        @endguest

        {{-- Cart Button --}}
        <a href="{{ route('cart.index') ?? '#' }}"
           class="relative w-10 h-10 rounded-full bg-warmwhite border border-soft/40 flex items-center
                  justify-center text-base hover:border-flame hover:bg-flame/5 transition-all duration-200">
          🛒
          @if(count($cart) > 0)
            <span
                id="cart-count"
                class="absolute -top-1 -right-1 w-5 h-5 bg-flame text-white text-xs font-bold rounded-full flex items-center justify-center border-2 border-cream {{ count($cart) ? '' : 'hidden' }}"
            >
                {{ count($cart) }}
            </span>
          @endif
        </a>
      </div>

      {{-- Mobile: cart + hamburger --}}
      <div class="flex md:hidden items-center gap-2">
        <a href="{{ route('cart.index') ?? '#' }}"
           class="relative w-9 h-9 rounded-full bg-warmwhite border border-soft/40 flex items-center
                  justify-center text-sm hover:border-flame transition-all">
          🛒
          @if(($count ?? 0) > 0)
            <span class="absolute -top-1 -right-1 w-4 h-4 bg-flame text-white text-xs font-bold
                         rounded-full flex items-center justify-center border-2 border-cream">
              {{ $count }}
            </span>
          @endif
        </a>
        <button id="mobileMenuBtn"
                onclick="document.getElementById('mobileMenu').classList.toggle('hidden')"
                class="w-9 h-9 rounded-lg flex flex-col items-center justify-center gap-1.5
                       border border-soft/40 bg-warmwhite hover:border-flame transition-all">
          <span class="block w-5 h-0.5 bg-charcoal rounded"></span>
          <span class="block w-5 h-0.5 bg-charcoal rounded"></span>
          <span class="block w-5 h-0.5 bg-charcoal rounded"></span>
        </button>
      </div>
    </div>

    {{-- Mobile Menu Dropdown --}}
    <div id="mobileMenu"
         class="hidden md:hidden border-t border-soft/20 py-4 flex flex-col gap-1">
      <a href="{{ route('home') }}"
         class="px-4 py-2.5 rounded-xl font-body font-medium text-sm text-brown
                hover:bg-flame/8 hover:text-flame transition-colors
                {{ request()->routeIs('home') ? 'bg-flame/10 text-flame' : '' }}">
        🏠 &nbsp;Home
      </a>
      <a href="{{ route('menu') }}"
         class="px-4 py-2.5 rounded-xl font-body font-medium text-sm text-brown
                hover:bg-flame/8 hover:text-flame transition-colors
                {{ request()->routeIs('menu*') ? 'bg-flame/10 text-flame' : '' }}">
        🍽️ &nbsp;Menu
      </a>
      <a href="#"
         class="px-4 py-2.5 rounded-xl font-body font-medium text-sm text-brown hover:bg-flame/8 hover:text-flame transition-colors">
        📖 &nbsp;About
      </a>
      <a href="#"
         class="px-4 py-2.5 rounded-xl font-body font-medium text-sm text-brown hover:bg-flame/8 hover:text-flame transition-colors">
        📞 &nbsp;Contact
      </a>
      <div class="flex gap-2 px-4 pt-2">
        @guest
          <!-- <a href="{{ route('login') }}"
             class="flex-1 text-center py-2.5 rounded-full border border-soft/50 font-medium text-sm text-brown hover:border-flame hover:text-flame transition-all">
            Sign In
          </a>
          <a href="{{ route('register') }}"
             class="flex-1 text-center py-2.5 rounded-full bg-gradient-to-r from-flame to-ember text-white font-semibold text-sm shadow-btn transition-all">
            Join Us
          </a> -->
        @endguest
      </div>
    </div>
  </div>
</div>