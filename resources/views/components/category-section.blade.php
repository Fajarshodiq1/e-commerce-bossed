@props([
    'categories' => [],
    'selectedCategory' => null,
])

<section class="py-10 bg-gray-50/50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Section -->
        <div class="flex flex-col items-center lg:items-start lg:text-left mb-6">
            <h2 class="text-2xl lg:text-3xl font-bold lg:font-extrabold text-gray-900 tracking-tight">
                Kategori Populer
            </h2>
            <p class="text-sm text-gray-500 mt-0.5">Pilih kategori untuk memfilter produk</p>
        </div>

        <!-- Grid Kategori -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-4">
            @forelse($categories as $category)
                @php
                    $isSelected = $selectedCategory === $category->slug;
                @endphp

                <button type="button" wire:click="$set('selectedCategory', '{{ $category->slug }}')"
                    class="group p-4 bg-white border rounded-xl transition-all text-left flex flex-col justify-between
                    {{ $isSelected ? 'border-primary ring-1 ring-primary shadow-sm' : 'border-gray-200 hover:border-primary-border hover:shadow-sm' }}">

                    <div class="flex items-center justify-between mb-3">
                        <!-- Icon Box -->
                        <div
                            class="w-10 h-10 rounded-lg transition-colors flex items-center justify-center
                            {{ $isSelected ? 'bg-primary text-white' : 'bg-primary-light text-primary group-hover:bg-primary group-hover:text-white' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                        </div>

                        <!-- Arrow Icon -->
                        <svg class="w-4 h-4 transition-colors {{ $isSelected ? 'text-primary' : 'text-gray-300 group-hover:text-primary' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </div>

                    <div>
                        <h3
                            class="text-sm font-semibold line-clamp-1 transition-colors {{ $isSelected ? 'text-primary font-bold' : 'text-gray-800 group-hover:text-primary' }}">
                            {{ $category->name }}
                        </h3>
                        <p class="text-[11px] text-gray-400 mt-0.5">
                            {{ $category->products_count ?? 0 }} Produk
                        </p>
                    </div>
                </button>
            @empty
                <div class="col-span-full py-6 text-center text-xs text-gray-400">
                    Belum ada kategori yang tersedia.
                </div>
            @endforelse
        </div>

    </div>
</section>
