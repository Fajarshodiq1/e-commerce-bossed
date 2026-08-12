<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <flux:heading size="xl">Manajemen Artikel</flux:heading>
            <flux:subheading>Kelola postingan artikel, status Table of Contents, dan konfigurasi SEO.</flux:subheading>
        </div>
        <flux:button href="{{ route('admin.artikel.create') }}" variant="primary" icon="plus" wire:navigate>
            Tambah Artikel
        </flux:button>
    </div>

    @if (session()->has('success'))
        <flux:badge color="green" class="mb-4 w-full justify-start py-2">
            {{ session('success') }}
        </flux:badge>
    @endif

    <div class="mb-6">
        <flux:input wire:model.live.debounce.300ms="search" placeholder="Cari judul artikel..." icon="magnifying-glass" />
    </div>

    <!-- Grid Layout Card Artikel dengan Gambar -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($articles as $article)
            <flux:card :key="$article->id" class="p-0 overflow-hidden flex flex-col justify-between">
                <div>
                    <!-- Featured Image / Gambar Artikel -->
                    <div class="relative h-48 w-full bg-zinc-100 dark:bg-zinc-800 overflow-hidden">
                        @if ($article->featured_image)
                            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" />
                        @else
                            <div
                                class="w-full h-full flex flex-col items-center justify-center text-zinc-400 dark:text-zinc-600">
                                <flux:icon icon="photo" class="w-10 h-10 mb-1 opacity-50" />
                                <span class="text-xs">Tanpa Gambar</span>
                            </div>
                        @endif

                        <!-- Badge Status TOC di atas gambar -->
                        <div class="absolute top-3 left-3">
                            @if ($article->has_toc)
                                <flux:badge color="lime" size="sm" class="shadow-sm">TOC Aktif</flux:badge>
                            @else
                                <flux:badge color="gray" size="sm" class="shadow-sm">TOC Non-aktif</flux:badge>
                            @endif
                        </div>
                    </div>

                    <!-- Konten Card -->
                    <div class="p-5 space-y-3">
                        <div class="flex items-center justify-between text-xs text-zinc-500 dark:text-zinc-400">
                            <span>Dipublikasikan</span>
                            <span>{{ $article->created_at->format('d M Y') }}</span>
                        </div>

                        <flux:heading size="lg" class="line-clamp-2">
                            {{ $article->title }}
                        </flux:heading>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="p-4 pt-0 flex items-center justify-end gap-2">
                    <flux:button href="{{ route('admin.artikel.edit', $article->id) }}" variant="subtle" size="sm"
                        icon="pencil-square" wire:navigate>
                        Edit
                    </flux:button>
                    <flux:button wire:click="delete({{ $article->id }})"
                        wire:confirm="Apakah Anda yakin ingin menghapus artikel ini?" variant="danger" size="sm"
                        icon="trash">
                        Hapus
                    </flux:button>
                </div>
            </flux:card>
        @empty
            <div class="col-span-full">
                <flux:card class="text-center py-12">
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">
                        Belum ada artikel yang ditambahkan.
                    </p>
                </flux:card>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $articles->links() }}
    </div>
</div>
