<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use App\Models\Partner;
use App\Models\Testimonial;
use App\Models\ProductLineup;
use App\Models\WebSetting;

class HomeIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $sort = 'latest';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => ''],
        'sort' => ['except' => 'latest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        // 1. Query Produk
        $query = Product::with('category')->where('is_active', true);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedCategory) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', $this->selectedCategory);
            });
        }

        switch ($this->sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12);

        // 2. Data Koleksi
        $categories = Category::withCount('products')->orderBy('name', 'asc')->get();
        $partners = Partner::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        $testimonials = Testimonial::approved()->latest()->take(6)->get();
        $productLineups = ProductLineup::active()->get();

        // 3. Data Pengaturan Web
        $storeName = WebSetting::getByKey('store_name', config('app.name', 'Bossed'));
        $heroImage = WebSetting::getByKey('img_hero_home');
        $aboutImage = WebSetting::getByKey('img_about_home');
        $waNumber = WebSetting::getByKey('whatsapp_number');

        // 4. Meta SEO
        $metaTitle = WebSetting::getByKey('meta_title_global', $storeName . ' - Katalog Produk Terlengkap');
        $metaDescription = WebSetting::getByKey('meta_description_global', 'Lihat katalog produk berkualitas kami dan pesan via WhatsApp.');

        return view('livewire.public.home-index', compact(
            'products',
            'categories',
            'partners',
            'testimonials',
            'productLineups',
            'storeName',
            'heroImage',
            'aboutImage',
            'waNumber'
        ))->layout('layouts.public', [
                    'metaTitle' => $metaTitle,
                    'metaDescription' => $metaDescription,
                ]);
    }
}