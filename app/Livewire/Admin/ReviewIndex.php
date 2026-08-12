<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Review;
use App\Models\Product;

class ReviewIndex extends Component
{
    use WithPagination;

    public $filterStatus = 'all';
    public $search = '';

    // === State untuk Modal Form ===
    public $showModal = false;
    public $editingId = null; // null = mode tambah, terisi = mode edit

    public $product_id = '';
    public $name = '';
    public $email = '';
    public $rating = 5;
    public $comment = '';
    public $status = 'approved'; // default approved karena diinput admin sendiri

    protected function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|min:3|max:100',
            'email' => 'nullable|email|max:150',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
            'status' => 'required|in:pending,approved,rejected',
        ];
    }

    protected $messages = [
        'product_id.required' => 'Silakan pilih produk.',
        'product_id.exists' => 'Produk yang dipilih tidak valid.',
        'name.required' => 'Nama wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'comment.required' => 'Isi ulasan wajib diisi.',
        'comment.min' => 'Ulasan minimal 10 karakter.',
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterStatus()
    {
        $this->resetPage();
    }

    public function setRating($value)
    {
        $this->rating = $value;
    }

    /**
     * Buka modal dalam mode tambah baru
     */
    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    /**
     * Buka modal dalam mode edit, isi form dengan data existing
     */
    public function edit($id)
    {
        $review = Review::findOrFail($id);

        $this->editingId = $review->id;
        $this->product_id = $review->product_id;
        $this->name = $review->name;
        $this->email = $review->email;
        $this->rating = $review->rating;
        $this->comment = $review->comment;
        $this->status = $review->status;

        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['editingId', 'product_id', 'name', 'email', 'comment']);
        $this->rating = 5;
        $this->status = 'approved';
        $this->resetErrorBag();
    }

    /**
     * Simpan data (create atau update tergantung editingId)
     */
    public function save()
    {
        $validated = $this->validate();

        if ($this->editingId) {
            $review = Review::findOrFail($this->editingId);
            $review->update($validated);
            session()->flash('message', 'Ulasan dari ' . $validated['name'] . ' berhasil diperbarui.');
        } else {
            Review::create($validated);
            session()->flash('message', 'Ulasan dari ' . $validated['name'] . ' berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function updateStatus($id, $status)
    {
        $allowedStatuses = ['pending', 'approved', 'rejected'];

        if (!in_array($status, $allowedStatuses)) {
            return;
        }

        $review = Review::findOrFail($id);
        $review->update(['status' => $status]);

        $statusText = [
            'approved' => 'disetujui',
            'rejected' => 'ditolak',
            'pending' => 'dikembalikan ke pending'
        ];

        session()->flash('message', 'Ulasan dari ' . $review->name . ' berhasil ' . ($statusText[$status] ?? $status) . '.');
    }

    public function delete($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        session()->flash('message', 'Ulasan berhasil dihapus.');
    }

    public function render()
    {
        $query = Review::query()->with('product');

        if ($this->filterStatus !== 'all') {
            $query->where('status', $this->filterStatus);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $searchTerm = '%' . trim($this->search) . '%';
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm)
                    ->orWhere('comment', 'like', $searchTerm)
                    ->orWhereHas('product', function ($pq) use ($searchTerm) {
                        $pq->where('name', 'like', $searchTerm);
                    });
            });
        }

        $reviews = $query->latest()->paginate(10);

        return view('livewire.admin.review-index', [
            'reviews' => $reviews,
            'products' => Product::orderBy('name')->get(['id', 'name']), // untuk dropdown modal
        ])->layout('layouts.app');
    }
}