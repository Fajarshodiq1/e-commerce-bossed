@php
    $categoriesMenu = \App\Models\Category::with([
        'products' => function ($q) {
            $q->where('is_active', true)->latest()->take(6);
        },
    ])->get();

    $getWaNumber = $whatsappNumber ?? \App\Models\WebSetting::getByKey('whatsapp_number');

    $waNumber = filled($getWaNumber) ? preg_replace('/[^0-9]/', '', $getWaNumber) : null;

    $waMessage = 'Halo, saya ingin bertanya tentang produk di BOOSED.';
@endphp
<header x-data="{ mobileMenuOpen: false, megaMenuOpen: false, activeCat: '{{ $categoriesMenu->first()->id ?? 0 }}' }" class="bg-white border-b sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- 1. Logo / Nama Toko -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}"
                    class="font-bold text-xl md:text-2xl tracking-tight text-[var(--color-primary)] hover:opacity-80 transition flex items-center gap-2">
                    <img src="{{ asset('assets/BOOSED_LOGO.png') }}" alt="" class="h-10 md:h-14">
                </a>
            </div>

            <!-- 2. Navigasi Desktop dengan Mega Dropdown -->
            <nav class="hidden lg:flex items-center space-x-8 text-sm font-medium text-gray-700">

                <!-- Link Beranda -->
                <a href="{{ route('home') }}" class="hover:text-primary transition flex items-center gap-1.5 py-5">
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-primary" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('public.about') }}"
                    class="group flex items-center gap-1.5 py-5 px-3 text-sm font-semibold transition duration-200">
                    <svg class="w-4 h-4 transition duration-200" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <span>Tentang Kami</span>
                </a>
                <!-- MEGA MENU DROPDOWN ITEM (Kategori & Produk) -->
                <div class="relative py-5" @mouseenter="megaMenuOpen = true" @mouseleave="megaMenuOpen = false">

                    <button
                        class="flex items-center gap-1.5 hover:text-primary transition focus:outline-none py-2 font-medium">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span>Kategori & Produk</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': megaMenuOpen }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- MEGA DROPDOWN PANEL -->
                    <div x-show="megaMenuOpen" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2" x-cloak
                        class="absolute left-1/2 -translate-x-1/2 top-full w-[850px] bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-50">

                        <div class="grid grid-cols-12 min-h-[400px] max-h-[500px]">

                            <!-- KOLOM KIRI: Daftar Kategori (Hoverable & Clickable) -->
                            <div
                                class="col-span-4 bg-gray-50/80 border-r border-gray-100 p-4 space-y-1 overflow-y-auto max-h-[500px] custom-scrollbar">
                                <p
                                    class="text-[11px] font-bold uppercase tracking-wider text-gray-400 px-3 mb-2 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 11h.01M7 15h.01M11 7h8M11 11h8M11 15h8"></path>
                                    </svg>
                                    Pilih Kategori
                                </p>

                                @forelse($categoriesMenu as $cat)
                                    <a href="{{ route('category.detail', $cat->slug) }}"
                                        @mouseenter="activeCat = '{{ $cat->id }}'"
                                        :class="activeCat == '{{ $cat->id }}' ?
                                            'bg-[var(--color-primary)] text-white font-semibold shadow-sm' :
                                            'text-gray-700 hover:bg-gray-200/60'"
                                        class="w-full text-left px-3 py-2.5 rounded-xl text-sm flex items-center justify-between transition-all duration-150 group">
                                        <div class="flex items-center gap-2.5 truncate">
                                            <svg class="w-4 h-4 opacity-70 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            <span class="truncate">{{ $cat->name }}</span>
                                        </div>
                                        <svg class="w-4 h-4 opacity-70 flex-shrink-0 transition-transform duration-150 group-hover:translate-x-0.5"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @empty
                                    <div class="p-3 text-xs text-gray-400 text-center">Belum ada kategori.</div>
                                @endforelse
                            </div>

                            <!-- KOLOM KANAN: Daftar Produk berdasarkan Hover Kategori -->
                            <div
                                class="col-span-8 p-6 bg-white flex flex-col justify-between overflow-y-auto max-h-[500px]">
                                <div>
                                    @foreach ($categoriesMenu as $cat)
                                        <div x-show="activeCat == '{{ $cat->id }}'"
                                            x-transition:enter="transition ease-out duration-150"
                                            x-transition:enter-start="opacity-0 scale-98"
                                            x-transition:enter-end="opacity-100 scale-100" x-cloak class="space-y-4">

                                            <!-- Header Panel Right -->
                                            <div
                                                class="flex items-center justify-between border-b border-gray-100 pb-3">
                                                <h4 class="font-bold text-gray-800 text-base flex items-center gap-2">
                                                    <svg class="w-5 h-5 text-[var(--color-primary)]" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                        </path>
                                                    </svg>
                                                    <span>{{ $cat->name }}</span>
                                                    <span
                                                        class="text-xs font-normal text-gray-400">({{ $cat->products->count() }}
                                                        Produk)</span>
                                                </h4>
                                                <a href="{{ route('category.detail', $cat->slug) }}"
                                                    class="text-xs text-[var(--color-primary)] font-semibold hover:underline flex items-center gap-1 group">
                                                    <span>Lihat Halaman Kategori</span>
                                                    <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-0.5"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                    </svg>
                                                </a>
                                            </div>

                                            <!-- Grid Produk (Maksimal 6 Produk) -->
                                            <div class="grid grid-cols-3 gap-3">
                                                @forelse($cat->products->take(6) as $product)
                                                    <a href="{{ route('product.detail', $product->slug) }}"
                                                        class="group border border-gray-200 rounded-xl p-2.5 hover:border-[var(--color-primary)] hover:shadow-md transition duration-200 bg-white flex flex-col justify-between">
                                                        <div>
                                                            <div
                                                                class="aspect-square rounded-lg overflow-hidden bg-gray-50 mb-2 relative">
                                                                @if ($product->primaryImage)
                                                                    <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}"
                                                                        alt="{{ $product->name }}" loading="lazy"
                                                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                                                @else
                                                                    <div
                                                                        class="w-full h-full flex items-center justify-center text-[10px] text-gray-400 flex-col gap-1">
                                                                        <svg class="w-5 h-5 text-gray-300"
                                                                            fill="none" stroke="currentColor"
                                                                            viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                stroke-width="1.5"
                                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                            </path>
                                                                        </svg>
                                                                        <span>No Image</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <h5
                                                                class="text-xs font-semibold text-gray-800 group-hover:text-primary line-clamp-2 transition leading-snug">
                                                                {{ $product->name }}
                                                            </h5>
                                                        </div>
                                                        <p class="text-xs font-bold text-[var(--color-primary)] mt-2">
                                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                                        </p>
                                                    </a>
                                                @empty
                                                    <div
                                                        class="col-span-3 py-12 text-center text-xs text-gray-400 flex flex-col items-center justify-center gap-2">
                                                        <svg class="w-8 h-8 text-gray-300" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                            </path>
                                                        </svg>
                                                        <span>Belum ada produk di kategori ini.</span>
                                                    </div>
                                                @endforelse
                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                                <!-- Footer Link -->
                                <div class="mt-4 pt-3 border-t border-gray-100 text-right">
                                    <a href="{{ route('home') }}"
                                        class="text-xs text-gray-500 hover:text-primary transition inline-flex items-center gap-1 font-medium group">
                                        <span>Lihat Seluruh Katalog Produk</span>
                                        <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-0.5"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Link Testimonial -->
                <a href="{{ route('artikel.index') }}"
                    class="hover:text-primary transition flex items-center gap-1.5 py-5 font-medium {{ request()->routeIs('artikel*') ? 'text-primary' : '' }}">
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-primary {{ request()->routeIs('artikel*') ? 'text-primary' : '' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                        </path>
                    </svg>
                    <span>Artikel</span>
                </a>

                <a href="{{ route('testimonials') }}"
                    class="hover:text-primary transition flex items-center gap-1.5 py-5 font-medium {{ request()->routeIs('testimonials*') ? 'text-primary' : '' }}">
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-primary {{ request()->routeIs('testimonials*') ? 'text-primary' : '' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    <span>Gallery & Testimonial</span>
                </a>
            </nav>

            <!-- 3. Kanan: WhatsApp CTA (desktop) + Admin Quick Access + Hamburger -->
            <div class="flex items-center space-x-2 md:space-x-3">

                @if ($waNumber)
                    <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($waMessage) }}" target="_blank"
                        rel="noopener noreferrer"
                        class="hidden lg:inline-flex items-center gap-2 bg-primary text-white text-xs font-semibold px-3.5 py-2 rounded-lg shadow-sm transition">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.87 9.87 0 004.74 1.21h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0012.04 2zm5.8 14.06c-.24.68-1.4 1.3-1.93 1.38-.5.08-1.12.11-1.8-.11-.42-.13-.95-.31-1.64-.61-2.88-1.24-4.76-4.15-4.9-4.34-.14-.19-1.17-1.56-1.17-2.97 0-1.42.74-2.11 1-2.4.26-.28.57-.35.76-.35.19 0 .38 0 .55.01.18.01.41-.07.64.49.24.58.81 2 .88 2.15.07.14.12.31.02.5-.09.19-.14.31-.28.48-.14.16-.29.36-.42.49-.14.14-.28.29-.12.57.16.28.71 1.17 1.53 1.9 1.05.94 1.94 1.23 2.22 1.37.28.14.44.12.61-.07.16-.19.69-.81.88-1.09.19-.28.37-.23.62-.14.26.09 1.63.77 1.91.91.28.14.47.21.53.33.07.12.07.68-.17 1.36z">
                            </path>
                        </svg>
                        <span>Chat WhatsApp</span>
                    </a>
                @endif

                <!-- 4. Mobile Menu Hamburger Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                    class="lg:hidden text-gray-600 hover:text-primary focus:outline-none p-2 -mr-2">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- 5. Mobile Menu Accordion Dropdown -->
    <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        class="lg:hidden border-t border-gray-100 bg-white max-h-[75vh] overflow-y-auto">
        <div class="px-4 pt-3 pb-4 space-y-1 text-sm font-medium">
            <a href="{{ route('home') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-gray-700 hover:bg-gray-50 active:bg-gray-100">
                <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span>Beranda</span>
            </a>

            <a href="{{ route('public.about') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-gray-700 hover:bg-gray-50 active:bg-gray-100">
                <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
                <span>Tentang Kami</span>
            </a>

            <div x-data="{ openCatMobile: false }" class="space-y-1">
                <button @click="openCatMobile = !openCatMobile"
                    class="w-full flex items-center justify-between px-3 py-3 rounded-lg text-gray-700 hover:bg-gray-50 active:bg-gray-100">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span>Kategori Produk</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform flex-shrink-0" :class="{ 'rotate-180': openCatMobile }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>

                <div x-show="openCatMobile" x-collapse x-cloak
                    class="pl-4 space-y-0.5 border-l-2 border-[var(--color-primary-light)] ml-6">
                    @forelse($categoriesMenu as $cat)
                        <a href="{{ route('category.detail', $cat->slug) }}"
                            class="flex items-center gap-2 px-3 py-2.5 text-sm text-gray-600 hover:text-primary rounded-md active:bg-gray-50">
                            <svg class="w-3.5 h-3.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span>{{ $cat->name }}</span>
                        </a>
                    @empty
                        <p class="px-3 py-2 text-xs text-gray-400">Belum ada kategori.</p>
                    @endforelse
                </div>
            </div>

            <a href="{{ route('testimonials') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-gray-700 hover:bg-gray-50 active:bg-gray-100">
                <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                    </path>
                </svg>
                <span>Gallery & Testimonial</span>
            </a>

            <!-- Tombol WhatsApp - mobile menu -->
            <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($waMessage) }}" target="_blank"
                rel="noopener"
                class="flex items-center justify-center gap-2 bg-green-500 text-white px-3 py-3 rounded-lg font-semibold mt-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.87 9.87 0 004.74 1.21h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0012.04 2zm5.8 14.06c-.24.68-1.4 1.3-1.93 1.38-.5.08-1.12.11-1.8-.11-.42-.13-.95-.31-1.64-.61-2.88-1.24-4.76-4.15-4.9-4.34-.14-.19-1.17-1.56-1.17-2.97 0-1.42.74-2.11 1-2.4.26-.28.57-.35.76-.35.19 0 .38 0 .55.01.18.01.41-.07.64.49.24.58.81 2 .88 2.15.07.14.12.31.02.5-.09.19-.14.31-.28.48-.14.16-.29.36-.42.49-.14.14-.28.29-.12.57.16.28.71 1.17 1.53 1.9 1.05.94 1.94 1.23 2.22 1.37.28.14.44.12.61-.07.16-.19.69-.81.88-1.09.19-.28.37-.23.62-.14.26.09 1.63.77 1.91.91.28.14.47.21.53.33.07.12.07.68-.17 1.36z">
                    </path>
                </svg>
                <span>Chat via WhatsApp</span>
            </a>

            @auth
                <div class="pt-2 border-t border-gray-100 mt-2">
                    <a href="{{ route('admin.products') }}"
                        class="flex items-center justify-center gap-2 text-xs bg-[var(--color-primary-light)] text-[var(--color-primary)] px-3 py-2.5 rounded-lg font-semibold border border-[var(--color-primary-light)]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Dashboard Admin</span>
                    </a>
                </div>
            @endauth
        </div>
    </div>
