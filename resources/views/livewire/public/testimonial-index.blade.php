<div>
    @php
        $heroBgUrl = $imgGalleryHeader
            ? \Illuminate\Support\Facades\Storage::url($imgGalleryHeader)
            : asset('assets/hero.jpg');
    @endphp

    <!-- SECTION: TESTIMONIAL & PORTOFOLIO HERO -->
    <section
        class="py-12 sm:py-20 md:py-28 text-white relative overflow-hidden border-b border-gray-800 bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ $heroBgUrl }}');">

        <!-- Dark Overlay untuk menjaga keterbacaan teks -->
        <div class="absolute inset-0 bg-gray-900/80"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <!-- Badge Kategori/Halaman dengan Skema Warna #f7f1ed & #4e3027 -->
            <p
                class="text-[11px] sm:text-xs font-bold tracking-widest text-[#f7f1ed] bg-[#4e3027]/40 border border-[#f7f1ed]/20 backdrop-blur-sm w-auto inline-flex px-3 py-1.5 rounded-xl mb-2 sm:mb-3">
                Testimonial & Portofolio
            </p>

            <!-- Judul Utama Hero -->
            <h1
                class="text-2xl sm:text-4xl md:text-5xl font-black tracking-tight text-white max-w-4xl mx-auto leading-snug sm:leading-tight px-2">
                Hasil Karya yang Dipercaya Berbagai Perusahaan
            </h1>

            <!-- Deskripsi -->
            <p class="mt-3 sm:mt-4 text-sm sm:text-lg text-gray-300 max-w-2xl mx-auto font-normal px-2">
                Dari ulasan pelanggan hingga hasil produksi, setiap proyek mencerminkan komitmen kami terhadap kualitas
                dan detail.
            </p>
        </div>
    </section>
    <!-- SECTION 2: CUSTOMER STORIES -->
    <section class="py-12 sm:py-16 md:py-24 bg-gray-50/50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Customer Stories & Rating Summary -->
            <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-14">
                <!-- Badge dengan Skema Warna #f7f1ed & #4e3027 -->
                <p
                    class="text-[11px] sm:text-xs font-bold tracking-widest text-[#4e3027] bg-[#f7f1ed] border border-[#4e3027]/10 w-auto inline-flex px-3.5 py-1.5 rounded-full mb-3">
                    Customer Stories
                </p>
                <h2
                    class="text-2xl sm:text-4xl font-extrabold text-gray-900 tracking-tight mb-3 sm:mb-4 leading-snug px-2">
                    Cerita dan Kepercayaan dari Setiap Kolaborasi
                </h2>
                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-6 sm:mb-8 px-2 max-w-2xl mx-auto">
                    Kepercayaan pelanggan menjadi motivasi kami untuk terus menghadirkan corporate merchandise dengan
                    kualitas terbaik. Temukan pengalaman kerja sama dan kesan yang mereka rasakan bersama Bossed.
                </p>

                <!-- Ringkasan Rating Badge -->
                <div
                    class="inline-flex items-center gap-3 sm:gap-4 bg-white px-5 sm:px-6 py-3 rounded-2xl border border-gray-200/80 shadow-sm">
                    <div class="flex items-center gap-1.5 text-amber-400">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span
                            class="text-lg sm:text-xl font-black text-gray-900 leading-none">{{ number_format($averageRating, 1) }}</span>
                    </div>
                    <div class="h-8 w-px bg-gray-200"></div>
                    <div class="text-left text-[11px] sm:text-xs text-gray-500">
                        <span class="font-bold text-gray-900 block">{{ $totalTestimonials }} Ulasan Pelanggan</span>
                        <span class="text-gray-400 text-[10px] sm:text-[11px]">Diverifikasi oleh sistem</span>
                    </div>
                </div>
            </div>

            <!-- DAFTAR ULASAN GRID -->
            <div class="max-w-5xl mx-auto">
                @if ($testimonials->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        @foreach ($testimonials as $item)
                            <div
                                class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-200/80 shadow-sm hover:shadow-md hover:border-[#4e3027]/20 transition-all duration-200 flex flex-col justify-between">
                                <div class="space-y-3.5">
                                    <!-- Header Profil & Rating -->
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <!-- Avatar foto atau Inisial -->
                                            @if ($item->avatar)
                                                <img src="{{ asset('storage/' . $item->avatar) }}"
                                                    alt="{{ $item->name }}"
                                                    class="w-10 h-10 rounded-full object-cover border border-gray-100 flex-shrink-0 shadow-sm">
                                            @else
                                                <div
                                                    class="w-10 h-10 rounded-full bg-[#f7f1ed] text-[#4e3027] border border-[#4e3027]/10 font-bold flex items-center justify-center text-xs flex-shrink-0">
                                                    {{ strtoupper(substr($item->name, 0, 1)) }}
                                                </div>
                                            @endif

                                            <div class="min-w-0">
                                                <h3 class="text-xs sm:text-sm font-bold text-gray-900 truncate">
                                                    {{ $item->name }}
                                                </h3>
                                                <p class="text-[11px] text-gray-400 truncate mt-0.5">
                                                    {{ $item->role_or_company ?: 'Klien Terverifikasi' }} &bull;
                                                    {{ $item->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Rating Bintang -->
                                        <div class="flex items-center gap-0.5 text-amber-400 flex-shrink-0 pt-0.5">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-3.5 h-3.5 {{ $i <= $item->rating ? 'fill-current' : 'text-gray-200' }}"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>

                                    <!-- Pesan / Isi Ulasan -->
                                    <p
                                        class="text-xs sm:text-sm text-gray-600 leading-relaxed italic relative pl-3 border-l-2 border-[#4e3027]/20">
                                        "{{ $item->message }}"
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8 sm:mt-10 flex justify-center [&_span]:text-xs [&_a]:text-xs">
                        {{ $testimonials->links() }}
                    </div>
                @else
                    <!-- Empty State jika Belum Ada Ulasan -->
                    <div
                        class="py-12 sm:py-16 text-center bg-white rounded-2xl border border-dashed border-gray-200 px-4 max-w-lg mx-auto">
                        <div
                            class="w-12 h-12 bg-[#f7f1ed] rounded-full flex items-center justify-center mx-auto mb-3 border border-[#4e3027]/10">
                            <svg class="w-6 h-6 text-[#4e3027]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-gray-800">Belum Ada Ulasan</h3>
                        <p class="text-xs text-gray-500 mt-1 max-w-xs mx-auto leading-relaxed">
                            Jadilah yang pertama membagikan ulasan dan pengalaman Anda bekerja sama dengan Bossed.
                        </p>
                    </div>
                @endif
            </div>

        </div>
    </section>

    <!-- SECTION 3: PRODUCT SHOWCASE -->
    <section class="py-12 sm:py-16 md:py-24 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Portofolio Klien -->
            <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-14">
                <!-- Badge dengan Skema Warna #f7f1ed & #4e3027 -->
                <p
                    class="text-[11px] sm:text-xs font-bold tracking-widest text-[#4e3027] bg-[#f7f1ed] border border-[#4e3027]/10 w-auto inline-flex px-3.5 py-1.5 rounded-full mb-3">
                    Portofolio Klien
                </p>
                <h2
                    class="text-2xl sm:text-4xl font-extrabold text-gray-900 tracking-tight mb-3 sm:mb-4 leading-snug px-2">
                    Hasil Produksi dalam Berbagai Kebutuhan
                </h2>
                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed px-2 max-w-2xl mx-auto">
                    Jelajahi dokumentasi hasil produksi {{ $storeName }} yang digunakan untuk berbagai kebutuhan
                    perusahaan, mulai dari corporate gift, employee welcome kit, dan lainnya.
                </p>
            </div>

            <!-- Grid Showcase Foto Produk Dinamis -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                @forelse ($productShowcases as $showcase)
                    <div
                        class="group relative bg-gray-100 rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm hover:shadow-md hover:border-[#4e3027]/30 transition-all duration-300 aspect-[4/3]">

                        <!-- Gambar Portofolio dengan Smooth Zoom Hover -->
                        <img src="{{ asset('storage/' . $showcase->image_path) }}" alt="{{ $showcase->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">

                        <!-- Overlay Gradient & Informasi Portofolio -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-gray-950/85 via-gray-950/30 to-transparent p-5 sm:p-6 flex flex-col justify-end transition-opacity duration-300">

                            <!-- Tag Kategori dengan Aksen Warna #f7f1ed & #4e3027 -->
                            <span
                                class="inline-block text-[10px] sm:text-xs font-bold uppercase tracking-wider text-[#4e3027] bg-[#f7f1ed] px-2.5 py-0.5 rounded-md w-fit mb-2 shadow-sm">
                                {{ $showcase->category }}
                            </span>

                            <!-- Judul Showcase -->
                            <h3
                                class="text-sm sm:text-base font-bold text-white leading-snug group-hover:text-[#f7f1ed] transition-colors duration-200">
                                {{ $showcase->title }}
                            </h3>
                        </div>
                    </div>
                @empty
                    <!-- Empty State jika Belum Ada Portofolio -->
                    <div
                        class="col-span-full py-12 sm:py-16 text-center bg-gray-50/50 rounded-2xl border border-dashed border-gray-200 px-4 max-w-lg mx-auto my-4">
                        <div
                            class="w-12 h-12 bg-[#f7f1ed] rounded-full flex items-center justify-center mx-auto mb-3 border border-[#4e3027]/10">
                            <svg class="w-6 h-6 text-[#4e3027]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-gray-800">Belum Ada Portofolio</h3>
                        <p class="text-xs text-gray-500 mt-1 max-w-xs mx-auto leading-relaxed">
                            Belum ada portofolio hasil produksi yang ditampilkan saat ini.
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>
    <!-- SECTION: OUR CLIENTS / MITRA PERUSAHAAN -->
    @if (isset($partners) && $partners->count() > 0)
        <section class="py-12 sm:py-16 bg-gray-50 border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12 flex flex-col items-center">
                    <!-- Badge Kemitraan -->
                    <p
                        class="text-[11px] sm:text-xs font-bold tracking-widest text-[#4e3027] bg-[#f7f1ed] border border-[#4e3027]/10 w-auto inline-flex px-3.5 py-1.5 rounded-full mb-3 uppercase">
                        Kemitraan
                    </p>

                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Telah Dipercaya oleh Berbagai Perusahaan
                    </h2>
                    <p class="mt-2 text-sm sm:text-base text-gray-500">
                        Bangga dapat menjadi bagian dari solusi corporate merchandise berkualitas untuk berbagai brand
                        dan instansi.
                    </p>
                </div>

                <!-- Grid Logo Clients -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 sm:gap-6 items-center">
                    @foreach ($partners as $partner)
                        @php
                            $partnerContent =
                                '
                            <div class="h-20 sm:h-24 w-full bg-white rounded-2xl border border-gray-200/80 p-4 flex items-center justify-center transition-all duration-300 group-hover:border-[#4e3027]/30 group-hover:shadow-md">
                                ' .
                                ($partner->logo
                                    ? '<img src="' .
                                        asset('storage/' . $partner->logo) .
                                        '" alt="' .
                                        e($partner->name) .
                                        '" class="max-h-12 sm:max-h-14 w-auto object-contain filter grayscale group-hover:grayscale-0 transition-all duration-300 opacity-70 group-hover:opacity-100">'
                                    : '<span class="text-xs sm:text-sm font-semibold text-gray-600 text-center line-clamp-2">' .
                                        e($partner->name) .
                                        '</span>') .
                                '
                            </div>
                        ';
                        @endphp

                        @if ($partner->url)
                            <a href="{{ $partner->url }}" target="_blank" rel="noopener noreferrer" class="group block"
                                title="{{ $partner->name }}">
                                {!! $partnerContent !!}
                            </a>
                        @else
                            <div class="group" title="{{ $partner->name }}">
                                {!! $partnerContent !!}
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </section>
    @endif
    <!-- SECTION 4: CALL TO ACTION (CTA) -->
    <section class="py-12 sm:py-16 md:py-24 bg-white border-b border-gray-100">
        @php
            // Ambil nomor WA dari Composer/WebSetting dan bersihkan formatnya
            $rawWa = $whatsappNumber ?? \App\Models\WebSetting::getByKey('whatsapp_number');
            $waDigits = filled($rawWa) ? preg_replace('/[^0-9]/', '', $rawWa) : null;

            $waMessage =
                'Halo, saya ingin berkonsultasi mengenai kebutuhan merchandise dan desain untuk perusahaan kami.';
            $dynamicWaUrl = $waDigits ? "https://wa.me/{$waDigits}?text=" . urlencode($waMessage) : '#';
        @endphp

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Container Utama CTA dengan Latar Warna #f7f1ed & Aksen #4e3027 -->
            <div
                class="relative overflow-hidden rounded-3xl bg-[#f7f1ed] border border-[#4e3027]/10 p-8 sm:p-12 md:p-16 text-center shadow-sm">

                <!-- Ornamen Dekoratif Latar Belakang -->
                <div
                    class="absolute -top-12 -right-12 w-40 h-40 bg-[#4e3027]/5 rounded-full blur-2xl pointer-events-none">
                </div>
                <div
                    class="absolute -bottom-12 -left-12 w-40 h-40 bg-[#4e3027]/5 rounded-full blur-2xl pointer-events-none">
                </div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-4 sm:space-y-6">
                    <!-- Badge Penjelas -->
                    <p
                        class="text-[11px] sm:text-xs font-bold tracking-widest text-[#4e3027] bg-white border border-[#4e3027]/10 w-auto inline-flex px-3.5 py-1.5 rounded-full shadow-2xs">
                        Langkah Selanjutnya
                    </p>

                    <!-- Judul Utama CTA -->
                    <h2
                        class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight text-gray-900 leading-snug">
                        Saatnya Merchandise Anda Menjadi Bagian dari Cerita Berikutnya
                    </h2>

                    <!-- Deskripsi -->
                    <p class="text-xs sm:text-base text-gray-600 font-normal leading-relaxed">
                        Konsultasikan kebutuhan merchandise, ide desain, dan anggaran perusahaan Anda bersama tim
                        spesialis
                        kami.
                    </p>

                    <!-- Tombol Aksi WhatsApp -->
                    <div class="pt-2">
                        <a href="{{ $dynamicWaUrl }}" target="_blank" rel="noopener noreferrer"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-xl bg-[#4e3027] hover:bg-[#3b241d] active:bg-[#2b1a15] text-white font-bold text-xs sm:text-sm transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5"
                            style="min-height:48px;">

                            <span>Konsultasikan Sekarang, Gratis!</span>

                            <!-- Panah Kanan -->
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
