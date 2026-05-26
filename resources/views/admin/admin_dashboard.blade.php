<x-admin-layout>


    {{-- STATS GRID --}}
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 gap-6 mb-8">

                {{-- CARD 1 --}}
                <div class="bg-white rounded-3xl p-6 shadow-card border border-soft/15 hover:shadow-card-hover transition-all duration-300">

                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <p class="text-sm text-muted font-medium mb-2">
                                Total Revenue
                            </p>

                            <h3 class="text-3xl font-bold text-charcoal">
                                ₦245,000
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-flame/10 flex items-center justify-center text-2xl">
                            💰
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-green-600 font-semibold">+12.5%</span>
                        <span class="text-muted">from last week</span>
                    </div>

                </div>

                {{-- CARD 2 --}}
                <div class="bg-white rounded-3xl p-6 shadow-card border border-soft/15 hover:shadow-card-hover transition-all duration-300">

                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <p class="text-sm text-muted font-medium mb-2">
                                Total Orders
                            </p>

                            <h3 class="text-3xl font-bold text-charcoal">
                                1,240
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-amber/10 flex items-center justify-center text-2xl">
                            📦
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-green-600 font-semibold">+8.2%</span>
                        <span class="text-muted">from yesterday</span>
                    </div>

                </div>

                {{-- CARD 3 --}}
                <div class="bg-white rounded-3xl p-6 shadow-card border border-soft/15 hover:shadow-card-hover transition-all duration-300">

                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <p class="text-sm text-muted font-medium mb-2">
                                Customers
                            </p>

                            <h3 class="text-3xl font-bold text-charcoal">
                                820
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-gold/20 flex items-center justify-center text-2xl">
                            👥
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-green-600 font-semibold">+15%</span>
                        <span class="text-muted">new signups</span>
                    </div>

                </div>

                {{-- CARD 4 --}}
                <div class="bg-white rounded-3xl p-6 shadow-card border border-soft/15 hover:shadow-card-hover transition-all duration-300">

                    <div class="flex items-start justify-between mb-5">
                        <div>
                            <p class="text-sm text-muted font-medium mb-2">
                                Pending Deliveries
                            </p>

                            <h3 class="text-3xl font-bold text-charcoal">
                                38
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center text-2xl">
                            🚚
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-red-500 font-semibold">+4</span>
                        <span class="text-muted">awaiting dispatch</span>
                    </div>

                </div>

            </section>

            {{-- MAIN GRID --}}
            <section class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 mb-8">

                {{-- RECENT ORDERS --}}
                <div class="xl:col-span-2 bg-white rounded-3xl shadow-card border border-soft/15 overflow-hidden">

                    <div class="px-6 py-5 border-b border-soft/15 flex items-center justify-between">
                        <div>
                            <h3 class="font-display text-2xl font-bold text-charcoal">
                                Recent Orders
                            </h3>

                            <p class="text-sm text-muted mt-1">
                                Latest customer purchases
                            </p>
                        </div>

                        <a href="{{ route('orders.view') }}" class="text-flame font-medium text-sm hover:underline">
                            View all
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-cream/60 border-b border-soft/15">
                                <tr>
                                    <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Order ID</th>
                                    <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Customer</th>
                                    <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Items</th>
                                    <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Amount</th>
                                    <th class="px-6 py-4 text-xs uppercase tracking-wider text-muted font-semibold">Status</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-soft/10">

                                <tr class="hover:bg-cream/40 transition-colors duration-200">
                                    <td class="px-6 py-5 font-semibold text-charcoal">#ES1024</td>
                                    <td class="px-6 py-5 text-muted">Uwem U.</td>
                                    <td class="px-6 py-5 text-muted">4 Items</td>
                                    <td class="px-6 py-5 font-semibold text-charcoal">₦18,500</td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber/15 text-amber">
                                            Pending
                                        </span>
                                    </td>
                                </tr>

                                <tr class="hover:bg-cream/40 transition-colors duration-200">
                                    <td class="px-6 py-5 font-semibold text-charcoal">#ES1025</td>
                                    <td class="px-6 py-5 text-muted">Daniel K.</td>
                                    <td class="px-6 py-5 text-muted">2 Items</td>
                                    <td class="px-6 py-5 font-semibold text-charcoal">₦9,000</td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            Delivered
                                        </span>
                                    </td>
                                </tr>

                                <tr class="hover:bg-cream/40 transition-colors duration-200">
                                    <td class="px-6 py-5 font-semibold text-charcoal">#ES1026</td>
                                    <td class="px-6 py-5 text-muted">Sarah T.</td>
                                    <td class="px-6 py-5 text-muted">6 Items</td>
                                    <td class="px-6 py-5 font-semibold text-charcoal">₦24,300</td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                            Processing
                                        </span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

                {{-- QUICK ACTIONS --}}
                <div class="space-y-6">

                    <div class="bg-gradient-to-br from-flame to-ember rounded-3xl p-6 text-white shadow-btn-hover">
                        <h3 class="font-display text-2xl font-bold mb-2">
                            Quick Actions
                        </h3>

                        <p class="text-white/80 text-sm mb-6 leading-relaxed">
                            Quickly manage products, orders, categories and customer requests.
                        </p>

                        <div class="space-y-3">

                            <a href="{{ route('product.create') }}" class="flex  w-full px-5 py-4 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/10 text-left transition-all duration-200">
                                ➕ Add New Product
                            </a>
                            <a href="{{ route('category.create') }}" class="flex  w-full px-5 py-4 rounded-2xl bg-white/10 hover:bg-white/20 border border-white/10 text-left transition-all duration-200">
                                📂 Manage Categories
                            </a>

                        </div>
                    </div>

                    {{-- INVENTORY --}}
                    <div class="bg-white rounded-3xl p-6 shadow-card border border-soft/15">

                        <div class="flex items-center justify-between mb-5">
                            <div>
                                <h3 class="font-display text-2xl font-bold text-charcoal">
                                    Inventory Status
                                </h3>

                                <p class="text-sm text-muted mt-1">
                                    Product availability overview
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-charcoal">In Stock</span>
                                    <span class="text-sm text-muted">78%</span>
                                </div>

                                <div class="h-3 rounded-full bg-soft/20 overflow-hidden">
                                    <div class="h-full w-[78%] bg-gradient-to-r from-flame to-ember rounded-full"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-charcoal">Low Stock</span>
                                    <span class="text-sm text-muted">14%</span>
                                </div>

                                <div class="h-3 rounded-full bg-soft/20 overflow-hidden">
                                    <div class="h-full w-[14%] bg-amber rounded-full"></div>
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-charcoal">Out of Stock</span>
                                    <span class="text-sm text-muted">8%</span>
                                </div>

                                <div class="h-3 rounded-full bg-soft/20 overflow-hidden">
                                    <div class="h-full w-[8%] bg-red-500 rounded-full"></div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </section>

            {{-- PRODUCT PERFORMANCE --}}
            <section class="bg-white rounded-3xl shadow-card border border-soft/15 overflow-hidden">

                <div class="px-6 py-5 border-b border-soft/15 flex items-center justify-between">
                    <div>
                        <h3 class="font-display text-2xl font-bold text-charcoal">
                            Best Selling Products
                        </h3>

                        <p class="text-sm text-muted mt-1">
                            Top-performing meals this week
                        </p>
                    </div>

                    <button class="px-5 py-3 rounded-2xl border border-soft/20 bg-cream text-charcoal font-medium hover:bg-soft/10 transition-all duration-200">
                        Export Report
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 p-6">

                    <div class="border border-soft/15 rounded-3xl p-5 hover:shadow-card-hover transition-all duration-300">
                        <div class="w-full h-44 rounded-2xl bg-gradient-to-br from-flame/20 to-ember/20 mb-5 flex items-center justify-center text-5xl">
                            🍕
                        </div>

                        <h4 class="font-bold text-lg text-charcoal mb-2">
                            Pepperoni Pizza
                        </h4>

                        <div class="flex items-center justify-between text-sm">
                            <span class="text-muted">Sold: 124</span>
                            <span class="font-semibold text-flame">₦3,500</span>
                        </div>
                    </div>

                    <div class="border border-soft/15 rounded-3xl p-5 hover:shadow-card-hover transition-all duration-300">
                        <div class="w-full h-44 rounded-2xl bg-gradient-to-br from-amber/20 to-gold/20 mb-5 flex items-center justify-center text-5xl">
                            🍔
                        </div>

                        <h4 class="font-bold text-lg text-charcoal mb-2">
                            Beef Burger Deluxe
                        </h4>

                        <div class="flex items-center justify-between text-sm">
                            <span class="text-muted">Sold: 98</span>
                            <span class="font-semibold text-flame">₦4,000</span>
                        </div>
                    </div>

                    <div class="border border-soft/15 rounded-3xl p-5 hover:shadow-card-hover transition-all duration-300">
                        <div class="w-full h-44 rounded-2xl bg-gradient-to-br from-green-100 to-emerald-100 mb-5 flex items-center justify-center text-5xl">
                            🥗
                        </div>

                        <h4 class="font-bold text-lg text-charcoal mb-2">
                            Caesar Salad
                        </h4>

                        <div class="flex items-center justify-between text-sm">
                            <span class="text-muted">Sold: 84</span>
                            <span class="font-semibold text-flame">₦2,500</span>
                        </div>
                    </div>

                    <div class="border border-soft/15 rounded-3xl p-5 hover:shadow-card-hover transition-all duration-300">
                        <div class="w-full h-44 rounded-2xl bg-gradient-to-br from-red-100 to-orange-100 mb-5 flex items-center justify-center text-5xl">
                            🌮
                        </div>

                        <h4 class="font-bold text-lg text-charcoal mb-2">
                            Chicken Tacos
                        </h4>

                        <div class="flex items-center justify-between text-sm">
                            <span class="text-muted">Sold: 76</span>
                            <span class="font-semibold text-flame">₦3,200</span>
                        </div>
                    </div>

                </div>

            </section>


</x-admin-layout>