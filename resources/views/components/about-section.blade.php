<section class="py-10 sm:py-16 md:py-24 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 sm:gap-10 lg:gap-16 items-center">

            <!-- ========================================================= -->
            <!-- KOLOM GAMBAR (Dinamis dengan Pemrosesan Path yang Aman)   -->
            <!-- ========================================================= -->
            <div class="order-2 lg:order-1 lg:col-span-5">
                <div
                    class="relative rounded-xl sm:rounded-2xl overflow-hidden bg-gray-200 border border-gray-200/80 aspect-[16/10] sm:aspect-[4/3] lg:aspect-square">

                    <!-- Skeleton Gambar saat loading -->
                    <div wire:loading wire:target="search" class="absolute inset-0 bg-gray-200 animate-pulse z-10"></div>

                    @php
                        $imgSrc = asset('assets/hero.jpg'); // Default fallback

                        if (!empty($aboutImage)) {
                            if (str_starts_with($aboutImage, 'http://') || str_starts_with($aboutImage, 'https://')) {
                                $imgSrc = $aboutImage;
                            } elseif (str_starts_with($aboutImage, 'storage/')) {
                                $imgSrc = asset($aboutImage);
                            } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($aboutImage)) {
                                $imgSrc = \Illuminate\Support\Facades\Storage::url($aboutImage);
                            } else {
                                $imgSrc = asset('storage/' . ltrim($aboutImage, '/'));
                            }
                        }
                    @endphp

                    <img src="{{ $imgSrc }}" alt="{{ $storeName ?? 'Bossed' }} Leather Merchandise"
                        class="w-full h-full object-cover" loading="lazy"
                        onload="this.parentElement.classList.remove('bg-gray-200')">
                </div>
            </div>

            <!-- ========================================================= -->
            <!-- KOLOM TEKS                                                -->
            <!-- ========================================================= -->
            <div class="order-1 lg:order-2 lg:col-span-7 space-y-4 sm:space-y-6 text-center lg:text-left">

                <!-- 1. SUB-HEADING BADGE -->
                <div wire:loading.remove wire:target="search">
                    <p
                        class="text-xs font-extrabold tracking-widest text-primary bg-primary-light border border-primary-border w-auto inline-flex px-3 py-1.5 rounded-xl">
                        Tentang {{ $storeName ?? 'Bossed' }}
                    </p>
                </div>
                <!-- Skeleton Sub-heading -->
                <div wire:loading wire:target="search" class="flex justify-center lg:justify-start">
                    <div class="h-8 w-32 bg-gray-200 rounded-xl animate-pulse"></div>
                </div>

                <!-- 2. HEADLINE -->
                <div wire:loading.remove wire:target="search">
                    <h2
                        class="text-lg sm:text-3xl lg:text-4xl font-extrabold text-gray-900 leading-tight tracking-tight">
                        Lebih dari Merchandise, Kami Bantu Brand Meninggalkan Kesan.
                    </h2>
                </div>
                <!-- Skeleton Headline -->
                <div wire:loading wire:target="search" class="space-y-3 animate-pulse">
                    <div class="h-7 sm:h-8 lg:h-10 bg-gray-200 rounded-lg w-full mx-auto lg:mx-0"></div>
                    <div class="h-7 sm:h-8 lg:h-10 bg-gray-200 rounded-lg w-4/5 mx-auto lg:mx-0"></div>
                </div>

                <!-- 3. DESKRIPSI -->
                <div wire:loading.remove wire:target="search">
                    <p
                        class="text-sm sm:text-base lg:text-lg text-gray-600 leading-relaxed font-normal max-w-xl mx-auto lg:mx-0">
                        {{ $storeName ?? 'Bossed' }} menghadirkan corporate merchandise custom berbahan kulit premium —
                        representasi nilai, profesionalisme, dan identitas brand Anda.
                    </p>
                </div>
                <!-- Skeleton Deskripsi -->
                <div wire:loading wire:target="search" class="space-y-2 animate-pulse max-w-xl mx-auto lg:mx-0 pt-1">
                    <div class="h-4 bg-gray-200 rounded-md w-full"></div>
                    <div class="h-4 bg-gray-200 rounded-md w-5/6 mx-auto lg:mx-0"></div>
                </div>

                <!-- 4. VALUE HIGHLIGHTS / FEATURE CARDS -->
                <div wire:loading.remove wire:target="search"
                    class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 pt-4 border-t border-gray-100 text-left">

                    <div
                        class="flex items-start gap-3.5 p-4 rounded-xl bg-primary-light border border-primary-border/60">
                        <div>
                            <h4 class="text-sm font-bold text-gray-900">Premium Leather Quality</h4>
                            <p class="text-xs text-gray-600 mt-1 leading-normal">Material kulit pilihan, tahan lama
                                &amp; estetik.</p>
                        </div>
                    </div>

                    <div
                        class="flex items-start gap-3.5 p-4 rounded-xl bg-primary-light border border-primary-border/60">
                        <div>
                            <h4 class="text-sm font-bold text-gray-900">Custom Brand Identity</h4>
                            <p class="text-xs text-gray-600 mt-1 leading-normal">Emboss logo &amp; desain sesuai
                                kebutuhan brand.</p>
                        </div>
                    </div>
                </div>

                <!-- Skeleton Feature Cards -->
                <div wire:loading wire:target="search"
                    class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 pt-4 border-t border-gray-100 animate-pulse">
                    <div class="h-20 bg-gray-200 rounded-xl"></div>
                    <div class="h-20 bg-gray-200 rounded-xl"></div>
                </div>

            </div>

        </div>
    </div>
</section>
