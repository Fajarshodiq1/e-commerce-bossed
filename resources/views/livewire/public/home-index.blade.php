<div>
    <!-- SECTION 1: HERO -->
    <x-hero-section :hero-image="$heroImage" :store-name="$storeName" :wa-number="$waNumber" />
    <x-about-section :store-name="$storeName ?? 'Bossed'" :about-image="$aboutImage ?? null" />
    @if ($productLineups->isNotEmpty())
        <section class="py-12 bg-white dark:bg-zinc-900 overflow-hidden border-y-2 border-[#4e3027] mt-3">
            <div class="relative w-full overflow-hidden">
                <!-- Gradient fade kiri & kanan -->
                <div
                    class="pointer-events-none absolute left-0 top-0 h-full w-16 md:w-32 z-10 bg-gradient-to-r from-white dark:from-zinc-900 to-transparent">
                </div>
                <div
                    class="pointer-events-none absolute right-0 top-0 h-full w-16 md:w-32 z-10 bg-gradient-to-l from-white dark:from-zinc-900 to-transparent">
                </div>

                {{-- JIKA MASIH LOADING (SKELETON STATE) --}}
                @if ($isLoading ?? false)
                    <div class="flex gap-6 w-max animate-pulse">
                        @for ($s = 0; $s < 8; $s++)
                            <div
                                class="relative flex-shrink-0 w-48 h-60 rounded-xl overflow-hidden bg-zinc-200 dark:bg-zinc-800 border border-zinc-300/50 dark:border-zinc-700/50 flex flex-col justify-end p-4">
                                {{-- Placeholder Teks Judul --}}
                                <div class="h-4 bg-zinc-300 dark:bg-zinc-700 rounded-md w-3/4 mb-2"></div>
                                {{-- Placeholder Teks Harga --}}
                                <div class="h-3 bg-zinc-300 dark:bg-zinc-700 rounded-md w-1/2"></div>
                            </div>
                        @endfor
                    </div>

                    {{-- JIKA DATA SUDAH SIAP (CONTENT STATE) --}}
                @else
                    <div class="marquee-track flex gap-6 w-max">
                        {{-- Loop 4 kali agar pergerakan marquee seamless tanpa celah --}}
                        @for ($i = 0; $i < 4; $i++)
                            @foreach ($productLineups as $item)
                                <div class="group relative flex-shrink-0 w-48 h-60 rounded-xl overflow-hidden border border-zinc-200 dark:border-zinc-700 shadow-sm bg-zinc-100 dark:bg-zinc-800"
                                    @if ($i > 0) aria-hidden="true" @endif>

                                    {{-- Gambar Produk Full Card --}}
                                    @if ($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}"
                                            alt="{{ $i === 0 ? $item->name : '' }}"
                                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                            width="192" height="240" loading="lazy" />
                                    @else
                                        <div
                                            class="w-full h-full bg-zinc-200 dark:bg-zinc-800 flex items-center justify-center text-zinc-400 text-xs">
                                            No Image
                                        </div>
                                    @endif

                                    {{-- Overlay Teks Saat Hover --}}
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4 text-white">
                                        <div class="font-medium text-sm text-white truncate drop-shadow-sm">
                                            {{ $item->name }}
                                        </div>
                                        @if ($item->price)
                                            <div class="text-xs text-zinc-200 mt-1 font-semibold drop-shadow-sm">
                                                Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            @endforeach
                        @endfor
                    </div>
                @endif
            </div>
        </section>

        <style>
            .marquee-track {
                display: flex;
                width: max-content;
                will-change: transform;
                animation: marquee-scroll 15s linear infinite;
                transform: translate3d(0, 0, 0);
                backface-visibility: hidden;
                -webkit-backface-visibility: hidden;
            }

            .marquee-track:hover {
                animation-play-state: paused;
            }

            @keyframes marquee-scroll {
                0% {
                    transform: translate3d(0, 0, 0);
                }

                100% {
                    transform: translate3d(calc(-25% - 0.375rem), 0, 0);
                }
            }
        </style>
    @endif
    <x-why-us-section />
    <!-- SECTION 2: KATEGORI POPULER -->
    <x-category-section :categories="$categories" :selectedCategory="$selectedCategory" />

    <!-- SECTION 3: KATALOG PRODUK -->
    <x-product-section :products="$products" :selectedCategory="$selectedCategory" :search="$search" :sort="$sort" />

    <!-- SECTION 4: TESTIMONIAL -->
    <x-trust-section :testimonials="$testimonials" />

    <x-faq-section />
</div>
