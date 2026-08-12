@props([
    'products' => [],
    'selectedCategory' => '',
    'search' => '',
    'sort' => 'latest',
])

<section class="py-6 sm:py-12">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

        <!-- Header Section & Control Bar (Statis - Tidak Terkena Skeleton) -->
        <div class="mb-6 pb-5 border-b border-gray-100">
            <div class="flex items-center justify-between gap-3 mb-1">

                <div class="flex flex-col gap-1 text-left">
                    <h2 class="text-2xl lg:text-3xl font-bold lg:font-extrabold text-gray-900 tracking-tight">
                        Katalog Produk
                    </h2>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        @if ($search)
                            Menampilkan hasil pencarian untuk
                            "<span class="font-semibold text-gray-800">{{ $search }}</span>"
                        @elseif($selectedCategory)
                            Menampilkan produk dalam kategori terpilih
                        @else
                            Jelajahi seluruh koleksi produk pilihan kami
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- 1. REAL CONTENT (Disembunyikan saat Livewire sedang loading data) -->
        <div wire:loading.remove wire:target="search, selectedCategory, sort, gotoPage, previousPage, nextPage">
            <!-- Grid Produk -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-6">
                @forelse($products as $product)
                    <div
                        class="group bg-white rounded-2xl border border-gray-200 overflow-hidden active:border-primary active:shadow-md sm:hover:border-primary sm:hover:shadow-md transition-all duration-200 flex flex-col justify-between">

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
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span class="text-[10px] text-gray-400">No Image</span>
                                    </div>
                                @endif

                                <!-- Badge Kategori Over Image -->
                                @if ($product->category)
                                    <span
                                        class="absolute top-2 left-2 sm:top-2.5 sm:left-2.5 bg-white/90 backdrop-blur-md text-gray-700 text-[9px] sm:text-[10px] font-semibold px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-full shadow-sm border border-gray-100">
                                        {{ $product->category->name }}
                                    </span>
                                @endif
                            </a>

                            <!-- Detail Produk -->
                            <div class="p-3 sm:p-4">
                                <h3
                                    class="font-semibold text-gray-800 text-[13px] sm:text-sm line-clamp-2 sm:group-hover:text-primary transition-colors leading-snug min-h-[2.4em]">
                                    <a href="{{ route('product.detail', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                            </div>
                        </div>

                        <!-- Footer Card: Tombol Detail -->
                        <div
                            class="px-3 pb-3 pt-1 sm:px-4 sm:pb-4 flex items-center justify-end border-t border-gray-50 mt-auto">
                            <a href="{{ route('product.detail', $product->slug) }}"
                                class="w-full bg-primary-light active:bg-primary active:text-white sm:hover:bg-primary sm:hover:text-white text-primary px-3 py-2 sm:py-2.5 rounded-xl transition-colors duration-200 flex items-center justify-center gap-1.5 text-xs font-semibold min-h-[38px]"
                                title="Lihat Detail Produk">
                                <span>Lihat Detail</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>

                    </div>
                @empty
                    <!-- Empty State -->
                    <div
                        class="col-span-full py-12 sm:py-16 px-4 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-300 mx-auto mb-3" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                            </path>
                        </svg>
                        <p class="text-sm font-semibold text-gray-700">Produk Tidak Ditemukan</p>
                        <p class="text-xs text-gray-400 mt-1 max-w-sm mx-auto leading-relaxed">
                            Maaf, tidak ada produk yang cocok dengan pencarian atau filter yang Anda pilih.
                        </p>

                        @if ($search || $selectedCategory)
                            <button type="button" wire:click="$set('search', ''); $set('selectedCategory', '')"
                                class="mt-4 inline-flex items-center gap-1.5 px-5 py-3 sm:px-4 sm:py-2 bg-primary text-white rounded-xl text-xs font-semibold active:opacity-90 sm:hover:opacity-90 transition min-h-[44px] sm:min-h-0">
                                Reset Filter & Pencarian
                            </button>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination Livewire -->
            <div class="mt-8 sm:mt-10 [&_span]:text-xs [&_a]:text-xs [&_a]:min-h-[40px] [&_a]:flex [&_a]:items-center">
                {{ $products->links() }}
            </div>
        </div>

        <!-- 2. SKELETON LOADING STATE (Ditampilkan saat proses request data berlangsung) -->
        <div wire:loading wire:target="search, selectedCategory, sort, gotoPage, previousPage, nextPage" class="w-full">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-6 animate-pulse">
                @for ($i = 0; $i < 8; $i++)
                    <div
                        class="bg-white rounded-2xl border border-gray-200 overflow-hidden flex flex-col justify-between p-0">
                        <div>
                            <!-- Skeleton Gambar -->
                            <div class="aspect-square bg-gray-200 w-full"></div>

                            <!-- Skeleton Judul -->
                            <div class="p-3 sm:p-4 space-y-2">
                                <div class="h-3.5 bg-gray-200 rounded w-full"></div>
                                <div class="h-3.5 bg-gray-200 rounded w-2/3"></div>
                            </div>
                        </div>

                        <!-- Skeleton Footer Card -->
                        <div
                            class="px-3 pb-3 pt-1 sm:px-4 sm:pb-4 flex items-center justify-end border-t border-gray-50 mt-auto">
                            <div class="h-[38px] bg-gray-200 rounded-xl w-full"></div>
                        </div>
                    </div>
                @endfor
            </div>

            <!-- Skeleton Pagination -->
            <div class="mt-8 sm:mt-10 flex items-center justify-center gap-2 animate-pulse">
                <div class="h-9 w-20 bg-gray-200 rounded-lg"></div>
                <div class="h-9 w-9 bg-gray-200 rounded-lg"></div>
                <div class="h-9 w-9 bg-gray-200 rounded-lg"></div>
                <div class="h-9 w-20 bg-gray-200 rounded-lg"></div>
            </div>
        </div>

    </div>
</section>
