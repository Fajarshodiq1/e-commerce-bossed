<div class="md:p-6 mx-auto space-y-6" x-data="{ activeTab: 'identity' }">
    {{-- Header --}}
    <div>
        <flux:heading size="xl" level="1">Pengaturan Web & WhatsApp</flux:heading>
        <flux:subheading>
            Kelola identitas toko, gambar halaman, WhatsApp order, sosial media, dan SEO.
        </flux:subheading>
    </div>

    {{-- Flash message --}}
    @if (session()->has('message'))
        <flux:badge color="green" size="lg" class="w-full justify-start py-3 px-4">
            {{ session('message') }}
        </flux:badge>
    @endif

    {{-- Custom Tab Navigation Menu --}}
    <div class="border-b border-zinc-200 dark:border-zinc-700">
        <nav class="-mb-px flex space-x-2 overflow-x-auto" aria-label="Tabs">
            {{-- Tab 1: Identitas Toko --}}
            <button type="button" @click="activeTab = 'identity'"
                :class="activeTab === 'identity'
                    ?
                    'border-indigo-600 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400 font-semibold' :
                    'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-200'"
                class="flex items-center gap-2 whitespace-nowrap py-3 px-4 border-b-2 text-sm transition-colors duration-150">
                <flux:icon name="building-storefront" class="w-4 h-4" />
                <span>Identitas Toko</span>
            </button>

            {{-- Tab 2: Media & Gambar --}}
            <button type="button" @click="activeTab = 'media'"
                :class="activeTab === 'media'
                    ?
                    'border-indigo-600 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400 font-semibold' :
                    'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-200'"
                class="flex items-center gap-2 whitespace-nowrap py-3 px-4 border-b-2 text-sm transition-colors duration-150">
                <flux:icon name="photo" class="w-4 h-4" />
                <span>Media & Gambar</span>
            </button>

            {{-- Tab 3: WhatsApp Order --}}
            <button type="button" @click="activeTab = 'whatsapp'"
                :class="activeTab === 'whatsapp'
                    ?
                    'border-indigo-600 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400 font-semibold' :
                    'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-200'"
                class="flex items-center gap-2 whitespace-nowrap py-3 px-4 border-b-2 text-sm transition-colors duration-150">
                <flux:icon name="phone" class="w-4 h-4" />
                <span>WhatsApp Order</span>
            </button>

            {{-- Tab 4: Sosial Media --}}
            <button type="button" @click="activeTab = 'social'"
                :class="activeTab === 'social'
                    ?
                    'border-indigo-600 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400 font-semibold' :
                    'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-200'"
                class="flex items-center gap-2 whitespace-nowrap py-3 px-4 border-b-2 text-sm transition-colors duration-150">
                <flux:icon name="share" class="w-4 h-4" />
                <span>Sosial Media</span>
            </button>

            {{-- Tab 5: Global SEO --}}
            <button type="button" @click="activeTab = 'seo'"
                :class="activeTab === 'seo'
                    ?
                    'border-indigo-600 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400 font-semibold' :
                    'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-200'"
                class="flex items-center gap-2 whitespace-nowrap py-3 px-4 border-b-2 text-sm transition-colors duration-150">
                <flux:icon name="magnifying-glass" class="w-4 h-4" />
                <span>Global SEO</span>
            </button>
        </nav>
    </div>

    {{-- Form Utama --}}
    <form wire:submit.prevent="save" class="space-y-6">

        {{-- TAB 1: IDENTITAS TOKO --}}
        <div x-show="activeTab === 'identity'" x-cloak
            class="p-6 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl space-y-6 shadow-sm">
            <flux:heading size="lg" level="2" class="border-b border-zinc-200 dark:border-zinc-700 pb-2">
                Identitas Toko
            </flux:heading>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                <flux:field>
                    <flux:label>Nama Toko</flux:label>
                    <flux:input wire:model="store_name" type="text" placeholder="Contoh: Toko Onlineku"
                        icon="building-storefront" />
                    <flux:error name="store_name" />
                </flux:field>

                <flux:field>
                    <flux:label>Tagline / Slogan Toko</flux:label>
                    <flux:input wire:model="tagline" type="text" placeholder="Contoh: Belanja Mudah, Cepat, Aman"
                        icon="pencil-square" />
                    <flux:error name="tagline" />
                </flux:field>

                <flux:field>
                    <flux:label>Email Toko</flux:label>
                    <flux:input wire:model="email" type="email" placeholder="Contoh: admin@toko.com"
                        icon="envelope" />
                    <flux:error name="email" />
                </flux:field>

                <flux:field>
                    <flux:label>Alamat Toko</flux:label>
                    <flux:textarea wire:model="address" rows="3"
                        placeholder="Contoh: Jl. Raya No. 123, Jakarta, Indonesia" />
                    <flux:error name="address" />
                </flux:field>

                <flux:field class="md:col-span-2">
                    <flux:label>Deskripsi Singkat Toko</flux:label>
                    <flux:textarea wire:model="description" rows="3"
                        placeholder="Contoh: Toko online terpercaya yang menyediakan berbagai produk berkualitas..." />
                    <flux:error name="description" />
                </flux:field>
            </div>

            {{-- Logo Toko --}}
            <flux:field>
                <flux:label>Logo Toko</flux:label>
                <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                    <div class="flex-1">
                        <flux:input wire:model="store_logo" type="file" accept="image/*" />
                        <flux:description class="mt-1">
                            Format PNG/SVG latar belakang transparan disarankan. Max 1MB.
                        </flux:description>
                        <flux:error name="store_logo" />
                        <div wire:loading wire:target="store_logo" class="text-xs text-zinc-500 mt-1">
                            Mengunggah logo...
                        </div>
                    </div>

                    @if ($store_logo)
                        <div>
                            <flux:label class="text-xs mb-1">Preview Logo Baru</flux:label>
                            <div
                                class="inline-block p-2 bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg">
                                <img src="{{ $store_logo->temporaryUrl() }}" class="h-16 object-contain">
                            </div>
                        </div>
                    @elseif ($oldStoreLogo)
                        <div>
                            <flux:label class="text-xs mb-1">Logo Saat Ini</flux:label>
                            <div
                                class="inline-block p-2 bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg">
                                <img src="{{ asset('storage/' . $oldStoreLogo) }}" class="h-16 object-contain">
                            </div>
                        </div>
                    @endif
                </div>
            </flux:field>
        </div>

        {{-- TAB 2: MEDIA & GAMBAR HALAMAN --}}
        <div x-show="activeTab === 'media'" x-cloak
            class="p-6 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl space-y-6 shadow-sm">
            <flux:heading size="lg" level="2" class="border-b border-zinc-200 dark:border-zinc-700 pb-2">
                Gambar Halaman Web
            </flux:heading>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $images = [
                        ['name' => 'imgHeroHome', 'old' => $oldImgHeroHome, 'label' => 'Hero Homepage'],
                        ['name' => 'imgAboutHome', 'old' => $oldImgAboutHome, 'label' => 'About Homepage'],
                        ['name' => 'imgAboutHeader', 'old' => $oldImgAboutHeader, 'label' => 'Header About Page'],
                        ['name' => 'imgAboutStory', 'old' => $oldImgAboutStory, 'label' => 'Story About Page'],
                        [
                            'name' => 'imgAboutPhilosophy',
                            'old' => $oldImgAboutPhilosophy,
                            'label' => 'Philosophy About Page',
                        ],
                        ['name' => 'imgGalleryHeader', 'old' => $oldImgGalleryHeader, 'label' => 'Header Gallery Page'],
                    ];
                @endphp

                @foreach ($images as $img)
                    <flux:field
                        class="p-4 border border-zinc-100 dark:border-zinc-700/60 rounded-lg bg-zinc-50/50 dark:bg-zinc-900/50">
                        <flux:label>{{ $img['label'] }}</flux:label>

                        <div class="flex flex-col space-y-3 mt-2">

                            {{-- Preview: gambar baru (belum disimpan) --}}
                            @if ($this->{$img['name']})
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-xs text-zinc-500">Preview Baru:</span>
                                        <button type="button" wire:click="$set('{{ $img['name'] }}', null)"
                                            class="text-xs font-medium text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 flex items-center gap-1">
                                            <flux:icon name="x-mark" class="w-3.5 h-3.5" />
                                            Batalkan
                                        </button>
                                    </div>
                                    <div
                                        class="rounded-lg overflow-hidden border border-zinc-200 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-900">
                                        <img src="{{ $this->{$img['name']}->temporaryUrl() }}"
                                            class="w-full h-auto max-h-96 object-contain">
                                    </div>
                                </div>

                                {{-- Preview: gambar lama yang sudah tersimpan --}}
                            @elseif ($img['old'])
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-xs text-zinc-500">Saat Ini:</span>
                                        <button type="button" wire:click="removeImage('{{ $img['name'] }}')"
                                            wire:confirm="Yakin ingin menghapus gambar ini?"
                                            class="text-xs font-medium text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 flex items-center gap-1">
                                            <flux:icon name="trash" class="w-3.5 h-3.5" />
                                            Hapus
                                        </button>
                                    </div>
                                    <div
                                        class="rounded-lg overflow-hidden border border-zinc-200 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-900">
                                        <img src="{{ asset('storage/' . $img['old']) }}"
                                            class="w-full h-auto max-h-96 object-contain">
                                    </div>
                                </div>
                            @endif

                            <flux:input wire:model="{{ $img['name'] }}" type="file" accept="image/*" />
                            <flux:error name="{{ $img['name'] }}" />

                            <div wire:loading wire:target="{{ $img['name'] }}" class="text-xs text-zinc-500">
                                Mengunggah gambar...
                            </div>
                        </div>
                    </flux:field>
                @endforeach
            </div>
        </div>

        {{-- TAB 3: WHATSAPP ORDER --}}
        <div x-show="activeTab === 'whatsapp'" x-cloak
            class="p-6 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl space-y-6 shadow-sm">
            <flux:heading size="lg" level="2" class="border-b border-zinc-200 dark:border-zinc-700 pb-2">
                WhatsApp Order
            </flux:heading>

            <flux:field>
                <flux:label>Nomor WhatsApp Admin (Format: 628xxx)</flux:label>
                <flux:input wire:model="whatsapp_number" type="text" placeholder="6281234567890"
                    icon="phone" />
                <flux:description class="mt-1">
                    Gunakan awalan kode negara tanpa tanda + (contoh: 6281234567890)
                </flux:description>
                <flux:error name="whatsapp_number" />
            </flux:field>

            <flux:field>
                <flux:label>Template Pesan WhatsApp Order</flux:label>
                <flux:textarea wire:model="whatsapp_template" rows="4" />

                <div
                    class="bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 p-3 rounded-lg mt-2 text-xs text-zinc-600 dark:text-zinc-400">
                    <span class="font-semibold block mb-1">Variabel Dinamis yang Bisa Digunakan:</span>
                    <ul class="list-disc list-inside space-y-0.5">
                        <li><code
                                class="bg-zinc-200 dark:bg-zinc-800 px-1 py-0.5 rounded text-indigo-600 dark:text-indigo-400">{store_name}</code>
                            : Nama toko Anda</li>
                        <li><code
                                class="bg-zinc-200 dark:bg-zinc-800 px-1 py-0.5 rounded text-indigo-600 dark:text-indigo-400">{product_name}</code>
                            : Nama produk yang diorder</li>
                        <li><code
                                class="bg-zinc-200 dark:bg-zinc-800 px-1 py-0.5 rounded text-indigo-600 dark:text-indigo-400">{product_price}</code>
                            : Harga produk</li>
                        <li><code
                                class="bg-zinc-200 dark:bg-zinc-800 px-1 py-0.5 rounded text-indigo-600 dark:text-indigo-400">{product_url}</code>
                            : Link URL produk</li>
                    </ul>
                </div>
                <flux:error name="whatsapp_template" />
            </flux:field>
        </div>

        {{-- TAB 4: SOSIAL MEDIA --}}
        <div x-show="activeTab === 'social'" x-cloak
            class="p-6 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl space-y-6 shadow-sm">
            <flux:heading size="lg" level="2" class="border-b border-zinc-200 dark:border-zinc-700 pb-2">
                Sosial Media
            </flux:heading>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                <flux:field>
                    <flux:label>Instagram</flux:label>
                    <flux:input wire:model="instagram_url" type="url"
                        placeholder="https://instagram.com/tokoanda" icon="camera" />
                    <flux:error name="instagram_url" />
                </flux:field>

                <flux:field>
                    <flux:label>Facebook</flux:label>
                    <flux:input wire:model="facebook_url" type="url" placeholder="https://facebook.com/tokoanda"
                        icon="hand-thumb-up" />
                    <flux:error name="facebook_url" />
                </flux:field>

                <flux:field>
                    <flux:label>Twitter / X</flux:label>
                    <flux:input wire:model="twitter_url" type="url" placeholder="https://x.com/tokoanda"
                        icon="at-symbol" />
                    <flux:error name="twitter_url" />
                </flux:field>

                <flux:field>
                    <flux:label>YouTube</flux:label>
                    <flux:input wire:model="youtube_url" type="url" placeholder="https://youtube.com/@tokoanda"
                        icon="play" />
                    <flux:error name="youtube_url" />
                </flux:field>

                <flux:field>
                    <flux:label>TikTok</flux:label>
                    <flux:input wire:model="tiktok_url" type="url" placeholder="https://tiktok.com/@tokoanda"
                        icon="musical-note" />
                    <flux:error name="tiktok_url" />
                </flux:field>
            </div>
        </div>

        {{-- TAB 5: GLOBAL SEO --}}
        <div x-show="activeTab === 'seo'" x-cloak
            class="p-6 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl space-y-6 shadow-sm">
            <flux:heading size="lg" level="2" class="border-b border-zinc-200 dark:border-zinc-700 pb-2">
                Global SEO Homepage Settings
            </flux:heading>

            <flux:field>
                <flux:label>Meta Title Global (Homepage)</flux:label>
                <flux:input wire:model="meta_title_global" type="text"
                    placeholder="Toko Onlineku - Katalog Produk Terlengkap" />
                <flux:error name="meta_title_global" />
            </flux:field>

            <flux:field>
                <flux:label>Meta Description Global (Homepage)</flux:label>
                <flux:textarea wire:model="meta_description_global" rows="3"
                    placeholder="Lihat katalog produk berkualitas kami..." />
                <flux:error name="meta_description_global" />
            </flux:field>
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end pt-4">
            <flux:button type="submit" variant="primary" icon="check">
                Simpan Pengaturan
            </flux:button>
        </div>
    </form>
</div>
