<div class="p-6 space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <flux:heading size="xl" level="1">Manajemen Partner / Brand</flux:heading>
            <flux:subheading>Kelola logo perusahaan atau brand yang bekerja sama dengan toko Anda.</flux:subheading>
        </div>

        <flux:button href="{{ route('admin.partners.create') }}" variant="primary" icon="plus">
            Tambah Partner Baru
        </flux:button>
    </div>

    <!-- Alert / Flash Message -->
    @if (session()->has('message'))
        <flux:badge color="green" size="lg" class="w-full justify-start py-3 px-4">
            {{ session('message') }}
        </flux:badge>
    @endif

    <!-- Filter & Search Section -->
    <div class="w-full md:w-1/3">
        <flux:input wire:model.live.debounce.300ms="search" type="search" placeholder="Cari nama partner..."
            icon="magnifying-glass" />
    </div>

    <!-- Data Table -->
    <flux:table>
        <flux:table.columns>
            <flux:table.column>Logo</flux:table.column>
            <flux:table.column>Nama Perusahaan / Brand</flux:table.column>
            <flux:table.column>Website / URL</flux:table.column>
            <flux:table.column>Urutan</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column class="text-right">Aksi</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse($partners as $partner)
                <flux:table.row :key="$partner->id">
                    <!-- Column: Logo -->
                    <flux:table.cell>
                        @if ($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                class="h-10 object-contain max-w-[120px] rounded border border-zinc-200 dark:border-zinc-700 p-1 bg-white dark:bg-zinc-800">
                        @else
                            <div
                                class="w-10 h-10 bg-zinc-100 dark:bg-zinc-800 rounded flex items-center justify-center text-xs text-zinc-400">
                                No Logo
                            </div>
                        @endif
                    </flux:table.cell>

                    <!-- Column: Nama -->
                    <flux:table.cell class="font-medium text-zinc-800 dark:text-zinc-200">
                        {{ $partner->name }}
                    </flux:table.cell>

                    <!-- Column: Website / URL -->
                    <flux:table.cell class="text-sm text-zinc-500 dark:text-zinc-400">
                        @if ($partner->url)
                            <flux:link href="{{ $partner->url }}" target="_blank" icon-trailing="arrow-up-right">
                                {{ Str::limit($partner->url, 30) }}
                            </flux:link>
                        @else
                            <span class="text-zinc-400 dark:text-zinc-600">-</span>
                        @endif
                    </flux:table.cell>

                    <!-- Column: Urutan -->
                    <flux:table.cell class="text-zinc-600 dark:text-zinc-400 text-sm">
                        {{ $partner->sort_order }}
                    </flux:table.cell>

                    <!-- Column: Status Toggle Badge -->
                    <flux:table.cell>
                        <flux:badge as="button" wire:click="toggleActive({{ $partner->id }})"
                            color="{{ $partner->is_active ? 'green' : 'zinc' }}" size="sm"
                            class="cursor-pointer hover:opacity-80 transition">
                            {{ $partner->is_active ? 'Aktif' : 'Sembunyi' }}
                        </flux:badge>
                    </flux:table.cell>

                    <!-- Column: Action Buttons -->
                    <flux:table.cell class="text-right">
                        <div class="flex justify-end gap-2">
                            <flux:button href="{{ route('admin.partners.edit', $partner->id) }}" variant="ghost"
                                size="sm" icon="pencil">
                                Edit
                            </flux:button>

                            <flux:button wire:click="delete({{ $partner->id }})"
                                wire:confirm="Yakin ingin menghapus partner ini?" variant="danger" size="sm"
                                icon="trash">
                                Hapus
                            </flux:button>
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="6" class="text-center py-6 text-zinc-500 dark:text-zinc-400">
                        Belum ada data partner.
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    <!-- Pagination -->
    <div>
        {{ $partners->links() }}
    </div>
</div>
