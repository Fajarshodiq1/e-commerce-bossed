<div class="md:p-6 space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <flux:heading size="xl" level="1">Manajemen Kategori</flux:heading>
            <flux:subheading>Kelola kategori produk untuk toko Anda.</flux:subheading>
        </div>

        <flux:button href="{{ route('admin.categories.create') }}" variant="primary" icon="plus">
            Tambah Kategori
        </flux:button>
    </div>

    <!-- Alert / Flash Message -->
    @if (session()->has('message'))
        <flux:badge color="green" size="lg" class="w-full justify-start py-3 px-4">
            {{ session('message') }}
        </flux:badge>
    @endif

    <!-- Search Input -->
    <div class="max-w-md">
        <flux:input wire:model.live.debounce.300ms="search" type="search" placeholder="Cari kategori..."
            icon="magnifying-glass" />
    </div>

    <!-- Data Table -->
    <flux:table>
        <flux:table.columns>
            <flux:table.column>Gambar</flux:table.column>
            <flux:table.column>Nama Kategori</flux:table.column>
            <flux:table.column>Slug</flux:table.column>
            <flux:table.column>Deskripsi</flux:table.column>
            <flux:table.column class="text-right">Aksi</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse($categories as $category)
                <flux:table.row :key="$category->id">
                    <flux:table.cell>
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                class="w-12 h-12 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700">
                        @else
                            <div
                                class="w-12 h-12 bg-zinc-100 dark:bg-zinc-800 rounded-lg flex items-center justify-center text-xs text-zinc-400">
                                No Image
                            </div>
                        @endif
                    </flux:table.cell>

                    <flux:table.cell class="font-medium text-zinc-800 dark:text-zinc-200">
                        {{ $category->name }}
                    </flux:table.cell>

                    <flux:table.cell class="text-zinc-500 text-sm">
                        {{ $category->slug }}
                    </flux:table.cell>

                    <flux:table.cell class="text-zinc-500 text-sm">
                        {{ \Illuminate\Support\Str::limit($category->description, 50) }}
                    </flux:table.cell>
                    <flux:table.cell class="text-right">
                        <div class="flex justify-end gap-2">
                            <flux:button href="{{ route('admin.categories.edit', $category->id) }}" variant="ghost"
                                size="sm" icon="pencil">
                                Edit
                            </flux:button>

                            <flux:button wire:click="delete({{ $category->id }})"
                                wire:confirm="Yakin ingin menghapus kategori ini? Semua produk dalam kategori ini juga akan terhapus."
                                variant="danger" size="sm" icon="trash">
                                Hapus
                            </flux:button>
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="4" class="text-center py-6 text-zinc-500">
                        Belum ada data kategori.
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    <!-- Pagination -->
    <div>
        {{ $categories->links() }}
    </div>
</div>
