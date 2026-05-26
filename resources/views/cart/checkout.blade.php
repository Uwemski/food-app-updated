<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout — Place Your Order</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        h1, h2, h3, .serif { font-family: 'DM Serif Display', serif; }

        .input-base {
            @apply w-full px-4 py-3 rounded-xl border bg-white text-gray-800 text-sm
                   placeholder-gray-400 transition-all duration-200
                   focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent;
        }

        /* Subtle grain texture on the page background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.035'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        amber: {
                            50:  '#fffbeb',
                            100: '#fef3c7',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-stone-50 relative z-10">

    {{-- ─── Top Bar ──────────────────────────────────────────────────────── --}}
    <header class="bg-white border-b border-stone-200 sticky top-0 z-30">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <a href="/" class="serif text-xl text-stone-800 tracking-tight">
                <span class="text-amber-500">●</span> YourStore
            </a>
            <nav class="flex items-center gap-2 text-sm text-stone-500">
                <a href="/cart" class="hover:text-stone-800 transition-colors">Cart</a>
                <span class="text-stone-300">›</span>
                <span class="font-semibold text-stone-800">Checkout</span>
            </nav>
        </div>
    </header>

    {{-- ─── Main Content ─────────────────────────────────────────────────── --}}
    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-10 lg:py-16">

        {{-- Page Title --}}
        <div class="mb-8">
            <h1 class="text-3xl sm:text-4xl text-stone-800 leading-tight">Complete Your Order</h1>
            <p class="text-stone-500 mt-1 text-sm">Fill in your delivery details below.</p>
        </div>

        {{-- ─── Grid: Form + Summary ─────────────────────────────────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_380px] gap-8 items-start">

            {{-- ══════════════════════════════════════════════════════════════
                 LEFT — Checkout Form
            ══════════════════════════════════════════════════════════════ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-stone-200 p-6 sm:p-8">

                <h2 class="serif text-xl text-stone-800 mb-6">Delivery Information</h2>
<!-- novalidate -->
                <form action="{{route('checkout.process')}}" method="POST" >
                    @csrf

                    {{-- ── Customer Name ──────────────────────────────────── --}}
                    <div class="mb-5">
                        <label for="name" class="block text-sm font-medium text-stone-700 mb-1.5">
                            Customer Name <span class="text-red-400">*</span>
                        </label>
                        <input
                            type="text"
                            id="customer_name"
                            name="customer_name"
                            value="{{ old('customer_name') }}"
                            placeholder="e.g. Amaka Okonkwo"
                            required
                            class="w-full px-4 py-3 rounded-xl border text-gray-800 text-sm placeholder-gray-400
                                   transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-amber-400
                                   focus:border-transparent bg-white
                                   {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-stone-200' }}"
                        >
                        @error('customer_name')
                            <p class="mt-1.5 text-red-500 text-xs flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- ── Phone Number ───────────────────────────────────── --}}
                    <div class="mb-5">
                        <label for="phone" class="block text-sm font-medium text-stone-700 mb-1.5">
                            Phone Number <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 text-sm select-none">🇳🇬</span>
                            <input
                                type="text"
                                id="customer_phone"
                                name="customer_phone"
                                value="{{ old('customer_phone') }}"
                                placeholder="08012345678"
                                maxlength="11"
                                required
                                class="w-full pl-11 pr-4 py-3 rounded-xl border text-gray-800 text-sm placeholder-gray-400
                                       transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-amber-400
                                       focus:border-transparent bg-white
                                       {{ $errors->has('phone') ? 'border-red-400 bg-red-50' : 'border-stone-200' }}"
                            >
                        </div>
                        <p class="mt-1 text-stone-400 text-xs">Must be exactly 11 digits (e.g. 08012345678)</p>
                        @error('customer_phone')
                            <p class="mt-1 text-red-500 text-xs flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- ── Delivery Address ───────────────────────────────── --}}
                    <div class="mb-5">
                        <label for="address" class="block text-sm font-medium text-stone-700 mb-1.5">
                            Delivery Address <span class="text-red-400">*</span>
                        </label>
                        <textarea
                            id="customer_address"
                            name="customer_address"
                            rows="3"
                            placeholder="House/flat number, street, area, city, state"
                            required
                            class="w-full px-4 py-3 rounded-xl border text-gray-800 text-sm placeholder-gray-400
                                   transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-amber-400
                                   focus:border-transparent bg-white resize-none
                                   {{ $errors->has('address') ? 'border-red-400 bg-red-50' : 'border-stone-200' }}"
                        >{{ old('customer_address') }}</textarea>
                        @error('customer_address')
                            <p class="mt-1.5 text-red-500 text-xs flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- ── Delivery Notes (optional) ──────────────────────── --}}
                    <div class="mb-8">
                        <label for="notes" class="block text-sm font-medium text-stone-700 mb-1.5">
                            Delivery Notes
                            <span class="text-stone-400 font-normal">(optional)</span>
                        </label>
                        <textarea
                            id="delivery_notes"
                            name="delivery_notes"
                            rows="2"
                            placeholder="Landmark, instructions for the rider, best time to deliver…"
                            class="w-full px-4 py-3 rounded-xl border border-stone-200 bg-white text-gray-800
                                   text-sm placeholder-gray-400 transition-all duration-200
                                   focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent resize-none"
                        >{{ old('delivery_notes') }}</textarea>
                    </div>

                    {{-- ── Submit ─────────────────────────────────────────── --}}
                    <button
                        type="submit"
                        class="w-full bg-amber-500 hover:bg-amber-600 active:scale-[0.98] text-white
                               font-semibold py-3.5 px-6 rounded-xl transition-all duration-200
                               shadow-md hover:shadow-amber-200 hover:shadow-lg
                               flex items-center justify-center gap-2 text-sm tracking-wide"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Place Order
                    </button>

                    <p class="text-center text-xs text-stone-400 mt-4">
                        By placing this order you agree to our
                        <a href="#" class="underline hover:text-stone-600">Terms of Service</a>.
                    </p>

                </form>
            </div>{{-- /form card --}}

            {{-- ══════════════════════════════════════════════════════════════
                 RIGHT — Order Summary Sidebar
            ══════════════════════════════════════════════════════════════ --}}
            <aside class="space-y-4 lg:sticky lg:top-24">

                {{-- Items Card --}}
                <div class="bg-white rounded-2xl shadow-sm border border-stone-200 p-6">
                    <h2 class="serif text-xl text-stone-800 mb-5">Order Summary</h2>

                    {{-- Item List --}}
                    <ul class="divide-y divide-stone-100">
                        @forelse($cart as $item)
                            <li class="py-3 flex items-start gap-3">
                                {{-- Product thumbnail placeholder --}}
                                <div class="w-10 h-10 rounded-lg bg-stone-100 flex-shrink-0 overflow-hidden">
                                    @if(!empty($item['image']))
                                        <img src="{{ Storage::disk('products')->url($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-stone-300 text-lg">📦</div>
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-stone-800 truncate">{{ $item['name'] }}</p>
                                    <p class="text-xs text-stone-400 mt-0.5">
                                        Qty: {{ $item['quantity'] }}
                                        &nbsp;·&nbsp;
                                        ₦{{ number_format($item['price'], 2) }} each
                                    </p>
                                </div>

                                <span class="text-sm font-semibold text-stone-800 flex-shrink-0">
                                    ₦{{ number_format($item['price'] * $item['quantity'], 2) }}
                                </span>
                            </li>
                        @empty
                            <li class="py-6 text-center text-stone-400 text-sm">
                                Your cart is empty.
                            </li>
                        @endforelse
                    </ul>
                </div>

                {{-- Pricing Summary Card --}}
                <div class="bg-white rounded-2xl shadow-sm border border-stone-200 p-6">
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between text-stone-600">
                            <span>Subtotal</span>
                            <span>₦{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-stone-600">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 16l-4-4m0 0l4-4m-4 4h16m-4 4l4-4-4-4"/>
                                </svg>
                                Delivery Fee
                            </span>
                            <span>₦{{ number_format($deliveryFee, 2) }}</span>
                        </div>

                        <div class="pt-3 border-t border-stone-100 flex justify-between items-center">
                            <span class="font-semibold text-stone-800 text-base">Total</span>
                            <span class="font-bold text-amber-600 text-lg">₦{{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    {{-- Trust badge --}}
                    <div class="mt-5 pt-4 border-t border-stone-100 flex items-center gap-2 text-xs text-stone-400">
                        <svg class="w-4 h-4 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Secure checkout — your data is safe with us.
                    </div>
                </div>

            </aside>{{-- /sidebar --}}

        </div>{{-- /grid --}}

    </main>

    {{-- ─── Footer ───────────────────────────────────────────────────────── --}}
    <footer class="mt-16 py-6 border-t border-stone-200 text-center text-xs text-stone-400">
        &copy; {{ date('Y') }} YourStore. All rights reserved.
    </footer>

    {{-- Phone field: enforce digit-only input in browser --}}
    <script>
        document.getElementById('phone').addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 11);
        });
    </script>

</body>
</html>