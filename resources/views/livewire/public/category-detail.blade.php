<div class="bg-gray-50/50 py-8 sm:py-10 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb Navigasi -->
        <nav class="flex text-xs text-gray-500 mb-5 sm:mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1.5 sm:space-x-2">
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center gap-1 text-gray-500 active:text-[#4e3027] sm:hover:text-[#4e3027] transition-colors">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="hidden sm:inline">Beranda</span>
                    </a>
                </li>
                <li class="text-gray-300">/</li>
                <li class="text-gray-400">Kategori</li>
                <li class="text-gray-300">/</li>
                <li class="font-semibold text-gray-800 truncate max-w-[120px] sm:max-w-none">
                    {{ $category->name }}
                </li>
            </ol>
        </nav>

        <!-- Header Deskripsi Kategori -->
        <div class="bg-white rounded-2xl p-5 sm:p-8 border border-gray-200/80 shadow-sm mb-6 sm:mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-5 sm:gap-6">

                <div class="space-y-2.5 max-w-3xl">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#f7f1ed] text-[#4e3027] border border-[#4e3027]/10 text-[11px] sm:text-xs font-semibold">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Kategori Produk
                        </span>

                        <span
                            class="inline-flex items-center px-2.5 py-1 rounded-full bg-gray-50 text-gray-500 text-[11px] font-semibold border border-gray-100">
                            {{ $products->total() }} Produk
                        </span>
                    </div>

                    <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 tracking-tight leading-tight">
                        {{ $category->name }}
                    </h1>

                    <p class="text-xs sm:text-sm text-gray-500 leading-relaxed">
                        {{ $category->description ?: 'Temukan pilihan produk terbaik untuk kategori ' . $category->name . ' di toko kami.' }}
                    </p>
                </div>

                <!-- Input Pencarian Produk di Kategori Ini -->
                <div class="w-full md:w-72 flex-shrink-0">
                    <label for="search-category-product" class="sr-only">Cari produk</label>
                    <div class="relative">
                        <input type="text" id="search-category-product" wire:model.live.debounce.300ms="search"
                            placeholder="Cari di kategori ini..."
                            class="w-full bg-gray-50 border border-gray-200 text-sm sm:text-xs text-gray-800 rounded-xl pl-10 pr-9 py-3 sm:py-2.5 min-h-[44px] sm:min-h-0 focus:ring-2 focus:ring-[#4e3027]/20 focus:border-[#4e3027] outline-none transition placeholder:text-gray-400">

                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

                        @if (!empty($search))
                            <button wire:click="$set('search', '')" type="button"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 active:text-gray-600 sm:hover:text-gray-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        @endif
                    </div>

                    @if (!empty($search))
                        <p class="text-[11px] text-gray-400 mt-1.5 pl-1">
                            Hasil untuk "<span class="font-semibold text-gray-600">{{ $search }}</span>"
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- SKELETON LOADING GRID (Tampil saat proses pencarian) -->
        <div wire:loading wire:target="search" class="w-full">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                @for ($i = 0; $i < 8; $i++)
                    <div
                        class="bg-white rounded-2xl border border-gray-100 overflow-hidden p-3 sm:p-4 animate-pulse space-y-3">
                        <div class="w-full aspect-square bg-gray-200 rounded-xl"></div>
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                        <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                        <div class="pt-2 flex justify-between items-center">
                            <div class="h-4 bg-gray-200 rounded w-1/3"></div>
                            <div class="w-8 h-8 bg-gray-200 rounded-xl"></div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- LIST PRODUK -->
        <div wire:loading.remove wire:target="search">
            @if ($products->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                    @foreach ($products as $product)
                        <div wire:key="category-product-{{ $product->id }}"
                            class="group bg-white rounded-2xl border border-gray-200 overflow-hidden active:border-[#4e3027] active:shadow-md sm:hover:border-[#4e3027] sm:hover:shadow-md transition-all duration-200 flex flex-col justify-between">

                            <div>
                                <!-- Gambar Produk -->
                                <a href="{{ route('product.detail', $product->slug) }}"
                                    class="block relative aspect-square overflow-hidden bg-gray-50">
                                    @if ($product->primaryImage)
                                        <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}"
                                            alt="{{ $product->name }}" loading="lazy"
                                            class="w-full h-full object-cover sm:group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div
                                            class="w-full h-full flex flex-col items-center justify-center text-gray-300 gap-1">
                                            <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-[10px] text-gray-400">No Image</span>
                                        </div>
                                    @endif
                                </a>

                                <!-- Detail Produk -->
                                <div class="p-3 sm:p-4">
                                    <h2
                                        class="font-semibold text-gray-800 text-[13px] sm:text-sm line-clamp-2 sm:group-hover:text-[#4e3027] transition-colors leading-snug min-h-[2.4em]">
                                        <a href="{{ route('product.detail', $product->slug) }}">
                                            {{ $product->name }}
                                        </a>
                                    </h2>
                                </div>
                            </div>

                            <!-- Footer Card: Harga & Tombol Detail -->
                            <div
                                class="px-3 pb-3 pt-1 sm:px-4 sm:pb-4 flex items-center justify-between border-t border-gray-50 mt-auto gap-2">
                                <div class="min-w-0">
                                    <span class="text-[10px] text-gray-400 block font-medium">Harga</span>
                                    <span class="font-bold text-gray-900 text-sm sm:text-base whitespace-nowrap">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>

                                <a href="{{ route('product.detail', $product->slug) }}"
                                    class="bg-[#f7f1ed] text-[#4e3027] border border-[#4e3027]/10 active:bg-[#4e3027] active:text-white sm:hover:bg-[#4e3027] sm:hover:text-white p-2.5 rounded-xl transition-colors duration-200 flex items-center justify-center min-w-[40px] min-h-[40px] flex-shrink-0"
                                    title="Lihat Detail Produk">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div
                    class="mt-8 sm:mt-10 [&_span]:text-xs [&_a]:text-xs [&_a]:min-h-[40px] [&_a]:flex [&_a]:items-center">
                    {{ $products->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div
                    class="py-12 sm:py-16 px-4 text-center bg-white rounded-2xl border border-dashed border-gray-200 flex flex-col items-center justify-center">
                    <div
                        class="w-12 h-12 bg-[#f7f1ed] rounded-full flex items-center justify-center mb-3 border border-[#4e3027]/10">
                        <svg class="w-6 h-6 text-[#4e3027]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h2 class="text-sm font-bold text-gray-800">Tidak ada produk ditemukan</h2>
                    <p class="text-xs text-gray-500 mt-1 max-w-sm leading-relaxed">
                        @if (!empty($search))
                            Tidak dapat menemukan produk dengan kata kunci
                            "<span class="font-semibold text-gray-700">{{ $search }}</span>".
                        @else
                            Belum ada produk yang tersedia untuk kategori {{ $category->name }}.
                        @endif
                    </p>
                    @if (!empty($search))
                        <button wire:click="$set('search', '')" type="button"
                            class="mt-4 inline-flex items-center gap-1.5 px-5 py-3 sm:px-4 sm:py-2 bg-[#4e3027] text-white rounded-xl text-xs font-semibold active:bg-[#3d251f] sm:hover:bg-[#3d251f] transition min-h-[44px] sm:min-h-0">
                            Bersihkan Pencarian
                        </button>
                    @endif
                </div>
            @endif
        </div>

    </div>
</div>
