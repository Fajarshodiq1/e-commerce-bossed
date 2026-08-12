<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\Product;

class CategoryDetail extends Component
{
    use WithPagination;

    public $category;
    public $search = '';

    public function mount($slug)
    {
        // Cari kategori berdasarkan slug
        $this->category = Category::where('slug', $slug)->firstOrFail();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Ambil produk berdasarkan ID kategori ini
        $products = Product::where('category_id', $this->category->id)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(12);

        return view('livewire.public.category-detail', [
            'products' => $products,
        ])->layout('layouts.public', [
                    'metaTitle' => $this->category->name . ' - Produk Kategori',
                    'metaDescription' => $this->category->description ?? 'Lihat semua produk dalam kategori ' . $this->category->name,
                ]);
    }
}