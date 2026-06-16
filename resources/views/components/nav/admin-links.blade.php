<!-- admin nav links -->
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