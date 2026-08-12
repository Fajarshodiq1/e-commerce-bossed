<div class="space-y-6">
    <div>
        <flux:heading size="xl">Dashboard</flux:heading>
        <flux:subheading>Ringkasan data toko Anda</flux:subheading>
    </div>

    {{-- Grid statistik utama --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <flux:card class="space-y-2">
            <div class="flex items-center justify-between">
                <flux:text size="sm" class="text-zinc-500">Produk</flux:text>
                <flux:icon.cube variant="outline" class="size-5 text-zinc-400" />
            </div>
            <flux:heading size="2xl">{{ $this->stats['products']['total'] }}</flux:heading>
            <div class="flex gap-2">
                <flux:badge size="sm" color="green">{{ $this->stats['products']['active'] }} aktif</flux:badge>
                <flux:badge size="sm" color="yellow">{{ $this->stats['products']['featured'] }} unggulan
                </flux:badge>
            </div>
        </flux:card>

        <flux:card class="space-y-2">
            <div class="flex items-center justify-between">
                <flux:text size="sm" class="text-zinc-500">Kategori</flux:text>
                <flux:icon.tag variant="outline" class="size-5 text-zinc-400" />
            </div>
            <flux:heading size="2xl">{{ $this->stats['categories']['total'] }}</flux:heading>
        </flux:card>

        <flux:card class="space-y-2">
            <div class="flex items-center justify-between">
                <flux:text size="sm" class="text-zinc-500">Ulasan Produk</flux:text>
                <flux:icon.star variant="outline" class="size-5 text-zinc-400" />
            </div>
            <flux:heading size="2xl">{{ $this->stats['reviews']['total'] }}</flux:heading>
            <div class="flex flex-wrap gap-2">
                <flux:badge size="sm" color="orange">{{ $this->stats['reviews']['pending'] }} pending</flux:badge>
                <flux:badge size="sm" color="green">{{ $this->stats['reviews']['approved'] }} approved
                </flux:badge>
                <flux:badge size="sm" color="zinc">rata-rata {{ $this->stats['reviews']['avg_rating'] ?? 0 }}★
                </flux:badge>
            </div>
        </flux:card>

        <flux:card class="space-y-2">
            <div class="flex items-center justify-between">
                <flux:text size="sm" class="text-zinc-500">Testimoni</flux:text>
                <flux:icon.chat-bubble-left-right variant="outline" class="size-5 text-zinc-400" />
            </div>
            <flux:heading size="2xl">{{ $this->stats['testimonials']['total'] }}</flux:heading>
            <div class="flex gap-2">
                <flux:badge size="sm" color="orange">{{ $this->stats['testimonials']['pending'] }} pending
                </flux:badge>
                <flux:badge size="sm" color="green">{{ $this->stats['testimonials']['approved'] }} approved
                </flux:badge>
            </div>
        </flux:card>

        <flux:card class="space-y-2">
            <div class="flex items-center justify-between">
                <flux:text size="sm" class="text-zinc-500">Partner</flux:text>
                <flux:icon.building-office variant="outline" class="size-5 text-zinc-400" />
            </div>
            <flux:heading size="2xl">{{ $this->stats['partners']['total'] }}</flux:heading>
            <flux:badge size="sm" color="green">{{ $this->stats['partners']['active'] }} aktif</flux:badge>
        </flux:card>

        <flux:card class="space-y-2">
            <div class="flex items-center justify-between">
                <flux:text size="sm" class="text-zinc-500">Showcase Produk</flux:text>
                <flux:icon.photo variant="outline" class="size-5 text-zinc-400" />
            </div>
            <flux:heading size="2xl">{{ $this->stats['showcases']['total'] }}</flux:heading>
            <flux:badge size="sm" color="green">{{ $this->stats['showcases']['active'] }} aktif</flux:badge>
        </flux:card>

        <flux:card class="space-y-2">
            <div class="flex items-center justify-between">
                <flux:text size="sm" class="text-zinc-500">Pengguna</flux:text>
                <flux:icon.users variant="outline" class="size-5 text-zinc-400" />
            </div>
            <flux:heading size="2xl">{{ $this->stats['users']['total'] }}</flux:heading>
        </flux:card>
    </div>

    {{-- Dua tabel: review & testimoni yang menunggu approval --}}
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <flux:card>
            <flux:heading size="lg" class="mb-4">Ulasan Menunggu Approval</flux:heading>

            @if ($this->recentReviews->isEmpty())
                <flux:text class="text-zinc-500">Tidak ada ulasan pending.</flux:text>
            @else
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column>Produk</flux:table.column>
                        <flux:table.column>Nama</flux:table.column>
                        <flux:table.column>Rating</flux:table.column>
                    </flux:table.columns>
                    <flux:table.rows>
                        @foreach ($this->recentReviews as $review)
                            <flux:table.row :key="$review->id">
                                <flux:table.cell>{{ $review->product?->name ?? '-' }}</flux:table.cell>
                                <flux:table.cell>{{ $review->name }}</flux:table.cell>
                                <flux:table.cell>{{ $review->rating }}★</flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            @endif
        </flux:card>

        <flux:card>
            <flux:heading size="lg" class="mb-4">Testimoni Menunggu Approval</flux:heading>

            @if ($this->recentTestimonials->isEmpty())
                <flux:text class="text-zinc-500">Tidak ada testimoni pending.</flux:text>
            @else
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column>Nama</flux:table.column>
                        <flux:table.column>Peran/Perusahaan</flux:table.column>
                        <flux:table.column>Rating</flux:table.column>
                    </flux:table.columns>
                    <flux:table.rows>
                        @foreach ($this->recentTestimonials as $testimonial)
                            <flux:table.row :key="$testimonial->id">
                                <flux:table.cell>{{ $testimonial->name }}</flux:table.cell>
                                <flux:table.cell>{{ $testimonial->role_or_company }}</flux:table.cell>
                                <flux:table.cell>{{ $testimonial->rating }}★</flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            @endif
        </flux:card>
    </div>
</div>
