@props(['partners' => null])

@php
    $partners = $partners ?? \App\Models\Partner::all();
@endphp

<!-- PARTNER MARQUEE SECTION -->
<section class="py-10 bg-gray-50/80 border-y border-gray-200/60 overflow-hidden relative">

    <!-- Gradient Fade Effect Sisi Kiri & Kanan -->
    <div class="pointer-events-none absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-gray-50 to-transparent z-10">
    </div>
    <div class="pointer-events-none absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-gray-50 to-transparent z-10">
    </div>

    <!-- Heading Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 text-center">
        <!-- Text Normal -->
        <p wire:loading.remove wire:target="search"
            class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-gray-500">
            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
            <span>Dipercaya Oleh Partner Kami</span>
            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
        </p>
        <!-- Skeleton Heading -->
        <div wire:loading wire:target="search" class="inline-block w-48 h-3.5 bg-gray-200 rounded-full animate-pulse">
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- SKELETON STATE (Muncul saat proses loading / search)       -->
    <!-- ========================================================= -->
    <div wire:loading wire:target="search"
        class="flex justify-center items-center gap-8 sm:gap-12 md:gap-16 px-4 overflow-hidden animate-pulse">
        @for ($i = 0; $i < 6; $i++)
            <div class="h-10 sm:h-12 w-28 sm:w-36 bg-gray-200 rounded-lg shrink-0"></div>
        @endfor
    </div>

    <!-- ========================================================= -->
    <!-- REAL CONTENT (Marquee Track 1 & 2)                       -->
    <!-- ========================================================= -->
    @if ($partners && $partners->count() > 0)
        <div wire:loading.remove wire:target="search" class="flex overflow-hidden select-none group">

            <!-- Track 1 -->
            <div
                class="flex items-center gap-16 min-w-full shrink-0 justify-around animate-marquee group-hover:[animation-play-state:paused]">
                @foreach ($partners as $partner)
                    <div class="flex items-center justify-center h-14 px-6">
                        @if ($partner->logo)
                            <img class="h-10 md:h-12 max-w-[160px] w-auto object-contain opacity-60 grayscale hover:grayscale-0 hover:opacity-100 hover:scale-105 transition duration-300"
                                src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                title="{{ $partner->name }}">
                        @else
                            <span
                                class="text-base font-bold text-gray-400 hover:text-amber-600 transition whitespace-nowrap">
                                {{ $partner->name }}
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Track 2 (Seamless Infinite Loop) -->
            <div aria-hidden="true"
                class="flex items-center gap-16 min-w-full shrink-0 justify-around animate-marquee group-hover:[animation-play-state:paused]">
                @foreach ($partners as $partner)
                    <div class="flex items-center justify-center h-14 px-6">
                        @if ($partner->logo)
                            <img class="h-10 md:h-12 max-w-[160px] w-auto object-contain opacity-60 grayscale hover:grayscale-0 hover:opacity-100 hover:scale-105 transition duration-300"
                                src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                title="{{ $partner->name }}">
                        @else
                            <span
                                class="text-base font-bold text-gray-400 hover:text-amber-600 transition whitespace-nowrap">
                                {{ $partner->name }}
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>

        </div>
    @endif

</section>