</header>

<!-- Floating WhatsApp Button - khusus mobile, selalu terlihat saat scroll -->
<a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($waMessage) }}" target="_blank" rel="noopener"
    class="md:hidden fixed bottom-5 right-5 z-50 bg-green-500 hover:bg-green-600 text-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center transition active:scale-95">
    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
        <path
            d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.87 9.87 0 004.74 1.21h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0012.04 2zm5.8 14.06c-.24.68-1.4 1.3-1.93 1.38-.5.08-1.12.11-1.8-.11-.42-.13-.95-.31-1.64-.61-2.88-1.24-4.76-4.15-4.9-4.34-.14-.19-1.17-1.56-1.17-2.97 0-1.42.74-2.11 1-2.4.26-.28.57-.35.76-.35.19 0 .38 0 .55.01.18.01.41-.07.64.49.24.58.81 2 .88 2.15.07.14.12.31.02.5-.09.19-.14.31-.28.48-.14.16-.29.36-.42.49-.14.14-.28.29-.12.57.16.28.71 1.17 1.53 1.9 1.05.94 1.94 1.23 2.22 1.37.28.14.44.12.61-.07.16-.19.69-.81.88-1.09.19-.28.37-.23.62-.14.26.09 1.63.77 1.91.91.28.14.47.21.53.33.07.12.07.68-.17 1.36z">
        </path>
    </svg>
</a>
