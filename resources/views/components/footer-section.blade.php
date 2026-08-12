@props([
    'storeName' => 'Toko Online',
    'whatsappNumber' => '6281234567890',
    'address' => null,
    'categories' => [],
])

<footer class="bg-gray-900 text-gray-300">

    <!-- CTA BANNER ATAS FOOTER -->
    <div class="border-b border-gray-800 bg-gradient-to-r from-[#4e3027]/70 to-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="text-center md:text-left">
                <h3 class="text-xl sm:text-2xl font-bold text-white tracking-tight">Butuh Bantuan atau Pertanyaan Khusus?
                </h3>
                <p class="text-xs sm:text-sm text-gray-400 mt-1">Tim customer service kami siap melayani kebutuhan
                    pesanan Anda secara langsung.</p>
            </div>

            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}?text={{ urlencode('Halo ' . $storeName . ', saya ingin bertanya mengenai produk.') }}"
                target="_blank"
                class="bg-emerald-600 hover:bg-emerald-500 text-white font-semibold px-6 py-3 rounded-xl text-xs sm:text-sm transition-colors flex items-center gap-2 shadow-lg flex-shrink-0">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z" />
                </svg>
                <span>Hubungi via WhatsApp</span>
            </a>
        </div>
    </div>

    <!-- MAIN FOOTER CONTENT -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

            <!-- KOLOM 1: INFO TOKO -->
            <div class="md:col-span-5 space-y-4">
                <span class="text-xl font-bold text-white tracking-tight block">
                    {{ $storeName }}
                </span>
                <p class="text-xs text-gray-400 leading-relaxed max-w-sm">
                    Platform katalog produk resmi dengan kemudahan transaksi langsung via WhatsApp. Temukan berbagai
                    penawaran dan produk pilihan berkualitas tinggi.
                </p>
                @if ($address)
                    <div class="text-xs text-gray-400 flex items-start gap-2 pt-2">
                        <svg class="w-4 h-4 text-[#4e3027] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>{{ $address }}</span>
                    </div>
                @endif
            </div>

            <!-- KOLOM 2: KATEGORI CEPAT -->
            <div class="md:col-span-4 space-y-3">
                <h4 class="text-xs font-bold text-white uppercase tracking-wider">Kategori Pilihan</h4>
                <ul class="space-y-2 text-xs text-gray-400">
                    @forelse($categories->take(5) as $category)
                        <li>
                            <button type="button" wire:click="$set('selectedCategory', '{{ $category->slug }}')"
                                class="hover:text-white transition-colors">
                                {{ $category->name }}
                            </button>
                        </li>
                    @empty
                        <li class="text-gray-500">Belum ada kategori</li>
                    @endforelse
                </ul>
            </div>

            <!-- KOLOM 3: INFORMASI BANTUAN -->
            <div class="md:col-span-3 space-y-3">
                <h4 class="text-xs font-bold text-white uppercase tracking-wider">Layanan Customer</h4>
                <ul class="space-y-2 text-xs text-gray-400">
                    <li><a href="#testimonial-section" class="hover:text-white transition-colors">Ulasan Pelanggan</a>
                    </li>
                    <li><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}" target="_blank"
                            class="hover:text-white transition-colors">Konfirmasi Pembayaran</a></li>
                    <li><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}" target="_blank"
                            class="hover:text-white transition-colors">Tanya Stok Produk</a></li>
                </ul>
            </div>

        </div>

        <!-- COPYRIGHT FOOTER -->
        <div
            class="mt-12 pt-6 border-t border-gray-800 text-center text-xs text-gray-500 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p>&copy; {{ date('Y') }} {{ $storeName }}. All rights reserved.</p>
            <p class="text-[11px] text-gray-600">Pemesanan Mudah, Aman &amp; Cepat</p>
        </div>
    </div>

</footer>
