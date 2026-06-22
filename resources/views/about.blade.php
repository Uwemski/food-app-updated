<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;1,9..144,500&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<style>
    :root {
        --flame: #E8440A;
        --ember: #FF7A3D;
        --char: #241712;
        --cream: #FFF8F1;
        --gold: #D9A441;
    }

    .font-display { font-family: 'Fraunces', serif; }
    .font-body { font-family: 'Inter', sans-serif; }

    .nav-link::after { content:''; display:block; height:2px; background:var(--flame); transform:scaleX(0); transition:transform .25s ease; border-radius:2px; }
    .nav-link:hover::after { transform:scaleX(1); }

    @keyframes shimmer { 0%{background-position:-400px 0} 100%{background-position:400px 0} }
    .skeleton { background:linear-gradient(90deg,#f0e8e1 25%,#fdf0e8 50%,#f0e8e1 75%); background-size:400px 100%; animation:shimmer 1.4s infinite; }

    .promo-card { transition: transform .28s ease, box-shadow .28s ease; }
    .promo-card:hover { transform: translateY(-4px); }

    @keyframes float { 0%,100%{ transform: translateY(0); } 50%{ transform: translateY(-12px); } }
    @keyframes fadeUp { 0%{ opacity:0; transform: translateY(20px); } 100%{ opacity:1; transform: translateY(0); } }
    @keyframes fadeIn { 0%{ opacity:0; } 100%{ opacity:1; } }
    .animate-float { animation: float 4s ease-in-out infinite; }
    .animate-fade-up { animation: fadeUp .6s ease both; }
    .animate-fade-in { animation: fadeIn .4s ease both; }

    /* Signature: drifting ember glow used only in the page header */
    @keyframes drift {
        0%   { transform: translate(0,0) scale(1); }
        50%  { transform: translate(20px,-30px) scale(1.08); }
        100% { transform: translate(0,0) scale(1); }
    }
    .ember-glow {
        position: absolute;
        border-radius: 9999px;
        filter: blur(60px);
        opacity: .55;
        animation: drift 9s ease-in-out infinite;
    }

    /* Process rail — a real sequence, so numbering earns its place here */
    .process-rail { position: relative; }
    .process-rail::before {
        content: '';
        position: absolute;
        top: 28px;
        left: 0;
        right: 0;
        height: 2px;
        background: repeating-linear-gradient(90deg, #E8440A 0 10px, transparent 10px 20px);
        opacity: .35;
    }
    @media (max-width: 768px) {
        .process-rail::before { left: 28px; right: auto; top: 0; bottom: 0; width: 2px; height: auto; background: repeating-linear-gradient(180deg, #E8440A 0 10px, transparent 10px 20px); }
    }
    .process-step-number {
        width: 56px; height: 56px;
        display: flex; align-items: center; justify-content: center;
        font-family: 'Fraunces', serif;
        font-weight: 600;
        color: #fff;
        background: linear-gradient(135deg, var(--flame), var(--ember));
        border-radius: 9999px;
        box-shadow: 0 0 0 6px var(--cream), 0 8px 18px -6px rgba(232,68,10,.45);
        position: relative;
        z-index: 1;
    }
</style>

<body class="font-body">

    <!-- NavBar -->
    <x-navbar :cart="$cart"/>

    <section class="bg-[var(--cream)]">

        <!-- PAGE HEADER -->
        <section class="relative overflow-hidden bg-[var(--char)] text-white">
            <div class="ember-glow w-72 h-72 bg-[var(--flame)] -top-10 -left-10"></div>
            <div class="ember-glow w-96 h-96 bg-[var(--gold)] bottom-[-6rem] right-[-4rem]" style="animation-delay:2s"></div>

            <div class="relative max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-28 text-center">
                <span class="animate-fade-in inline-block text-xs sm:text-sm tracking-[0.2em] uppercase text-[var(--ember)] font-semibold mb-5">
                    About Us
                </span>
                <h1 class="animate-fade-up font-display italic text-4xl sm:text-5xl lg:text-6xl leading-tight max-w-3xl mx-auto">
                    Every Dish Starts With Fire
                </h1>
                <p class="animate-fade-up text-white/70 mt-6 max-w-xl mx-auto text-base sm:text-lg" style="animation-delay:.1s">
                    We started in one small kitchen with one simple promise — real food,
                    made with care, delivered like someone who loves you made it.
                </p>
            </div>
        </section>

        <!-- OUR STORY -->
        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <div class="order-2 lg:order-1">
                    <h2 class="font-display text-3xl font-semibold text-[var(--char)] mb-6">
                        From One Stove To A Whole Community
                    </h2>

                    <p class="text-gray-600 leading-relaxed mb-5">
                        It began the way most good food stories do — with someone cooking
                        more than they could eat and a neighbour who couldn't say no.
                        That kitchen grew into a network of trusted local cooks and vendors,
                        all held to the same standard: nothing leaves the kitchen unless
                        we'd serve it to our own family.
                    </p>

                    <p class="text-gray-600 leading-relaxed">
                        Today, we connect food lovers with kitchens we know and trust,
                        so every order still feels like it came from someone's home —
                        just delivered to yours.
                    </p>
                </div>

                <div class="order-1 lg:order-2 relative">
                    <img src="{{ asset('images/about-story.jpg') }}"
                         alt="Our kitchen story"
                         class="rounded-2xl shadow-lg w-full">
                    <div class="hidden sm:flex absolute -bottom-6 -left-6 bg-white rounded-xl shadow-lg px-6 py-4 items-center gap-3">
                        <span class="font-display text-2xl font-semibold text-[var(--flame)]">7+</span>
                        <span class="text-sm text-gray-600 leading-tight">years<br>of cooking for our community</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- WHAT WE STAND FOR -->
        <div class="bg-white py-20">
            <div class="max-w-7xl mx-auto px-6">

                <div class="text-center mb-14">
                    <span class="text-xs tracking-[0.2em] uppercase text-[var(--flame)] font-semibold">Our Values</span>
                    <h2 class="font-display text-3xl font-semibold text-[var(--char)] mt-3">
                        What We Stand For
                    </h2>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    <div class="promo-card border rounded-2xl p-8 hover:shadow-lg">
                        <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center mb-5">
                            <span class="text-xl">🌿</span>
                        </div>
                        <h4 class="font-display font-semibold text-xl mb-3 text-[var(--char)]">Sourced With Care</h4>
                        <p class="text-gray-600">
                            Ingredients are picked fresh each morning from suppliers we've
                            worked with for years, not whoever's cheapest that day.
                        </p>
                    </div>

                    <div class="promo-card border rounded-2xl p-8 hover:shadow-lg">
                        <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center mb-5">
                            <span class="text-xl">🔥</span>
                        </div>
                        <h4 class="font-display font-semibold text-xl mb-3 text-[var(--char)]">Cooked With Soul</h4>
                        <p class="text-gray-600">
                            Our kitchen partners cook from family recipes, slow-built
                            flavor over shortcuts, every single time.
                        </p>
                    </div>

                    <div class="promo-card border rounded-2xl p-8 hover:shadow-lg">
                        <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center mb-5">
                            <span class="text-xl">🛵</span>
                        </div>
                        <h4 class="font-display font-semibold text-xl mb-3 text-[var(--char)]">Delivered With Heart</h4>
                        <p class="text-gray-600">
                            Packed hot, handled gently, and handed over by someone who
                            actually wants you to enjoy your meal.
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <!-- PROCESS -->
        <div class="bg-[var(--cream)] py-20">
            <div class="max-w-6xl mx-auto px-6">

                <div class="text-center mb-16">
                    <span class="text-xs tracking-[0.2em] uppercase text-[var(--flame)] font-semibold">How It Works</span>
                    <h2 class="font-display text-3xl font-semibold text-[var(--char)] mt-3">
                        From Our Kitchen To Your Table
                    </h2>
                </div>

                <div class="process-rail grid md:grid-cols-4 gap-10 md:gap-6">

                    <div class="flex md:flex-col items-center md:items-center gap-4 md:gap-0 text-left md:text-center">
                        <span class="process-step-number flex-shrink-0">01</span>
                        <div class="md:mt-5">
                            <h4 class="font-semibold text-[var(--char)] mb-1">Order Placed</h4>
                            <p class="text-sm text-gray-600">You pick your cravings, we get to work.</p>
                        </div>
                    </div>

                    <div class="flex md:flex-col items-center md:items-center gap-4 md:gap-0 text-left md:text-center">
                        <span class="process-step-number flex-shrink-0">02</span>
                        <div class="md:mt-5">
                            <h4 class="font-semibold text-[var(--char)] mb-1">Kitchen Fires Up</h4>
                            <p class="text-sm text-gray-600">A trusted local cook starts on your meal.</p>
                        </div>
                    </div>

                    <div class="flex md:flex-col items-center md:items-center gap-4 md:gap-0 text-left md:text-center">
                        <span class="process-step-number flex-shrink-0">03</span>
                        <div class="md:mt-5">
                            <h4 class="font-semibold text-[var(--char)] mb-1">Packed With Care</h4>
                            <p class="text-sm text-gray-600">Sealed hot, checked twice, ready to ride.</p>
                        </div>
                    </div>

                    <div class="flex md:flex-col items-center md:items-center gap-4 md:gap-0 text-left md:text-center">
                        <span class="process-step-number flex-shrink-0">04</span>
                        <div class="md:mt-5">
                            <h4 class="font-semibold text-[var(--char)] mb-1">At Your Door</h4>
                            <p class="text-sm text-gray-600">Delivered fresh, right on time.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- FOUNDER QUOTE -->
        <div class="bg-white py-20">
            <div class="max-w-3xl mx-auto px-6 text-center">
                <p class="font-display italic text-2xl sm:text-3xl text-[var(--char)] leading-relaxed">
                    "We didn't set out to build an app. We set out to make sure no one
                    ever has to choose between being busy and being well-fed."
                </p>
                <div class="w-10 h-[2px] bg-[var(--flame)] mx-auto mt-8 mb-4"></div>
                <p class="text-gray-500 text-sm">
                    <span class="font-semibold text-[var(--char)]">Amaka Obi</span> — Founder
                </p>
            </div>
        </div>

        <!-- STATS -->
        <div class="bg-[var(--char)] text-white py-20">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div>
                        <h3 class="font-display text-4xl font-semibold text-[var(--ember)]">12</h3>
                        <p class="mt-2 text-white/70">Cities Served</p>
                    </div>

                    <div>
                        <h3 class="font-display text-4xl font-semibold text-[var(--ember)]">28 min</h3>
                        <p class="mt-2 text-white/70">Avg. Delivery Time</p>
                    </div>

                    <div>
                        <h3 class="font-display text-4xl font-semibold text-[var(--ember)]">7+</h3>
                        <p class="mt-2 text-white/70">Years Serving Communities</p>
                    </div>

                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="bg-gray-900 text-white">
            <div class="max-w-4xl mx-auto px-6 py-20 text-center">

                <h2 class="font-display text-4xl font-semibold mb-6">
                    Taste The Story For Yourself
                </h2>

                <p class="text-gray-300 mb-8">
                    Every order supports a real kitchen and a real cook.
                    Come hungry — we've got the rest.
                </p>

                <a href="{{ route('menu') }}"
                   class="inline-block bg-green-600 hover:bg-green-700 px-8 py-4 rounded-lg font-semibold transition">
                    Browse Menu
                </a>

            </div>
        </div>

        <x-footer/>

    </section>

</body>
</html>