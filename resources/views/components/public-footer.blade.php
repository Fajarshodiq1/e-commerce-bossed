@props([
    'storeName' => null,
    'description' => null,
    'address' => null,
    'whatsappNumber' => null,
    'email' => null,
    'instagramUrl' => null,
    'facebookUrl' => null,
    'twitterUrl' => null,
    'youtubeUrl' => null,
    'tiktokUrl' => null,
])

@php
    // Gunakan nilai dari props jika terisi, jika kosong gunakan fallback default
    $storeName = filled($storeName) ? $storeName : 'Bossed Leather';

    $description = filled($description)
        ? $description
        : 'Corporate Merchandise & Leather Specialist. Menghadirkan produk berbahan kulit berkualitas untuk memperkuat identitas brand perusahaan Anda.';

    $email = filled($email) ? $email : null;
    $address = filled($address) ? $address : null;

    $socialLinks = collect([
        'facebook' => $facebookUrl,
        'instagram' => $instagramUrl,
        'twitter' => $twitterUrl,
        'youtube' => $youtubeUrl,
        'tiktok' => $tiktokUrl,
    ])->filter(fn($url) => filled($url));

    $waDigits = filled($whatsappNumber) ? preg_replace('/[^0-9]/', '', $whatsappNumber) : null;
@endphp

<!-- SECTION: FOOTER -->
<footer class="border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14 md:py-16">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-8 sm:gap-10 lg:gap-12">

            <!-- Brand & Deskripsi -->
            <div class="lg:col-span-5 space-y-4">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('assets/BOOSED_LOGO.png') }}" alt="{{ $storeName }}" class="h-8 w-auto">
                    <span class="text-lg font-black text-gray-900 tracking-tight">{{ $storeName }}</span>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed max-w-sm">
                    {{ $description }}
                </p>
                <p
                    class="text-[11px] sm:text-xs font-bold tracking-widest text-[#4e3027] bg-[#f7f1ed] w-auto inline-flex px-3 py-1.5 rounded-xl border border-[#4e3027]/10">
                    #LeatherForFurther
                </p>
            </div>

            <!-- Navigasi -->
            <div class="lg:col-span-3">
                <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Navigasi</h3>
                <ul class="space-y-2.5 text-sm text-gray-600">
                    <li><a href="{{ route('home') }}" class="hover:text-[#4e3027] transition">Beranda</a></li>
                    <li><a href="{{ route('public.about') }}" class="hover:text-[#4e3027] transition">Tentang Kami</a>
                    </li>
                    <li><a href="{{ route('testimonials') }}" class="hover:text-[#4e3027] transition">Testimonial</a>
                    </li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="lg:col-span-4">
                <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Hubungi Kami</h3>
                <ul class="space-y-3 text-sm text-gray-600">
                    @if ($address)
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-[#4e3027] mt-0.5 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $address }}</span>
                        </li>
                    @endif

                    @if ($waDigits)
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-[#4e3027] flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            <a href="https://wa.me/{{ $waDigits }}" target="_blank"
                                class="hover:text-[#4e3027] transition">+{{ $waDigits }}</a>
                        </li>
                    @endif

                    @if ($email)
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-[#4e3027] flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <a href="mailto:{{ $email }}"
                                class="hover:text-[#4e3027] transition">{{ $email }}</a>
                        </li>
                    @endif
                </ul>

                <!-- Social Media: hanya tampil jika minimal 1 akun terisi -->
                @if ($socialLinks->isNotEmpty())
                    <div class="flex items-center gap-3 mt-5">
                        @if (isset($socialLinks['facebook']))
                            <a href="{{ $socialLinks['facebook'] }}" target="_blank" rel="noopener noreferrer"
                                aria-label="Facebook"
                                class="w-9 h-9 rounded-xl bg-[#f7f1ed] text-[#4e3027] flex items-center justify-center hover:bg-[#4e3027] hover:text-white transition border border-[#4e3027]/10">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M22 12a10 10 0 10-11.5 9.87v-6.98h-2.54V12h2.54V9.8c0-2.5 1.5-3.89 3.78-3.89 1.1 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.98A10 10 0 0022 12z" />
                                </svg>
                            </a>
                        @endif

                        @if (isset($socialLinks['instagram']))
                            <a href="{{ $socialLinks['instagram'] }}" target="_blank" rel="noopener noreferrer"
                                aria-label="Instagram"
                                class="w-9 h-9 rounded-xl bg-[#f7f1ed] text-[#4e3027] flex items-center justify-center hover:bg-[#4e3027] hover:text-white transition border border-[#4e3027]/10">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.16c3.2 0 3.58.01 4.85.07 3.25.15 4.77 1.69 4.92 4.92.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.15 3.23-1.66 4.77-4.92 4.92-1.27.06-1.64.07-4.85.07s-3.58-.01-4.85-.07c-3.26-.15-4.77-1.7-4.92-4.92-.06-1.27-.07-1.65-.07-4.85s.01-3.58.07-4.85C2.35 3.85 3.87 2.31 7.15 2.16 8.42 2.1 8.8 2.16 12 2.16zM12 0C8.74 0 8.33.01 7.05.07c-4.35.2-6.78 2.62-6.98 6.98C0 8.33 0 8.74 0 12s.01 3.67.07 4.95c.2 4.36 2.62 6.78 6.98 6.98C8.33 24 8.74 24 12 24s3.67-.01 4.95-.07c4.35-.2 6.78-2.62 6.98-6.98.06-1.28.07-1.69.07-4.95s-.01-3.67-.07-4.95c-.2-4.35-2.62-6.78-6.98-6.98C15.67.01 15.26 0 12 0z" />
                                    <path
                                        d="M12 5.84A6.16 6.16 0 1012 18.16 6.16 6.16 0 0012 5.84zm0 10.16a4 4 0 110-8 4 4 0 010 8z" />
                                    <circle cx="18.41" cy="5.59" r="1.44" />
                                </svg>
                            </a>
                        @endif

                        @if (isset($socialLinks['twitter']))
                            <a href="{{ $socialLinks['twitter'] }}" target="_blank" rel="noopener noreferrer"
                                aria-label="Twitter / X"
                                class="w-9 h-9 rounded-xl bg-[#f7f1ed] text-[#4e3027] flex items-center justify-center hover:bg-[#4e3027] hover:text-white transition border border-[#4e3027]/10">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                </svg>
                            </a>
                        @endif

                        @if (isset($socialLinks['youtube']))
                            <a href="{{ $socialLinks['youtube'] }}" target="_blank" rel="noopener noreferrer"
                                aria-label="YouTube"
                                class="w-9 h-9 rounded-xl bg-[#f7f1ed] text-[#4e3027] flex items-center justify-center hover:bg-[#4e3027] hover:text-white transition border border-[#4e3027]/10">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.376.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.376-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </a>
                        @endif

                        @if (isset($socialLinks['tiktok']))
                            <a href="{{ $socialLinks['tiktok'] }}" target="_blank" rel="noopener noreferrer"
                                aria-label="TikTok"
                                class="w-9 h-9 rounded-xl bg-[#f7f1ed] text-[#4e3027] flex items-center justify-center hover:bg-[#4e3027] hover:text-white transition border border-[#4e3027]/10">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.58-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                </svg>
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Bottom Bar -->
        <div
            class="mt-10 sm:mt-12 pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">
            <p class="text-xs text-gray-500">
                &copy; {{ date('Y') }} {{ $storeName }}. All rights reserved.
            </p>
            <p class="text-xs text-gray-400">
                Made with care in Indonesia 🇮🇩
            </p>
        </div>

    </div>
</footer>
