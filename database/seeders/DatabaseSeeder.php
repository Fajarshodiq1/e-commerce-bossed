<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\WebSetting;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin (Hanya untuk pengelola toko)
        User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Default Web Settings (Konfigurasi WhatsApp & SEO Global)
        $settings = [
            'store_name' => 'Toko Onlineku',
            'whatsapp_number' => '6281234567890',
            'whatsapp_template' => 'Halo {store_name}, saya tertarik untuk memesan produk *{product_name}* (Harga: Rp {product_price}). Mohon info selengkapnya: {product_url}',
            'meta_title_global' => 'Toko Onlineku - Katalog Produk Terlengkap & Terpercaya',
            'meta_description_global' => 'Lihat katalog produk berkualitas kami dan lakukan pemesanan secara langsung dan cepat via WhatsApp.',
        ];

        foreach ($settings as $key => $value) {
            WebSetting::create([
                'key' => $key,
                'value' => $value,
            ]);
        }

        // 3. Sample Kategori
        $catElektronik = Category::create([
            'name' => 'Elektronik',
            'slug' => 'elektronik',
        ]);

        $catFashion = Category::create([
            'name' => 'Fashion',
            'slug' => 'fashion',
        ]);

        // 4. Sample Produk
        $product = Product::create([
            'category_id' => $catElektronik->id,
            'name' => 'Smartphone Flagship Pro',
            'slug' => 'smartphone-flagship-pro',
            'price' => 8500000.00,
            'description' => "Spesifikasi Unggulan:\n- Layar AMOLED 120Hz\n- Kamera 108MP\n- Baterai 5000mAh Fast Charging\n\nHubungi kami via WhatsApp untuk order atau tanya stok!",
            'is_active' => true,
            'is_featured' => true,
            'meta_title' => 'Beli Smartphone Flagship Pro Garansi Resmi',
            'meta_description' => 'Dapatkan Smartphone Flagship Pro original dengan harga khusus hari ini. Pesan langsung via WhatsApp.',
        ]);

        // Sample Gambar Produk
        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => 'products/sample-phone.jpg',
            'is_primary' => true,
        ]);

        // 5. Sample Reviews (Testimoni Publik)
        Review::create([
            'product_id' => $product->id,
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'rating' => 5,
            'comment' => 'Respon WhatsApp sangat cepat dan barang sampai sesuai pesanan!',
            'status' => 'approved',
        ]);

        Review::create([
            'product_id' => $product->id,
            'name' => 'Siti Rahma',
            'email' => 'siti@example.com',
            'rating' => 4,
            'comment' => 'Produk bagus, pengemasan rapi.',
            'status' => 'pending', // Menunggu moderasi admin
        ]);
    }
}