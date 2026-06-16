{{--
    Mobile navigation drawer.
    Visible only on small screens (hidden on md: and above via the Alpine logic).
    Uses Alpine.js $store.mobileNav to sync with the hamburger in admin-header.
--}}
<div
    x-data
    x-show="$store.mobileNav.isOpen"
    x-cloak
    class="md:hidden"
    role="dialog"
    aria-modal="true"
    aria-label="Mobile navigation"
    id="mobile-drawer"
>

    {{-- ① Backdrop overlay --}}
    <div
        x-show="$store.mobileNav.isOpen"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm"
        aria-hidden="true"
        @click="$store.mobileNav.close()"
    ></div>

    {{-- ② Slide-in drawer panel --}}
    <div
        x-show="$store.mobileNav.isOpen"
        x-transition:enter="transition transform ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition transform ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 z-50 w-72 flex flex-col bg-gradient-to-b from-brand-900 to-brand-950 text-white shadow-2xl"
        @keydown.escape.window="$store.mobileNav.close()"
    >

        {{-- Drawer header --}}
        <div class="flex items-center justify-between px-6 py-5 border-b border-white/10 flex-shrink-0">
            {{-- Brand --}}
            
                href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3"
                @click="$store.mobileNav.close()"
            >
                <div class="w-9 h-9 rounded-xl bg-flame flex items-center justify-center text-white font-bold text-base shadow-lg">
                    B
                </div>
                <div>
                    <p class="font-bold text-white leading-tight">B-Kitchen</p>
                    <p class="text-white/50 text-xs">Admin Panel</p>
                </div>
            </a>

            {{-- Close button --}}
            <button
                type="button"
                class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-white/60 hover:bg-white/10 hover:text-white transition-colors duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-flame"
                aria-label="Close navigation menu"
                @click="$store.mobileNav.close()"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        {{-- Drawer nav links — same shared partial, mobile=true --}}
        <div class="flex-1 px-4 py-5 overflow-y-auto">
            <x-nav.admin-links mobile="true"/>
        </div>

        {{-- Drawer footer --}}
        <div class="px-4 py-4 border-t border-white/10 flex-shrink-0">
            <div class="flex items-center gap-3 px-4 py-3 rounded-2xl">
                <div class="w-9 h-9 rounded-full bg-flame/30 flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">User name</p>
                    <p class="text-xs text-white/50 truncate">User email</p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button
                    type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white transition-all duration-200"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Sign out
                </button>
            </form>
        </div>

    </div>
</div>