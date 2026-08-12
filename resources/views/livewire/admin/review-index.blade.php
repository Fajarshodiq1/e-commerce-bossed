<div class="md:p-6 space-y-6">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">Moderasi Ulasan Produk</flux:heading>
            <flux:subheading>
                Tinjau ulasan dan rating produk dari pengunjung sebelum ditayangkan di halaman detail produk.
            </flux:subheading>
        </div>

        <flux:button wire:click="create" variant="primary" icon="plus">
            Tambah Ulasan
        </flux:button>
    </div>

    <!-- Alert / Flash Message -->
    @if (session()->has('message'))
        <flux:badge color="green" size="lg" class="w-full justify-start py-3 px-4">
            {{ session('message') }}
        </flux:badge>
    @endif

    <!-- Filter & Search Section -->
    <div
        class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white dark:bg-zinc-800 p-4 rounded-xl border border-zinc-200 dark:border-zinc-700 shadow-sm">
        <div class="w-full md:w-1/3">
            <flux:input wire:model.live.debounce.300ms="search" type="search"
                placeholder="Cari pengirim, email, produk, atau komentar..." icon="magnifying-glass" />
        </div>

        <!-- Filter Status Buttons -->
        <div class="flex flex-wrap gap-2 w-full md:w-auto">
            <flux:button wire:click="$set('filterStatus', 'all')"
                variant="{{ $filterStatus === 'all' ? 'primary' : 'subtle' }}" size="sm">
                Semua
            </flux:button>

            <flux:button wire:click="$set('filterStatus', 'pending')"
                variant="{{ $filterStatus === 'pending' ? 'filled' : 'subtle' }}" color="yellow" size="sm">
                Perlu Moderasi (Pending)
            </flux:button>

            <flux:button wire:click="$set('filterStatus', 'approved')"
                variant="{{ $filterStatus === 'approved' ? 'filled' : 'subtle' }}" color="green" size="sm">
                Disetujui
            </flux:button>

            <flux:button wire:click="$set('filterStatus', 'rejected')"
                variant="{{ $filterStatus === 'rejected' ? 'filled' : 'subtle' }}" color="red" size="sm">
                Ditolak
            </flux:button>
        </div>
    </div>

    <!-- Data Table -->
    <flux:table>
        <flux:table.columns>
            <flux:table.column>Pengirim & Email</flux:table.column>
            <flux:table.column>Produk</flux:table.column>
            <flux:table.column>Rating</flux:table.column>
            <flux:table.column>Ulasan</flux:table.column>
            <flux:table.column>Tanggal</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column class="text-right">Aksi Moderasi</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse($reviews as $item)
                <flux:table.row :key="$item->id">
                    <!-- Column: Pengirim & Email -->
                    <flux:table.cell>
                        <div class="flex items-center gap-3">
                            <flux:avatar name="{{ $item->name }}" size="sm" />
                            <div>
                                <div class="font-medium text-zinc-800 dark:text-zinc-200 text-sm">
                                    {{ $item->name }}
                                </div>
                                <div class="text-xs text-zinc-400 dark:text-zinc-500">
                                    {{ $item->email ?? 'Tidak ada email' }}
                                </div>
                            </div>
                        </div>
                    </flux:table.cell>

                    <!-- Column: Produk -->
                    <flux:table.cell class="max-w-[180px]">
                        <div class="font-medium text-xs text-zinc-700 dark:text-zinc-300 truncate"
                            title="{{ $item->product->name ?? 'Produk Dihapus' }}">
                            {{ $item->product->name ?? 'Produk Dihapus' }}
                        </div>
                    </flux:table.cell>

                    <!-- Column: Rating Stars -->
                    <flux:table.cell>
                        <div class="flex text-amber-400 text-sm">
                            @for ($i = 1; $i <= 5; $i++)
                                <span>{{ $i <= $item->rating ? '★' : '☆' }}</span>
                            @endfor
                        </div>
                    </flux:table.cell>

                    <!-- Column: Comment -->
                    <flux:table.cell class="max-w-md">
                        <p
                            class="italic text-xs bg-zinc-50 dark:bg-zinc-900/50 p-2.5 rounded-lg border border-zinc-200 dark:border-zinc-700 text-zinc-700 dark:text-zinc-300">
                            "{{ $item->comment }}"
                        </p>
                    </flux:table.cell>

                    <!-- Column: Tanggal -->
                    <flux:table.cell class="text-xs text-zinc-500 dark:text-zinc-400 whitespace-nowrap">
                        {{ $item->created_at->format('d M Y, H:i') }}
                    </flux:table.cell>

                    <!-- Column: Status Badge -->
                    <flux:table.cell class="whitespace-nowrap">
                        @if ($item->status === 'approved')
                            <flux:badge color="green" size="sm">Disetujui</flux:badge>
                        @elseif($item->status === 'rejected')
                            <flux:badge color="red" size="sm">Ditolak</flux:badge>
                        @else
                            <flux:badge color="yellow" size="sm">Pending</flux:badge>
                        @endif
                    </flux:table.cell>

                    <!-- Column: Action Buttons -->
                    <flux:table.cell class="text-right whitespace-nowrap">
                        <div class="flex justify-end items-center gap-1.5">
                            @if ($item->status !== 'approved')
                                <flux:button wire:click="updateStatus({{ $item->id }}, 'approved')"
                                    variant="filled" color="green" size="sm" icon="check">
                                    Setujui
                                </flux:button>
                            @endif

                            @if ($item->status !== 'rejected')
                                <flux:button wire:click="updateStatus({{ $item->id }}, 'rejected')"
                                    variant="filled" color="yellow" size="sm" icon="x-mark">
                                    Tolak
                                </flux:button>
                            @endif

                            <flux:button wire:click="delete({{ $item->id }})"
                                wire:confirm="Yakin ingin menghapus ulasan ini secara permanen?" variant="danger"
                                size="sm" icon="trash">
                                Hapus
                            </flux:button>
                            <flux:button wire:click="edit({{ $item->id }})" variant="subtle" size="sm"
                                icon="pencil">
                                Edit
                            </flux:button>
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="7" class="text-center py-6 text-zinc-500 dark:text-zinc-400">
                        Tidak ada data ulasan produk.
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    <!-- Pagination -->
    <div>
        {{ $reviews->links() }}
    </div>

    <!-- Modal Tambah/Edit Ulasan -->
    <flux:modal wire:model.self="showModal" class="max-w-2xl w-full">
        <form wire:submit="save" class="space-y-5">
            <div>
                <flux:heading size="lg">
                    {{ $editingId ? 'Edit Ulasan Produk' : 'Tambah Ulasan Baru' }}
                </flux:heading>
                <flux:subheading>
                    {{ $editingId ? 'Perbarui data ulasan ini.' : 'Input manual ulasan dari admin.' }}
                </flux:subheading>
            </div>

            <!-- Produk (Full Width) -->
            <flux:field>
                <flux:label>Produk <span class="text-red-500">*</span></flux:label>
                <flux:select wire:model="product_id" placeholder="Pilih produk...">
                    @foreach ($products as $product)
                        <flux:select.option value="{{ $product->id }}">{{ $product->name }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="product_id" />
            </flux:field>

            <!-- Grid 2 kolom untuk Nama & Email -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nama -->
                <flux:field>
                    <flux:label>Nama Pengirim <span class="text-red-500">*</span></flux:label>
                    <flux:input wire:model="name" placeholder="Masukkan nama" />
                    <flux:error name="name" />
                </flux:field>

                <!-- Email -->
                <flux:field>
                    <flux:label>Email (opsional)</flux:label>
                    <flux:input wire:model="email" type="email" placeholder="nama@email.com" />
                    <flux:error name="email" />
                </flux:field>
            </div>

            <!-- Grid 2 kolom untuk Rating & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                <!-- Rating -->
                <flux:field>
                    <flux:label>Rating <span class="text-red-500">*</span></flux:label>
                    <div class="flex gap-1 text-3xl select-none pt-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" wire:click="setRating({{ $i }})"
                                class="transition-transform hover:scale-110 {{ $i <= $rating ? 'text-amber-400' : 'text-zinc-300 dark:text-zinc-600' }}">
                                ★
                            </button>
                        @endfor
                    </div>
                    <flux:error name="rating" />
                </flux:field>

                <!-- Status -->
                <flux:field>
                    <flux:label>Status <span class="text-red-500">*</span></flux:label>
                    <flux:select wire:model="status">
                        <flux:select.option value="pending">Pending</flux:select.option>
                        <flux:select.option value="approved">Disetujui</flux:select.option>
                        <flux:select.option value="rejected">Ditolak</flux:select.option>
                    </flux:select>
                    <flux:error name="status" />
                </flux:field>
            </div>

            <!-- Komentar (Full Width) -->
            <flux:field>
                <flux:label>Isi Ulasan <span class="text-red-500">*</span></flux:label>
                <flux:textarea wire:model="comment" rows="4" placeholder="Tulis ulasan produk..." />
                <flux:error name="comment" />
            </flux:field>

            <!-- Actions -->
            <div class="flex justify-end gap-2 pt-2">
                <flux:button type="button" variant="subtle" wire:click="closeModal">
                    Batal
                </flux:button>
                <flux:button type="submit" variant="primary" wire:loading.attr="disabled" wire:target="save">
                    <span wire:loading.remove wire:target="save">
                        {{ $editingId ? 'Simpan Perubahan' : 'Tambah Ulasan' }}
                    </span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>
