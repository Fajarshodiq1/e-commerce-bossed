<div class="md:p-6 mx-auto space-y-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">
                {{ $categoryId ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
            </flux:heading>
            <flux:subheading>
                Isi formulir di bawah ini untuk {{ $categoryId ? 'memperbarui' : 'menambahkan' }} data kategori.
            </flux:subheading>
        </div>

        <flux:button href="{{ route('admin.categories') }}" variant="ghost" size="sm" icon="arrow-left">
            Kembali
        </flux:button>
    </div>

    <!-- Card Form -->
    <flux:card>
        <form wire:submit.prevent="save" class="space-y-6">
            <!-- Field: Nama Kategori -->
            <flux:field>
                <flux:label>Nama Kategori</flux:label>
                <flux:input wire:model="name" type="text" placeholder="Contoh: Elektronik, Fashion..." />
                <flux:error name="name" />
            </flux:field>

            <!-- Field: Deskripsi Kategori -->
            <flux:field>
                <flux:label>Deskripsi Kategori (Opsional)</flux:label>
                <flux:textarea wire:model="description" rows="3"
                    placeholder="Tuliskan deskripsi singkat tentang kategori ini..." />
                <flux:error name="description" />
            </flux:field>
            <!-- Field: Upload Gambar -->
            <flux:field>
                <flux:label>Gambar Kategori (Opsional)</flux:label>
                <flux:input wire:model="image" type="file" />
                <flux:error name="image" />

                <!-- Image Preview Section -->
                <div class="mt-3">
                    @if ($image)
                        <flux:subheading class="mb-1">Preview Gambar Baru:</flux:subheading>
                        <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                            class="w-24 h-24 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700">
                    @elseif($oldImage)
                        <flux:subheading class="mb-1">Gambar Saat Ini:</flux:subheading>
                        <img src="{{ asset('storage/' . $oldImage) }}" alt="Gambar saat ini"
                            class="w-24 h-24 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700">
                    @endif
                </div>
            </flux:field>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                <flux:button href="{{ route('admin.categories') }}" variant="ghost">
                    Batal
                </flux:button>

                <flux:button type="submit" variant="primary">
                    {{ $categoryId ? 'Perbarui Kategori' : 'Simpan Kategori' }}
                </flux:button>
            </div>
        </form>
    </flux:card>
</div>
