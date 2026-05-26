<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
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

            <a href="{{route('admin.dashboard')}}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-white/10 text-white font-medium border border-white/10 shadow-card">
                <span class="text-lg">📊</span>
                Dashboard
            </a>

            <a href="{{route('products.show')}}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/70 hover:bg-white/5 hover:text-white transition-all duration-200">
                <span class="text-lg">🍔</span>
                Products
            </a>

            <a href="{{route('orders.view')}}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/70 hover:bg-white/5 hover:text-white transition-all duration-200">
                <span class="text-lg">📦</span>
                Orders
            </a>

            <!-- where paymentt status is paid -->
            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/70 hover:bg-white/5 hover:text-white transition-all duration-200">
                <span class="text-lg">🧾</span>
                Transactions
            </a>

            <a href="{{route('category.show')}}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/70 hover:bg-white/5 hover:text-white transition-all duration-200">
                <span class="text-lg">📂</span>
                Categories
            </a>

            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/70 hover:bg-white/5 hover:text-white transition-all duration-200">
                <span class="text-lg">👥</span>
                Customers
            </a>

            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-white/70 hover:bg-white/5 hover:text-white transition-all duration-200">
                <span class="text-lg">⚙️</span>
                Settings
            </a>
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