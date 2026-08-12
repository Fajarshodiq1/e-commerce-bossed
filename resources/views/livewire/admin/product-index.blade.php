<div class="md:p-6 space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <flux:heading size="xl" level="1">Manajemen Produk</flux:heading>
            <flux:subheading>Kelola katalog produk yang tampil di toko online Anda.</flux:subheading>
        </div>

        <flux:button href="{{ route('admin.products.create') }}" variant="primary" icon="plus">
            Tambah Produk Baru
        </flux:button>
    </div>

    <!-- Alert / Flash Message -->
    @if (session()->has('message'))
        <flux:badge color="green" size="lg" class="w-full justify-start py-3 px-4">
            {{ session('message') }}
        </flux:badge>
    @endif

    <!-- Filter & Search Section -->
    <div class="flex flex-col md:flex-row gap-4">
        <div class="w-full md:w-1/3">
            <flux:input wire:model.live.debounce.300ms="search" type="search" placeholder="Cari nama produk..."
                icon="magnifying-glass" />
        </div>

        <div class="w-full md:w-1/4">
            <flux:select wire:model.live="categoryFilter" placeholder="Semua Kategori">
                <flux:select.option value="">Semua Kategori</flux:select.option>
                @foreach ($categories as $category)
                    <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <!-- Data Table -->
    <flux:table>
        <flux:table.columns>
            <flux:table.column>Gambar</flux:table.column>
            <flux:table.column>Nama Produk</flux:table.column>
            <flux:table.column>Kategori</flux:table.column>
            <flux:table.column>Harga</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column class="text-right">Aksi</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse($products as $product)
                <flux:table.row :key="$product->id">
                    <!-- Column: Gambar -->
                    <flux:table.cell>
                        @if ($product->primaryImage)
                            <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}"
                                alt="{{ $product->name }}"
                                class="w-12 h-12 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700">
                        @else
                            <div
                                class="w-12 h-12 bg-zinc-100 dark:bg-zinc-800 rounded-lg flex items-center justify-center text-xs text-zinc-400">
                                No Image
                            </div>
                        @endif
                    </flux:table.cell>

                    <!-- Column: Nama & Slug -->
                    <flux:table.cell>
                        <div class="font-medium text-zinc-800 dark:text-zinc-200">{{ $product->name }}</div>
                        <div class="text-xs text-zinc-400">{{ $product->slug }}</div>
                    </flux:table.cell>

                    <!-- Column: Kategori -->
                    <flux:table.cell class="text-zinc-600 dark:text-zinc-400 text-sm">
                        {{ $product->category->name ?? '-' }}
                    </flux:table.cell>

                    <!-- Column: Harga -->
                    <flux:table.cell class="font-medium text-zinc-900 dark:text-zinc-100">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </flux:table.cell>

                    <!-- Column: Status Badges -->
                    <flux:table.cell>
                        <div class="flex flex-wrap items-center gap-1.5">
                            @if ($product->is_active)
                                <flux:badge color="green" size="sm">Aktif</flux:badge>
                            @else
                                <flux:badge color="red" size="sm">Non-aktif</flux:badge>
                            @endif

                            @if ($product->is_featured)
                                <flux:badge color="amber" size="sm">Unggulan</flux:badge>
                            @endif
                        </div>
                    </flux:table.cell>

                    <!-- Column: Action Buttons -->
                    <flux:table.cell class="text-right">
                        <div class="flex justify-end gap-2">
                            <flux:button href="{{ route('admin.products.edit', $product->id) }}" variant="ghost"
                                size="sm" icon="pencil">
                                Edit
                            </flux:button>

                            <flux:button wire:click="delete({{ $product->id }})"
                                wire:confirm="Yakin ingin menghapus produk ini?" variant="danger" size="sm"
                                icon="trash">
                                Hapus
                            </flux:button>
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="6" class="text-center py-6 text-zinc-500">
                        Belum ada data produk.
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    <!-- Pagination -->
    <div>
        {{ $products->links() }}
    </div>
</div>
