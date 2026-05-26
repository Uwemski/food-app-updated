<div>
    <!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
     <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex overflow-x-auto hide-scrollbar gap-2 py-3">
      {{-- All --}}
      <a href="{{ route('menu') }}"
         class="cat-tab shrink-0 flex items-center gap-1.5 px-5 py-2 rounded-full font-body font-semibold text-sm
                transition-all duration-200 whitespace-nowrap shadow-card
                {{ !request('category') ? 'bg-gradient-to-r from-flame to-ember text-white shadow-btn' : 'bg-white border border-soft/40 text-muted hover:border-flame hover:text-flame hover:bg-flame/5' }}">
        🍽️ All
        <span class="text-[0.68rem] font-bold px-1.5 py-px rounded-full
                     {{ !request('category') ? 'bg-white/20' : 'bg-black/8' }}">
          {{ $totalProducts ?? '' }}
        </span>
      </a>

      {{-- Dynamic categories --}}
      @foreach($categories as $category)
        <a href="{{ route('menu', ['category' => $category->slug]) }}"
           class="cat-tab shrink-0 flex items-center gap-1.5 px-5 py-2 rounded-full font-body font-semibold text-sm
                  transition-all duration-200 whitespace-nowrap shadow-card
                  {{ request('category') == $category->slug
                       ? 'bg-gradient-to-r from-flame to-ember text-white shadow-btn'
                       : 'bg-white border border-soft/40 text-muted hover:border-flame hover:text-flame hover:bg-flame/5' }}">
          <span>{{ $category->icon ?? '🍴' }}</span>
          {{ $category->name }}
          <span class="text-[0.68rem] font-bold px-1.5 py-px rounded-full
                       {{ request('category') == $category->slug ? 'bg-white/20' : 'bg-black/8' }}">
            {{ count($category->product) ?? 0 }}
          </span>
        </a>
      @endforeach
    </div>
  </div>
</div>