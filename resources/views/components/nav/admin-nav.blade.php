<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
 <!-- desktop wrappr -->
 <aside class="hidden md:flex w-full md:w-72 bg-charcoal text-white flex flex-col border-r border-white/5 md:min-h-screen">

        {{-- LOGO --}}
        <div class="px-6 py-6 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-flame to-ember flex items-center justify-center text-xl shadow-btn">
                    🍽️
                </div>

                <div>
                    <h1 class="font-display text-xl font-bold text-white leading-tight">
                        Ember & Spice
                    </h1>

                    <p class="text-xs text-white/50 uppercase tracking-[0.2em] mt-1">
                        Admin Panel
                    </p>
                </div>
            </div>
        </div>

        {{-- NAVIGATION --}}
        <div class="flex-1 overflow-y-auto sidebar-scroll px-4 py-6 space-y-2">

            <x-nav.admin-links/>
        </div>

        {{-- ADMIN PROFILE --}}
        <div class="p-4 border-t border-white/10">
            <div class="bg-white/5 rounded-2xl p-4 flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-amber to-gold flex items-center justify-center font-bold text-charcoal">
                    A
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-white">
                        Admin User
                    </h3>

                    <p class="text-xs text-white/50">
                        Super Administrator
                    </p>
                </div>
            </div>
        </div>

    </aside>