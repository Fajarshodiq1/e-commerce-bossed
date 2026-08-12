@php
    // Helper function lokal untuk memproses URL Gambar dengan aman
    $getImageUrl = function ($imagePath, $fallback = 'assets/hero.jpg') {
        if (empty($imagePath)) {
            return asset($fallback);
        }
        if (str_starts_with($imagePath, 'http://') || str_starts_with($imagePath, 'https://')) {
            return $imagePath;
        }
        if (str_starts_with($imagePath, 'storage/')) {
            return asset($imagePath);
        }
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath)) {
            return \Illuminate\Support\Facades\Storage::url($imagePath);
        }
        return asset('storage/' . ltrim($imagePath, '/'));
    };

    $headerImgUrl = $getImageUrl($imgAboutHeader ?? null);
    $storyImgUrl = $getImageUrl($imgAboutStory ?? null);
    $philosophyImgUrl = $getImageUrl($imgAboutPhilosophy ?? null);
@endphp

<div>
    <!-- SECTION 1: HEADER SECTION -->
    <section
        class="py-14 sm:py-20 md:py-28 text-white relative overflow-hidden border-b border-gray-800 bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ $headerImgUrl }}');">

        <!-- Dark Overlay untuk memastikan teks tetap terbaca -->
        <div class="absolute inset-0 bg-gray-900/75"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">

            <!-- 1. SUB-HEADING BADGE -->
            <div wire:loading.remove wire:target="search">
                <p
                    class="text-xs font-extrabold tracking-widest text-[#f7f1ed] bg-[#4e3027]/80 border border-[#f7f1ed]/20 w-auto inline-flex px-3 py-1.5 rounded-xl mb-3">
                    Tentang {{ $storeName ?? 'Bossed' }}
                </p>
            </div>
            <!-- Skeleton Sub-heading -->
            <div wire:loading wire:target="search" class="flex justify-center mb-3">
                <div class="h-8 w-32 bg-gray-700/50 rounded-xl animate-pulse"></div>
            </div>

            <!-- 2. HEADLINE -->
            <div wire:loading.remove wire:target="search">
                <h1
                    class="text-2xl xs:text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    #LeatherForFurther
                </h1>
            </div>
            <!-- Skeleton Headline -->
            <div wire:loading wire:target="search" class="flex justify-center">
                <div class="h-10 sm:h-12 w-64 xs:w-80 sm:w-96 bg-gray-700/50 rounded-xl animate-pulse"></div>
            </div>

            <!-- 3. SUBTITLE -->
            <p
                class="mt-4 text-sm sm:text-base md:text-lg text-gray-300 max-w-2xl mx-auto font-normal leading-relaxed px-2">
                Corporate Merchandise & Leather Specialist
            </p>

        </div>
    </section>

    <!-- SECTION 2: BOSSED STORY -->
    <section class="py-12 sm:py-16 md:py-24 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-10 lg:gap-16 items-center">

                <!-- Visual Story -->
                <div class="lg:col-span-5 lg:order-2">
                    <div
                        class="relative rounded-2xl overflow-hidden bg-gray-100 border border-gray-200/80 aspect-[16/10] sm:aspect-[4/3] lg:aspect-square">
                        <img src="{{ $storyImgUrl }}" alt="{{ $storeName ?? 'Bossed' }} Story"
                            class="w-full h-full object-cover" loading="lazy">
                    </div>
                </div>

                <!-- Teks Story -->
                <div class="lg:col-span-7 lg:order-1 space-y-3 sm:space-y-4">

                    <!-- 1. SUB-HEADING BADGE -->
                    <div wire:loading.remove wire:target="search">
                        <p
                            class="text-[11px] sm:text-xs font-bold tracking-widest text-[#4e3027] bg-[#f7f1ed] border border-[#4e3027]/10 w-auto inline-flex px-3 py-1.5 rounded-xl">
                            {{ $storeName ?? 'Bossed' }} Story
                        </p>
                    </div>
                    <!-- Skeleton Sub-heading -->
                    <div wire:loading wire:target="search" class="flex justify-start">
                        <div class="h-7 w-28 bg-gray-200 rounded-xl animate-pulse"></div>
                    </div>

                    <!-- 2. HEADLINE -->
                    <div wire:loading.remove wire:target="search">
                        <h2
                            class="text-xl sm:text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight leading-tight">
                            Berawal dari sebuah keresahan,
                        </h2>
                    </div>
                    <!-- Skeleton Headline -->
                    <div wire:loading wire:target="search" class="flex justify-start">
                        <div class="h-8 sm:h-9 w-64 sm:w-80 bg-gray-200 rounded-xl animate-pulse"></div>
                    </div>

                    <!-- 3. DESCRIPTION -->
                    <p class="text-sm sm:text-base md:text-lg text-gray-600 leading-relaxed font-normal pt-1 sm:pt-2">
                        Kami melihat banyak perusahaan kesulitan menemukan vendor yang mampu memenuhi kebutuhan
                        produk berbahan kulit sintetis dengan kualitas yang konsisten dan proses yang dapat
                        diandalkan.
                    </p>

                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: PHILOSOPHY -->
    <section class="py-12 sm:py-16 md:py-24 bg-gray-50/70 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-10 lg:gap-16 items-center">

                <!-- Visual Philosophy -->
                <div class="lg:col-span-5 lg:order-1">
                    <div
                        class="relative rounded-2xl overflow-hidden bg-gray-100 border border-gray-200/80 aspect-[16/10] sm:aspect-[4/3] lg:aspect-square">
                        <img src="{{ $philosophyImgUrl }}" alt="Philosophy Embossed Craft"
                            class="w-full h-full object-cover" loading="lazy">
                    </div>
                </div>

                <!-- Teks Philosophy -->
                <div class="lg:col-span-7 lg:order-2 space-y-3 sm:space-y-4">

                    <!-- 1. SUB-HEADING BADGE -->
                    <div wire:loading.remove wire:target="search">
                        <p
                            class="text-[11px] sm:text-xs font-bold tracking-widest text-[#4e3027] bg-[#f7f1ed] border border-[#4e3027]/10 w-auto inline-flex px-3 py-1.5 rounded-xl">
                            Filosofi Kami
                        </p>
                    </div>
                    <!-- Skeleton Sub-heading -->
                    <div wire:loading wire:target="search" class="flex justify-start">
                        <div class="h-7 w-28 bg-gray-200 rounded-xl animate-pulse"></div>
                    </div>

                    <!-- 2. HEADLINE -->
                    <div wire:loading.remove wire:target="search">
                        <h2
                            class="text-xl sm:text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight leading-tight">
                            A name inspired by our craft.
                        </h2>
                    </div>
                    <!-- Skeleton Headline -->
                    <div wire:loading wire:target="search" class="flex justify-start">
                        <div class="h-8 sm:h-9 w-64 sm:w-80 bg-gray-200 rounded-xl animate-pulse"></div>
                    </div>

                    <!-- 3. DESCRIPTION -->
                    <p class="text-sm sm:text-base md:text-lg text-gray-600 leading-relaxed font-normal pt-1 sm:pt-2">
                        Nama <span class="font-bold text-gray-900">{{ $storeName ?? 'Bossed' }}</span> terinspirasi dari
                        teknik <span class="italic font-semibold text-[#4e3027]">Embossed</span>, salah satu metode
                        custom yang identik dengan produk berbahan kulit. Sebuah teknik yang memberikan identitas dan
                        karakter pada setiap produk yang dibuat.
                    </p>

                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: VISION & MISSION -->
    <section class="py-12 sm:py-16 md:py-24 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="max-w-3xl mx-auto text-center mb-8 sm:mb-12">
                <div wire:loading.remove wire:target="search">
                    <p
                        class="text-[11px] sm:text-xs font-bold tracking-widest text-[#4e3027] bg-[#f7f1ed] border border-[#4e3027]/10 w-auto inline-flex px-3 py-1.5 rounded-xl mb-2">
                        Arah & Komitmen
                    </p>
                </div>
                <div wire:loading wire:target="search" class="flex justify-center mb-2">
                    <div class="h-7 w-32 bg-gray-200 rounded-xl animate-pulse"></div>
                </div>

                <div wire:loading.remove wire:target="search">
                    <h2
                        class="text-xl sm:text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight leading-tight">
                        Visi & Misi Perusahaan
                    </h2>
                </div>
                <div wire:loading wire:target="search" class="flex justify-center">
                    <div class="h-8 sm:h-9 w-60 sm:w-72 bg-gray-200 rounded-xl animate-pulse"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-8 lg:gap-12">
                <!-- Card Visi -->
                <div
                    class="lg:col-span-5 bg-[#f7f1ed]/60 border border-[#4e3027]/15 p-5 sm:p-8 rounded-2xl flex flex-col justify-between">
                    <div>
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-[#f7f1ed] text-[#4e3027] border border-[#4e3027]/10 text-[11px] sm:text-xs font-bold uppercase tracking-wider mb-4 sm:mb-6">
                            Visi Kami
                        </div>
                        <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 leading-snug italic">
                            Menjadi mitra terpercaya dalam menghadirkan corporate merchandise berbahan kulit yang
                            berkelas, fungsional, dan memperkuat identitas setiap brand.
                        </h3>
                    </div>
                    <div
                        class="mt-6 sm:mt-8 pt-5 sm:pt-6 border-t border-[#4e3027]/15 text-[11px] sm:text-xs font-bold uppercase tracking-widest text-[#4e3027]">
                        {{ $storeName ?? 'Bossed' }} Indonesia
                    </div>
                </div>

                <!-- Card Misi -->
                <div class="lg:col-span-7 bg-white border border-gray-100 p-5 sm:p-8 rounded-2xl shadow-sm">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-gray-100 text-gray-800 text-[11px] sm:text-xs font-bold uppercase tracking-wider mb-4 sm:mb-6">
                        Misi Kami
                    </div>

                    <ol class="space-y-3.5 sm:space-y-4">
                        <li class="flex items-start gap-3 sm:gap-3.5">
                            <span
                                class="w-6 h-6 rounded-full bg-[#f7f1ed] text-[#4e3027] border border-[#4e3027]/10 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">1</span>
                            <span class="text-sm sm:text-base text-gray-700 font-medium leading-relaxed">Mengutamakan
                                kualitas, ketelitian, dan konsistensi dalam setiap produk.</span>
                        </li>
                        <li class="flex items-start gap-3 sm:gap-3.5">
                            <span
                                class="w-6 h-6 rounded-full bg-[#f7f1ed] text-[#4e3027] border border-[#4e3027]/10 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">2</span>
                            <span class="text-sm sm:text-base text-gray-700 font-medium leading-relaxed">Menghadirkan
                                merchandise yang fungsional, berkarakter, dan bernilai.</span>
                        </li>
                        <li class="flex items-start gap-3 sm:gap-3.5">
                            <span
                                class="w-6 h-6 rounded-full bg-[#f7f1ed] text-[#4e3027] border border-[#4e3027]/10 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">3</span>
                            <span class="text-sm sm:text-base text-gray-700 font-medium leading-relaxed">Menjalankan
                                proses yang profesional, transparan, dan tepat waktu.</span>
                        </li>
                        <li class="flex items-start gap-3 sm:gap-3.5">
                            <span
                                class="w-6 h-6 rounded-full bg-[#f7f1ed] text-[#4e3027] border border-[#4e3027]/10 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">4</span>
                            <span class="text-sm sm:text-base text-gray-700 font-medium leading-relaxed">Berinovasi pada
                                material, teknik, dan layanan untuk menciptakan solusi yang relevan.</span>
                        </li>
                        <li class="flex items-start gap-3 sm:gap-3.5">
                            <span
                                class="w-6 h-6 rounded-full bg-[#f7f1ed] text-[#4e3027] border border-[#4e3027]/10 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">5</span>
                            <span class="text-sm sm:text-base text-gray-700 font-medium leading-relaxed">Membangun
                                kemitraan yang tepercaya, berkelanjutan, dan saling bertumbuh.</span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: VALUES -->
    <section class="py-12 sm:py-16 md:py-24 bg-gray-50/70 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center mb-8 sm:mb-12">
                <div wire:loading.remove wire:target="search">
                    <p
                        class="text-[11px] sm:text-xs font-bold tracking-widest text-[#4e3027] bg-[#f7f1ed] border border-[#4e3027]/10 w-auto inline-flex px-3 py-1.5 rounded-xl mb-2">
                        Prinsip Utama
                    </p>
                </div>
                <div wire:loading wire:target="search" class="flex justify-center mb-2">
                    <div class="h-7 w-28 bg-gray-200 rounded-xl animate-pulse"></div>
                </div>

                <div wire:loading.remove wire:target="search">
                    <h2
                        class="text-xl sm:text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight leading-tight">
                        Nilai yang Menjadi Dasar Setiap Proses
                    </h2>
                </div>
                <div wire:loading wire:target="search" class="flex justify-center">
                    <div class="h-8 sm:h-9 w-64 sm:w-80 bg-gray-200 rounded-xl animate-pulse"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                <!-- 01. Quality -->
                <div
                    class="bg-white p-5 sm:p-8 rounded-2xl border border-gray-200/80 shadow-sm transition hover:shadow-md">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-[#f7f1ed] text-[#4e3027] border border-[#4e3027]/10 flex items-center justify-center font-bold text-base sm:text-lg mb-4 sm:mb-6">
                        01
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Quality</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Kami percaya kualitas dimulai dari pemilihan material, ketelitian pengerjaan, hingga proses
                        quality control yang konsisten.
                    </p>
                </div>

                <!-- 02. Detail -->
                <div
                    class="bg-white p-5 sm:p-8 rounded-2xl border border-gray-200/80 shadow-sm transition hover:shadow-md">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-[#f7f1ed] text-[#4e3027] border border-[#4e3027]/10 flex items-center justify-center font-bold text-base sm:text-lg mb-4 sm:mb-6">
                        02
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Detail</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Perhatian terhadap setiap detail menjadi bagian penting dalam menghasilkan merchandise yang
                        mampu merepresentasikan identitas perusahaan.
                    </p>
                </div>

                <!-- 03. Reliability -->
                <div
                    class="bg-white p-5 sm:p-8 rounded-2xl border border-gray-200/80 shadow-sm transition hover:shadow-md">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-[#f7f1ed] text-[#4e3027] border border-[#4e3027]/10 flex items-center justify-center font-bold text-base sm:text-lg mb-4 sm:mb-6">
                        03
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Reliability</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Kami berkomitmen menjadi partner yang dapat diandalkan melalui komunikasi yang jelas, proses
                        yang terstruktur, dan hasil yang sesuai ekspektasi.
                    </p>
                </div>

                <!-- 04. Collaboration -->
                <div
                    class="bg-white p-5 sm:p-8 rounded-2xl border border-gray-200/80 shadow-sm transition hover:shadow-md">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-[#f7f1ed] text-[#4e3027] border border-[#4e3027]/10 flex items-center justify-center font-bold text-base sm:text-lg mb-4 sm:mb-6">
                        04
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Collaboration</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Setiap proyek diawali dengan memahami kebutuhan klien agar solusi yang diberikan benar-benar
                        relevan dengan tujuan perusahaan.
                    </p>
                </div>

                <!-- 05. Consistency -->
                <div
                    class="bg-white p-5 sm:p-8 rounded-2xl border border-gray-200/80 shadow-sm transition hover:shadow-md sm:col-span-2 lg:col-span-1">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-[#f7f1ed] text-[#4e3027] border border-[#4e3027]/10 flex items-center justify-center font-bold text-base sm:text-lg mb-4 sm:mb-6">
                        05
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3">Consistency</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Kami menjaga standar kualitas dan pelayanan pada setiap pesanan sehingga setiap klien memperoleh
                        pengalaman yang sama baiknya.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 6: OUR COMMITMENT -->
    <section class="py-12 sm:py-16 md:py-24 bg-white border-b border-gray-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

            <!-- 1. HEADLINE -->
            <div wire:loading.remove wire:target="search">
                <h2
                    class="text-xl sm:text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight leading-tight mb-4 sm:mb-6">
                    Komitmen Kami
                </h2>
            </div>
            <!-- Skeleton Headline -->
            <div wire:loading wire:target="search" class="flex justify-center mb-4 sm:mb-6">
                <div class="h-8 sm:h-9 w-48 sm:w-64 bg-gray-200 rounded-xl animate-pulse"></div>
            </div>

            <!-- 2. DESKRIPSI -->
            <p class="text-sm sm:text-base md:text-xl text-gray-600 leading-relaxed max-w-4xl mx-auto font-normal">
                Kami berkomitmen menghadirkan corporate merchandise berbahan kulit dengan kualitas yang konsisten,
                proses yang profesional, dan pelayanan yang responsif. Karena setiap produk yang kami hasilkan
                merupakan
                <span class="font-bold text-[#4e3027]">representasi dari identitas Perusahaan yang Anda bangun</span>.
            </p>

        </div>
    </section>
</div>
