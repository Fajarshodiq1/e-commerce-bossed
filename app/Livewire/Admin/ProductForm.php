<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductForm extends Component
{
    use WithFileUploads;

    public $productId;
    public $category_id;
    public $name;
    public $price;
    public $description;
    public $is_active = true;
    public $is_featured = false;
    public $meta_title;
    public $meta_description;

    // Array tunggal untuk repeater gambar produk
    public $productImages = [];

    public function mount($id = null)
    {
        if ($id) {
            $product = Product::with('images')->findOrFail($id);
            $this->productId = $product->id;
            $this->category_id = $product->category_id;
            $this->name = $product->name;
            $this->price = $product->price;
            $this->description = $product->description;
            $this->is_active = $product->is_active;
            $this->is_featured = $product->is_featured;
            $this->meta_title = $product->meta_title;
            $this->meta_description = $product->meta_description;

            // Load gambar dari DB ke dalam struktur repeater
            $this->productImages = $product->images->map(function ($img) {
                return [
                    'id' => $img->id,
                    'image_path' => $img->image_path,
                    'is_primary' => (bool) $img->is_primary,
                    'file' => null,
                ];
            })->toArray();
        } else {
            // Jika tambah baru, buat 1 baris repeater kosong secara otomatis
            $this->addImageRow();
        }
    }

    // Tambah baris repeater baru
    public function addImageRow()
    {
        $isFirst = count($this->productImages) === 0;

        $this->productImages[] = [
            'id' => null,
            'image_path' => null,
            'is_primary' => $isFirst, // Otomatis jadi gambar utama jika baris pertama
            'file' => null,
        ];
    }

    // Hapus baris repeater
    public function removeImageRow($index)
    {
        $item = $this->productImages[$index] ?? null;

        if ($item && !empty($item['id'])) {
            // Hapus berkas dan record dari database jika sudah ada sebelumnya
            $imageModel = ProductImage::find($item['id']);
            if ($imageModel) {
                Storage::disk('public')->delete($imageModel->image_path);
                $imageModel->delete();
            }
        }

        $wasPrimary = $item['is_primary'] ?? false;
        unset($this->productImages[$index]);
        $this->productImages = array_values($this->productImages); // Re-index array

        // Jika yang dihapus adalah gambar utama, set gambar pertama yang tersisa jadi utama
        if ($wasPrimary && count($this->productImages) > 0) {
            $this->setPrimaryImage(0);
        }
    }

    // Mengatur satu gambar menjadi utama
    public function setPrimaryImage($selectedIndex)
    {
        foreach ($this->productImages as $index => &$item) {
            $item['is_primary'] = ($index === $selectedIndex);
        }
    }

    protected function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'productImages.*.file' => 'nullable|image|max:2048', // Validation per file repeater
        ];
    }

    public function save()
    {
        $this->validate();

        $product = Product::updateOrCreate(
            ['id' => $this->productId],
            [
                'category_id' => $this->category_id,
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'price' => $this->price,
                'description' => $this->description,
                'is_active' => $this->is_active,
                'is_featured' => $this->is_featured,
                'meta_title' => $this->meta_title,
                'meta_description' => $this->meta_description,
            ]
        );

        // Proses penyimpanan repeater gambar
        foreach ($this->productImages as $item) {
            // Jika ada file baru diupload pada baris ini
            if (isset($item['file']) && is_object($item['file'])) {
                // Jika sebelumnya sudah ada berkas lamanya, hapus dulu
                if (!empty($item['id'])) {
                    $oldImage = ProductImage::find($item['id']);
                    if ($oldImage) {
                        Storage::disk('public')->delete($oldImage->image_path);
                    }
                }

                $path = $item['file']->store('products', 'public');

                ProductImage::updateOrCreate(
                    ['id' => $item['id'] ?? null],
                    [
                        'product_id' => $product->id,
                        'image_path' => $path,
                        'is_primary' => $item['is_primary'] ?? false,
                    ]
                );
            } elseif (!empty($item['id'])) {
                // Hanya update status is_primary jika gambar lama tidak diubah file-nya
                ProductImage::where('id', $item['id'])->update([
                    'is_primary' => $item['is_primary'] ?? false,
                ]);
            }
        }

        // Auto regenerate sitemap jika ada
        if (class_exists(\Illuminate\Support\Facades\Artisan::class)) {
            try {
                \Illuminate\Support\Facades\Artisan::call('sitemap:generate');
            } catch (\Exception $e) {
                // ignore
            }
        }

        session()->flash('message', $this->productId ? 'Produk berhasil diperbarui.' : 'Produk berhasil ditambahkan.');

        return redirect()->route('admin.products');
    }

    public function render()
    {
        $categories = Category::orderBy('name')->get();

        return view('livewire.admin.product-form', compact('categories'))
            ->layout('layouts.app');
    }
}