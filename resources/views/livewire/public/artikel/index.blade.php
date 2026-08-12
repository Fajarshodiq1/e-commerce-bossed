<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header Section -->
    <div class="text-center max-w-3xl mx-auto mb-12">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">
            Artikel & Wawasan Terbaru
        </h1>
        <p class="mt-3 text-lg text-gray-600 dark:text-gray-400">
            Temukan panduan, tren merchandise perusahaan, serta inspirasi souvenir kulit premium untuk kebutuhan event
            Anda.
        </p>

        <!-- Search Input -->
        <div class="mt-6 max-w-md mx-auto">
            <div class="relative">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari artikel..."
                    class="w-full pl-10 pr-4 py-2.5 text-sm bg-white dark:bg-zinc-900 border border-gray-300 dark:border-zinc-700 rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 shadow-sm transition" />
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($articles as $article)
            <article
                class="flex flex-col bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition duration-200">
                <!-- Thumbnail -->
                <a href="{{ route('artikel.show', $article->slug) }}" wire:navigate
                    class="block aspect-video w-full overflow-hidden bg-gray-100 dark:bg-zinc-800">
                    @if ($article->featured_image)
                        <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                            class="w-full h-full object-cover hover:scale-105 transition duration-300" />
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-zinc-600">
                            <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                    @endif
                </a>

                <!-- Content -->
                <div class="flex-1 p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-2">
                            <time datetime="{{ $article->created_at->toIso8601String() }}">
                                {{ $article->created_at->format('d M Y') }}
                            </time>
                        </div>

                        <h2
                            class="text-xl font-bold text-gray-900 dark:text-white line-clamp-2 hover:text-emerald-600 dark:hover:text-emerald-400 transition">
                            <a href="{{ route('artikel.show', $article->slug) }}" wire:navigate>
                                {{ $article->title }}
                            </a>
                        </h2>

                        <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 line-clamp-3">
                            {{ $article->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-zinc-800">
                        <a href="{{ route('artikel.show', $article->slug) }}" wire:navigate
                            class="inline-flex items-center text-sm font-semibold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition">
                            Baca Selengkapnya
                            <svg class="ml-1.5 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 dark:text-gray-400 text-lg">
                    @if ($search)
                        Tidak ada artikel yang cocok dengan kata kunci "{{ $search }}".
                    @else
                        Belum ada artikel yang dipublikasikan.
                    @endif
                </p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $articles->links() }}
    </div>
</div>
