<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Product;
use App\Models\Category;

class GenerateSitemap extends Command
{
    /**
     * Perintah artisan yang dipanggil: php artisan sitemap:generate
     */
    protected $signature = 'sitemap:generate';
    protected $description = 'Auto-generate file sitemap.xml untuk SEO Google Search Console';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // 1. Tambahkan Homepage
        $sitemap->add(
            Url::create('/')
                ->setPriority(1.0)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
        );

        // 2. Tambahkan Semua Halaman Kategori
        Category::all()->each(function (Category $category) use ($sitemap) {
            $sitemap->add(
                Url::create("/category/{$category->slug}")
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            );
        });

        // 3. Tambahkan Semua Produk Aktif
        Product::where('is_active', true)->each(function (Product $product) use ($sitemap) {
            $sitemap->add(
                Url::create("/product/{$product->slug}")
                    ->setPriority(0.9)
                    ->setLastModificationDate($product->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            );
        });

        // Simpan file ke public/sitemap.xml
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Berhasil! File sitemap.xml telah diperbarui di folder public.');
    }
}