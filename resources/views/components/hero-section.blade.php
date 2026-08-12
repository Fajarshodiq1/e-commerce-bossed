@props([
    'storeName' => 'Bossed',
    'heroImage' => null,
    'waNumber' => null,
])

@php
    $waNumber = $waNumber ?? config('services.whatsapp.number');
    $waMessage = config('services.whatsapp.default_message');

    // Logika pemanggilan gambar: Memakai $heroImage jika ada, atau fallback ke default asset
    $bgImage = !empty($heroImage)
        ? (str_starts_with($heroImage, 'http')
            ? $heroImage
            : asset('storage/' . $heroImage))
        : asset('assets/hero.jpg');
@endphp

<section
    class="relative py-20 sm:py-24 lg:py-32 overflow-hidden bg-slate-950 text-white border-b border-gray-100 lg:min-h-screen flex items-center">

    <!-- ========================================================= -->
    <!-- BACKGROUND IMAGE & OVERLAY LAYER                          -->
    <!-- ========================================================= -->
    <div class="absolute inset-0 z-0">
        <!-- Skeleton Background (Muncul saat pencarian) -->
        <div wire:loading wire:target="search" class="absolute inset-0 bg-slate-900 animate-pulse z-20 opacity-90"></div>

        <!-- Gambar Background Hero yang dipanggil -->
        <img src="{{ $bgImage }}" alt="{{ $storeName }}"
            class="w-full h-full object-cover object-center transition-opacity duration-500 scale-105" loading="eager">

        <!-- 1. Primary Tint Layer (Memberikan sentuhan warna tema pada latar) -->
        <div class="absolute inset-0 bg-primary/20 mix-blend-multiply z-10 pointer-events-none"></div>

        <!-- 2. Multi-Directional Gradient Overlay (Menjamin keterbacaan teks di semua layar) -->
        <div
            class="absolute inset-0 z-10 bg-gradient-to-t via-slate-950/70 from-slate-950/95 to-slate-950/60 lg:bg-gradient-to-r lg:from-slate-950/95 lg:via-slate-950/80 lg:to-slate-950/30">
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- KONTEN HERO (TEKS & INTERAKSI)                            -->
    <!-- ========================================================= -->
    <div class="relative z-20 w-full max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="max-w-2xl text-center lg:text-left space-y-6 sm:space-y-7 lg:space-y-8 mx-auto lg:mx-0">
            <!-- 1. HEADLINE -->
            <div wire:loading.remove wire:target="search">
                <h1 class="text-2xl sm:text-4xl font-extrabold tracking-wide text-white leading-snug drop-shadow-sm">
                    Corporate Merchandise Kulit Premium untuk Perusahaan
                </h1>
            </div>
            <!-- Skeleton Headline -->
            <div wire:loading wire:target="search" class="space-y-3 animate-pulse">
                <div class="h-8 sm:h-10 lg:h-12 bg-slate-700/60 rounded-lg w-full mx-auto lg:mx-0"></div>
                <div class="h-8 sm:h-10 lg:h-12 bg-slate-700/60 rounded-lg w-4/5 mx-auto lg:mx-0"></div>
            </div>

            <!-- 2. DESKRIPSI -->
            <div wire:loading.remove wire:target="search">
                <p
                    class="text-sm sm:text-base lg:text-lg text-slate-200/90 leading-loose tracking-wide max-w-xl mx-auto lg:mx-0 font-normal drop-shadow-sm">
                    Notebook kulit, card holder, lanyard, gift set, hingga desk organizer —
                    siap dipersonalisasi dengan logo &amp; identitas brand perusahaan Anda.
                </p>
            </div>
            <!-- Skeleton Deskripsi -->
            <div wire:loading wire:target="search" class="space-y-2 animate-pulse max-w-xl mx-auto lg:mx-0 pt-1">
                <div class="h-4 bg-slate-700/60 rounded-md w-full"></div>
                <div class="h-4 bg-slate-700/60 rounded-md w-3/4 mx-auto lg:mx-0"></div>
            </div>

            <!-- 3. BUTTON CTA (WHATSAPP) -->
            <div class="pt-3 flex flex-col sm:flex-row items-center gap-3 sm:gap-4 justify-center lg:justify-start">

                <!-- Tombol Asli -->
                <div wire:loading.remove wire:target="search" class="w-full sm:w-auto">
                    <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($waMessage) }}" target="_blank"
                        rel="noopener"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-primary text-white font-semibold px-6 py-4 rounded-xl text-sm shadow-lg hover:shadow-primary/20 hover:brightness-110 transition duration-200 active:scale-95">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.87 9.87 0 004.74 1.21h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0012.04 2zm5.8 14.06c-.24.68-1.4 1.3-1.93 1.38-.5.08-1.12.11-1.8-.11-.42-.13-.95-.31-1.64-.61-2.88-1.24-4.76-4.15-4.9-4.34-.14-.19-1.17-1.56-1.17-2.97 0-1.42.74-2.11 1-2.4.26-.28.57-.35.76-.35.19 0 .38 0 .55.01.18.01.41-.07.64.49.24.58.81 2 .88 2.15.07.14.12.31.02.5-.09.19-.14.31-.28.48-.14.16-.29.36-.42.49-.14.14-.28.29-.12.57.16.28.71 1.17 1.53 1.9 1.05.94 1.94 1.23 2.22 1.37.28.14.44.12.61-.07.16-.19.69-.81.88-1.09.19-.28.37-.23.62-.14.26.09 1.63.77 1.91.91.28.14.47.21.53.33.07.12.07.68-.17 1.36z">
                            </path>
                        </svg>
                        <span>Konsultasi via WhatsApp</span>
                    </a>
                </div>

                <!-- Skeleton Tombol WhatsApp -->
                <div wire:loading wire:target="search"
                    class="w-full sm:w-52 h-12 bg-slate-700/60 rounded-xl animate-pulse"></div>

            </div>

        </div>
    </div>
</section>
