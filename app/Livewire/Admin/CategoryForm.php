<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryForm extends Component
{
    use WithFileUploads;

    public $categoryId;
    public $name;
    public $image;
    public $oldImage;
    public $description;
    
    public function mount($id = null)
    {
        if ($id) {
            $category = Category::findOrFail($id);
            $this->categoryId = $category->id;
            $this->name = $category->name;
            $this->description = $category->description;
            $this->oldImage = $category->image;
        }
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|max:1024', // Max 1MB
        ];
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->oldImage;
        if ($this->image) {
            if ($this->oldImage) {
                Storage::disk('public')->delete($this->oldImage);
            }
            $imagePath = $this->image->store('categories', 'public');
        }

        Category::updateOrCreate(
            ['id' => $this->categoryId],
            [
                'name' => $this->name,
                'description' => $this->description,
                'slug' => Str::slug($this->name),
                'image' => $imagePath,
            ]
        );

        // Auto regenerate sitemap
        \Illuminate\Support\Facades\Artisan::call('sitemap:generate');

        session()->flash('message', $this->categoryId ? 'Kategori berhasil diperbarui.' : 'Kategori berhasil ditambahkan.');

        return redirect()->route('admin.categories');
    }

    public function render()
    {
        return view('livewire.admin.category-form')
            ->layout('layouts.app');
    }
}