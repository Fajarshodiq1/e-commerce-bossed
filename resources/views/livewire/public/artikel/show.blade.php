<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">
    <!-- Breadcrumb Navigasi -->
    <nav class="flex items-center gap-2 text-xs sm:text-sm text-zinc-500 mb-6 overflow-x-auto whitespace-nowrap pb-1">
        <a href="/" class="hover:text-[var(--color-primary)] dark:hover:text-white transition">Beranda</a>
        <span>/</span>
        <a href="{{ route('artikel.index') }}"
            class="hover:text-[var(--color-primary)] dark:hover:text-white transition">Artikel</a>
        <span>/</span>
        <span
            class="text-zinc-900 dark:text-zinc-200 font-medium truncate max-w-[180px] sm:max-w-xs">{{ $article->title }}</span>
    </nav>

    <!-- Header Artikel -->
    <header class="max-w-4xl mx-auto text-center space-y-4 mb-8">
        <h1
            class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-zinc-900 dark:text-white leading-tight tracking-tight">
            {{ $article->title }}
        </h1>

        <div class="flex items-center justify-center gap-3 text-xs sm:text-sm text-zinc-500 dark:text-zinc-400">
            <span class="inline-flex items-center gap-1.5">
                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                {{ $article->created_at->translatedFormat('d F Y') }}
            </span>
            <span>•</span>
            <span class="inline-flex items-center gap-1.5">
                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min baca
            </span>
        </div>
    </header>

    <!-- Featured Image -->
    @if ($article->featured_image)
        <div
            class="max-w-4xl mx-auto mb-10 overflow-hidden rounded-xl sm:rounded-2xl border border-[var(--color-primary-border)] dark:border-zinc-800 shadow-xs">
            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                class="w-full h-auto max-h-[400px] sm:max-h-[480px] object-cover">
        </div>
    @endif

    <!-- Content Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start max-w-6xl mx-auto">

        <!-- SIDEBAR (TOC & Artikel Lainnya) -->
        @if (($article->has_toc && !empty($parsed['toc'])) || $relatedArticles->isNotEmpty())
            <aside class="lg:col-span-4 order-1 lg:order-2 lg:self-start space-y-6">

                <!-- 1. TOC (Daftar Isi) -->
                @if ($article->has_toc && !empty($parsed['toc']))
                    {{-- FIX: sticky hanya aktif di layout 2 kolom (lg ke atas).
                         Di mobile posisinya statis sehingga tidak menimpa konten lain. --}}
                    <div
                        class=" p-4 sm:p-5 bg-[var(--color-primary-light)]/80 dark:bg-zinc-900/60 backdrop-blur-md border border-[var(--color-primary-border)] dark:border-zinc-800 rounded-2xl space-y-3">
                        <div
                            class="flex items-center gap-2 font-semibold text-xs sm:text-sm text-[var(--color-primary)] dark:text-white border-b border-[var(--color-primary-border)] dark:border-zinc-800 pb-2.5">
                            <svg class="w-4 h-4 text-[var(--color-primary)] dark:text-emerald-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                            <span>Daftar Isi</span>
                        </div>

                        <nav
                            class="text-xs sm:text-sm max-h-none lg:max-h-[calc(100vh-220px)] overflow-visible lg:overflow-y-auto space-y-1 pr-1">
                            @foreach ($parsed['toc'] as $item)
                                <a href="#{{ $item['id'] ?? ($item['slug'] ?? '') }}"
                                    class="block py-1.5 px-2.5 rounded-lg hover:bg-[var(--color-primary-light)] dark:hover:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-[var(--color-primary)] dark:hover:text-white transition-all
                                           {{ ($item['level'] ?? 'h2') === 'h3' ? 'ml-3 text-[11px] sm:text-xs' : 'font-medium' }}">
                                    {{ $item['text'] ?? '' }}
                                </a>
                            @endforeach
                        </nav>
                    </div>
                @endif

                <!-- 2. Artikel Lainnya (statis, tepat di bawah TOC) -->
                @if ($relatedArticles->isNotEmpty())
                    <div
                        class="p-4 sm:p-5 bg-[var(--color-primary-light)]/80 dark:bg-zinc-900/60 backdrop-blur-md border border-[var(--color-primary-border)] dark:border-zinc-800 rounded-2xl space-y-4">
                        <div
                            class="flex items-center justify-between border-b border-[var(--color-primary-border)] dark:border-zinc-800 pb-2.5">
                            <h2 class="text-xs sm:text-sm font-semibold text-[var(--color-primary)] dark:text-white">
                                Artikel Lainnya
                            </h2>
                            <a href="{{ route('artikel.index') }}"
                                class="text-[11px] sm:text-xs font-semibold text-[var(--color-primary)] dark:text-emerald-400 hover:underline">
                                Semua →
                            </a>
                        </div>

                        <div class="space-y-3">
                            @foreach ($relatedArticles as $item)
                                <a href="{{ route('artikel.show', $item->slug) }}"
                                    class="group flex items-center gap-3 p-1.5 rounded-xl hover:bg-[var(--color-primary-light)] dark:hover:bg-zinc-800/60 transition-all">
                                    <!-- Thumbnail -->
                                    <div
                                        class="relative w-14 h-14 sm:w-16 sm:h-16 rounded-lg bg-[var(--color-primary-border)] dark:bg-zinc-800 overflow-hidden shrink-0">
                                        @if ($item->featured_image)
                                            <img src="{{ asset('storage/' . $item->featured_image) }}"
                                                alt="{{ $item->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                        @else
                                            <div
                                                class="w-full h-full flex items-center justify-center text-[var(--color-primary)]">
                                                <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Judul & Tanggal -->
                                    <div class="flex-1 min-w-0">
                                        <h3
                                            class="text-xs sm:text-sm font-medium text-zinc-800 dark:text-zinc-200 line-clamp-2 group-hover:text-[var(--color-primary)] dark:group-hover:text-emerald-400 transition-colors leading-snug">
                                            {{ $item->title }}
                                        </h3>
                                        <span
                                            class="text-[10px] sm:text-xs text-zinc-400 dark:text-zinc-500 mt-1 block">
                                            {{ $item->created_at->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </aside>
        @endif

        <!-- MAIN CONTENT -->
        <main
            class="{{ ($article->has_toc && !empty($parsed['toc'])) || $relatedArticles->isNotEmpty() ? 'lg:col-span-8' : 'lg:col-span-12 max-w-4xl mx-auto' }} order-2 lg:order-1 space-y-6">

            <!-- Body Isi Artikel (Typography Responsif) -->
            <article
                class="prose prose-sm sm:prose-base dark:prose-invert max-w-none
                prose-headings:scroll-mt-28
                prose-h2:text-xl sm:prose-h2:text-2xl prose-h2:font-bold prose-h2:mt-6 prose-h2:mb-3
                prose-h3:text-lg sm:prose-h3:text-xl prose-h3:font-semibold prose-h3:mt-5 prose-h3:mb-2
                prose-p:text-zinc-600 dark:prose-p:text-zinc-300 prose-p:leading-relaxed prose-p:text-sm sm:prose-p:text-base
                prose-a:text-[var(--color-primary)] dark:prose-a:text-emerald-400 hover:prose-a:underline
                prose-img:rounded-xl prose-img:border prose-img:border-[var(--color-primary-border)] dark:prose-img:border-zinc-800">
                {!! $parsed['content'] !!}
            </article>

            <!-- Tombol Bagikan -->
            <div
                class="pt-6 border-t border-[var(--color-primary-border)] dark:border-zinc-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-xs sm:text-sm text-zinc-500 text-center sm:text-left">
                    Suka artikel ini? Bagikan ke tim atau kolega Anda.
                </div>
                <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}"
                    target="_blank"
                    class="w-full sm:w-auto px-4 py-2.5 bg-[var(--color-primary)] hover:opacity-90 active:opacity-80 text-white rounded-xl text-xs sm:text-sm font-semibold transition-all shadow-xs inline-flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path
                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z" />
                    </svg>
                    Bagikan ke WhatsApp
                </a>
            </div>
        </main>

    </div>
</div>
