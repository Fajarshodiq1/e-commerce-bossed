<!-- FAQ SECTION -->
<style>
    :root {
        --color-primary: #4e3027;
        --color-primary-light: #f7f1ed;
    }

    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<section class="py-10 sm:py-16 md:py-24" x-data="{ activeTab: 'seputar', activeFaq: null }">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
            <p class="text-[11px] sm:text-xs font-bold uppercase tracking-widest text-[#4e3027] mb-2">
                Pertanyaan Umum
            </p>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">
                Sering Ditanyakan Mengenai Bossed
            </h2>
            <p class="text-xs sm:text-sm text-gray-500 mt-3 leading-relaxed">
                Temukan jawaban lengkap seputar produk, kustomisasi, pemesanan, hingga layanan korporat kami.
            </p>
        </div>

        <!-- Tab Kategori FAQ -->
        <!-- MOBILE: horizontal scroll pills (no wrap, easier to scan with a thumb) -->
        <!-- DESKTOP (sm+): wraps and centers like before -->
        <div
            class="flex sm:flex-wrap items-center sm:justify-center gap-2 mb-8 sm:mb-10
                    overflow-x-auto sm:overflow-visible no-scrollbar -mx-4 px-4 sm:mx-0 sm:px-0 pb-1 sm:pb-0">
            <button @click="activeTab = 'seputar'; activeFaq = null"
                :class="activeTab === 'seputar' ? 'bg-[#4e3027] text-white font-semibold' :
                    'bg-gray-100 text-gray-600 active:bg-gray-200 sm:hover:bg-gray-200'"
                class="shrink-0 px-4 py-2.5 sm:py-2 rounded-xl text-xs sm:text-sm transition duration-200 whitespace-nowrap min-h-[40px]">
                Seputar Bossed & Produk
            </button>
            <button @click="activeTab = 'custom'; activeFaq = null"
                :class="activeTab === 'custom' ? 'bg-[#4e3027] text-white font-semibold' :
                    'bg-gray-100 text-gray-600 active:bg-gray-200 sm:hover:bg-gray-200'"
                class="shrink-0 px-4 py-2.5 sm:py-2 rounded-xl text-xs sm:text-sm transition duration-200 whitespace-nowrap min-h-[40px]">
                Custom & Branding
            </button>
            <button @click="activeTab = 'pemesanan'; activeFaq = null"
                :class="activeTab === 'pemesanan' ? 'bg-[#4e3027] text-white font-semibold' :
                    'bg-gray-100 text-gray-600 active:bg-gray-200 sm:hover:bg-gray-200'"
                class="shrink-0 px-4 py-2.5 sm:py-2 rounded-xl text-xs sm:text-sm transition duration-200 whitespace-nowrap min-h-[40px]">
                Pemesanan & Sample
            </button>
            <button @click="activeTab = 'layanan'; activeFaq = null"
                :class="activeTab === 'layanan' ? 'bg-[#4e3027] text-white font-semibold' :
                    'bg-gray-100 text-gray-600 active:bg-gray-200 sm:hover:bg-gray-200'"
                class="shrink-0 px-4 py-2.5 sm:py-2 rounded-xl text-xs sm:text-sm transition duration-200 whitespace-nowrap min-h-[40px]">
                Proses & Layanan
            </button>
        </div>

        <!-- Accordion Container -->
        <div class="space-y-4">

            <!-- TAB 1: SEPUTAR BOSSED & PRODUK -->
            <div x-show="activeTab === 'seputar'" class="space-y-3">

                <!-- Q1 -->
                <div class="border border-gray-200/80 rounded-2xl bg-gray-50/50 overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 1 ? null : 1)"
                        class="w-full text-left p-4 sm:p-5 flex items-center justify-between gap-4 min-h-[56px] active:bg-gray-100/60 sm:active:bg-transparent transition-colors">
                        <span class="font-bold text-gray-900 text-sm sm:text-base leading-snug">Apa itu Bossed?</span>
                        <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200"
                            :class="{ 'rotate-180': activeFaq === 1 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 1" x-collapse
                        class="px-4 sm:px-5 pb-4 sm:pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-3 bg-white">
                        Bossed adalah penyedia corporate merchandise custom berkualitas yang berfokus pada produk
                        berbahan kulit. Kami membantu perusahaan menciptakan merchandise yang merepresentasikan nilai,
                        profesionalisme, dan identitas brand.
                    </div>
                </div>

                <!-- Q2 -->
                <div class="border border-gray-200/80 rounded-2xl bg-gray-50/50 overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 2 ? null : 2)"
                        class="w-full text-left p-4 sm:p-5 flex items-center justify-between gap-4 min-h-[56px] active:bg-gray-100/60 sm:active:bg-transparent transition-colors">
                        <span class="font-bold text-gray-900 text-sm sm:text-base leading-snug">Produk apa saja yang
                            bisa dibuat di Bossed?</span>
                        <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200"
                            :class="{ 'rotate-180': activeFaq === 2 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 2" x-collapse
                        class="px-4 sm:px-5 pb-4 sm:pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-3 bg-white">
                        Kami memproduksi ID card holder, agenda cover, pouch, clutch, notebook cover, mousepad, desk
                        mat, employee welcome kit, seminar kit, dompet, totebag, passport holder, hingga berbagai
                        aksesori custom lainnya.
                    </div>
                </div>

                <!-- Q3 -->
                <div class="border border-gray-200/80 rounded-2xl bg-gray-50/50 overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 3 ? null : 3)"
                        class="w-full text-left p-4 sm:p-5 flex items-center justify-between gap-4 min-h-[56px] active:bg-gray-100/60 sm:active:bg-transparent transition-colors">
                        <span class="font-bold text-gray-900 text-sm sm:text-base leading-snug">Apakah hanya menerima
                            produk berbahan kulit?</span>
                        <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200"
                            :class="{ 'rotate-180': activeFaq === 3 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 3" x-collapse
                        class="px-4 sm:px-5 pb-4 sm:pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-3 bg-white">
                        Fokus utama kami memang pada kulit (genuine & premium synthetic/PU leather). Namun, kami juga
                        melayani kombinasi material lain seperti canvas, denim, kayu, hingga metal sesuai konsep yang
                        Anda inginkan.
                    </div>
                </div>

                <!-- Q4 -->
                <div class="border border-gray-200/80 rounded-2xl bg-gray-50/50 overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 4 ? null : 4)"
                        class="w-full text-left p-4 sm:p-5 flex items-center justify-between gap-4 min-h-[56px] active:bg-gray-100/60 sm:active:bg-transparent transition-colors">
                        <span class="font-bold text-gray-900 text-sm sm:text-base leading-snug">Mengapa merchandise
                            berbahan kulit menjadi pilihan perusahaan?</span>
                        <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200"
                            :class="{ 'rotate-180': activeFaq === 4 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 4" x-collapse
                        class="px-4 sm:px-5 pb-4 sm:pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-3 bg-white">
                        Material kulit memberikan kesan mewah, profesional, tahan lama, dan berkelas. Penerima
                        cenderung menggunakan produk kulit dalam jangka panjang sehingga nilai brand recall perusahaan
                        Anda jauh lebih tinggi.
                    </div>
                </div>

            </div>

            <!-- TAB 2: CUSTOM & BRANDING -->
            <div x-show="activeTab === 'custom'" class="space-y-3" x-cloak>

                <!-- Q5 -->
                <div class="border border-gray-200/80 rounded-2xl bg-gray-50/50 overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 5 ? null : 5)"
                        class="w-full text-left p-4 sm:p-5 flex items-center justify-between gap-4 min-h-[56px] active:bg-gray-100/60 sm:active:bg-transparent transition-colors">
                        <span class="font-bold text-gray-900 text-sm sm:text-base leading-snug">Apakah semua produk
                            bisa di-custom?</span>
                        <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200"
                            :class="{ 'rotate-180': activeFaq === 5 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 5" x-collapse
                        class="px-4 sm:px-5 pb-4 sm:pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-3 bg-white">
                        Ya, 100% dapat disesuaikan. Anda bisa menentukan ukuran, warna material, pola jahitan,
                        kompartemen dalam, hingga aplikasi logo perusahaan.
                    </div>
                </div>

                <!-- Q6 -->
                <div class="border border-gray-200/80 rounded-2xl bg-gray-50/50 overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 6 ? null : 6)"
                        class="w-full text-left p-4 sm:p-5 flex items-center justify-between gap-4 min-h-[56px] active:bg-gray-100/60 sm:active:bg-transparent transition-colors">
                        <span class="font-bold text-gray-900 text-sm sm:text-base leading-snug">Teknik branding apa
                            saja yang tersedia?</span>
                        <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200"
                            :class="{ 'rotate-180': activeFaq === 6 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 6" x-collapse
                        class="px-4 sm:px-5 pb-4 sm:pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-3 bg-white">
                        Kami menyediakan teknik Deboss/Emboss (polos/foil emas/perak), Laser Engraving, Screen
                        Printing / UV Print, hingga Custom Hardware Metal Plate.
                    </div>
                </div>

                <!-- Q7 -->
                <div class="border border-gray-200/80 rounded-2xl bg-gray-50/50 overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 7 ? null : 7)"
                        class="w-full text-left p-4 sm:p-5 flex items-center justify-between gap-4 min-h-[56px] active:bg-gray-100/60 sm:active:bg-transparent transition-colors">
                        <span class="font-bold text-gray-900 text-sm sm:text-base leading-snug">Apakah saya perlu
                            memiliki desain sendiri sebelum menghubungi Bossed?</span>
                        <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200"
                            :class="{ 'rotate-180': activeFaq === 7 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 7" x-collapse
                        class="px-4 sm:px-5 pb-4 sm:pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-3 bg-white">
                        Tidak harus. Cukup berikan logo perusahaan Anda, dan tim desainer kami akan membantu
                        membuatkan mockup visual secara gratis.
                    </div>
                </div>

            </div>

            <!-- TAB 3: PEMESANAN & SAMPLE -->
            <div x-show="activeTab === 'pemesanan'" class="space-y-3" x-cloak>

                <!-- Q8 -->
                <div class="border border-gray-200/80 rounded-2xl bg-gray-50/50 overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 8 ? null : 8)"
                        class="w-full text-left p-4 sm:p-5 flex items-center justify-between gap-4 min-h-[56px] active:bg-gray-100/60 sm:active:bg-transparent transition-colors">
                        <span class="font-bold text-gray-900 text-sm sm:text-base leading-snug">Berapa minimum order
                            (MOQ) & apakah bisa pesan satuan?</span>
                        <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200"
                            :class="{ 'rotate-180': activeFaq === 8 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 8" x-collapse
                        class="px-4 sm:px-5 pb-4 sm:pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-3 bg-white">
                        MOQ kami fleksibel mulai dari 20-50 pcs tergantung jenis produk. Untuk pemesanan satuan khusus
                        diperuntukkan bagi pembuatan sampel fisik sebelum produksi massal.
                    </div>
                </div>

                <!-- Q9 -->
                <div class="border border-gray-200/80 rounded-2xl bg-gray-50/50 overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 9 ? null : 9)"
                        class="w-full text-left p-4 sm:p-5 flex items-center justify-between gap-4 min-h-[56px] active:bg-gray-100/60 sm:active:bg-transparent transition-colors">
                        <span class="font-bold text-gray-900 text-sm sm:text-base leading-snug">Apakah bisa membuat
                            sample terlebih dahulu & apakah berbayar?</span>
                        <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200"
                            :class="{ 'rotate-180': activeFaq === 9 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 9" x-collapse
                        class="px-4 sm:px-5 pb-4 sm:pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-3 bg-white">
                        Bisa. Pembuatan sampel dikenakan biaya awal, tetapi biaya sampel ini nantinya akan dipotongkan
                        (deducted) langsung dari total tagihan saat Anda lanjut ke produksi massal.
                    </div>
                </div>

            </div>

            <!-- TAB 4: PROSES & LAYANAN -->
            <div x-show="activeTab === 'layanan'" class="space-y-3" x-cloak>

                <!-- Q10 -->
                <div class="border border-gray-200/80 rounded-2xl bg-gray-50/50 overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 10 ? null : 10)"
                        class="w-full text-left p-4 sm:p-5 flex items-center justify-between gap-4 min-h-[56px] active:bg-gray-100/60 sm:active:bg-transparent transition-colors">
                        <span class="font-bold text-gray-900 text-sm sm:text-base leading-snug">Bagaimana proses dari
                            ide hingga produk jadi?</span>
                        <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200"
                            :class="{ 'rotate-180': activeFaq === 10 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 10" x-collapse
                        class="px-4 sm:px-5 pb-4 sm:pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-3 bg-white">
                        Proses meliputi: Konsultasi & Briefing -> Desain Mockup -> Pembuatan Sample -> QC & Approval ->
                        Produksi Massal -> Quality Control Akhir -> Pengiriman ke alamat kantor Anda.
                    </div>
                </div>

                <!-- Q11 -->
                <div class="border border-gray-200/80 rounded-2xl bg-gray-50/50 overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 11 ? null : 11)"
                        class="w-full text-left p-4 sm:p-5 flex items-center justify-between gap-4 min-h-[56px] active:bg-gray-100/60 sm:active:bg-transparent transition-colors">
                        <span class="font-bold text-gray-900 text-sm sm:text-base leading-snug">Apakah Bossed melayani
                            pengiriman ke seluruh Indonesia?</span>
                        <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200"
                            :class="{ 'rotate-180': activeFaq === 11 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="activeFaq === 11" x-collapse
                        class="px-4 sm:px-5 pb-4 sm:pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-3 bg-white">
                        Ya. Kami bekerja sama dengan jaringan kargo darat, laut, dan udara terpercaya untuk memastikan
                        pesanan sampai tepat waktu di lokasi mana pun di Indonesia.
                    </div>
                </div>

            </div>

        </div>

        @php
            // Ambil dari variabel $whatsappNumber jika ada, jika tidak ambil dari WebSetting
            $waNumber = $whatsappNumber ?? \App\Models\WebSetting::getByKey('whatsapp_number', '6281234567890');
            $waDigits = filled($waNumber) ? preg_replace('/[^0-9]/', '', $waNumber) : null;
        @endphp

        <!-- CTA Box Bawah FAQ -->
        <div class="mt-10 sm:mt-12 text-center p-6 sm:p-8 rounded-2xl bg-[#f7f1ed]/80 border border-[#4e3027]/20">
            <h3 class="font-bold text-gray-900 text-sm sm:text-base leading-snug">
                Punya Pertanyaan Lain yang Belum Terjawab?
            </h3>
            <p class="text-xs text-gray-600 mt-1.5 mb-5 leading-relaxed">
                Tim kami siap membantu Anda mendiskusikan kebutuhan merchandise secara langsung.
            </p>

            @if ($waDigits)
                <a href="https://wa.me/{{ $waDigits }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex w-full sm:w-auto items-center justify-center gap-2 px-5 py-3.5 sm:py-2.5 rounded-xl bg-[#4e3027] hover:bg-[#3b241d] active:bg-[#2b1a15] text-white font-semibold text-xs sm:text-sm transition shadow-sm min-h-[48px]">
                    <span>Hubungi Tim Konsultasi</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            @endif
        </div>

    </div>
</section>
