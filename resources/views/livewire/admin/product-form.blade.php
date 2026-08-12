<div class="md:p-6 mx-auto space-y-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">
                {{ $productId ? 'Edit Produk' : 'Tambah Produk Baru' }}
            </flux:heading>
            <flux:subheading>
                Isi rincian informasi produk di bawah ini.
            </flux:subheading>
        </div>

        <flux:button href="{{ route('admin.products') }}" variant="ghost" size="sm" icon="arrow-left">
            Kembali
        </flux:button>
    </div>

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Section 1: Informasi Utama -->
        <flux:card class="space-y-6">
            <flux:heading size="lg" level="2" class="border-b border-zinc-200 dark:border-zinc-700 pb-2">
                Informasi Produk
            </flux:heading>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Field: Nama Produk -->
                <flux:field>
                    <flux:label>Nama Produk</flux:label>
                    <flux:input wire:model="name" type="text" placeholder="Contoh: Sepatu Sneaker Pria" />
                    <flux:error name="name" />
                </flux:field>

                <!-- Field: Kategori -->
                <flux:field>
                    <flux:label>Kategori</flux:label>
                    <flux:select wire:model="category_id" placeholder="Pilih Kategori">
                        <flux:select.option value="">-- Pilih Kategori --</flux:select.option>
                        @foreach ($categories as $category)
                            <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <flux:error name="category_id" />
                </flux:field>
            </div>

            <!-- Field: Harga -->
            <flux:field>
                <flux:label>Harga (Rp)</flux:label>
                <flux:input wire:model="price" type="number" step="0.01" placeholder="150000"
                    icon="currency-dollar" />
                <flux:error name="price" />
            </flux:field>

            <!-- Field: Deskripsi -->
            <flux:field>
                <flux:label>Deskripsi Produk</flux:label>
                <flux:textarea wire:model="description" rows="5"
                    placeholder="Tuliskan spesifikasi, keunggulan, dan detail produk..." />
                <flux:error name="description" />
            </flux:field>

            <!-- Checkbox/Switch Settings -->
            <div class="flex flex-col sm:flex-row gap-6 pt-2">
                <flux:checkbox wire:model="is_active" label="Tampilkan Produk (Aktif)" />
                <flux:checkbox wire:model="is_featured" label="Jadikan Produk Unggulan" />
            </div>
        </flux:card>

        <!-- Section 2: Gambar Produk (Pola Repeater) -->
        <flux:card class="space-y-6">
            <div class="flex items-center justify-between border-b border-zinc-200 dark:border-zinc-700 pb-2">
                <div>
                    <flux:heading size="lg" level="2">
                        Galeri Gambar Produk
                    </flux:heading>
                    <flux:subheading>
                        Kelola daftar foto produk dan tentukan gambar mana yang menjadi sampul utama.
                    </flux:subheading>
                </div>
                <flux:button type="button" wire:click="addImageRow" variant="filled" size="sm" icon="plus">
                    Tambah Gambar
                </flux:button>
            </div>

            <!-- Repeater List Container -->
            <div class="space-y-4">
                @forelse ($productImages as $index => $item)
                    <div
                        class="p-4 border border-zinc-200 dark:border-zinc-700 rounded-xl bg-zinc-50/50 dark:bg-zinc-800/50 flex flex-col sm:flex-row items-center gap-4 transition">

                        <!-- Thumbnail / Preview Gambar -->
                        <div
                            class="w-full sm:w-28 h-28 rounded-lg overflow-hidden border border-zinc-200 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-900 shrink-0 flex items-center justify-center relative">
                            @if (isset($item['file']) && is_object($item['file']))
                                {{-- Preview jika file baru diupload --}}
                                <img src="{{ $item['file']->temporaryUrl() }}" class="w-full h-full object-cover">
                            @elseif (!empty($item['image_path']))
                                {{-- Preview jika gambar sudah ada di storage DB --}}
                                <img src="{{ asset('storage/' . $item['image_path']) }}"
                                    class="w-full h-full object-cover">
                            @else
                                {{-- Placeholder jika belum memilih file --}}
                                <flux:icon name="photo" class="w-8 h-8 text-zinc-400" />
                            @endif

                            @if (!empty($item['is_primary']))
                                <flux:badge color="green" size="sm" class="absolute top-1 left-1 shadow-sm">
                                    Utama
                                </flux:badge>
                            @endif
                        </div>

                        <!-- Input Control & Options -->
                        <div class="flex-1 w-full space-y-3">
                            <flux:field>
                                <flux:label class="text-xs">File Gambar (PNG, JPG, WEBP)</flux:label>
                                <flux:input wire:model="productImages.{{ $index }}.file" type="file"
                                    size="sm" />
                                <flux:error name="productImages.{{ $index }}.file" />
                            </flux:field>

                            <div class="flex items-center gap-4">
                                <flux:radio wire:click="setPrimaryImage({{ $index }})"
                                    name="primary_image_selection" :checked="!empty($item['is_primary'])"
                                    label="Jadikan Gambar Utama" />
                            </div>
                        </div>

                        <!-- Action: Remove Item -->
                        <div
                            class="w-full sm:w-auto flex justify-end border-t sm:border-t-0 pt-2 sm:pt-0 border-zinc-200 dark:border-zinc-700">
                            <flux:button type="button" wire:click="removeImageRow({{ $index }})"
                                variant="danger" size="sm" icon="trash" tooltip="Hapus Baris Ini" />
                        </div>
                    </div>
                @empty
                    <div
                        class="text-center py-8 border-2 border-dashed border-zinc-200 dark:border-zinc-700 rounded-xl">
                        <flux:icon name="photo" class="w-10 h-10 text-zinc-400 mx-auto mb-2" />
                        <flux:subheading>Belum ada gambar produk yang ditambahkan.</flux:subheading>
                        <flux:button type="button" wire:click="addImageRow" variant="filled" size="sm"
                            icon="plus" class="mt-3">
                            Tambah Gambar Pertama
                        </flux:button>
                    </div>
                @endforelse
            </div>
            <flux:error name="productImages" />
        </flux:card>

        <!-- Section 3: SEO Metadata -->
        <flux:card class="space-y-6">
            <flux:heading size="lg" level="2" class="border-b border-zinc-200 dark:border-zinc-700 pb-2">
                Pengaturan SEO (Opsional)
            </flux:heading>

            <flux:field>
                <flux:label>Custom Meta Title</flux:label>
                <flux:input wire:model="meta_title" type="text"
                    placeholder="Kosongkan jika ingin menggunakan nama produk" />
            </flux:field>

            <flux:field>
                <flux:label>Custom Meta Description</flux:label>
                <flux:textarea wire:model="meta_description" rows="2"
                    placeholder="Ringkasan singkat untuk hasil pencarian Google..." />
            </flux:field>
        </flux:card>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-3">
            <flux:button href="{{ route('admin.products') }}" variant="ghost">
                Batal
            </flux:button>

            <flux:button type="submit" variant="primary">
                {{ $productId ? 'Perbarui Produk' : 'Simpan Produk' }}
            </flux:button>
        </div>
    </form>
</div>
