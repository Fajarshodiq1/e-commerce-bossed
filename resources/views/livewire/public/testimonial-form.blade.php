<div
    class="p-6 md:p-8 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-2xl shadow-lg space-y-6 max-w-2xl mx-auto">
    <!-- Header Section -->
    <div>
        <flux:heading size="xl" level="3">Kirim Ulasan Anda</flux:heading>
        <flux:subheading>
            Pengalaman Anda sangat berharga bagi peningkatan kualitas layanan kami.
        </flux:subheading>
    </div>

    <!-- Alert / Success Message -->
    @if (session()->has('success_testimonial'))
        <flux:badge color="green" size="lg" class="w-full justify-start py-3 px-4">
            {{ session('success_testimonial') }}
        </flux:badge>
    @endif

    <form wire:submit.prevent="submit" class="space-y-4">
        <!-- Grid: Nama & Pekerjaan -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
            <flux:field>
                <flux:label>Nama Lengkap *</flux:label>
                <flux:input wire:model="name" type="text" placeholder="Contoh: Budi Santoso" />
                <flux:error name="name" />
            </flux:field>

            <flux:field>
                <flux:label>Pekerjaan / Perusahaan (Opsional)</flux:label>
                <flux:input wire:model="role_or_company" type="text"
                    placeholder="Contoh: Pembeli Setia / PT Melati" />
                <flux:error name="role_or_company" />
            </flux:field>
        </div>

        <!-- Rating Bintang -->
        <flux:field>
            <flux:label>Rating Bintang *</flux:label>
            <flux:select wire:model="rating">
                <flux:select.option value="5">★★★★★ (5 - Sangat Puas)</flux:select.option>
                <flux:select.option value="4">★★★★☆ (4 - Puas)</flux:select.option>
                <flux:select.option value="3">★★★☆☆ (3 - Cukup)</flux:select.option>
                <flux:select.option value="2">★★☆☆☆ (2 - Kurang)</flux:select.option>
                <flux:select.option value="1">★☆☆☆☆ (1 - Buruk)</flux:select.option>
            </flux:select>
            <flux:error name="rating" />
        </flux:field>

        <!-- Isi Ulasan -->
        <flux:field>
            <flux:label>Isi Ulasan / Testimonial *</flux:label>
            <flux:textarea wire:model="message" rows="3"
                placeholder="Tuliskan pengalaman Anda belanja di toko kami..." />
            <flux:error name="message" />
        </flux:field>

        <!-- Upload Foto / Profil -->
        <flux:field>
            <flux:label>Foto / Profil (Opsional)</flux:label>
            <flux:input wire:model="avatar" type="file" />
            <flux:error name="avatar" />
        </flux:field>

        <!-- Submit Button -->
        <flux:button type="submit" variant="primary" class="w-full" icon="paper-airplane">
            Kirim Testimonial
        </flux:button>
    </form>
</div>
