<?php

namespace App\Livewire\Admin;

use App\Models\ProductShowcase;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductShowcaseIndex extends Component
{
    use WithFileUploads, WithPagination;

    public $title, $category, $image, $sort_order = 0, $is_active = true;
    public $showcaseId = null;
    public $isModalOpen = false;

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'image' => $this->showcaseId ? 'nullable|image|max:2048' : 'required|image|max:2048',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ];
    }

    public function render()
    {
        return view('livewire.admin.product-showcase-index', [
            'showcases' => ProductShowcase::orderBy('sort_order', 'asc')->latest()->paginate(10),
        ]); // Sesuaikan dengan nama layout admin Anda
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isModalOpen = true;
    }

    public function edit($id)
    {
        $showcase = ProductShowcase::findOrFail($id);
        $this->showcaseId = $showcase->id;
        $this->title = $showcase->title;
        $this->category = $showcase->category;
        $this->sort_order = $showcase->sort_order;
        $this->is_active = $showcase->is_active;
        $this->isModalOpen = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'category' => $this->category,
            'sort_order' => $this->sort_order,
            'is_active' => $this->is_active,
        ];

        if ($this->image) {
            if ($this->showcaseId) {
                $existing = ProductShowcase::find($this->showcaseId);
                if ($existing && $existing->image_path) {
                    Storage::disk('public')->delete($existing->image_path);
                }
            }
            $data['image_path'] = $this->image->store('showcases', 'public');
        }

        ProductShowcase::updateOrCreate(['id' => $this->showcaseId], $data);

        session()->flash('message', $this->showcaseId ? 'Showcase berhasil diperbarui.' : 'Showcase berhasil ditambahkan.');

        $this->closeModal();
    }

    public function toggleActive($id)
    {
        $showcase = ProductShowcase::findOrFail($id);
        $showcase->update(['is_active' => !$showcase->is_active]);
    }

    public function delete($id)
    {
        $showcase = ProductShowcase::findOrFail($id);
        if ($showcase->image_path) {
            Storage::disk('public')->delete($showcase->image_path);
        }
        $showcase->delete();

        session()->flash('message', 'Showcase berhasil dihapus.');
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->showcaseId = null;
        $this->title = '';
        $this->category = '';
        $this->image = null;
        $this->sort_order = 0;
        $this->is_active = true;
        $this->resetErrorBag();
    }
}