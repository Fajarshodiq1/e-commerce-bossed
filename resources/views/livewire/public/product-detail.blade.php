<div>
    <!-- Schema.org Structured Data untuk Google Search -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org/',
        '@type' => 'Product',
        'name' => $product->name,
        'image' => [
            $activeImage ? asset('storage/' . $activeImage) : asset('images/default-og.jpg')
        ],
        'description' => \Illuminate\Support\Str::limit(strip_tags($product->description), 200),
        'sku' => (string) $product->id,
        'offers' => [
            '@type' => 'Offer',
            'url' => url()->current(),
            'priceCurrency' => 'IDR',
            'price' => (string) $product->price,
            'itemCondition' => 'https://schema.org/NewCondition',
            'availability' => 'https://schema.org/InStock'
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>

    @php
        // Ambil nomor WA dari Composer/WebSetting dan bersihkan formatnya
        $rawWa = $whatsappNumber ?? \App\Models\WebSetting::getByKey('whatsapp_number');
        $waDigits = filled($rawWa) ? preg_replace('/[^0-9]/', '', $rawWa) : null;

        $waMessage =
            'Halo, saya tertarik dengan produk ' .
            $product->name .
            ' (Rp ' .
            number_format($product->price, 0, ',', '.') .
            '). Boleh minta informasi lebih detail?';
        $dynamicWaUrl = $waDigits ? "https://wa.me/{$waDigits}?text=" . urlencode($waMessage) : $waUrl ?? '#';
    @endphp

    <div class="py-6 sm:py-10 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 sm:space-y-12">

            <!-- Breadcrumb -->
            <nav
                class="flex items-center gap-1.5 sm:gap-2 text-[11px] sm:text-xs text-gray-500 overflow-x-auto whitespace-nowrap pb-1 scrollbar-none">
                <a href="{{ route('home') }}" class="hover:text-[#4e3027] transition flex-shrink-0">Beranda</a>
                <span class="flex-shrink-0">/</span>
                @if ($product->category)
                    <span class="text-gray-500 flex-shrink-0">{{ $product->category->name }}</span>
                    <span class="flex-shrink-0">/</span>
                @endif
                <span class="text-gray-900 font-medium truncate max-w-[160px] sm:max-w-none">{{ $product->name }}</span>
            </nav>

            <!-- Main Detail Card -->
            <div class="bg-white rounded-2xl border border-gray-100 p-4 sm:p-8 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-10 items-start">

                    <!-- Col Left: Galeri Gambar Produk -->
                    <div class="md:col-span-5 space-y-3 mx-auto w-full max-w-md">
                        <div
                            class="aspect-[4/3] sm:aspect-square bg-gray-50 rounded-xl overflow-hidden border border-gray-100 relative">
                            @if ($activeImage)
                                <img src="{{ asset('storage/' . $activeImage) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex flex-col items-center justify-center text-gray-400 text-xs gap-1.5">
                                    <svg class="w-8 h-8 stroke-current" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>Tidak ada gambar</span>
                                </div>
                            @endif
                        </div>

                        <!-- Thumbnails Carousel -->
                        @if ($product->images && $product->images->count() > 1)
                            <div class="flex items-center gap-2.5 overflow-x-auto pb-1 scrollbar-none">
                                @foreach ($product->images as $img)
                                    <button type="button" wire:click="setActiveImage('{{ $img->image_path }}')"
                                        class="w-16 h-16 sm:w-14 sm:h-14 rounded-lg overflow-hidden border transition shrink-0 {{ $activeImage === $img->image_path ? 'border-[#4e3027] ring-2 ring-[#4e3027]/10' : 'border-gray-200 opacity-60 hover:opacity-100' }}">
                                        <img src="{{ asset('storage/' . $img->image_path) }}" alt="Thumbnail"
                                            class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Col Right: Detail & Informasi -->
                    <div class="md:col-span-7 flex flex-col justify-between h-full space-y-5 sm:space-y-6">
                        <div class="space-y-3 sm:space-y-4">
                            @if ($product->category)
                                <span
                                    class="inline-block bg-[#f7f1ed] text-[#4e3027] text-[11px] font-semibold tracking-wider uppercase px-2.5 py-0.5 rounded-md">
                                    {{ $product->category->name }}
                                </span>
                            @endif

                            <h1 class="text-lg sm:text-2xl font-bold text-gray-900 leading-snug">
                                {{ $product->name }}
                            </h1>

                            <div class="text-xl sm:text-2xl font-extrabold text-[#4e3027]">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>

                            <div class="pt-3 sm:pt-4 border-t border-gray-100 space-y-2">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400">Deskripsi Produk
                                </h3>
                                <div class="text-xs sm:text-sm text-gray-600 leading-relaxed space-y-2">
                                    {!! nl2br(e($product->description)) !!}
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="pt-2 sm:pt-4">
                            <a href="{{ $dynamicWaUrl }}" target="_blank" rel="noopener noreferrer"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 bg-green-500 hover:bg-green-600 active:bg-green-700 text-white font-semibold py-3.5 px-6 rounded-xl transition text-sm"
                                style="min-height:50px;">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.87 9.87 0 004.74 1.21h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0012.04 2zm5.8 14.06c-.24.68-1.4 1.3-1.93 1.38-.5.08-1.12.11-1.8-.11-.42-.13-.95-.31-1.64-.61-2.88-1.24-4.76-4.15-4.9-4.34-.14-.19-1.17-1.56-1.17-2.97 0-1.42.74-2.11 1-2.4.26-.28.57-.35.76-.35.19 0 .38 0 .55.01.18.01.41-.07.64.49.24.58.81 2 .88 2.15.07.14.12.31.02.5-.09.19-.14.31-.28.48-.14.16-.29.36-.42.49-.14.14-.28.29-.12.57.16.28.71 1.17 1.53 1.9 1.05.94 1.94 1.23 2.22 1.37.28.14.44.12.61-.07.16-.19.69-.81.88-1.09.19-.28.37-.23.62-.14.26.09 1.63.77 1.91.91.28.14.47.21.53.33.07.12.07.68-.17 1.36z">
                                    </path>
                                </svg>
                                <span>Beli Sekarang via WhatsApp</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Section: Produk Terkait -->
            @if ($relatedProducts->count() > 0)
                <div class="space-y-4 sm:space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-base sm:text-lg font-bold text-gray-900">Produk Serupa</h2>
                            <p class="text-[11px] sm:text-xs text-gray-500">Pilihan produk lainnya di kategori
                                {{ $product->category->name ?? '' }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                        @foreach ($relatedProducts as $item)
                            <a href="{{ route('product.detail', $item->slug) }}"
                                class="group bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md active:shadow-sm transition duration-200 flex flex-col justify-between">
                                <div>
                                    <div class="aspect-[4/3] bg-gray-50 overflow-hidden relative">
                                        @if ($item->primaryImage)
                                            <img src="{{ asset('storage/' . $item->primaryImage->image_path) }}"
                                                alt="{{ $item->name }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center text-gray-300 text-xs">
                                                No Image
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-2.5 sm:p-3.5 space-y-1">
                                        <h3
                                            class="text-xs sm:text-sm font-semibold text-gray-800 group-hover:text-[#4e3027] transition line-clamp-1">
                                            {{ $item->name }}
                                        </h3>
                                        <p class="text-xs sm:text-sm font-bold text-[#4e3027]">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
            <livewire:public.product-reviews :product="$product" :key="'reviews-' . $product->id" />

        </div>
    </div>
</div>
