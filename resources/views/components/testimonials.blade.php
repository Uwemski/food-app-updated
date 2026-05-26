<section class="bg-gradient-to-br from-[#2A1508] via-[#3D1A08] to-[#5A2510] py-16">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full
                bg-gold/15 border border-gold/30 text-gold text-xs font-semibold
                uppercase tracking-widest mb-5">
      ❤️ &nbsp;Loved by thousands
    </div>
    <h2 class="font-display font-bold text-white text-[clamp(1.6rem,3.5vw,2.25rem)] mb-12">
      What our guests say
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
      @forelse($testimonials ?? [] as $t)
        <div class="bg-white/6 backdrop-blur-sm border border-white/10 rounded-2xl p-6 text-left">
          <div class="text-amber text-base mb-3">{{ str_repeat('★', $t->rating ?? 5) }}</div>
          <p class="text-white/75 text-sm leading-relaxed mb-4">"{{ $t->body }}"</p>
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-flame/30 flex items-center justify-center text-sm font-bold text-flame">
              {{ strtoupper(substr($t->name, 0, 1)) }}
            </div>
            <div>
              <div class="text-white font-semibold text-sm leading-none">{{ $t->name }}</div>
              <div class="text-white/40 text-xs mt-0.5">{{ $t->location ?? '' }}</div>
            </div>
          </div>
        </div>
      @empty
        {{-- Fallback static cards --}}
        @foreach([
          ['Amara O.','Lagos Island','Best jollof rice in town — smoky, rich and perfectly spiced. Delivered piping hot!',5],
          ['Chidi N.','Victoria Island','The lava cake is extraordinary. Add-to-cart was smooth and delivery was 12 minutes!',5],
          ['Fatima B.','Lekki','Every order feels premium. Packaging, taste, speed — everything is top tier.',5],
        ] as $r)
          <div class="bg-white/6 backdrop-blur-sm border border-white/10 rounded-2xl p-6 text-left">
            <div class="text-amber text-base mb-3">{{ str_repeat('★', $r[3]) }}</div>
            <p class="text-white/75 text-sm leading-relaxed mb-4">"{{ $r[2] }}"</p>
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-full bg-flame/30 flex items-center justify-center text-sm font-bold text-flame">
                {{ strtoupper(substr($r[0],0,1)) }}
              </div>
              <div>
                <div class="text-white font-semibold text-sm leading-none">{{ $r[0] }}</div>
                <div class="text-white/40 text-xs mt-0.5">{{ $r[1] }}</div>
              </div>
            </div>
          </div>
        @endforeach
      @endforelse
    </div>
  </div>
</section>