<div class="md:p-6 space-y-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">Lineup Produk</flux:heading>
            <flux:subheading>
                Kelola galeri produk yang ditampilkan di halaman depan.
            </flux:subheading>
        </div>

        <flux:button wire:click="create" variant="primary" icon="plus">
            Tambah Produk
        </flux:button>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <flux:badge color="green" size="lg" class="w-full justify-start py-3 px-4">
            {{ session('message') }}
        </flux:badge>
    @endif

    <!-- Filter & Search -->
    <div
        class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white dark:bg-zinc-800 p-4 rounded-xl border border-zinc-200 dark:border-zinc-700 shadow-sm">
        <div class="w-full md:w-1/3">
            <flux:input wire:model.live.debounce.300ms="search" type="search" placeholder="Cari nama produk..."
                icon="magnifying-glass" />
        </div>

        <div class="flex flex-wrap gap-2 w-full md:w-auto">
            <flux:button wire:click="$set('filterStatus', 'all')"
                variant="{{ $filterStatus === 'all' ? 'primary' : 'subtle' }}" size="sm">
                Semua
            </flux:button>
            <flux:button wire:click="$set('filterStatus', 'active')"
                variant="{{ $filterStatus === 'active' ? 'filled' : 'subtle' }}" color="green" size="sm">
                Aktif
            </flux:button>
            <flux:button wire:click="$set('filterStatus', 'inactive')"
                variant="{{ $filterStatus === 'inactive' ? 'filled' : 'subtle' }}" color="zinc" size="sm">
                Nonaktif
            </flux:button>
        </div>
    </div>

    <!-- Data Table -->
    <flux:table>
        <flux:table.columns>
            <flux:table.column>Gambar</flux:table.column>
            <flux:table.column>Nama Produk</flux:table.column>
            <flux:table.column>Harga</flux:table.column>
            <flux:table.column>Urutan</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column class="text-right">Aksi</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse($lineups as $item)
                <flux:table.row :key="$item->id">
                    <!-- Gambar -->
                    <flux:table.cell>
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}"
                                class="w-14 h-14 rounded-lg object-cover border border-zinc-200 dark:border-zinc-700" />
                        @else
                            <div
                                class="w-14 h-14 rounded-lg bg-zinc-100 dark:bg-zinc-700 flex items-center justify-center text-zinc-400 text-xs">
                                No Image
                            </div>
                        @endif
                    </flux:table.cell>

                    <!-- Nama -->
                    <flux:table.cell>
                        <div class="font-medium text-zinc-800 dark:text-zinc-200 text-sm">
                            {{ $item->name }}
                        </div>
                        @if ($item->description)
                            <div class="text-xs text-zinc-400 dark:text-zinc-500 truncate max-w-[220px]">
                                {{ $item->description }}
                            </div>
                        @endif
                    </flux:table.cell>

                    <!-- Harga -->
                    <flux:table.cell class="text-sm text-zinc-600 dark:text-zinc-300 whitespace-nowrap">
                        {{ $item->price ? 'Rp ' . number_format($item->price, 0, ',', '.') : '-' }}
                    </flux:table.cell>

                    <!-- Urutan -->
                    <flux:table.cell class="text-sm text-zinc-500 dark:text-zinc-400">
                        {{ $item->sort_order }}
                    </flux:table.cell>

                    <!-- Status -->
                    <flux:table.cell class="whitespace-nowrap">
                        <button wire:click="toggleStatus({{ $item->id }})">
                            @if ($item->status === 'active')
                                <flux:badge color="green" size="sm">Aktif</flux:badge>
                            @else
                                <flux:badge color="zinc" size="sm">Nonaktif</flux:badge>
                            @endif
                        </button>
                    </flux:table.cell>

                    <!-- Aksi -->
                    <flux:table.cell class="text-right whitespace-nowrap">
                        <div class="flex justify-end items-center gap-1.5">
                            <flux:button wire:click="edit({{ $item->id }})" variant="subtle" size="sm"
                                icon="pencil">
                                Edit
                            </flux:button>
                            <flux:button wire:click="delete({{ $item->id }})"
                                wire:confirm="Yakin ingin menghapus produk ini secara permanen?" variant="danger"
                                size="sm" icon="trash">
                                Hapus
                            </flux:button>
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="6" class="text-center py-6 text-zinc-500 dark:text-zinc-400">
                        Belum ada produk di lineup.
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    <!-- Pagination -->
    <div>
        {{ $lineups->links() }}
    </div>

    <!-- Modal Tambah/Edit Produk -->
    <flux:modal wire:model.self="showModal" class="max-w-2xl w-full">
        <form wire:submit="save" class="space-y-5">
            <div>
                <flux:heading size="lg">
                    {{ $editingId ? 'Edit Produk' : 'Tambah Produk Baru' }}
                </flux:heading>
                <flux:subheading>
                    {{ $editingId ? 'Perbarui data produk ini.' : 'Tambahkan produk baru ke lineup.' }}
                </flux:subheading>
            </div>

            <!-- Nama Produk -->
            <flux:field>
                <flux:label>Nama Produk <span class="text-red-500">*</span></flux:label>
                <flux:input wire:model="name" placeholder="Masukkan nama produk" />
                <flux:error name="name" />
            </flux:field>

            <!-- Grid 3 Kolom: Harga, Urutan, Status -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Harga -->
                <flux:field>
                    <flux:label>Harga (opsional)</flux:label>
                    <flux:input wire:model="price" type="number" step="0.01" placeholder="0" />
                    <flux:error name="price" />
                </flux:field>

                <!-- Urutan -->
                <flux:field>
                    <flux:label>Urutan Tampil</flux:label>
                    <flux:input wire:model="sort_order" type="number" min="0" placeholder="0" />
                    <flux:error name="sort_order" />
                </flux:field>

                <!-- Status -->
                <flux:field>
                    <flux:label>Status <span class="text-red-500">*</span></flux:label>
                    <flux:select wire:model="status">
                        <flux:select.option value="active">Aktif</flux:select.option>
                        <flux:select.option value="inactive">Nonaktif</flux:select.option>
                    </flux:select>
                    <flux:error name="status" />
                </flux:field>
            </div>

            <!-- Gambar -->
            <flux:field>
                <flux:label>Gambar Produk {{ $editingId ? '' : '*' }}</flux:label>

                @if ($currentImage && !$image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $currentImage) }}"
                            class="w-20 h-20 rounded-lg object-cover border" />
                    </div>
                @endif

                <input type="file" wire:model="image" accept="image/*"
                    class="block w-full text-sm text-zinc-600 dark:text-zinc-300
                       file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                       file:text-sm file:font-medium file:bg-zinc-100 dark:file:bg-zinc-700
                       file:text-zinc-700 dark:file:text-zinc-200 hover:file:bg-zinc-200" />

                <div wire:loading wire:target="image" class="text-xs text-zinc-400 mt-1">
                    Mengunggah gambar...
                </div>

                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="mt-2 w-20 h-20 rounded-lg object-cover border" />
                @endif

                <flux:error name="image" />
            </flux:field>

            <!-- Deskripsi -->
            <flux:field>
                <flux:label>Deskripsi</flux:label>
                <flux:textarea wire:model="description" rows="3" placeholder="Deskripsi singkat produk..." />
                <flux:error name="description" />
            </flux:field>

            <!-- Actions -->
            <div class="flex justify-end gap-2 pt-2">
                <flux:button type="button" variant="subtle" wire:click="closeModal">
                    Batal
                </flux:button>
                <flux:button type="submit" variant="primary" wire:loading.attr="disabled" wire:target="save">
                    <span wire:loading.remove wire:target="save">
                        {{ $editingId ? 'Simpan Perubahan' : 'Tambah Produk' }}
                    </span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
