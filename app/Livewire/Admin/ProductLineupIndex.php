<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ProductLineup;
use Illuminate\Support\Facades\Storage;

class ProductLineupIndex extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $filterStatus = 'all'; // 'all', 'active', 'inactive'

    // === State Modal Form ===
    public $showModal = false;
    public $editingId = null;

    public $name = '';
    public $description = '';
    public $price = '';
    public $sort_order = 0;
    public $status = 'active';
    public $image; // file baru (temporary upload)
    public $currentImage = null; // path gambar lama saat edit

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3|max:150',
            'description' => 'nullable|string|max:1000',
            'price' => 'nullable|numeric|min:0',
            'sort_order' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'image' => $this->editingId
                ? 'nullable|image|max:2048'
                : 'required|image|max:2048',
        ];
    }

    protected $messages = [
        'name.required' => 'Nama produk wajib diisi.',
        'image.required' => 'Gambar produk wajib diunggah.',
        'image.image' => 'File harus berupa gambar.',
        'image.max' => 'Ukuran gambar maksimal 2MB.',
        'price.numeric' => 'Harga harus berupa angka.',
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterStatus()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $lineup = ProductLineup::findOrFail($id);

        $this->editingId = $lineup->id;
        $this->name = $lineup->name;
        $this->description = $lineup->description;
        $this->price = $lineup->price;
        $this->sort_order = $lineup->sort_order;
        $this->status = $lineup->status;
        $this->currentImage = $lineup->image;
        $this->image = null;

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['editingId', 'name', 'description', 'price', 'image', 'currentImage']);
        $this->sort_order = 0;
        $this->status = 'active';
        $this->resetErrorBag();
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->image) {
            if ($this->editingId && $this->currentImage) {
                Storage::disk('public')->delete($this->currentImage);
            }
            $validated['image'] = $this->image->store('product-lineups', 'public');
        } else {
            $validated['image'] = $this->currentImage;
        }

        if ($this->editingId) {
            $lineup = ProductLineup::findOrFail($this->editingId);
            $lineup->update($validated);
            session()->flash('message', 'Produk "' . $validated['name'] . '" berhasil diperbarui.');
        } else {
            ProductLineup::create($validated);
            session()->flash('message', 'Produk "' . $validated['name'] . '" berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function toggleStatus($id)
    {
        $lineup = ProductLineup::findOrFail($id);
        $lineup->status = $lineup->status === 'active' ? 'inactive' : 'active';
        $lineup->save();

        session()->flash('message', 'Status "' . $lineup->name . '" berhasil diubah.');
    }

    public function delete($id)
    {
        $lineup = ProductLineup::findOrFail($id);

        if ($lineup->image) {
            Storage::disk('public')->delete($lineup->image);
        }

        $lineup->delete();

        session()->flash('message', 'Produk berhasil dihapus.');
    }

    public function render()
    {
        $query = ProductLineup::query();

        if ($this->filterStatus !== 'all') {
            $query->where('status', $this->filterStatus);
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . trim($this->search) . '%');
        }

        $lineups = $query->orderBy('sort_order')->orderBy('id')->paginate(10);

        return view('livewire.admin.product-lineup-index', [
            'lineups' => $lineups,
        ])->layout('layouts.app');
    }
}