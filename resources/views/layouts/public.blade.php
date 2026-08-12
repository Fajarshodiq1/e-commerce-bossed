<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title & SEO Dasar -->
    <title>{{ $metaTitle ?? 'Vendor Corporate Merchandise Kulit Premium & Custom Kit | Bossed' }}</title>
    <meta name="description"
        content="{{ $metaDescription ?? 'Pusat pembuatan corporate merchandise & gift set berbahan kulit premium. Custom logo untuk seminar kit, welcome kit, & hampers perusahaan.' }}">
    <meta name="keywords"
        content="{{ $metaKeywords ?? 'corporate merchandise kulit, souvenir perusahaan, vendor gift set, seminar kit custom, hampers kulit' }}">
    <meta name="robots" content="{{ $metaRobots ?? 'index, follow' }}">
    <meta name="author" content="Bossed Corporate Merchandise">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Branding UI Browser & Mobile Theme -->
    <meta name="theme-color" content="#1a2923"> <!-- Warna tema status bar browser mobile -->

    <!-- ========================================================= -->
    <!-- FAVICON & APPLE TOUCH ICON (Cukup Menggunakan 1 Logo Utama) -->
    <!-- ========================================================= -->
    <!-- Favicon Browser Tab (Desktop/Mobile) -->
    <link rel="icon" type="image/png" href="{{ asset('assets/BOOSED_LOGO.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/BOOSED_LOGO.png') }}" type="image/x-icon">

    <!-- Apple Touch Icon (Aplikasi Layar Utama iPhone / iPad) -->
    <link rel="apple-touch-icon" href="{{ asset('assets/BOOSED_LOGO.png') }}">

    <!-- Open Graph / Facebook / WhatsApp Sharing -->
    <meta property="og:type" content="{{ $metaType ?? 'website' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $metaTitle ?? 'Vendor Corporate Merchandise Kulit Premium | Bossed' }}">
    <meta property="og:description"
        content="{{ $metaDescription ?? 'Pusat pembuatan corporate merchandise & gift set berbahan kulit premium. Custom logo untuk seminar kit, welcome kit, & hampers perusahaan.' }}">
    <meta property="og:image" content="{{ $metaImage ?? asset('assets/BOOSED_LOGO.png') }}">
    <meta property="og:image:secure_url" content="{{ $metaImage ?? asset('assets/BOOSED_LOGO.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $metaTitle ?? 'Bossed Corporate Merchandise' }}">
    <meta property="og:site_name" content="{{ config('app.name', 'Bossed') }}">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle ?? 'Vendor Corporate Merchandise Kulit Premium | Bossed' }}">
    <meta name="twitter:description"
        content="{{ $metaDescription ?? 'Pusat pembuatan corporate merchandise & gift set berbahan kulit premium. Custom logo untuk seminar kit, welcome kit, & hampers perusahaan.' }}">
    <meta name="twitter:image" content="{{ $metaImage ?? asset('assets/BOOSED_LOGO.png') }}">

    <!-- Keamanan / Referrer Policy -->
    <meta name="referrer" content="no-referrer-when-downgrade">

    <!-- Slot Khusus Schema.org JSON-LD Structured Data -->
    @stack('schema')

    <style>
        @keyframes marquee {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .animate-marquee {
            animation: marquee 25s linear infinite;
        }
    </style>

    <!-- Asset Vite (Tailwind CSS & JavaScript) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-50 font-sans text-gray-900 antialiased">
    <!-- Header / Navbar Public -->
    @if (view()->exists('components.public-header'))
        <x-public-header />
    @endif

    <!-- Main Content Dynamic Slot -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <!-- Dynamic Floating WhatsApp CTA Button -->
    {{-- @if (view()->exists('components.whatsapp-button'))
        <x-whatsapp-button />
    @endif --}}


    <x-public-footer :store-name="$storeName" :description="$description" :whatsapp-number="$whatsappNumber" :email="$email" :address="$address"
        :instagram-url="$instagramUrl" :facebook-url="$facebookUrl" :twitter-url="$twitterUrl" :youtube-url="$youtubeUrl" :tiktok-url="$tiktokUrl" />
    @livewireScripts
</body>

</html>
