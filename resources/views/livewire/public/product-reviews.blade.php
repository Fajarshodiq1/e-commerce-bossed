<div class="space-y-6 sm:space-y-8">

    <div class="bg-white rounded-2xl border border-gray-100 p-4 sm:p-8 shadow-sm">
        <flux:heading size="lg" class="mb-1">Ulasan Produk</flux:heading>
        <flux:subheading class="mb-5">Apa kata pembeli lain</flux:subheading>

        <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 sm:gap-10">

            {{-- Ringkasan rating --}}
            <div
                class="sm:col-span-4 flex flex-col items-center sm:items-start gap-2 sm:border-r sm:border-gray-100 sm:pr-8">
                <div class="text-4xl font-extrabold text-gray-900">
                    {{ $this->averageRating ?: '0.0' }}
                </div>
                <div class="flex gap-0.5">
                    @for ($i = 1; $i <= 5; $i++)
                        <flux:icon.star variant="{{ $i <= round($this->averageRating) ? 'solid' : 'outline' }}"
                            class="w-4 h-4 {{ $i <= round($this->averageRating) ? 'text-amber-500' : 'text-gray-300' }}" />
                    @endfor
                </div>
                <flux:text size="sm" class="text-gray-500">
                    {{ $this->reviewCount }} ulasan
                </flux:text>

                {{-- Breakdown per bintang --}}
                <div class="w-full mt-3 space-y-1.5">
                    @foreach ($this->ratingBreakdown as $star => $data)
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <span class="w-3">{{ $star }}</span>
                            <flux:icon.star variant="solid" class="w-3 h-3 text-amber-400 shrink-0" />
                            <div class="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-amber-500 rounded-full" style="width: {{ $data['percent'] }}%">
                                </div>
                            </div>
                            <span class="w-6 text-right">{{ $data['count'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Daftar ulasan --}}
            <div class="sm:col-span-8 space-y-5">
                @forelse ($this->approvedReviews as $review)
                    <div class="border-b border-gray-100 last:border-0 pb-4 last:pb-0">
                        <div class="flex items-center justify-between">
                            <flux:text class="font-semibold text-gray-800">{{ $review->name }}</flux:text>
                            <flux:text size="sm" class="text-gray-400">
                                {{ $review->created_at->translatedFormat('d M Y') }}
                            </flux:text>
                        </div>
                        <div class="flex gap-0.5 my-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <flux:icon.star variant="{{ $i <= $review->rating ? 'solid' : 'outline' }}"
                                    class="w-3.5 h-3.5 {{ $i <= $review->rating ? 'text-amber-500' : 'text-gray-300' }}" />
                            @endfor
                        </div>
                        <flux:text size="sm" class="text-gray-600 leading-relaxed">
                            {{ $review->comment }}
                        </flux:text>
                    </div>
                @empty
                    <flux:text class="text-gray-400 text-sm">Belum ada ulasan untuk produk ini.</flux:text>
                @endforelse

                @if ($this->approvedReviews->hasPages())
                    <div class="pt-2">
                        {{ $this->approvedReviews->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
