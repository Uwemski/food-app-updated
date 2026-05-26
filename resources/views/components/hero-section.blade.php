<div class="relative rounded-3xl overflow-hidden
              bg-gradient-to-br from-[#2A1508] via-[#4A1F0D] to-[#6B2E14]
              min-h-[360px] lg:min-h-[420px]">

    {{-- Decorative glows --}}
    <div class="absolute -top-16 -right-16 w-72 h-72 rounded-full
                bg-amber/20 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/3 w-48 h-48 rounded-full
                bg-flame/15 blur-2xl pointer-events-none"></div>

    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-8
                items-center px-8 sm:px-12 lg:px-16 py-12 lg:py-16">

      {{-- Hero Text --}}
      <div class="animate-fade-up">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full
                    bg-gold/15 border border-gold/30 text-gold text-xs font-semibold
                    uppercase tracking-widest mb-5">
          ✨ &nbsp;{{ $heroBadge ?? 'Daily Special — Free Delivery' }}
        </div>
        <h1 class="font-display font-black text-white leading-[1.08] mb-4
                   text-[clamp(2rem,5vw,3.5rem)]">
          Crafted with
          <em class="text-gold not-italic">Fire</em>,<br>
          Served with
          <em class="text-gold not-italic">Soul</em>
        </h1>
        <p class="text-white/60 text-[0.95rem] leading-relaxed mb-8 max-w-md">
          {{ $heroDesc ?? 'Premium street food elevated — smoky, bold flavours made fresh to order. Pick up in 15 min or delivered hot to your door.' }}
        </p>
        <div class="flex flex-wrap gap-3">
          <a href="{{ route('menu') }}"
             class="inline-flex items-center gap-2 px-7 py-3 rounded-full font-body font-semibold
                    text-white bg-gradient-to-r from-flame to-amber
                    shadow-[0_6px_24px_rgba(232,68,10,0.5)]
                    hover:shadow-[0_10px_32px_rgba(232,68,10,0.6)] hover:-translate-y-0.5
                    transition-all duration-250 text-sm">
            Explore Menu 🍽️
          </a>
          <button class="inline-flex items-center gap-2 px-7 py-3 rounded-full font-body font-medium
                         text-white bg-white/8 border border-white/20 text-sm
                         hover:bg-white/14 transition-all duration-250">
            Watch Story ▶
          </button>
        </div>
      </div>

      {{-- Hero Visual --}}
      <div class="hidden lg:flex flex-col items-center justify-center relative animate-fade-in">
        <div class="w-[260px] h-[260px] rounded-full flex items-center justify-center
                    bg-gradient-radial from-[#FF9A5C] via-[#E8440A] to-[#8B2500]
                    animate-float text-[7rem] relative
                    shadow-[0_20px_60px_rgba(0,0,0,0.5),inset_0_-10px_30px_rgba(0,0,0,0.2)]"
             style="background:radial-gradient(circle at 35% 35%, #FF9A5C, #E8440A 60%, #8B2500)">
          🍕
          {{-- Shadow below plate --}}
          <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 w-4/5 h-5
                      rounded-full bg-black/30 blur-md"></div>
        </div>
        {{-- Stats row --}}
        <div class="absolute bottom-2 right-0 flex gap-2">
          @foreach([['4.9','Rating'],['12k+','Orders'],["15'",'Delivery']] as $stat)
            <div class="bg-white/8 backdrop-blur-sm border border-white/10 rounded-xl
                        px-3 py-2 text-center">
              <div class="font-display font-bold text-gold text-xl leading-none">{{ $stat[0] }}</div>
              <div class="text-white/50 text-[0.65rem] uppercase tracking-wider mt-0.5">{{ $stat[1] }}</div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>