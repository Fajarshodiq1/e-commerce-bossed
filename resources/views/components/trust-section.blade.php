@props([
    'testimonials' => [],
    'partners' => [],
])

<div id="testimonial-section" class="bg-gray-50/60 border-t border-gray-100 py-10 sm:py-16">
    <div class="max-w-7xl mx-auto px-0 sm:px-6 lg:px-8 space-y-10 sm:space-y-16">

        <!-- PART 1: TESTIMONIAL PELANGGAN -->
        <div>
            <div class="text-center max-w-xl mx-auto mb-6 sm:mb-10 px-4 sm:px-0">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 tracking-tight">Apa Kata Pelanggan Kami?</h2>
                <p class="text-xs text-gray-500 mt-1">Ulasan jujur dari pembeli yang telah bertransaksi dengan kami
                </p>
            </div>

            @if (count($testimonials) > 0)
                <!-- MOBILE: horizontal slider with scroll-snap -->
                <!-- DESKTOP (md+): reverts to a normal 3-column grid -->
                <div class="relative">
                    <div x-data="{
                        active: 0,
                        count: {{ count($testimonials) }},
                        scrollToSlide(i) {
                            const track = $refs.track;
                            const slide = track.children[i];
                            if (slide) track.scrollTo({ left: slide.offsetLeft - track.offsetLeft, behavior: 'smooth' });
                        },
                        onScroll() {
                            const track = $refs.track;
                            const slide = track.children[0];
                            if (!slide) return;
                            const slideWidth = slide.offsetWidth + 12;
                            this.active = Math.round(track.scrollLeft / slideWidth);
                        }
                    }">
                        <div x-ref="track" @scroll.passive="onScroll"
                            class="flex md:grid md:grid-cols-3 gap-3 sm:gap-6 overflow-x-auto md:overflow-visible snap-x snap-mandatory scroll-px-4 px-4 sm:px-0 pb-2 md:pb-0 no-scrollbar">
                            @foreach ($testimonials as $item)
                                <div
                                    class="snap-start shrink-0 w-[85%] xs:w-[80%] sm:w-[70%] md:w-auto bg-white p-5 sm:p-6 rounded-2xl border border-gray-200/80 shadow-sm flex flex-col justify-between">
                                    <div>
                                        <!-- Rating Bintang -->
                                        <div class="flex items-center gap-1 text-[#4e3027] mb-3">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= ($item->rating ?? 5) ? 'fill-current' : 'text-gray-200' }}"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>

                                        <!-- Isi Ulasan -->
                                        <p class="text-sm text-gray-600 italic leading-relaxed">
                                            "{{ $item->message }}"
                                        </p>
                                    </div>

                                    <!-- Info Pembeli -->
                                    <div class="mt-6 pt-4 border-t border-gray-100 flex items-center gap-3">
                                        <div
                                            class="w-9 h-9 rounded-full bg-[#f7f1ed] text-[#4e3027] font-bold flex items-center justify-center text-xs flex-shrink-0 border border-[#4e3027]/10">
                                            {{ strtoupper(substr($item->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h4 class="text-xs font-bold text-gray-800">{{ $item->name }}</h4>
                                            <p class="text-[10px] text-gray-400">Pembeli Terverifikasi</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Dots indicator: mobile only -->
                        @if (count($testimonials) > 1)
                            <div class="flex md:hidden items-center justify-center gap-1.5 mt-4">
                                <template x-for="i in count" :key="i">
                                    <button type="button" @click="scrollToSlide(i - 1)"
                                        :class="active === i - 1 ? 'w-5 bg-[#4e3027]' : 'w-1.5 bg-gray-300'"
                                        class="h-1.5 rounded-full transition-all duration-300"
                                        :aria-label="'Ke ulasan ' + i"></button>
                                </template>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="py-8 text-center text-xs text-gray-400">
                    Belum ada ulasan dari pelanggan.
                </div>
            @endif
        </div>

        <!-- PART 2: LOGO PARTNER / BRAND (OPTIONAL) -->
        @if (count($partners) > 0)
            <div class="pt-8 border-t border-gray-200/60 px-4 sm:px-0">
                <p class="text-center text-xs font-semibold text-gray-400 uppercase tracking-wider mb-6">
                    Bekerja Sama Dengan Brand & Partner Terpercaya
                </p>

                <!-- MOBILE: horizontal scroll strip; DESKTOP: wraps and centers -->
                <div
                    class="flex md:flex-wrap items-center justify-start md:justify-center gap-8 md:gap-12 overflow-x-auto md:overflow-visible no-scrollbar opacity-70 grayscale hover:grayscale-0 transition-all">
                    @foreach ($partners as $partner)
                        <div class="h-8 w-auto flex items-center justify-center flex-shrink-0">
                            @if ($partner->logo)
                                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                    class="h-full object-contain">
                            @else
                                <span
                                    class="text-sm font-bold text-gray-400 whitespace-nowrap">{{ $partner->name }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

<style>
    /* Sembunyikan scrollbar pada slider mobile, tapi scroll tetap berfungsi normal */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
