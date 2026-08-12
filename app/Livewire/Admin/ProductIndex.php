<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $product = Product::with('images')->findOrFail($id);

        // Hapus file gambar dari storage
        foreach ($product->images as $image) {
            if ($image->image_path) {
                Storage::disk('public')->delete($image->image_path);
            }
        }

        $product->delete();

        // Regenerate sitemap otomatis
        \Illuminate\Support\Facades\Artisan::call('sitemap:generate');

        session()->flash('message', 'Produk berhasil dihapus.');
    }

    public function render()
    {
        $categories = Category::orderBy('name')->get();

        $products = Product::with(['category', 'primaryImage'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('category_id', $this->categoryFilter);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.product-index', compact('products', 'categories'))
            ->layout('layouts.app');
    }
}