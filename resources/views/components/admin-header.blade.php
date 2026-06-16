{{--
    Admin top header bar.
    On mobile: shows hamburger that opens the mobile drawer via Alpine store.
    On desktop: hamburger is hidden (md:hidden).
--}}
<header class="sticky top-0 z-30 flex items-center justify-between px-4 md:px-8 h-[64px] bg-white border-b border-soft/15 shadow-sm">

    {{-- Left side: hamburger (mobile only) + page title --}}
    <div class="flex items-center gap-3">

        {{-- Hamburger button — mobile only --}}
        <button
            type="button"
            class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl text-brand-900 hover:bg-brand-900/5 transition-colors duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-flame"
            aria-label="Open navigation menu"
            aria-controls="mobile-drawer"
            aria-expanded="false"
            x-data
            @click="$store.mobileNav.open()"
            :aria-expanded="$store.mobileNav.isOpen.toString()"
        >
            {{-- Hamburger icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <line x1="3" y1="6" x2="21" y2="6" />
                <line x1="3" y1="12" x2="21" y2="12" />
                <line x1="3" y1="18" x2="21" y2="18" />
            </svg>
        </button>

        {{-- Page title — replace with a @yield or $slot if you want per-page titles --}}
        <div>
                    <h2 class="font-display text-3xl font-bold text-charcoal leading-tight">
                        Dashboard Overview
                    </h2>

                    <p class="text-muted text-sm mt-1">
                        Monitor sales, orders, inventory & customer activity.
                    </p>
                </div>
    </div>

    {{-- Right side: notifications, avatar, etc. (extend as needed) --}}
    <div class="flex items-center gap-2">

        {{-- Notification bell example --}}
        <button
            type="button"
            class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-brand-900/60 hover:bg-brand-900/5 transition-colors duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-flame"
            aria-label="Notifications"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 01-3.46 0"/>
            </svg>
        </button>

        <a href="{{ route('product.create') }}" class="px-5 py-3 rounded-2xl bg-gradient-to-r from-flame to-ember text-white font-semibold shadow-btn hover:shadow-btn-hover transition-all duration-200">
                        + Add Product
                    </a>

    </div>
</header>