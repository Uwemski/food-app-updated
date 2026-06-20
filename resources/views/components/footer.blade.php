<div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

      {{-- Brand col --}}
      <div class="sm:col-span-2 lg:col-span-1">
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-flame to-amber flex items-center justify-center text-base">🔥</div>
          <span class="font-display font-bold text-white text-lg">Ember<span class="text-flame">&amp;</span>Spice</span>
        </div>
        <p class="text-sm leading-relaxed mb-5">
          Premium street food elevated. Crafted with fire, served with soul — right to your door.
        </p>
        <div class="flex gap-3">
          @foreach([['📘','#'],['📸','#'],['🐦','#'],['▶️','#']] as $s)
            <a href="{{ $s[1] }}"
               class="w-9 h-9 rounded-full bg-white/8 flex items-center justify-center text-sm
                      hover:bg-flame/30 transition-colors duration-200">{{ $s[0] }}</a>
          @endforeach
        </div>
      </div>

      {{-- Quick links --}}
      <div>
        <h4 class="font-body font-semibold text-white text-sm uppercase tracking-widest mb-4">Quick Links</h4>
        <ul class="space-y-2.5 text-sm">
          @foreach(['Home'=>'home','Menu'=>'menu','About'=>'#','Contact'=>'#'] as $label => $route)
            <li>
              <a href="{{ is_string($route) && str_starts_with($route,'#') ? $route : route($route) }}"
                 class="hover:text-flame transition-colors duration-200">{{ $label }}</a>
            </li>
          @endforeach
        </ul>
      </div>

      {{-- Categories --}}
      <div>
        <h4 class="font-body font-semibold text-white text-sm uppercase tracking-widest mb-4">Categories</h4>
        <ul class="space-y-2.5 text-sm">
          @forelse($footerCategories ?? [] as $cat)
            <li>
              <a href="{{ route('menu', ['category' => $cat->slug]) }}"
                 class="hover:text-flame transition-colors duration-200">{{ $cat->name }}</a>
            </li>
          @empty
            @foreach(['Pizza','Burgers','Rice & Sides','Chicken','Pasta','Drinks','Desserts'] as $c)
              <li><a href="#" class="hover:text-flame transition-colors duration-200">{{ $c }}</a></li>
            @endforeach
          @endforelse
        </ul>
      </div>

      {{-- Contact --}}
      <div id="contact">
        <h4 class="font-body font-semibold text-white text-sm uppercase tracking-widest mb-4">Contact</h4>
        <ul class="space-y-3 text-sm">
          <li class="flex gap-2.5"><span class="shrink-0">📍</span> {{ $settings->address ?? '14 Bola Ajibola St, Lagos' }}</li>
          <li class="flex gap-2.5"><span class="shrink-0">📞</span> {{ $settings->phone ?? '+234 812 345 6789' }}</li>
          <li class="flex gap-2.5"><span class="shrink-0">📧</span> {{ $settings->email ?? 'hello@emberandspice.ng' }}</li>
          <li class="flex gap-2.5"><span class="shrink-0">🕐</span> Mon–Sun: 10am – 10pm</li>
        </ul>
      </div>
    </div>

    <div class="border-t border-white/8 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
      <p>© {{ date('Y') }} <span class="text-flame">Ember &amp; Spice</span>.Developed by Uwem Paul All rights reserved.</p>
      <div class="flex gap-4">
        <a href="#" class="hover:text-flame transition-colors">Privacy Policy</a>
        <a href="#" class="hover:text-flame transition-colors">Terms of Service</a>
      </div>
    </div>
  </div>