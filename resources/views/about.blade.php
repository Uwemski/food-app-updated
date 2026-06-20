<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <section class="bg-white">

```
<!-- HERO -->
<div class="relative bg-green-600 text-white">
    <div class="max-w-7xl mx-auto px-6 py-24 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6">
            Fresh Meals Delivered To Your Doorstep
        </h1>

        <p class="max-w-3xl mx-auto text-lg md:text-xl text-green-100">
            We make ordering delicious meals simple, fast, and convenient.
            Whether you're at home, work, or on the move, your favorite
            meals are only a few clicks away.
        </p>
    </div>
</div>

<!-- ABOUT -->
<div class="max-w-7xl mx-auto px-6 py-20">
    <div class="grid lg:grid-cols-2 gap-12 items-center">

        <div>
            <img src="{{ asset('images/about-food.jpg') }}"
                 alt="Food"
                 class="rounded-2xl shadow-lg w-full">
        </div>

        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">
                Who We Are
            </h2>

            <p class="text-gray-600 leading-relaxed mb-5">
                We are passionate about connecting food lovers with
                delicious meals prepared by trusted kitchens and food
                vendors. Our platform was created to eliminate the hassle
                of searching for quality food while providing a seamless
                ordering experience.
            </p>

            <p class="text-gray-600 leading-relaxed">
                From local favorites to special treats, we bring a variety
                of meals together in one convenient place so customers can
                order with confidence and satisfaction.
            </p>
        </div>

    </div>
</div>

<!-- MISSION & VISION -->
<div class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid md:grid-cols-2 gap-8">

            <div class="bg-white p-8 rounded-2xl shadow">
                <h3 class="text-2xl font-bold text-green-600 mb-4">
                    Our Mission
                </h3>

                <p class="text-gray-600">
                    To provide customers with quick access to fresh,
                    affordable, and delicious meals while supporting food
                    businesses with a reliable digital platform.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow">
                <h3 class="text-2xl font-bold text-green-600 mb-4">
                    Our Vision
                </h3>

                <p class="text-gray-600">
                    To become the preferred destination for food ordering
                    by delivering exceptional customer experiences and
                    connecting communities through great food.
                </p>
            </div>

        </div>

    </div>
</div>

<!-- WHY CHOOSE US -->
<div class="max-w-7xl mx-auto px-6 py-20">

    <div class="text-center mb-14">
        <h2 class="text-3xl font-bold text-gray-900">
            Why Choose Us?
        </h2>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">

        <div class="border rounded-xl p-6">
            <h4 class="font-semibold text-xl mb-3">
                Fresh Meals
            </h4>
            <p class="text-gray-600">
                Prepared using quality ingredients and delivered fresh.
            </p>
        </div>

        <div class="border rounded-xl p-6">
            <h4 class="font-semibold text-xl mb-3">
                Fast Delivery
            </h4>
            <p class="text-gray-600">
                Quick and reliable delivery service to your location.
            </p>
        </div>

        <div class="border rounded-xl p-6">
            <h4 class="font-semibold text-xl mb-3">
                Easy Ordering
            </h4>
            <p class="text-gray-600">
                Browse, select, and checkout in a few simple steps.
            </p>
        </div>

        <div class="border rounded-xl p-6">
            <h4 class="font-semibold text-xl mb-3">
                Customer Support
            </h4>
            <p class="text-gray-600">
                Friendly support whenever you need assistance.
            </p>
        </div>

    </div>

</div>

<!-- STATS -->
<div class="bg-green-600 text-white py-20">
    <div class="max-w-6xl mx-auto px-6">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">

            <div>
                <h3 class="text-4xl font-bold">5K+</h3>
                <p class="mt-2">Orders Delivered</p>
            </div>

            <div>
                <h3 class="text-4xl font-bold">1K+</h3>
                <p class="mt-2">Happy Customers</p>
            </div>

            <div>
                <h3 class="text-4xl font-bold">100+</h3>
                <p class="mt-2">Daily Orders</p>
            </div>

            <div>
                <h3 class="text-4xl font-bold">50+</h3>
                <p class="mt-2">Menu Items</p>
            </div>

        </div>

    </div>
</div>

<!-- TESTIMONIALS -->
<div class="max-w-7xl mx-auto px-6 py-20">

    <div class="text-center mb-14">
        <h2 class="text-3xl font-bold">
            What Customers Say
        </h2>
    </div>

    <div class="grid md:grid-cols-3 gap-8">

        <div class="bg-gray-50 p-6 rounded-xl">
            <p class="text-gray-600 italic">
                "The ordering process was smooth and my food arrived hot
                and fresh. Highly recommended."
            </p>

            <h4 class="mt-4 font-semibold">
                Sarah A.
            </h4>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl">
            <p class="text-gray-600 italic">
                "Excellent service and delicious meals. I'll definitely
                order again."
            </p>

            <h4 class="mt-4 font-semibold">
                Michael O.
            </h4>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl">
            <p class="text-gray-600 italic">
                "Fast delivery and great customer support. A wonderful
                experience."
            </p>

            <h4 class="mt-4 font-semibold">
                Grace E.
            </h4>
        </div>

    </div>

</div>

<!-- CTA -->
<div class="bg-gray-900 text-white">
    <div class="max-w-4xl mx-auto px-6 py-20 text-center">

        <h2 class="text-4xl font-bold mb-6">
            Ready To Enjoy Delicious Meals?
        </h2>

        <p class="text-gray-300 mb-8">
            Explore our menu today and discover a variety of meals prepared
            to satisfy every craving.
        </p>

        <a href="{{ route('menu') }}"
           class="inline-block bg-green-600 hover:bg-green-700 px-8 py-4 rounded-lg font-semibold">
            Browse Menu
        </a>

    </div>
</div>
```

</section>

</body>
</html>