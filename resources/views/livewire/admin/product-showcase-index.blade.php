<div class="md:p-6 space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <flux:heading size="xl" level="1">CMS Product Showcase</flux:heading>
            <flux:subheading>Kelola foto portofolio hasil produksi yang tampil di halaman testimonial.</flux:subheading>
        </div>

        <flux:button wire:click="create" variant="primary" icon="plus">
            Tambah Showcase
        </flux:button>
    </div>

    <!-- Alert / Flash Message -->
    @if (session()->has('message'))
        <flux:badge color="green" size="lg" class="w-full justify-start py-3 px-4">
            {{ session('message') }}
        </flux:badge>
    @endif

    <!-- Data Table -->
    <flux:table>
        <flux:table.columns>
            <flux:table.column>Gambar</flux:table.column>
            <flux:table.column>Judul & Kategori</flux:table.column>
            <flux:table.column>Urutan</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column class="text-right">Aksi</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse($showcases as $item)
                <flux:table.row :key="$item->id">
                    <!-- Column: Gambar -->
                    <flux:table.cell>
                        @if ($item->image_path)
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}"
                                class="w-12 h-12 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700">
                        @else
                            <div
                                class="w-12 h-12 bg-zinc-100 dark:bg-zinc-800 rounded-lg flex items-center justify-center text-xs text-zinc-400">
                                No Image
                            </div>
                        @endif
                    </flux:table.cell>

                    <!-- Column: Judul & Kategori -->
                    <flux:table.cell>
                        <div class="font-medium text-zinc-800 dark:text-zinc-200">{{ $item->title }}</div>
                        <div class="text-xs text-indigo-600 dark:text-indigo-400 uppercase font-semibold">
                            {{ $item->category }}</div>
                    </flux:table.cell>

                    <!-- Column: Urutan -->
                    <flux:table.cell class="font-medium text-zinc-800 dark:text-zinc-200">
                        {{ $item->sort_order }}
                    </flux:table.cell>

                    <!-- Column: Status Badges -->
                    <flux:table.cell>
                        <button wire:click="toggleActive({{ $item->id }})" class="focus:outline-none">
                            @if ($item->is_active)
                                <flux:badge color="green" size="sm">Aktif</flux:badge>
                            @else
                                <flux:badge color="zinc" size="sm">Draft</flux:badge>
                            @endif
                        </button>
                    </flux:table.cell>

                    <!-- Column: Action Buttons -->
                    <flux:table.cell class="text-right">
                        <div class="flex justify-end gap-2">
                            <flux:button wire:click="edit({{ $item->id }})" variant="ghost" size="sm"
                                icon="pencil">
                                Edit
                            </flux:button>

                            <flux:button wire:click="delete({{ $item->id }})"
                                wire:confirm="Yakin ingin menghapus item ini?" variant="danger" size="sm"
                                icon="trash">
                                Hapus
                            </flux:button>
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="5" class="text-center py-6 text-zinc-500">
                        Belum ada portofolio showcase. Klik tombol di atas untuk menambah.
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    <!-- Pagination -->
    <div>
        {{ $showcases->links() }}
    </div>

    <!-- Modal Form (Tambah / Edit) -->
    <flux:modal wire:model="isModalOpen" class="md:w-114 space-y-6">
        <div>
            <flux:heading size="lg">
                {{ $showcaseId ? 'Edit Showcase' : 'Tambah Showcase Baru' }}
            </flux:heading>
            <flux:subheading>Isi detail informasi portofolio hasil produksi.</flux:subheading>
        </div>

        <form wire:submit.prevent="save" class="space-y-4">
            <flux:field>
                <flux:label>Judul Produk / Proyek *</flux:label>
                <flux:input wire:model="title" placeholder="Contoh: Gift Box Akrilik Premium" />
                <flux:error name="title" />
            </flux:field>

            <flux:field>
                <flux:label>Kategori *</flux:label>
                <flux:input wire:model="category" placeholder="Misal: Corporate Gift, Welcome Kit" />
                <flux:error name="category" />
            </flux:field>

            <flux:field>
                <flux:label>Gambar Showcase *</flux:label>
                <flux:input type="file" wire:model="image" />
                <flux:error name="image" />

                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}"
                        class="mt-2 h-20 rounded-lg object-cover border border-zinc-200 dark:border-zinc-700">
                @endif
            </flux:field>

            <div class="grid grid-cols-2 gap-4 items-center">
                <flux:field>
                    <flux:label>Urutan Tampil</flux:label>
                    <flux:input type="number" wire:model="sort_order" />
                    <flux:error name="sort_order" />
                </flux:field>

                <div class="pt-6">
                    <flux:checkbox wire:model="is_active" label="Tampilkan" />
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                <flux:button wire:click="closeModal" variant="ghost">Batal</flux:button>
                <flux:button type="submit" variant="primary">Simpan</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
