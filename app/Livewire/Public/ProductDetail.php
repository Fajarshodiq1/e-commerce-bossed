<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Product;
use App\Models\WebSetting;
use Illuminate\Support\Str;

class ProductDetail extends Component
{
    public $product;
    public $whatsappNumber;
    public $activeImage = null;

    public function mount($slug)
    {
        $this->product = Product::with(['category', 'images', 'primaryImage'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $this->whatsappNumber = WebSetting::getByKey('whatsapp_number', '6281234567890');

        $primary = $this->product->primaryImage ?? $this->product->images->first();
        if ($primary) {
            $this->activeImage = $primary->image_path;
        }
    }

    public function setActiveImage($imagePath)
    {
        $this->activeImage = $imagePath;
    }

    public function render()
    {
        $storeName = WebSetting::getByKey('store_name', config('app.name', 'Bossed'));

        // URL Gambar untuk Open Graph (WhatsApp/Social Media)
        $ogImage = $this->activeImage
            ? asset('storage/' . $this->activeImage)
            : asset('assets/BOOSED_LOGO.png'); 

        // Clean meta description (hapus HTML tag dan batasi 150 karakter)
        $cleanDescription = $this->product->meta_description
            ?: Str::limit(strip_tags($this->product->description), 150);

        // Related Products
        $relatedProducts = Product::with(['primaryImage', 'category'])
            ->where('category_id', $this->product->category_id)
            ->where('id', '!=', $this->product->id)
            ->where('is_active', true)
            ->latest()
            ->take(4)
            ->get();

        // Template Pesan WA
        $message = "Halo " . $storeName . ", saya berminat dengan produk:\n\n";
        $message .= "*Nama Produk:* " . $this->product->name . "\n";
        $message .= "*Harga:* Rp " . number_format($this->product->price, 0, ',', '.') . "\n";
        $message .= "*Link Produk:* " . url()->current() . "\n\n";
        $message .= "Apakah stok masih tersedia?";

        $waUrl = "https://wa.me/" . preg_replace('/[^0-9]/', '', $this->whatsappNumber) . "?text=" . urlencode($message);

        return view('livewire.public.product-detail', [
            'waUrl' => $waUrl,
            'relatedProducts' => $relatedProducts,
        ])->layout('layouts.public', [
                    'metaTitle' => ($this->product->meta_title ?: $this->product->name) . ' - ' . $storeName,
                    'metaDescription' => $cleanDescription,
                    'metaImage' => $ogImage,
                    'metaType' => 'product',
                ]);
    }
}