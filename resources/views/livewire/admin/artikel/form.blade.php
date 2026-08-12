<div class="space-y-6">
    <div>
        <flux:heading size="xl" level="1">
            {{ $article && $article->exists ? 'Edit Artikel' : 'Tambah Artikel Baru' }}
        </flux:heading>
        <flux:subheading>
            Isi konten artikel, atur Table of Contents, dan optimalkan Meta SEO.
        </flux:subheading>
    </div>

    <form wire:submit="save" class="space-y-6">
        <!-- Section 1: Konten Utama -->
        <flux:card class="space-y-6">
            <flux:heading size="lg">Konten Artikel</flux:heading>

            <flux:input wire:model.live="title" label="Judul Artikel *" placeholder="Masukkan judul artikel..." required />

            <flux:checkbox wire:model.live="has_toc" label="Aktifkan Table of Contents (TOC)"
                description="TOC otomatis dibuat dari tag <h2> dan <h3> pada konten artikel." />

            <!-- Quill JS Editor Container -->
            <div>
                <flux:label class="mb-1.5">Konten Artikel *</flux:label>

                <div x-data="{
                    content: @entangle('content'),
                    quill: null
                }" x-init="quill = new Quill($refs.editor, {
                    theme: 'snow',
                    placeholder: 'Tuliskan konten artikel. Gunakan Heading 2 atau Heading 3 untuk TOC...',
                    modules: {
                        toolbar: [
                            [{ 'header': [2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            ['link', 'image', 'blockquote', 'code-block'],
                            ['clean']
                        ]
                    }
                });
                
                // Set konten awal jika ada
                if (content) {
                    quill.root.innerHTML = content;
                }
                
                // Update Livewire ketika isi editor berubah
                quill.on('text-change', () => {
                    content = quill.root.innerHTML;
                });
                
                // Sinkronkan balik jika Livewire memperbarui nilai content dari server
                $watch('content', (value) => {
                    if (value !== quill.root.innerHTML) {
                        quill.root.innerHTML = value || '';
                    }
                });" wire:ignore>
                    <div x-ref="editor" class="bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 rounded-b-lg">
                    </div>
                </div>

                <flux:error name="content" />
            </div>
        </flux:card>

        <!-- Section 2: SEO & Meta Data -->
        <flux:card class="space-y-6">
            <div>
                <flux:heading size="lg">Optimasi SEO & Social Media</flux:heading>
                <flux:subheading>
                    Atur tampilan meta tags untuk pencarian Google dan pratinjau pesan media sosial.
                </flux:subheading>
            </div>

            <flux:input wire:model="meta_title" label="Meta Title" placeholder="Judul SEO yang muncul di Google" />

            <flux:textarea wire:model="meta_description" label="Meta Description"
                placeholder="Ringkasan singkat artikel (150-160 karakter)" rows="3" />

            <flux:input wire:model="meta_keywords" label="Meta Keywords"
                placeholder="Contoh: souvenir kulit, seminar kit, gift set custom" />

            <div>
                <flux:input type="file" wire:model="featured_image" label="Featured / OpenGraph Image"
                    description="Format gambar: JPG / PNG (Maksimal 2MB)." />

                @if ($featured_image)
                    <div class="mt-3">
                        <img src="{{ $featured_image->temporaryUrl() }}"
                            class="h-32 w-auto rounded-lg border border-zinc-200 dark:border-zinc-700 object-cover" />
                    </div>
                @elseif ($existing_featured_image)
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $existing_featured_image) }}"
                            class="h-32 w-auto rounded-lg border border-zinc-200 dark:border-zinc-700 object-cover" />
                    </div>
                @endif
            </div>
        </flux:card>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-3">
            <flux:button :href="route('admin.artikel.index')" wire:navigate variant="subtle">
                Batal
            </flux:button>

            <flux:button type="submit" variant="primary">
                {{ $article && $article->exists ? 'Simpan Perubahan' : 'Terbit Artikel' }}
            </flux:button>
        </div>
    </form>
</div>
