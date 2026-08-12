<div class="md:p-6 mx-auto space-y-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">
                {{ $partnerId ? 'Edit Partner' : 'Tambah Partner Baru' }}
            </flux:heading>
            <flux:subheading>
                Isi detail partner atau logo brand pendukung toko Anda.
            </flux:subheading>
        </div>

        <flux:button href="{{ route('admin.partners') }}" variant="ghost" size="sm" icon="arrow-left">
            Kembali
        </flux:button>
    </div>

    <!-- Form Section -->
    <div class="p-6 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl shadow-sm">
        <form wire:submit.prevent="save" class="space-y-6">

            <!-- Nama Perusahaan / Brand -->
            <flux:field>
                <flux:label>Nama Perusahaan / Brand</flux:label>
                <flux:input wire:model="name" type="text" placeholder="Contoh: PT Sumber Makmur / Nike" />
                <flux:error name="name" />
            </flux:field>

            <!-- Logo Perusahaan -->
            <flux:field>
                <flux:label>Logo Perusahaan</flux:label>
                <flux:input wire:model="logo" type="file" />
                <flux:description class="mt-1">
                    Format PNG/SVG dengan latar belakang transparan disarankan. Max 1MB.
                </flux:description>
                <flux:error name="logo" />

                <!-- Preview Logo -->
                @if ($logo || $oldLogo)
                    <div class="mt-3">
                        <flux:label class="text-xs mb-1">
                            {{ $logo ? 'Preview Logo Baru:' : 'Logo Saat Ini:' }}
                        </flux:label>
                        <div
                            class="inline-block p-2 bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg">
                            <img src="{{ $logo ? $logo->temporaryUrl() : asset('storage/' . $oldLogo) }}"
                                class="h-16 object-contain">
                        </div>
                    </div>
                @endif
            </flux:field>

            <!-- Link Website Partner -->
            <flux:field>
                <flux:label>Link Website Partner (Opsional)</flux:label>
                <flux:input wire:model="url" type="url" placeholder="https://perusahaan.com" icon="link" />
                <flux:error name="url" />
            </flux:field>

            <!-- Grid: Urutan Tampil & Checkbox Active -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-start pt-2">
                <div>
                    <flux:field>
                        <flux:label>Urutan Tampil (Sort Order)</flux:label>
                        <flux:input wire:model="sort_order" type="number" />
                        <flux:description class="mt-1">
                            Angka kecil tampil lebih dulu (misal: 1, 2, 3)
                        </flux:description>
                        <flux:error name="sort_order" />
                    </flux:field>
                </div>

                <div class="sm:pt-8">
                    <flux:checkbox wire:model="is_active" label="Tampilkan di Web" />
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                <flux:button href="{{ route('admin.partners') }}" variant="ghost">
                    Batal
                </flux:button>

                <flux:button type="submit" variant="primary" icon="check">
                    {{ $partnerId ? 'Perbarui Partner' : 'Simpan Partner' }}
                </flux:button>
            </div>
        </form>
    </div>
</div>
