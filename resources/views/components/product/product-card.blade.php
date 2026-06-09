<div>
    <!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Maria Skłodowska-Curie -->
     {{-- Card Image --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-[#FDE8DC] to-[#F9C6AE]"
               style="padding-top:65%">
            <div class="absolute inset-0 flex items-center justify-center">
              @if($product->image)
                <img src="{{ $product->image}}"
                     alt="{{ $product->name }}"
                     class="card-img-zoom w-full h-full object-cover">
              @else
                <span class="card-img-zoom text-[4rem] sm:text-[5rem]
                             transition-transform duration-400 select-none
                             hover:rotate-[-3deg]">
                  {{ $product->emoji ?? '🍽️' }}
                </span>
              @endif
            </div>

            {{-- Sold-out overlay --}}
            @if($product->is_sold_out)
              <div class="absolute inset-0 bg-charcoal/50 flex items-center justify-center">
                <span class="bg-charcoal/75 text-white/80 text-xs font-bold uppercase
                             tracking-widest px-3 py-1.5 rounded-full">
                  Sold Out
                </span>
              </div>
            @endif

            {{-- Badge --}}
            @if($product->badge && !$product->is_sold_out)
              <span class="absolute top-3 left-3 text-[0.68rem] font-bold uppercase tracking-wide
                           px-2.5 py-1 rounded-full
                           @switch($product->badge)
                             @case('hot') bg-flame text-white @break
                             @case('new') bg-amber text-brown @break
                             @case('deal') bg-emerald-500 text-white @break
                             @default bg-charcoal/70 text-white/80
                           @endswitch">
                @switch($product->badge)
                  @case('hot') 🔥 Hot @break
                  @case('new') ✨ New @break
                  @case('deal') 💰 Deal @break
                  @default {{ $product->badge }}
                @endswitch
              </span>
            @endif

            {{-- Discount % badge --}}
            @if($product->original_price && $product->original_price > $product->price)
              <span class="absolute top-3 right-3 bg-emerald-500 text-white text-[0.65rem]
                           font-bold px-2 py-0.5 rounded-full">
                -{{ round((1 - $product->price / $product->original_price) * 100) }}%
              </span>
            @endif

            {{-- Wishlist btn --}}
            <button data-product-id="{{ $product->id }}"
                    onclick="toggleWishlist(this)"
                    class="wishlist-btn absolute top-3 right-3 w-8 h-8 rounded-full
                           bg-white/90 shadow-sm flex items-center justify-center text-sm
                           opacity-0 group-hover:opacity-100 scale-90 group-hover:scale-100
                           transition-all duration-200 hover:bg-white hover:scale-110
                           {{ $product->is_sold_out ? 'right-3' : ($product->original_price ? 'right-10' : 'right-3') }}"
                    aria-label="Add to wishlist">
              🤍
            </button>
          </div>

          {{-- Card Body --}}
          
          <div class="flex flex-col flex-1 p-4">
            {{-- Meta row --}}
            <div class="flex items-center justify-between mb-2">
              <span class="text-flame text-[0.7rem] font-bold uppercase tracking-wider">
                {{ $product->category->name ?? 'Uncategorized' }}
              </span>
              <div class="flex items-center gap-1 text-[0.75rem] text-muted font-medium">
                <span class="text-amber text-xs">★</span>
                {{ number_format($product->rating ?? 4.5, 1) }}
                <span class="text-soft">({{ $product->reviews_count ?? 0 }})</span>
              </div>
            </div>

            {{-- Name --}}
            <h3 class="font-display font-bold text-charcoal leading-tight mb-1.5
                       text-[0.95rem] sm:text-[1.05rem] line-clamp-2">
              {{ $product->name }}
            </h3>

            {{-- Description --}}
            <p class="text-muted text-xs sm:text-[0.8rem] leading-relaxed mb-4 flex-1 line-clamp-2">
              {{ $product->description }}
            </p>
            <p class="text-muted text-xs sm:text-[0.8rem] leading-relaxed mb-4">
              {{$product->quantity}} left
            </p>

            {{-- Footer: price + add btn --}}
            <div class="flex items-center justify-between gap-2 mt-auto">
              <div>
                @if($product->original_price && $product->original_price > $product->price)
                  <div class="text-soft line-through text-xs leading-none mb-0.5">
                    ₦{{ number_format($product->original_price) }}
                  </div>
                @endif
                <div class="font-display font-bold leading-none
                            text-[1.1rem] sm:text-[1.2rem]
                            {{ ($product->original_price && $product->original_price > $product->price) ? 'text-ember' : 'text-charcoal' }}">
                  ₦{{ number_format($product->price) }}
                </div>
              </div>

              @if($product->is_sold_out)
                <button disabled
                        class="px-3 py-2 rounded-full bg-soft/25 text-muted font-semibold
                               text-xs cursor-not-allowed shrink-0">
                  ✕ Sold Out
                </button>
              @else
              <!-- decide if you want to pass the product ID in the route or as a hidden input in the form -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="shrink-0">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit"
                          class="btn-add flex items-center gap-1.5 px-3 py-2 rounded-full
                                 bg-gradient-to-r from-flame to-ember text-white font-body
                                 font-semibold text-xs shadow-btn shrink-0">
                    <span class="text-sm leading-none">＋</span> Add
                  </button>
                </form>
              @endif
            </div>
        </div>
</div>